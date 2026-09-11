@extends('layouts.layout-site')


{{-- ===(title)=== --}}
@section('title')
    وبلاگ | صفحه ثبت نام
@endsection


{{-- ====(main)=== --}}
@section('site-content')
    <!-- ======================= Inner intro START -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8 col-xl-8 mx-auto ">
                    <div class="rounded custom-box-shadow rounded p-4 p-sm-5">
                        <h2>ثبت نام در سایت </h2>
                        <!-- Form START -->
                        <form class="mt-4" method="post" action="{{ route('register.check') }}">

                            @csrf

                            <!-- Name -->
                            <div class="mb-1 mt-2">
                                <label class="form-label" for="name">نام <sup class="text-danger ms-1">*</sup></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                                <label class="small" style="color:rgb(182, 24, 24);">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <!-- Email -->
                            <div class="mb-1 mt-2">
                                <label class="form-label" for="email">ایمیل<sup class="text-danger ms-1">*</sup></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                                <label class="small" style="color:rgb(182, 24, 24);">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <!-- Phone number -->
                            <div class="mb-1 mt-2">
                                <label class="form-label" for="phone_number">شماره تلفن<sup class="text-danger ms-1">*</sup></label>
                                <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number') }}">
                                <label class="small" style="color:rgb(182, 24, 24);">
                                    @error('phone_number')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <!-- Password -->
                            <div class="mb-1 mt-1">
                                <label class="form-label" for="password">رمز عبور<sup class="text-danger ms-1">*</sup></label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="">
                                <div id="password-strength" class="mb-1 d-flex gap-1 w-100">
                                    <div class="strength-password-part" id="strength_password_1"></div>
                                    <div class="strength-password-part" id="strength_password_2"></div>
                                    <div class="strength-password-part" id="strength_password_3"></div>
                                    <div class="strength-password-part" id="strength_password_4"></div>
                                    <div class="strength-password-part" id="strength_password_5"></div>
                                </div>
                                <label style="color:rgb(182, 24, 24);">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="mb-1 mt-1">
                                <label class="form-label" for="password_confirmation">تایید رمز عبور<sup class="text-danger ms-1">*</sup></label>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" value="">
                                <label class="small" style="color:rgb(182, 24, 24);">
                                    @error('password_confirmation')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            {{-- <!-- Gender -->
                                <div class="mb-4 mt-1">
                                    <label class="form-label">جنسیت</label>
                                    <select class="js-example-basic-single form-select w-100" id="gender" name="gender">
                                        <option value="doNotWantSay" {{ old('gender') == 'doNotWantSay' ? 'selected' : '' }} >ترجیح می دهم نگویم</option>
                                        <option value="male"         {{ old('gender') == 'male'         ? 'selected' : '' }} >مرد</option>
                                        <option value="female"       {{ old('gender') == 'female'       ? 'selected' : '' }} >زن</option>
                                        <option value="other"        {{ old('gender') == 'other'        ? 'selected' : '' }} >سایر</option>
                                    </select>
                                </div> --}}

                            <!-- permissions -->
                            <div class="mt-3">
                                <!-- send SMS permission -->
                                <div class="form-check mb-2 ">
                                    <input type="checkbox" class="form-check-input" id="smsConsent" value="1" name="smsConsent" {{ old('smsConsent') ? 'checked' : '' }}>
                                    <label class="form-check-label" id="smsConsent">مایلم اخبار جدید را از طریق پیامک دریافت کنم.</label>
                                </div>

                                <!-- receive news permission -->
                                <div class="form-check mb-4">
                                    <input type="checkbox" class="form-check-input" id="newsConsent" value="1" name="newsConsent" {{ old('newsConsent') ? 'checked' : '' }}>
                                    <label class="form-check-label" id="newsConsent">مایلم اخبار جدید را از طریق ایمیل دریافت کنم.</label>
                                </div>
                            </div>

                            <!-- Button -->
                            <div class="row align-items-center">
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-success">ثبت نام</button>
                                </div>
                                <div class="col-sm-8 text-sm-end">
                                    <span>آیا قبلا ثبت نام کرده اید؟ <a href="{{ route('login') }}"><u class="text-decoration-none">ورود</u></a></span>
                                </div>
                            </div>
                        </form>
                        <!-- Form END -->
                        <hr>
                        <!-- Social-media btn -->
                        <div class="text-center">
                            <p>می توانید با شبکه اجتماعی خود وارد شوید</p>
                            <ul class="list-unstyled d-flex mt-3 justify-content-center">
                                <li class="mx-2">
                                    <a href="#" class="btn btn-light d-inline-block fs-6">github<i class="fab fa-github text-dark align-middle ms-2 fs-5"></i></a>
                                </li>
                                <li class="mx-2">
                                    <a href="#" class="btn btn-light d-inline-block fs-6">google<i class="fab fa-google text-danger align-middle ms-2 fs-5"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======================= Inner intro END -->
@endsection

@push('scripts')
    <script>
        // password strength profile
        document.addEventListener("DOMContentLoaded", function() {
            const passwordInput = document.getElementById("password");

            const parts = [
                document.getElementById("strength_password_1"),
                document.getElementById("strength_password_2"),
                document.getElementById("strength_password_3"),
                document.getElementById("strength_password_4"),
                document.getElementById("strength_password_5")
            ];

            passwordInput.addEventListener("input", function() {
                const password = passwordInput.value;
                let score = 0;

                if (password.length > 0) {
                    if (password.length >= 8) score++;
                    if (/[a-z]/.test(password)) score++;
                    if (/[A-Z]/.test(password)) score++;
                    if (/[0-9]/.test(password)) score++;
                    if (/[^a-zA-Z0-9]/.test(password)) score++;
                }

                parts.forEach(part => {
                    if (part) part.style.backgroundColor = "rgba(0, 0, 0, 0.2)";
                });

                let color = "";
                switch (score) {
                    case 1:
                        color = "#dc3545";
                        break;
                    case 2:
                        color = "#fd7e14";
                        break;
                    case 3:
                        color = "#ffc107";
                        break;
                    case 4:
                        color = "#9acd32";
                        break;
                    case 5:
                        color = "#198754";
                        break;
                }

                for (let i = 0; i < score; i++) {
                    if (parts[i]) {
                        parts[i].style.backgroundColor = color;
                    }
                }
            });
        });
    </script>
@endpush
