<?php

namespace App\Http\Controllers\Auth;

use App\Events\NewsConsentUpdated;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\SmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function create()
    {
        if (Auth::check()) {
            return redirect()->route('user.dashboard.page');
        }

        return view('auth.register');
    }

    public function store(
        Request $request,
        SmsService $smsService
    ) {
        $validated = $request->validate([
            'email' => [
                'required',
                'email',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'min:8',
            ],

            'password_confirmation' => [
                'required',
                'same:password',
            ],

            'name' => [
                'required',
                'string',
            ],

            'phone_number' => [
                'required',
                'size:11',
                'regex:/^09\d{9}$/',

                function ($attribute, $value, $fail) {
                    $formattedPhone = $this->formatForDb($value);

                    $phoneExists = User::where(
                        'phone_number',
                        $formattedPhone
                    )->exists();

                    if ($phoneExists) {
                        $fail('● این شماره تلفن قبلاً ثبت شده است!');
                    }
                },
            ],
        ], [
            'email.required'                 =>         '● لطفا این فیلد را تکمیل کنید!',
            'email.email'                    =>         '● لطفا ایمیل خود را درست وارد کنید!',
            'email.unique'                   =>         '● این ایمیل قبلاً ثبت شده است!',

            'password.required'              =>         '● لطفا این فیلد را تکمیل کنید!',
            'password.min'                   =>         '● رمز عبور باید حداقل 8 کاراکتر باشد!',

            'password_confirmation.required' =>         '● لطفا این فیلد را تکمیل کنید!',
            'password_confirmation.same'     =>         '● رمز عبور با تکرار آن مطابقت ندارد!',

            'phone_number.required'          =>         '● لطفا این فیلد را تکمیل کنید!',
            'phone_number.size'              =>         '● شماره تلفن صحیح نمی‌باشد!',
            'phone_number.regex'             =>         '● شماره تلفن صحیح نمی‌باشد!',

            'name.required'                  =>         '● لطفا این فیلد را تکمیل کنید!',
            'name.string'                    =>         '● این نام صحیح نمی‌باشد!',
        ]); 

        $phoneNumber = $this->formatForDb(
            $validated['phone_number']
        );

        $user = User::create([
            'name'              => $validated['name'],
            'email'             => $validated['email'],
            'email_verified_at' => now(),
            'password'          => Hash::make($validated['password']),
            'phone_number'      => $phoneNumber,
            'smsConsent'        => $request->boolean('smsConsent'),
            'newsConsent'       => $request->boolean('newsConsent'),
            'is_active'         => true,
        ]);

        NewsConsentUpdated::dispatch(
            $user,
            $request->boolean('newsConsent')
        );

        $smsSent = $smsService->sendRegistrationSuccess(
            phoneNumber: $user->phone_number,
            name: $user->name
        );

        if (!$smsSent) {
            Log::warning(
                'کاربر ثبت‌نام شد، اما پیامک ثبت‌نام ارسال نشد.',
                [
                    'user_id'      => $user->id,
                    'phone_number' => $user->phone_number,
                ]
            );
        }

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()
            ->route('user.dashboard.page')
            ->with(
                'success',
                'ثبت‌نام شما با موفقیت انجام شد.'
            );
    }


// convert phone number format for save in database

    private function formatForDb(string $phoneNumber): string
    {
        $rawPhone = preg_replace('/\D+/', '', $phoneNumber);

        if (str_starts_with($rawPhone, '0')) {
            $rawPhone = '98' . substr($rawPhone, 1);
        }

        return sprintf(
            '+%s-%s-%s-%s',
            substr($rawPhone, 0, 2),
            substr($rawPhone, 2, 3),
            substr($rawPhone, 5, 3),
            substr($rawPhone, 8, 4)
        );
    }
}
