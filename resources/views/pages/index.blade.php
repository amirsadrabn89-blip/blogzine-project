@extends('layouts.layout-site')

{{-- ===(title)=== --}}
@section('title')
    وبلاگ | صفحۀ اصلی
@endsection

@push('styles')
    <style>
        html,
        body {
            overflow-x: hidden !important;
            max-width: 100vw;
        }

        .max-width-700 {
            max-width: 700px;
        }

        .text-shadow {
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
        }

        .daily-news-slider-slide,
        .daily-news-slider-slide .card-img,
        .daily-news-slider-image {
            height: clamp(240px, 25vw + 80px, 460px) !important;
            max-height: 460px !important;
            width: 100% !important;
            object-fit: cover !important;
            object-position: center !important;
        }

        .card-grid-lg {
            height: auto !important;
            min-height: unset !important;
        }

        .swiper {
            overflow: hidden !important;
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
                            <div class="badge bg-primary p-2 px-3">امروز : {{ verta()->format('%d %B') }} ماه {{ verta()->format('%Y') }}</div>
                        </div>
                        <marquee behavior="" direction="right" width="100%" onmouseover="this.stop();" onmouseout="this.start();">
                            <span class="nav-item me-1">
                                به وبلاگ ما خوش آمدید؛ جایی برای مطالعه، آگاهی و کشف مطالب تازه.
                            </span>
                            <span class="nav-item me-1">
                                در اینجا تازه‌ترین اخبار، مقالات خواندنی، دانستنی‌های کاربردی و موضوعات روز دنیا را با شما به اشتراک می‌گذاریم.
                            </span>
                        </marquee>
                    </div>
                </div>
            </div> <!-- Row END -->
        </div>
    </section>
    <!-- Trending END -->

    <!-- Main hero START -->
    <section class="pt-4 pb-0 card-grid">
        <div class="container">
            <p class="fw-bold mb-4 fs-5">اخبار <span class="fw-normal fs-6">روز</span></p>
            <div class="swiper" dir="rtl">
                <div class="swiper-wrapper daily-news-slider">
                    @foreach ($latestArticles as $article)
                        <div class="swiper-slide">
                            <div class="card border-0 rounded-4 overflow-hidden shadow-sm h-100 d-flex flex-column">

                                <div class="position-relative w-100 flex-shrink-0" style="height: 250px;">
                                    <a href="{{ route('articles.show', $article) }}" class="d-block w-100 h-100">
                                        <img class="w-100 h-100" style="object-fit: cover; object-position: center;" src="{{ $article->main_image ?? asset('assets/images/no-image-available.jpg') }}" alt="{{ $article->title }}" loading="{{ $loop->first ? 'eager' : 'lazy' }}">
                                    </a>

                                    <div class="position-absolute top-0 start-0 p-3 w-100 d-flex justify-content-between align-items-center" style="pointer-events: none;">
                                        <span class="badge bg-primary px-3 py-2 fw-bold d-none d-md-inline-block" style="pointer-events: auto;">
                                            <i class="fas fa-circle me-1 small"></i>{{ $article->category->title ?? 'بدون دسته‌بندی' }}
                                        </span>
                                        <span class="badge bg-dark bg-opacity-50 text-white py-2 px-3">
                                            <i class="bi bi-calendar-check me-1"></i>{{ verta($article->created_at)->format('%d %B %Y') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="p-3 bg-light border-top flex-grow-1 d-flex flex-column justify-content-between gap-2">

                                    <a href="{{ route('articles.show', $article) }}" class="text-decoration-none text-dark d-block">
                                        <h5 class="fw-bold m-0 lh-base text-truncate-2" style="font-size: 1.1rem; line-height: 1.6;">
                                            {{ $article->title }}
                                        </h5>
                                    </a>

                                    <div class="d-none d-md-flex align-items-center pt-2 border-top border-secondary-subtle">
                                        <div class="avatar avatar-sm me-2">
                                            <img class="avatar-img rounded-circle user-profile-trigger" src="{{ $article->user?->avatar_url ?? asset('assets/images/avatar/user_natural.png') }}" alt="avatar" role="button" style="cursor: pointer; width: 34px; height: 34px; object-fit: cover;" data-user-url="{{ route('users.quick-profile', $article->user_id) }}">
                                        </div>
                                        <span class="user-profile-trigger text-secondary fw-semibold small" role="button" style="cursor: pointer;" data-user-url="{{ route('users.quick-profile', $article->user_id) }}">
                                            {{ $article->user?->name }}
                                        </span>
                                    </div>

                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Categories START -->
    <section class="mt-4">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4 gap-3">
                <p class="fw-bold mb-0 fs-5 position-relative news-section-title text-nowrap">دسته بندی <span class="fw-normal fs-6">جدیدترین ها</span></p>
                <div class="border-bottom border-primary border-2 opacity-1 flex-grow-1"></div>
            </div>
            <div class="col-12">
                <div class="row g-4 justify-content-center">
                    @foreach ($popularCategories as $category)
                        <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                            <a href="{{ route('post-grid-masonry-filter.page', ['category_id' => $category->id]) }}" class="shadow-sm py-2 py-md-3 px-1 d-block btn btn-light card-img-flash border" style="border-radius:.7rem;">
                                <div class="d-flex justify-content-start ms-2">
                                    <div class="border-bottom border-start p-2 rounded-3 shadow-sm">
                                        {{ $category->title }}
                                    </div>
                                </div>
                                <hr class="mt-2 mt-md-4 mb-0">
                                <div class="d-flex justify-content-between align-items-center me-3">
                                    <span class="ms-2 mt-2 small"> تعداد اخبار :</span>
                                    <div class="badge text-bg-light bg-opacity-50 w-25 mt-3 shadow-sm border p-0 py-1">
                                        {{ $category->articles_count }}
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Articles START -->
    <section class="my-4">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4 gap-3">
                <p class="fw-bold mb-0 fs-5 position-relative news-section-title text-nowrap">
                    داغ ترین <span class="fw-normal fs-6">خبرها</span>
                </p>
                <div class="border-bottom border-primary border-2 opacity-1 flex-grow-1"></div>
            </div>
            <div class="row">
                @foreach ($popularArticles as $article)
                    <div class="col-md-6 mb-3">
                        <div class="card d-flex flex-row p-3 align-items-center h-100" style="box-shadow: 0 5px 20px 0 rgba(69, 67, 96, 0.1); border-radius: .7rem;">
                            <a class="w-25 image-hover p-1 rounded-3 flex-shrink-0" href="{{ route('articles.show', $article) }}">
                                <img class="rounded-3 w-100 border border-secondary border-2" style="object-fit: cover; height: 100px; min-width: 80px;" src="{{ $article->main_image ?? asset('assets/images/no-image-available.jpg') }}" alt="article main image">
                            </a>
                            <div class="d-flex flex-column justify-content-center ms-3">
                                <h6 class="mb-1"><a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a></h6>
                                <div class="small text-muted">{{ verta($article->created_at)->format('%d %B %Y') }}</div>
                                <div class="mt-2">
                                    <span class="text-success border border-success rounded-2 py-0 px-2 small">
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
                <a href="{{ route('post-grid-masonry-filter.page') }}" class="btn btn-outline-primary rounded-3">
                    مشاهدۀ همۀ اخبار
                </a>
            </div>

            <div class="border-bottom border-primary border-2 opacity-1 mt-4"></div>
        </div>
    </section>

    <!-- Banner CTA START -->
    <section class="my-4 pb-0 card-grid">
        <div class="container">
            <div class="card bg-dark-overlay-6 overflow-hidden card-bg-scale h-400 position-relative rounded-4 shadow-lg" style="background-image:url({{ asset('assets/images/blog/16by9/05.jpg') }}); background-position: center; background-size: cover;">
                <div class="position-absolute top-0 start-0 w-100 h-100 rounded-4" style="background: linear-gradient(45deg, rgba(10,20,40,0.95) 0%, rgba(10,20,40,0.85) 60%, rgba(10,20,40,0.35) 100%);"></div>
                <div class="card-img-overlay d-flex align-items-center justify-content-center p-4 p-sm-5">
                    <div class="w-100 my-auto text-center text-white position-relative">
                        <span class="badge bg-primary bg-opacity-75 px-3 py-2 rounded-pill mb-3 shadow-sm">
                            <i class="fas fa-bolt me-1"></i> سریع، ساده، بدون معطلی
                        </span>
                        <h2 class="display-6 fw-bold mb-3 text-white text-shadow">
                            کمتر از ۱۰ دقیقه، خبر خودت را بساز و منتشر کن!
                        </h2>
                        <p class="fs-5 opacity-50 mb-4 mx-auto max-width-700">
                            مقالۀ خبری خودت رو با دیگران به راحتی به اشتراک بذار.
                        </p>
                        <a href="{{ route('dashboard-post-create.page') }}" class="btn btn-light btn-lg px-4 rounded-pill fw-bold shadow @if (auth()->user()?->is_admin) disabled @endif">
                            همین حالا شروع کن <i class="fas fa-pen-nib ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Technology News START -->
    @if ($technologyArticles->isNotEmpty())
        <section class="my-4 pb-0 card-grid">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center gap-3">
                    <p class="fw-bold mb-0 fs-5 position-relative news-section-title text-nowrap">
                        اخبار <span class="fw-normal fs-6">تکنولوژی</span>
                    </p>
                    <div class="border-bottom border-primary border-2 opacity-1 flex-grow-1"></div>
                </div>

                <div class="d-flex justify-content-center justify-content-md-end my-3">
                    <a href="{{ route('post-grid-masonry-filter.page', ['category_id' => $technologyCategory->id]) }}" class="btn btn-outline-primary rounded-3">
                        مشاهده همه اخبار تکنولوژی
                    </a>
                </div>

                <div class="swiper technology-news-swiper" dir="rtl">
                    <div class="swiper-wrapper py-2">
                        @foreach ($technologyArticles as $article)
                            <div class="swiper-slide py-2">
                                <div class="card bg-lights p-3 p-md-4 h-100" style="box-shadow: 0 5px 20px 0 rgba(69, 67, 96, 0.1);">
                                    <div class="position-relative">
                                        <img class="card-img news-image" style="object-fit: cover; object-position: center;" src="{{ $article->main_image ?? asset('assets/images/no-image-available.jpg') }}" alt="article main image" loading="{{ $loop->first ? 'eager' : 'lazy' }}">
                                        <div class="card-img-overlay d-flex align-items-start flex-column p-3">
                                            <div class="w-100 mt-auto">
                                                <div class="badge btn btn-outline-info bg-info bg-opacity-75 d-none d-md-inline-block">
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

    <!-- Sport News START -->
    @if ($sportArticles->isNotEmpty())
        <section class="my-4 pb-0 card-grid">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center gap-3">
                    <p class="fw-bold mb-0 fs-5 position-relative news-section-title text-nowrap">
                        اخبار <span class="fw-normal fs-6">ورزشی</span>
                    </p>
                    <div class="border-bottom border-primary border-2 opacity-1 flex-grow-1"></div>
                </div>

                <div class="d-flex justify-content-center justify-content-md-end my-3">
                    <a href="{{ route('post-grid-masonry-filter.page', ['category_id' => $sportCategory->id]) }}" class="btn btn-outline-primary rounded-3">
                        مشاهده همه اخبار ورزشی
                    </a>
                </div>

                <div class="swiper technology-news-swiper" dir="rtl">
                    <div class="swiper-wrapper py-2">
                        @foreach ($sportArticles as $article)
                            <div class="swiper-slide py-2">
                                <div class="card bg-lights p-3 p-md-4 h-100" style="box-shadow: 0 5px 20px 0 rgba(69, 67, 96, 0.1);">
                                    <div class="position-relative">
                                        <img class="card-img news-image" style="object-fit: cover; object-position: center;" src="{{ $article->main_image ?? asset('assets/images/no-image-available.jpg') }}" alt="article main image" loading="{{ $loop->first ? 'eager' : 'lazy' }}">
                                        <div class="card-img-overlay d-flex align-items-start flex-column p-3">
                                            <div class="w-100 mt-auto">
                                                <div class="badge btn btn-outline-info bg-info bg-opacity-75 d-none d-md-inline-block">
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

    <!-- Editor Choice START -->
    <section class="my-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="mb-4 d-flex justify-content-between align-items-center gap-3">
                        <p class="fw-bold mb-0 fs-5 position-relative news-section-title text-nowrap">
                            منتخب <span class="fw-normal fs-6">سردبیر</span>
                        </p>
                        <div class="border-bottom border-primary border-2 opacity-1 flex-grow-1"></div>
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
                                    <div class="position-relative">
                                        <img class="card-img news-image" style="object-fit: cover; object-position: center;" src="{{ $article->main_image ?? asset('assets/images/no-image-available.jpg') }}" alt="article main image" loading="{{ $loop->first ? 'eager' : 'lazy' }}">
                                        <div class="card-img-overlay d-flex align-items-start flex-column p-3">
                                            <div class="w-100 mt-auto">
                                                <div class="badge text-bg-info d-none d-md-inline-block">
                                                    <i class="fas fa-circle me-2 small fw-bold"></i>
                                                    {{ $article->category->title ?? 'بدون دسته‌بندی' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body px-0 pt-3">
                                        <h5 class="card-title" style="height:40px"><a href="{{ route('articles.show', $article) }}" class="btn-link text-reset">{{ Str::limit($article->title, 60, '...') }}</a></h5>
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
                                            <li class="nav-item">{{ verta($article->created_at)->format('d F، Y') }}</li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section END -->

@endsection
