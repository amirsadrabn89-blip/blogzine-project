@extends('layouts.layout-site')


{{-- ===(title)=== --}}
@section('title')
    وبلاگ | صفحۀ اصلی
@endsection


@push('styles')
    <style>
        .max-width-700 {
            max-width: 700px;
        }

        .text-shadow {
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
        }
    </style>
@endpush

{{-- ====(main)=== --}}
@section('site-content')

    <!-- Trending START -->
    <section class="py-2 mt-3">
        <div class="container">
            <div class="row g-0">
                <div class="col-12 bg-primary bg-opacity-10 p-2 rounded-3">
                    <div class="d-sm-flex align-items-center text-center text-sm-start">
                        <!-- Title -->
                        <div class="pe-2">
                            <div class="badge bg-primary p-2 px-3 ">امروز : {{ verta()->format('%d %B') }} ماه {{ verta()->format('%Y') }}</div>
                        </div>
                        <marquee behavior="" direction="right" width="100%" onmouseover="this.stop();" onmouseout="this.start();">

                            <span class="nav-item me-1">
                                به وبلاگ ما خوش آمدید؛ جایی برای مطالعه، آگاهی و کشف مطالب تازه.
                            </span>

                            <span class="nav-item me-1">
                                در اینجا تازه‌ترین اخبار، مقالات خواندنی، دانستنی‌های کاربردی و موضوعات روز دنیا را با شما به اشتراک می‌گذاریم.
                            </span>

                        </marquee>


                        {{-- <!-- Slider -->
                            <div class="tiny-slider arrow-end arrow-xs arrow-white arrow-round arrow-md-none">
                                <div class="tiny-slider-inner" data-autoplay="true" data-hoverpause="true" data-gutter="0" data-arrow="true" data-dots="false" data-items="1">
                                    <!-- Slider items -->
                                    <div> <a href="#" class="text-reset btn-link">افزایش آلودگی هوا در شهرهای پُرجمعیت تا فردا</a></div>
                                    <div> <a href="#" class="text-reset btn-link">حضورمسیحیان در حرم سامرابا آغاز سال جدید </a></div>
                                    <div> <a href="#" class="text-reset btn-link">انتقاد ستاره رئال از شعارهای نژادپرستانه </a></div>
                                </div>
                            </div> --}}
                    </div>
                </div>
            </div> <!-- Row END -->
        </div>
    </section>
    <!-- Trending END -->

    <!-- Main hero START -->
    <section class="pt-4 pb-0 card-grid ">
        <div class="container pe-0">
            <p class="fw-bold mb-4 fs-5">اخبار <span class="fw-normal fs-6">روز</span></p>
            <div class="swiper" dir="rtl">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper daily-news-slider">

                    @foreach ($latestArticles as $article)
                        <div class="swiper-slide">
                            <div class="card card-overlay-bottom card-grid-lg card-bg-scale daily-news-slider-slide">
                                <img class="img-fluid daily-news-slider-image" src="{{ $article->main_image ?? asset('assets/images/avatar/user_natural.png') }}" alt="article main image">
                                <!-- Card featured -->
                                <span class="card-featured" title=""><i class="fas fa-star"></i></span>
                                <!-- Card Image overlay -->
                                <div class="card-img-overlay">
                                    <div class="w-100 h-100 position-relative">
                                        <!-- Publish Date -->
                                        <span class="position-absolute start-0 badge text-bg-light"><i class="bi bi-calendar-check me-2"></i>{{ verta($article->created_at)->format('%d %B %Y') }}</span>
                                        <!-- Card category -->
                                        <div class="badge btn btn-outline-info bg-info bg-opacity-75 m-2 mt-0 me-3 position-absolute end-0 "><i class="fas fa-circle me-2 small fw-bold"></i>{{ $article->category->title ?? 'بدون دسته‌بندی' }}</div>
                                        <!-- Card title -->
                                        <!-- Author -->
                                        <div class="text-white position-absolute" style="bottom: 57px;right: 13px;">
                                            <div class="avatar avatar-sm">
                                                <img class="avatar-img rounded-circle ratio ratio-1x1 user-profile-trigger" src="{{ $article->user?->avatar_url ?? asset('assets/images/avatar/user_natural.png') }}" alt="avatar" role="button" style="cursor: pointer;" data-user-url="{{ route('users.quick-profile', $article->user_id) }}">
                                            </div>
                                            <span class="ms-2 user-profile-trigger stretched-link text-reset btn-link" role="button" style="cursor: pointer;" data-user-url="{{ route('users.quick-profile', $article->user_id) }}">
                                                {{ $article->user?->name }}
                                            </span>
                                        </div>
                                        <h2 class="w-100 rounded px-3 py-3 slider-topic-title position-absolute bottom-0 text-white">
                                            <a class="stretched-link text-reset btn-link" href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                {{-- <!-- If we need pagination -->
                    <div class="swiper-pagination"></div>

                    <!-- If we need navigation buttons -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div> --}}
            </div>
        </div>
    </section>

    <section class="mt-4">
        <div class="container">
            <div class="d-flex justify-content-between align-items-baseline mb-4">
                <p class="fw-bold mb-3 fs-5 position-relative news-section-title">دسته بندی <span class="fw-normal fs-6">جدیدترین ها</span></p>
                <div class="border-bottom border-primary border-2 opacity-1" style="width: 75%;">
                </div>
            </div>
            <div class="col-12">
                <!-- Grid START -->
                <div class="row g-4 justify-content-center">

                    @foreach ($popularCategories as $category)
                        <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                            <a href="{{ route('post-grid-masonry-filter.page', ['category_id' => $category->id]) }}">

                                <div class="">
                                    <a href="{{ route('post-grid-masonry-filter.page', ['category_id' => $category->id]) }}" class="shadow-sm py-3 px-1 d-block btn btn-light card-img-flash border" style="border-radius:.7rem;">

                                        <div class="d-flex justify-content-start ms-2">
                                            <div class="border-bottom border-start p-2 rounded-3 shadow-sm">
                                                {{ $category->title }}
                                            </div>
                                        </div>
                                        <hr class="mt-4 mb-0 ">
                                        <div class="d-flex justify-content-between align-items-center me-3">
                                            <span class="ms-2 mt-2 small"> تعداد اخبار :</span>
                                            <div class="badge text-bg-light bg-opacity-50 w-25 mt-3 shadow-sm border p-0 py-1">
                                                {{ $category->articles_count }}
                                            </div>
                                        </div>
                                    </a>
                                </div>

                            </a>
                        </div>
                    @endforeach

                    <!-- Earning item -->

                </div>
                <!-- Grid END -->
            </div>
        </div>
    </section>

    <section class="my-4">
        <div class="container">
            <div class="d-flex justify-content-between align-items-baseline mb-4">
                <p class="fw-bold mb-3 fs-5 position-relative news-section-title">داغ ترین <span class="fw-normal fs-6">خبرها
                    </span>
                </p>
                <div class="border-bottom border-primary border-2 opacity-1" style="width: 75%;">
                </div>
            </div>
            <!-- Recent post widget START -->
            <div class="row">


                @foreach ($popularArticles as $article)
                    <div class="col-md-6 card mb-3">
                        <div class="d-flex p-3 align-items-center" style="box-shadow: 0 5px 20px 0 rgba(69, 67, 96, 0.1);border-radius: .7rem;">
                            <a class="w-25 image-hover p-1 rounded-3" href="{{ route('articles.show', $article) }}">
                                <img class="rounded-3 w-100 border border-secondary border-2" style="background-position: center left; background-size: cover; height: 100px;" src="{{ $article->main_image ?? asset('assets/images/avatar/user_natural.png') }}" alt="article main image">
                            </a>
                            <div class="d-flex flex-column justify-content-center ms-4">
                                <h6><a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a></h6>
                                <div class="small mt-1">{{ verta($article->created_at)->format('%d %B %Y') }}</div>
                                <div class="mt-3">
                                    <span class="text-success border border-success rounded-2 py-0 px-3">
                                        <i class="bi bi-hand-thumbs-up fs-6"></i>
                                        {{ $article->likes_count }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <div class="d-flex justify-content-center mt-4">
                <a href="{{ route('post-grid-masonry-filter.page') }}">
                    <button class="btn btn-outline-primary rounded-3" type="">مشاهدۀ همۀ اخبار</button>
                </a>
            </div>
            <!-- Recent post widget END -->
        </div>
    </section>

    <section class="my-4 pb-0 card-grid">
        <div class="container">
            <div class="card bg-dark-overlay-6 overflow-hidden card-bg-scale h-400 position-relative rounded-4 shadow-lg" style="background-image:url({{ asset('assets/images/blog/16by9/05.jpg') }}); background-position: center; background-size: cover;">

                <div class="position-absolute top-0 start-0 w-100 h-100 rounded-4" style="background: linear-gradient(45deg, rgba(10,20,40,0.95) 0%, rgba(10,20,40,0.85) 60%, rgba(1060%, rgba(100.35) 100%);"></div>

                <div class="card-img-overlay d-flex align-items-center justify-content-center p-4 p-sm-5">
                    <div class="w-100 my-auto text-center text-white position-relative">

                        <span class="badge bg-primary bg-opacity-75 px-3 py-2 rounded-pill mb-3 shadow-sm">
                            <i class="fas fa-bolt me-1"></i> سریع، ساده، بدون معطلی
                        </span>

                        <h2 class="display-6 fw-bold mb-3 text-white text-shadow">
                            کمتر از ۱۰ دقیقه، خبر خودت را بساز و منتشر کن!
                        </h2>

                        <p class="fs-5 opacity-50 mb-4 mx-auto max-width-700">
                            مقالۀ خبری خودت رو با با دیگران به  راحتی به اشتراک بذار.
                        </p>

                        <a href="{{ route('dashboard-post-create.page') }}" class="btn btn-light btn-lg px-4 rounded-pill fw-bold shadow">
                            همین حالا شروع کن <i class="fas fa-pen-nib ms-2"></i>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </section>



    {{-- <section class="my-4 pb-0 card-grid">
        <div class="container">
            <div class="d-flex justify-content-between align-items-baseline mb-4">
                <p class="fw-bold mb-3 fs-5 position-relative news-section-title">جدیدترین <span class="fw-normal fs-6">ویدیوها </span>
                </p>
                <div class="border-bottom border-primary border-2 opacity-1" style="width: 75%;"></div>
            </div>
            <div class="row g-4">
                <!-- Left big card -->
                <div class="col-lg-6">
                    <div class="card card-overlay-bottom card-bg-scale">
                        <img class="img-fluid h-100" src="{{ asset('assets/images/blog/1by1/11.jpg') }}" alt="">
                        <!-- Card featured -->
                        <span class="card-featured" title=""><i class="fas fa-star"></i></span>
                        <!-- Card Image overlay -->
                        <div class="card-img-overlay d-flex align-items-center p-3 p-sm-4">
                            <div class="w-100 mt-auto">
                                <!-- Card category -->
                                <div class="badge text-bg-danger mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>مگامنو</div>
                                <!-- Card title -->
                                <h2 class="text-white h1"><a href="#" class="btn-link stretched-link text-reset">ده نشانه که نشان می دهد برای راه اندازی یک استارتاپ جدید به آن نیاز دارید.</a></h2>
                                <p class="text-white">در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد. </p>
                                <!-- Card info -->
                                <ul class="nav nav-divider text-white-force align-items-center d-none d-sm-inline-block">
                                    <li class="nav-item">
                                        <div class="nav-link">
                                            <div class="d-flex align-items-center text-white position-relative">
                                                <div class="avatar avatar-sm">
                                                    <img class="avatar-img rounded-circle" src="{{ asset('assets/images/avatar/vahid.jpeg') }}" alt="avatar">
                                                </div>
                                                <span class="ms-3"> <a href="#" class="stretched-link text-reset btn-link">وحید صالحی</a></span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav-item">15 دی، 1400</li>
                                    <li class="nav-item">5 دقیقه زمان مطالعه</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Right small cards -->
                <div class="col-lg-6">
                    <div class="row g-4">
                        <!-- Card item START -->
                        <div class="col-12">
                            <div class="card card-overlay-bottom card-grid-sm card-bg-scale" style="background-image:url({{ asset('assets/images/blog/1by1/02.jpg') }}); background-position: center; background-size: cover;">
                                <!-- Card Image -->
                                <!-- Card Image overlay -->
                                <div class="card-img-overlay d-flex align-items-center p-3 p-sm-4">
                                    <div class="w-100 mt-auto">
                                        <!-- Card category -->
                                        <div class="badge text-bg-warning mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>تکنولوژی</div>
                                        <!-- Card title -->
                                        <h4 class="text-white"><a href="#" class="btn-link stretched-link text-reset">بهترین تابلوهای Pinterest برای یادگیری در مورد تجارت</a></h4>
                                        <!-- Card info -->
                                        <ul class="nav nav-divider text-white-force align-items-center d-none d-sm-inline-block">
                                            <li class="nav-item position-relative">
                                                <div class="nav-link"><a href="#" class="stretched-link text-reset btn-link">مهدی راد</a>
                                                </div>
                                            </li>
                                            <li class="nav-item">18 تیر، 1400</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Card item END -->
                        <!-- Card item START -->
                        <div class="col-md-6">
                            <div class="card card-overlay-bottom card-grid-sm card-bg-scale" style="background-image:url({{ asset('assets/images/blog/1by1/03.jpg') }}); background-position: center; background-size: cover;">
                                <!-- Card Image overlay -->
                                <div class="card-img-overlay d-flex align-items-center p-3 p-sm-4">
                                    <div class="w-100 mt-auto">
                                        <!-- Card category -->
                                        <div class="badge text-bg-success mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>اقتصاد</div>
                                        <!-- Card title -->
                                        <h4 class="text-white"><a href="#" class="btn-link stretched-link text-reset">دلیل کاهش نرخ دلار </a>
                                        </h4>
                                        <!-- Card info -->
                                        <ul
                                            class="nav nav-divider text-white-force align-items-center d-none d-sm-inline-block">
                                            <li class="nav-item position-relative">
                                                <div class="nav-link"><a href="#" class="stretched-link text-reset btn-link">مسعود خالدی</a>
                                                </div>
                                            </li>
                                            <li class="nav-item">8 دی، 1400</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Card item END -->
                        <!-- Card item START -->
                        <div class="col-md-6">
                            <div class="card card-overlay-bottom card-grid-sm card-bg-scale" style="background-image:url({{ asset('assets/images/blog/1by1/04.jpg') }}); background-position: center; background-size: cover;">
                                <!-- Card Image overlay -->
                                <div class="card-img-overlay d-flex align-items-center p-3 p-sm-4">
                                    <div class="w-100 mt-auto">
                                        <!-- Card category -->
                                        <div class="badge text-bg-info mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>ورزش</div>
                                        <!-- Card title -->
                                        <h4 class="text-white"><a href="#" class="btn-link stretched-link text-reset">جدول لیگ در پایان هفته</a></h4>
                                        <!-- Card info -->
                                        <ul class="nav nav-divider text-white-force align-items-center d-none d-sm-inline-block">
                                            <li class="nav-item position-relative">
                                                <div class="nav-link"><a href="#" class="stretched-link text-reset btn-link">شادی اسدی</a>
                                                </div>
                                            </li>
                                            <li class="nav-item">28 آذر، 1400</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Card item END -->
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    @if ($technologyArticles->isNotEmpty())
        <section class="my-4 pb-0 card-grid">
            <div class="container pe-0">

                <div class="d-flex justify-content-between align-items-baseline">
                    <p class="fw-bold mb-3 fs-5 position-relative news-section-title">
                        اخبار
                        <span class="fw-normal fs-6">تکنولوژی</span>
                    </p>

                    <div class="border-bottom border-primary border-2 opacity-1" style="width: 75%;">
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-0">
                    <a href="{{ route('post-grid-masonry-filter.page', ['category_id' => $technologyCategory->id]) }}" class="btn btn-outline-primary rounded-3">
                        مشاهده همه اخبار تکنولوژی
                    </a>
                </div>

                <div class="swiper technology-news-swiper" dir="rtl">
                    <div class="swiper-wrapper p-3">

                        @foreach ($technologyArticles as $article)
                            <div class="swiper-slide py-2">

                                <div class="card bg-lights p-4" style=" box-shadow: 0 5px 20px 0 rgba(69, 67, 96, 0.1);">

                                    <div class="position-relative">
                                        <img class="card-img technology-news-image" style="height:350px" src="{{ $article->main_image ?? asset('assets/images/avatar/user_natural.png') }}" alt="article main image" loading="{{ $loop->first ? 'eager' : 'lazy' }}">

                                        <div class="card-img-overlay d-flex align-items-start flex-column p-3">
                                            <div class="w-100 mt-auto">
                                                <div class="badge btn btn-outline-info bg-info bg-opacity-75">
                                                    <i class="fas fa-circle me-2 small fw-bold"></i>
                                                    {{ $article->category->title ?? 'تکنولوژی' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body px-0 pt-3">

                                        <h4 class="card-title mt-2">
                                            <a href="{{ route('articles.show', $article) }}" class="btn-link text-reset">
                                                {{ $article->title }}
                                            </a>
                                        </h4>

                                        <p class="card-text">
                                            {{ Str::limit(strip_tags($article->body), 160) }}
                                        </p>

                                        <ul class="nav nav-divider align-items-center d-none d-sm-inline-block">
                                            <li class="nav-item">
                                                <div class="nav-link">
                                                    <div class="d-flex align-items-center position-relative">
                                                        <div class="avatar avatar-sm">
                                                            <img class="avatar-img rounded-circle ratio ratio-1x1 user-profile-trigger" src="{{ $article->user?->avatar_url ?? asset('assets/images/avatar/user_natural.png') }}" alt="avatar" role="button" style="cursor: pointer;" data-user-url="{{ route('users.quick-profile', $article->user_id) }}">
                                                        </div>
                                                        <span class="ms-2 user-profile-trigger stretched-link text-reset btn-link" role="button" style="cursor: pointer;" data-user-url="{{ route('users.quick-profile', $article->user_id) }}">
                                                            {{ $article->user?->name }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="nav-item">
                                                {{ verta($article->created_at)->format('d F، Y') }}
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                </div>
            </div>
        </section>
    @endif

    @if ($technologyArticles->isNotEmpty())
        <section class="my-4 pb-0 card-grid">
            <div class="container pe-0">

                <div class="d-flex justify-content-between align-items-baseline">
                    <p class="fw-bold mb-3 fs-5 position-relative news-section-title">
                        اخبار
                        <span class="fw-normal fs-6">ورزشی</span>
                    </p>

                    <div class="border-bottom border-primary border-2 opacity-1" style="width: 75%;">
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-0">
                    <a href="{{ route('post-grid-masonry-filter.page', ['category_id' => $sportCategory->id]) }}" class="btn btn-outline-primary rounded-3">
                        مشاهده همه اخبار ورزشی
                    </a>
                </div>

                <div class="swiper technology-news-swiper" dir="rtl">
                    <div class="swiper-wrapper p-3">

                        @foreach ($sportArticles as $article)
                            <div class="swiper-slide py-2">

                                <div class="card bg-lights p-4" style=" box-shadow: 0 5px 20px 0 rgba(69, 67, 96, 0.1);">

                                    <div class="position-relative">
                                        <img class="card-img sport-news-image" style="height:350px" src="{{ $article->main_image ?? asset('assets/images/no-image-available.jpg') }}" alt="article main image" loading="{{ $loop->first ? 'eager' : 'lazy' }}">

                                        <div class="card-img-overlay d-flex align-items-start flex-column p-3">
                                            <div class="w-100 mt-auto">
                                                <div class="badge btn btn-outline-info bg-info bg-opacity-75">
                                                    <i class="fas fa-circle me-2 small fw-bold"></i>
                                                    {{ $article->category->title ?? 'ورزشی' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body px-0 pt-3">

                                        <h4 class="card-title mt-2">
                                            <a href="{{ route('articles.show', $article) }}" class="btn-link text-reset">
                                                {{ $article->title }}
                                            </a>
                                        </h4>

                                        <p class="card-text">
                                            {{ Str::limit(strip_tags($article->body), 160) }}
                                        </p>

                                        <ul class="nav nav-divider align-items-center d-none d-sm-inline-block">
                                            <li class="nav-item">
                                                <div class="nav-link">
                                                    <div class="d-flex align-items-center position-relative">
                                                        <div class="avatar avatar-sm">
                                                            <img class="avatar-img rounded-circle ratio ratio-1x1 user-profile-trigger" src="{{ $article->user?->avatar_url ?? asset('assets/images/avatar/user_natural.png') }}" alt="avatar" role="button" style="cursor: pointer;" data-user-url="{{ route('users.quick-profile', $article->user_id) }}">
                                                        </div>
                                                        <span class="ms-2 user-profile-trigger stretched-link text-reset btn-link" role="button" style="cursor: pointer;" data-user-url="{{ route('users.quick-profile', $article->user_id) }}">
                                                            {{ $article->user?->name }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="nav-item">
                                                {{ verta($article->created_at)->format('d F، Y') }}
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                </div>
            </div>
        </section>
    @endif

    <section class="my-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Title -->
                    <div class="mb-4 d-flex justify-content-between align-items-baseline">
                        <p class="fw-bold mb-3 fs-5 position-relative news-section-title">منتخب <span class="fw-normal fs-6">سردبیر</span></p>
                        <div class="border-bottom border-primary border-2 opacity-1" style="width: 75%;"></div>
                    </div>
                    <div class="tiny-slider arrow-hover arrow-blur arrow-dark arrow-round rounded-3 shadow p-3">
                        <div class="tiny-slider-inner"
                             data-autoplay="false"
                             data-hoverpause="true"
                             data-gutter="24"
                             data-arrow="false"
                             data-dots="false"
                             data-items-xl="4"
                             data-items-md="3"
                             data-items-sm="2"
                             data-items-xs="1">

                            @foreach ($editorSelectedArticles as $article)
                                <div class="card">
                                    <!-- Card img -->
                                    <div class="position-relative">
                                        <img class="card-img sport-news-image" style="height:200px" src="{{ $article->main_image ?? asset('assets/images/no-image-available.jpg') }}" alt="article main image" loading="{{ $loop->first ? 'eager' : 'lazy' }}">
                                        <div class="card-img-overlay d-flex align-items-start flex-column p-3">
                                            <!-- Card overlay Top -->
                                            <div class="w-100 mb-auto d-flex justify-content-end">
                                                <div class="text-end ms-auto">

                                                </div>
                                            </div>
                                            <!-- Card overlay bottom -->
                                            <div class="w-100 mt-auto">
                                                <div class="badge text-bg-info"><i class="fas fa-circle me-2 small fw-bold"></i>{{ $article->category->title ?? 'بدون دسته‌بندی' }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body px-0 pt-3">
                                        <h5 class="card-title" style="height:40px"><a href="{{ route('articles.show', $article) }}" class="btn-link text-reset">{{ Str::limit($article->title, 60, '...') }}</a></h5>
                                        <!-- Card info -->
                                        <ul class="mt-2 nav nav-divider align-items-center d-none d-sm-inline-block">
                                            <li class="nav-item">
                                                <div class="nav-link">
                                                    <div class="d-flex align-items-center position-relative">
                                                        <div class="avatar avatar-sm">
                                                            <img class="avatar-img rounded-circle ratio ratio-1x1 user-profile-trigger" src="{{ $article->user?->avatar_url ?? asset('assets/images/avatar/user_natural.png') }}" alt="avatar" role="button" style="cursor: pointer;" data-user-url="{{ route('users.quick-profile', $article->user_id) }}">
                                                        </div>
                                                        <span class="ms-2 user-profile-trigger stretched-link text-reset btn-link" role="button" style="cursor: pointer;" data-user-url="{{ route('users.quick-profile', $article->user_id) }}">
                                                            {{ $article->user?->name }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="nav-item ">{{ verta($article->created_at)->format('d F، Y') }}</li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Card item START -->

                            <!-- Card item END -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section END -->

@endsection
