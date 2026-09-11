@extends('layouts.layout-site')


{{-- ===(title)=== --}}
@section('title')
    وبلاگ | صفحه فراموشی رمزعبور
@endsection


{{-- ====(main)=== --}}
@section('site-content')
    <!-- ======================= Inner intro START -->
    <section>
        <div class="container mb-5 mt-5">
            <div class="row">
                <div class="col-md-12 col-lg-8 col-xl-8 mx-auto ">
                    <div class="p-4 p-sm-5  rounded custom-box-shadow">
                        <h2>فراموشی رمز عبور</h2>

                        @if (session('dev_otp'))
                            <p class="text-yellow-400 text-sm mb-4">کد تست (فقط محیط توسعه): {{ session('dev_otp') }}</p>
                        @endif

                        <!-- Form START -->
                        <form class="mt-4" method="post" action="{{ route('password.email') }}">

                            @csrf

                            {{-- @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif --}}

                            <div class="mb-4 mt-5">
                                <label class="form-label">شماره موبایل<sup class="text-danger ms-1">*</sup></label>
                                <input type="text" class="form-control mb-1" name="phone_number" value="{{ old('phone_number') }}">
                                <label class="small" style="color:rgb(182, 24, 24);">
                                    @error('phone_number')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-success">
                                    ارسال کد تایید
                                </button>

                                <a href="{{ route('login') }}">
                                    <button type="button" class="btn btn-primary">
                                        بازگشت
                                    </button>
                                </a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======================= Inner intro END -->
@endsection
