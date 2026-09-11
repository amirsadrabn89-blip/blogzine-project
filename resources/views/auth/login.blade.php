@extends('layouts.layout-site')


{{-- ===(title)=== --}}
@section('title')
    وبلاگ | صفحه ورود
@endsection


{{-- ====(main)=== --}}
@section('site-content')
    <!-- ======================= Inner intro START -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8 col-xl-8 mx-auto ">
                    <div class="p-4 p-sm-5  rounded custom-box-shadow">
                        <h2>ورود به حساب کاربری</h2>
                        <!-- Form START -->
                        <form class="mt-4" method="post" action="{{ route('login.check') }}">

                            @csrf

                            <!-- Email -->
                            <div class="mb-1 mt-2">
                                <label class="form-label" for="email">ایمیل<sup class="text-danger ms-1">*</sup></label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                                <label class="small" style="color:rgb(182, 24, 24);">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <!-- Password -->
                            <div class="mb-1 mt-2">
                                <label class="form-label" for="password">رمز عبور<sup class="text-danger ms-1">*</sup></label>
                                <input type="password" class="form-control" id="password" name="password">
                                <label class="small" class="small" style="color:rgb(182, 24, 24);">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>
                            <a href="{{ route('password.request') }}"><u class="text-decoration-none">فراموشی رمز عبور</u></a>

                            <!-- Checkbox -->
                            <div class="mb-3 mt-4 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">مرا به خاطر بسپار</label>
                            </div>

                            <!-- Button -->
                            <div class="row align-items-center mt-4">
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-success">ورود </button>
                                </div>
                                <div class="col-sm-8 text-sm-end">
                                    <span>آیا هنوز ثبت نام نکرده اید؟ <a href="{{ route('register') }}"><u class="text-decoration-none">ثبت نام</u></a></span>
                                </div>
                            </div>
                        </form>
                        <!-- Form END -->
                        <hr>
                        <!-- Social-media btn -->
                        <div class="text-center">
                            <p>برای دسترسی سریع، با شبکه اجتماعی خود وارد شوید</p>
                            <ul class="list-unstyled d-sm-flex mt-3 justify-content-center">
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
