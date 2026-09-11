<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordResetOtp;
use App\Models\User;
use App\Services\SmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ForgotPasswordController extends Controller
{
    public function showPhoneForm()
    {
        return view('auth.forgot-password');
    }

    public function sendOtp(Request $request, SmsService $smsService)
    {
        $request->validate([
            'phone_number' => [
                'required',
                'regex:/^09\d{9}$/',
                function ($attribute, $value, $fail) {
                    $formatted = $this->formatForDb($value);
                    if (!User::where('phone_number', $formatted)->exists()) {
                        $fail('● این شماره تلفن قبلاً ثبت نشده است!');
                    }
                },
            ],
        ], [
            'phone_number.required' => '● لطفا این فیلد را تکمیل کنید !',
            'phone_number.regex'    => '● شماره تلفن صحیح نمی باشد !',
        ]);

        $formattedPhone = $this->formatForDb($request->phone_number);
        $otp = (string) rand(10000, 99999);

        $sent = $smsService->sendForgotPasswordCode($formattedPhone, $otp);

        if (!$sent) {
            return back()->withErrors(['phone_number' => '● خطا در ارسال پیامک. لطفا دوباره تلاش کنید.']);
        }

        PasswordResetOtp::updateOrCreate(
            ['phone_number' => $formattedPhone],
            ['otp' => $otp, 'expires_at' => now()->addMinutes(5)]
        );

        session(['reset_phone' => $formattedPhone]);

        return redirect()->route('password.verify-otp')
            ->with('status', 'کد تایید برای شما پیامک شد.');
    }

    public function showOtpForm()
    {
        if (!session('reset_phone')) {
            return redirect()->route('password.request');
        }
        return view('auth.verify-otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:5',
        ],[
            'otp.required' => '● لطفا این فیلد را تکمیل کنید !',
            'otp.digits'   => '● کد باید 5 رقم باشد !',
        ]);

        $record = PasswordResetOtp::where('phone_number', session('reset_phone'))
            ->where('otp', $request->otp)
            ->where('expires_at', '>', now())
            ->first();

        if (!$record) {
            return back()->withErrors(['otp' => '● کد وارد شده صحیح نیست یا منقضی شده است.']);
        }

        session(['otp_verified' => true]);

        return redirect()->route('password.reset-form');
    }

    public function showResetForm()
    {
        if (!session('otp_verified') || !session('reset_phone')) {
            return redirect()->route('password.request');
        }
        return view('auth.reset-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password'              => ['required', Rules\Password::defaults()],
            'password_confirmation' => ['required' , 'same:password'],
        ],[
            'password.required'              => '● لطفا این فیلد را تکمیل کنید !',
            'password_confirmation.required' => '● لطفا این فیلد را تکمیل کنید !',
            'password_confirmation.same'     => '● رمز عبور با تکرار آن مطابقت ندارد !',
        ]);

        $user = User::where('phone_number', session('reset_phone'))->first();
        
        if ($user) {
            $user->update(['password' => Hash::make($request->password)]);
            
            PasswordResetOtp::where('phone_number', session('reset_phone'))->delete();
            session()->forget(['reset_phone', 'otp_verified']);

            return redirect()->route('login')->with('status', 'رمز عبور با موفقیت تغییر یافت.');
        }

        return redirect()->route('password.request');
    }

    private function formatForDb($value) {
        $raw = preg_replace('/\D+/', '', $value);
        if (str_starts_with($raw, '0')) {
            $raw = '98' . substr($raw, 1);
        }
        return sprintf('+%s-%s-%s-%s',
            substr($raw, 0, 2),
            substr($raw, 2, 3),
            substr($raw, 5, 3),
            substr($raw, 8, 4)
        );
    }
}
