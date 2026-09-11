@extends('layouts.layout-site')

{{-- ===(title)=== --}}
@section('title')
    وبلاگ | ارتباط ما
@endsection

@section('site-content')
    <main class="py-5">
        <div class="container">

            {{-- Header --}}
            <div class="text-center mb-5">

                <h1 class="news-section-title fw-bold mb-3">
                    تماس با ما
                </h1>

                <div class="border-bottom border-primary border-2 opacity-1 mx-auto" style="width: 150px;">
                </div>

                <p class=" mt-3 mb-0">
                    برای ارتباط با ما، ارسال پیشنهادها و بیان دیدگاه‌های خود از فرم زیر استفاده کنید.
                </p>
            </div>

            <div class="row g-4">

                {{-- Contact Information --}}
                <div class="col-lg-5">
                    <div class="h-100 p-4 p-md-5 rounded-4 bg-light border shadow-sm">

                        <span class="badge text-bg-info mb-3">
                            ارتباط با ما
                        </span>

                        <h4 class="fw-bold mb-4">
                            خوشحال می‌شویم صدای شما را بشنویم
                        </h4>

                        <p class=" lh-lg mb-4">
                            اگر سؤال، پیشنهاد یا انتقادی دارید، از طریق اطلاعات زیر یا فرم تماس
                            با ما در ارتباط باشید. پیام شما در سریع‌ترین زمان ممکن بررسی خواهد شد.
                        </p>

                        <div class="mb-4">
                            <h6 class="fw-bold mb-2">ایمیل</h6>
                            <a href="mailto:info@example.com" class="text-decoration-none ">
                                info@example.com
                            </a>
                        </div>

                        <div class="mb-4">
                            <h6 class="fw-bold mb-2">شماره تماس</h6>
                            <a href="tel:09123456789" class="text-decoration-none ">
                                ۰۹۱۲۳۴۵۶۷۸۹
                            </a>
                        </div>

                        <div>
                            <h6 class="fw-bold mb-2">نشانی</h6>
                            <p class=" mb-0">
                                ایران، بیرجند
                            </p>
                        </div>

                    </div>
                </div>

                {{-- Contact Form --}}
                <div class="col-lg-7">
                    <div class="p-4 p-md-5 rounded-4 bg-light border shadow-sm">

                        <span class="badge text-bg-success mb-3">
                            ارسال پیام
                        </span>

                        <h4 class="fw-bold mb-4">
                            پیام خود را برای ما ارسال کنید
                        </h4>

                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf

                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label for="name" class="form-label">
                                        نام و نام خانوادگی
                                    </label>

                                    <input type="text" id="name" name="name" disabled value="@if (!auth()->user()?->is_admin) {{ auth()->user()?->name }} @endif" class="form-control">

                                    <label class="small" style="color:rgb(182, 24, 24);">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label">
                                        ایمیل
                                    </label>

                                    <input type="email" id="email" name="email" disabled value="@if (!auth()->user()?->is_admin) {{ auth()->user()?->email }} @endif" class="form-control">

                                    <label class="small" style="color:rgb(182, 24, 24);">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>

                                <div class="col-12">
                                    <label for="subject" class="form-label">
                                        موضوع پیام
                                    </label>

                                    <input type="text" id="subject" name="subject" value="{{ old('subject') }}" class="form-control @error('subject') is-invalid @enderror" @guest disabled @endguest @if (auth()->user()?->is_admin) disabled @endif>

                                    <label class="small" style="color:rgb(182, 24, 24);">
                                        @error('subject')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>

                                <div class="col-12">
                                    <label for="message" class="form-label">
                                        متن پیام
                                    </label>

                                    <textarea id="message" name="message" rows="6" class="form-control @error('message') is-invalid @enderror" @guest disabled @endguest @if (auth()->user()?->is_admin) disabled @endif>{{ old('message') }}</textarea>

                                    <label class="small" style="color:rgb(182, 24, 24);">
                                        @error('message')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>

                                @guest
                                    <div class="">
                                        <div class="d-block d-md-inline">
                                            <span class="small text-danger">● برای ارسال پیام ابتدا باید وارد حساب خود شوید !</span>
                                        </div>
                                        <div class="d-block d-md-inline">
                                            <a class="small ms-2" href="login">( ورود به حساب کاربری )</a>
                                        </div>
                                    </div>
                                @endguest

                                @if (auth()->user()?->is_admin)
                                    <div class="d-block d-md-inline">
                                        <span class="small text-danger">● شما مدیر هستید و اجازۀ ارسال نظر را ندارید !</span>
                                    </div>
                                @endif

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-4" @guest disabled @endguest @if (auth()->user()?->is_admin) disabled @endif>
                                        ارسال پیام
                                    </button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>

            </div>

        </div>
    </main>
@endsection
