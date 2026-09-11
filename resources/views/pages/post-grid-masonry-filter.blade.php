@extends('layouts.layout-site')

{{-- ===(title)=== --}}
@section('title')
    وبلاگ | اخبار با فیلتر دسته بندی
@endsection

{{-- ====(main)=== --}}
@section('site-content')

    <!-- Inner intro START -->
    <section class="pt-4 pb-3 bg-body-custom">
        <div class="container d-flex justify-content-start">
            <div class="d-flex justify-content-center mb-3">
                <span class="fw-semibold fs-3">تازه‌ترین اخبار</span>
            </div>
        </div>
    </section>
    <!-- Inner intro END -->

    <!-- Main content START -->
    <section class="position-relative pt-0 bg-body-custom" style="min-height: 100vh;">
        <div class="container">
            <!-- Nav Filters -->
            <div class="row mb-4">
                <div class="col-12">
                    <!-- Filter Form START -->
                    <div class="p-2 border border-2 rounded-4">
                        <form method="GET" action="{{ route('post-grid-masonry-filter.page') }}" class="d-flex justify-content-between px-3 row g-2">

                            <div class="col-12 col-sm-12 col-md-6 mt-2">
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0" style="height: 44px"><i class="fas fa-search text-muted"></i></span>
                                    <input type="text" name="search" class="form-control" style="height: 44px" placeholder="جستجو در عنوان یا متن..." value="{{ request('search') }}">
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-3 mt-2">
                                <select name="category_id" class="form-select" style="height: 44px">
                                    <option value="">همه دسته‌بندی‌ها</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                                            ● {{ $category->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 col-sm-5 col-md-3 d-flex gap-2 pt-1 mt-2">
                                <button type="submit" class="btn btn-primary flex-fill" style="height: 38px">
                                    <i class="fas fa-filter me-1"></i>فیلتر
                                </button>
                                <a href="{{ route('post-grid-masonry-filter.page') }}" class="btn btn-outline-secondary" style="height: 38px">پاک کردن</a>
                            </div>
                        </form>
                    </div>
                    <!-- Filter Form END -->
                </div>
            </div>

            @if ($articles->isEmpty())
                <div class="container">
                    <div class="d-flex align-items-center justify-content-center mt-5 border border-2 rounded-4">
                        <div class="d-flex flex-column align-items-center justify-content-center p-4 p-md-5">
                            <span class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-circle" style="width: 80px; height: 80px;">
                                <i class="fas fa-search fs-1"></i>
                            </span>
                            <span class="fs-5 mt-4">متاسفانه خبری برای این فیلتر یافت نشد !</span>
                            <span class="fs-6 mt-1 text-muted">می‌توانید از فیلتر دیگری استفاده کنید.</span>
                        </div>
                    </div>
                </div>
            @else
                <div class="row py-2" id="news-container">
                    @include('partials.news-card', ['articles' => $articles])
                </div>
            @endif

            @if ($articles->hasMorePages())
                <div class="text-center my-4" id="load-more-wrapper">
                    <button 
                        id="load-more-btn" 
                        class="btn btn-primary px-5 py-2 rounded-pill shadow"
                        data-next-page="{{ $articles->currentPage() + 1 }}"
                    >
                        <span class="btn-text">نمایش بیشتر</span>
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
                </div>
            @endif

        </div>
    </section>
    <!-- Main content END -->

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const loadMoreBtn = document.getElementById('load-more-btn');
    const newsContainer = document.getElementById('news-container');
    const loadMoreWrapper = document.getElementById('load-more-wrapper');

    if (!loadMoreBtn) return;

    loadMoreBtn.addEventListener('click', function () {
        const page = this.getAttribute('data-next-page');
        const btnText = this.querySelector('.btn-text');
        const spinner = this.querySelector('.spinner-border');

        loadMoreBtn.disabled = true;
        btnText.textContent = 'در حال دریافت...';
        spinner.classList.remove('d-none');

        const currentParams = new URLSearchParams(window.location.search);
        currentParams.set('page', page);

        fetch("{{ route('articles.loadMore') }}?" + currentParams.toString(), {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('خطا در دریافت اطلاعات');
            return response.json();
        })
        .then(data => {

            newsContainer.insertAdjacentHTML('beforeend', data.html);

            if (data.has_more) {
                loadMoreBtn.setAttribute('data-next-page', data.next_page);
                loadMoreBtn.disabled = false;
                btnText.textContent = 'نمایش بیشتر';
                spinner.classList.add('d-none');
            } else {
                loadMoreWrapper.remove();
            }
        })
        .catch(error => {
            console.error(error);
            loadMoreBtn.disabled = false;
            btnText.textContent = 'تلاش مجدد';
            spinner.classList.add('d-none');
        });
    });
});
</script>
@endpush
