<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        $user = $request->user();

        $is_admin = $user->is_admin;

        return view('pages.dashboard-edit-profile', compact('user' , 'is_admin'));
    }

    private function toDbPhone(?string $raw): ?string
    {
        if (!$raw) {
            return null;
        }

        $raw = preg_replace('/\D+/', '', $raw);

        if (preg_match('/^09\d{9}$/', $raw)) {
            return '+98-' . substr($raw, 1, 3) . '-' . substr($raw, 4, 3) . '-' . substr($raw, 7, 4);
        }

        return $raw;
    }

    // User Account
    public function updateAccount(Request $request)
    {
        $user = $request->user();

        $rawPhone = $request->input('phone_number');

        $formattedPhoneForDb = $this->toDbPhone($rawPhone);

        $validator = Validator::make(
            $request->all(),
            [
                'name'                  => ['required', 'string', 'max:50',],
                'username'              => ['nullable','string','max:25','unique:users,username,' . $user->id,],
                'email'                 => ['required','string','email','max:255','unique:users,email,' . $user->id,],
                'phone_number'          => ['required','string','regex:/^09\d{9}$/',],
                'avatar'                => ['nullable','image','mimes:jpeg,png,jpg,gif','max:2048',],
                'job_title'             => ['nullable','string','max:70',],
                'province'              => ['nullable','string',],
                'bio'                   => ['nullable','string','max:1000',],
                'gender'                => ['nullable',],
            ],
            [
                'name.required'         => '● لطفا این فیلد را تکمیل کنید !',
                'name.string'           => '● نام صحیح نمی باشد !',
                'name.max'              => '● نام باید حداکثر 50 کاراکتر باشد !',

                'username.string'       => '● نام کاربری صحیح نمی باشد !',
                'username.max'          => '● نام کاربری باید حداکثر 25 کاراکتر باشد !',
                'username.unique'       => '● این نام کاربری قبلا ثبت شده است !',

                'email.required'        => '● لطفا این فیلد را تکمیل کنید !',
                'email.string'          => '● ایمیل صحیح نمی باشد !',
                'email.email'           => '● ایمیل صحیح نمی باشد !',
                'email.unique'          => '● این ایمیل قبلا ثبت شده است !',

                'phone_number.required' => '● لطفا این فیلد را تکمیل کنید !',
                'phone_number.regex'    => '● شماره تلفن باید مانند 09123456789 باشد !',

                'avatar.image'          => '● این تصویر مجاز نمی باشد !',
                'avatar.max'            => '● حجم تصویر نباید بیشتر از 2 مگابایت باشد !',
                'avatar.mimes'          => '● پسوند این تصویر مجاز نمی باشد !',

                'job_title.string'      => '● این عنوان شغلی مجاز نمی باشد !',
                'job_title.max'         => '● عنوان شغلی باید حداکثر 70 کاراکتر باشد !',

                'province.string'       => '● استان صحیح نمی باشد !',

                'bio.string'            => '● این مقدار بیوگرافی صحیح نمی باشد !',
                'bio.max'               => '● بیوگرافی باید حداکثر 1000 کاراکتر باشد !',
            ]
        );

        $validator->after(function ($validator) use (
            $rawPhone,
            $formattedPhoneForDb,
            $user
        ) {

            if (!preg_match('/^09\d{9}$/', (string) $rawPhone)) {
                return;
            }

            $phoneExists = User::query()
                ->where('phone_number', $formattedPhoneForDb)
                ->where('id', '!=', $user->id)
                ->exists();

            if ($phoneExists) {
                $validator->errors()->add(
                    'phone_number',
                    '● این شماره تماس قبلا ثبت شده است !'
                );
            }
        });

        $validated = $validator->validate();

        $validated['phone_number'] = $formattedPhoneForDb;



        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');

            if ($file->isValid()) {
                if (
                    $user->avatar &&
                    \Storage::disk('public')->exists($user->avatar)
                ) {
                    \Storage::disk('public')->delete($user->avatar);
                }

                $path = $file->store('avatars', 'public');
                $validated['avatar'] = $path;
            }
        } elseif ($request->input('remove_avatar') === '1') {
            if (
                $user->avatar &&
                \Storage::disk('public')->exists($user->avatar)
            ) {
                \Storage::disk('public')->delete($user->avatar);
            }

            $validated['avatar'] = null;
        }

        $user->update($validated);

        return redirect()
            ->route('profile.edit')
            ->with('success', 'اطلاعات کاربری با موفقیت به‌روزرسانی شد.');
    }

    // Social networks
    public function updateSocials(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'facebook'     => ['nullable', 'url', 'max:255'],
            'linkedin'     => ['nullable', 'url', 'max:255'],
            'twitter'      => ['nullable', 'url', 'max:255'],
        ], [
            'facebook.url' => '● آدرس صحیح نمی باشد !',
            'facebook.max' => '● آدرس باید حداکثر 70 کاراکتر باشد !',

            'linkedin.url' => '● آدرس صحیح نمی باشد !',
            'linkedin.max' => '● آدرس باید حداکثر 70 کاراکتر باشد !',

            'twitter.url'  => '● آدرس صحیح نمی باشد !',
            'twitter.max'  => '● آدرس باید حداکثر 70 کاراکتر باشد !',
        ]);

        $user->update($validated);

        return redirect()->route('profile.edit')->with('success', 'شبکه‌های اجتماعی با موفقیت به‌روزرسانی شدند.');
    }

    // Account Settings
    public function updateSettings(Request $request)
    {
        $user = $request->user();

        $user->update([
            'showProfile'       => $request->has('showProfile'),
            'smsConsent'        => $request->has('smsConsent'),
            'newsConsent'       => $request->has('newsConsent'),
        ]);

        return redirect()->route('profile.edit')->with('success', 'تنظیمات حساب کاربری با موفقیت به‌روزرسانی شد.');
    }

    // Change Password
    public function updatePassword(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'current_password'                   => ['required', 'current_password'],
            'password'                           => ['required', 'min:8', Password::defaults()],
            'password_confirmation'              => ['required', 'same:password'],
        ], [
            'current_password.required'          => '● لطفا این فیلد را تکمیل کنید !',
            'current_password.current_password'  => '● رمز عبور صحیح نمی باشد !',

            'password.required'                  => '● لطفا این فیلد را تکمیل کنید !',
            'password.min'                       => '● رمز عبور باید حداقل 8 کاراکتر باشد!',

            'password_confirmation.required'     => '● لطفا این فیلد را تکمیل کنید !',
            'password_confirmation.same'         => '● رمز عبور با تکرار آن مطابقت ندارد !',
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);
        
        return redirect()->route('profile.edit')->with('success', 'رمز عبور با موفقیت تغییر کرد.');
    }
}
