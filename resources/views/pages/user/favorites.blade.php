@extends('layouts.layout-dashboard')

@section('title')
    وبلاگ | علاقه‌مندی‌های من
@endsection

@section('dashboard-content')
    <section class="pb-4 bg-body-custom">
        <div class="container" style="min-height: 100vh;">
            <div class="row g-4">
                <div class="col-12">

                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h2 class="mb-0">علاقه‌مندی‌های من</h2>

                        <span class="badge bg-info py-2 px-3">
                            <span class="fs-5">{{ $favorites->total() }}</span>
                            <span class="fs-6 ms-1">خبر ذخیره شده</span>
                        </span>
                    </div>

                    <hr class="mb-5">

                    @if ($favorites->count())
                        <div class="row">

                            @foreach ($favorites as $article)
                                <div class="col-12 col-md-6 col-lg-4 mb-4 favorite-card" id="fav-{{ $article->id }}">

                                    <div class="card h-100 shadow-sm">

                                        @if ($article->main_image)
                                            <img src="{{ asset($article->main_image) }}" class="card-img-top" alt="{{ $article->title }}" style="height: 180px; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('assets/images/avatar/user_natural.png') }}" class="card-img-top" alt="تصویر پیش‌فرض" style="height: 180px; object-fit: cover;">
                                        @endif

                                        <div class="card-body">
                                            <h5 class="card-title">
                                                {{ $article->title }}
                                            </h5>

                                            <p class="card-text text-muted small">
                                                {{ Str::limit(strip_tags($article->body), 160) }}
                                            </p>
                                        </div>

                                        <div class="card-footer d-flex justify-content-between align-items-center">

                                            <a href="{{ route('articles.show', $article) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-eye"></i>
                                                مشاهده
                                            </a>

                                            <form action="{{ route('articles.favorite.toggle', $article) }}" method="POST" onsubmit="return confirm('آیا از حذف این خبر مطمئن هستید؟');">
                                                @csrf

                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger">
                                                    <i class="bi bi-trash"></i>
                                                    حذف
                                                </button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            {{ $favorites->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-bookmark-star display-1 text-muted"></i>

                            <h4 class="mt-3">
                                خبری در علاقه‌مندی‌های شما وجود ندارد.
                            </h4>

                            <a href="{{ route('post-grid-masonry-filter.page') }}" class="btn btn-primary mt-3">
                                <i class="bi bi-newspaper"></i>
                                مشاهده اخبار
                            </a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
@endsection
