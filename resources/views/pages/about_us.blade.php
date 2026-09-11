@extends('layouts.layout-site')


{{-- ===(title)=== --}}
@section('title')
    وبلاگ | دربارۀ ما
@endsection


{{-- ====(main)=== --}}
@section('site-content')
    <main class="py-5 bg-body-custom">
        <div class="container">

            <div class="text-center mb-5">
                <h1 class="news-section-title fs-3 fw-bold mb-3">درباره ما</h1>
                <div class="border-bottom border-primary border-2 opacity-1 mx-auto" style="width: 150px;"></div>
            </div>

            <div class="row justify-content-center mb-4">
                <div class="col-lg-10">
                    <div class="p-4 p-md-5 rounded-4 bg-primary bg-opacity-10 border">
                        <p class="mb-0 lh-lg">
                            این وبلاگ با هدف انتشار مطالب تخصصی، اخبار روز و محتوای کاربردی در زمینه‌های مختلف
                            طراحی شده است. تلاش ما این است که محتوایی ساده، مفید و قابل اعتماد در اختیار شما قرار دهیم.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="h-100 p-4 rounded-4 border bg-light shadow-sm">
                        <span class="badge text-bg-success mb-3">تمرکز ما</span>
                        <h5 class="fw-bold mb-3">ارائه محتوای مفید</h5>
                        <p class="lh-lg mb-0">
                            تمرکز ما روی تولید و انتشار مطالبی است که برای مخاطب واقعی ارزش ایجاد کند.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="h-100 p-4 rounded-4 border bg-light shadow-sm">
                        <span class="badge text-bg-info mb-3">رویکرد ما</span>
                        <h5 class="fw-bold mb-3">سادگی و خوانایی</h5>
                        <p class="lh-lg mb-0">
                            طراحی و محتوا را طوری پیش می‌بریم که کاربر سریع، ساده و بدون شلوغی به نتیجه برسد.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="h-100 p-4 rounded-4 border bg-light shadow-sm">
                        <span class="badge text-bg-warning mb-3">هدف ما</span>
                        <h5 class="fw-bold mb-3">اعتماد و استمرار</h5>
                        <p class="lh-lg mb-0">
                            می‌خواهیم این وبلاگ به مرجعی قابل اتکا برای دنبال‌کردن موضوعات مورد علاقه شما تبدیل شود.
                        </p>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('post-grid-masonry-filter.page') }}" class="btn btn-light card-img-flash border px-4 py-2">
                    مشاهده اخبار
                </a>
            </div>

        </div>
    </main>
@endsection
