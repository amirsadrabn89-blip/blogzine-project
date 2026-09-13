@extends('layouts.layout-site')


{{-- ===(title)=== --}}
@section('title')
    وبلاگ | خبر
@endsection


{{-- ====(main)=== --}}
@section('site-content')
    <!-- Inner intro START -->
    <section class="bg-body-custom">
        <div class="container">
            <div class="row mx-1">
                <div class="col-md-9 text-center mx-auto position-relative z-index-9 border py-5 rounded-5 my-5 bg-secondary bg-opacity-10">

                    <div class="mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-warning-subtle text-warning border" style="width: 90px; height: 90px;">
                            <i class="bi bi-file-earmark-lock-fill fs-1"></i>
                        </div>
                    </div>
                    
                    <h3 class="fw-bold text-secondary mb-3">
                        مقاله در حال حاضر قابل نمایش نیست
                    </h3>

                    @if ($writer_id = auth()->id())
                        <p class="text-muted lh-lg mb-4">
                            مقالۀ شما غیرفعال می باشد. لطفا تا بررسی آن توسط مدیر صبر نمایید.
                        </p>
                    @else
                        <p class="text-muted lh-lg mb-4">
                            متأسفانه این مقاله موقتاً غیرفعال شده است و امکان مشاهده محتوای آن وجود ندارد. لطفاً مقالات دیگر را بررسی کنید.
                        </p>
                    @endif

                    

                    <a href="{{ url()->previous() }}" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-arrow-right me-1"></i>
                        بازگشت به صفحۀ قبل
                    </a>

                </div>
            </div>
        </div>
    </section>
    <!-- Inner intro END -->
@endsection
