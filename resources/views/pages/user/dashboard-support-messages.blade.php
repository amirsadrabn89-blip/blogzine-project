@extends('layouts.layout-dashboard')


{{-- ===(title)=== --}}
@section('title')

    وبلاگ |  پیام‌های پشتیبانی
    
@endsection


{{-- ====(main)=== --}}
@section('dashboard-content')

    <main class="py-5 bg-body-custom" style="min-height: 100vh;">
        <div class="container">

            <div class="text-center mb-5">

                <h1 class="news-section-title fw-bold mb-3">
                    پیام‌های پشتیبانی
                </h1>

                <div class="border-bottom border-primary border-2 opacity-1 mx-auto" style="width: 150px;">
                </div>

                <p class="mt-3 mb-0">
                    در این بخش می‌توانید پیام‌های ارسال‌شده و پاسخ‌های پشتیبانی را مشاهده کنید.
                </p>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    {{ session('success') }}

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="بستن">
                    </button>
                </div>
            @endif

            {{-- messages list --}}
            @forelse($contactMessages as $key => $contactMessage)
                @php
                    $collapseId = 'support-message-' . $contactMessage->id;
                @endphp

                <div class="rounded-4 bg-light border shadow-sm p-3 p-md-4 mb-3">

                    <div class="d-flex align-items-start gap-2 w-100">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 w-100">

                            <div class="d-flex align-items-center flex-grow-1">

                                <h5 class="fw-bold mb-0 p-2 border-3 border-end me-1 me-md-3 mb-1 rounded-2">
                                    {{ $contactMessages->total() - $contactMessages->firstItem() - $key + 1 }}
                                </h5>

                                <button type="button"
                                        class="btn btn-link text-decoration-none text-light-emphasis text-start fw-bold p-0"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#{{ $collapseId }}"
                                        aria-expanded="false"
                                        aria-controls="{{ $collapseId }}">

                                    <span class="border-2 border-bottom border-start p-2 rounded-4 d-inline-block">
                                        {{ $contactMessage->subject }}
                                    </span>
                                </button>
                            </div>

                            <div class="d-flex align-items-center gap-3">

                                <div class="text-md-end">
                                    @if($contactMessage->status == 0)
                                        <span class="badge text-bg-warning p-2 px-3">
                                            در انتظار پاسخ
                                        </span>
                                    @else
                                        <span class="badge text-bg-success p-2 px-3">
                                            پاسخ داده شده
                                        </span>
                                    @endif

                                    <div class="small mt-2">
                                        ثبت پیام:
                                        {{ verta($contactMessage->created_at)->format('Y/m/d - H:i') }}
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div>
                            <button type="button" class="d-flex p-2 btn btn-light-secondary btn-sm px-3 collapsed"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#{{ $collapseId }}"
                                    aria-expanded="false"
                                    aria-controls="{{ $collapseId }}">
                                <i class="text-center bi bi-chevron-down"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="collapse mt-3" id="{{ $collapseId }}">
                        <div class="border-top pt-3">

                            <div class="mb-4">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <span class="badge text-bg-info">
                                        پیام شما
                                    </span>

                                    <span class="small">
                                        {{ $contactMessage->name }}
                                    </span>
                                </div>

                                <div class="rounded-4 border bg-body p-3">
                                    <p class="lh-lg mb-0">
                                        {!! nl2br(e($contactMessage->message)) !!}
                                    </p>
                                </div>
                            </div>

                            @if($contactMessage->status == 1 && $contactMessage->admin_reply)
                                <div class="rounded-4 bg-primary bg-opacity-10 border p-3">

                                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-3">
                                        <span class="badge bg-secondary">
                                            پاسخ پشتیبانی
                                        </span>

                                        @if($contactMessage->replied_at)
                                            <small>
                                                زمان پاسخ:
                                                {{ verta($contactMessage->replied_at)->format('Y/m/d - H:i') }}
                                            </small>
                                        @endif
                                    </div>

                                    <p class="lh-lg mb-0">
                                        {!! nl2br(e($contactMessage->admin_reply)) !!}
                                    </p>
                                </div>
                            @else
                                <div class="alert alert-warning mb-0 rounded-4">
                                    پاسخ پشتیبانی هنوز ثبت نشده است.
                                </div>
                            @endif

                        </div>
                    </div>

                </div>
            @empty

                <div class="rounded-4 bg-light border shadow-sm p-5 text-center">
                    <span class="badge text-bg-secondary mb-3">
                        بدون پیام
                    </span>

                    <h5 class="fw-bold mb-3">
                        هنوز پیامی برای پشتیبانی ارسال نکرده‌اید.
                    </h5>

                    <p class="text-secondary mb-4">
                        اگر سؤال، پیشنهاد یا مشکلی دارید، از صفحه تماس با ما پیام خود را ثبت کنید.
                    </p>

                    <a href="{{ route('contact_us.page') }}" class="btn btn-primary px-4">
                        ارسال پیام جدید
                    </a>
                </div>
            @endforelse

            @if($contactMessages->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $contactMessages->links() }}
                </div>
            @endif

        </div>
    </main>
@endsection
