@extends('layouts.layout-dashboard')

{{-- ===( title )=== --}}
@section('title', 'خبرهای من')

{{-- ====( main content )==== --}}
@section('dashboard-content')

    <!-- Page Header START -->
    <section class="py-4 bg-body-custom">
        <div class="container">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
                <div>
                    <h4 class="fw-bold mb-1 fs-4">خبرهای من</h4>
                    <span class="small text-muted fs-6">مدیریت، ویرایش و انتشار اخبار ثبت‌شده</span>
                </div>
            </div>
        </div>
    </section>
    <!-- Page Header END -->

    <section class="py-4 bg-body-custom" style="min-height: 80vh;">
        <div class="container">

            <!-- Stats Cards START -->
            <div class="p-3 border border-2 rounded-3 shadow-sm overflow-hidden">
                <div class="row g-3 mb-4">
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="card border-0 shadow-sm h-100 bg-dark-subtle">
                            <div class="card-body d-flex align-items-center">
                                <div class="rounded-circle border bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center me-3" style="width: 52px; height: 52px;">
                                    <i class="bi bi-newspaper fs-4"></i>
                                </div>
                                <div>
                                    <div class="small text-muted">کل خبرها</div>
                                    <div class="fs-4">{{ $totalArticles }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="card border-0 shadow-sm h-100 bg-dark-subtle">
                            <div class="card-body d-flex align-items-center">
                                <div class="rounded-circle border bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center me-3" style="width: 52px; height: 52px;">
                                    <i class="bi bi-check-circle-fill fs-4 mt-1"></i>
                                </div>
                                <div>
                                    <div class="small text-muted">منتشرشده</div>
                                    <div class="fs-4">{{ $publishedArticles }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="card border-0 shadow-sm h-100 bg-dark-subtle">
                            <div class="card-body d-flex align-items-center">
                                <div class="rounded-circle border bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center me-3" style="width: 52px; height: 52px;">
                                    <i class="bi bi-clock-fill fs-4 mt-1"></i>
                                </div>
                                <div>
                                    <div class="small text-muted">در انتظار</div>
                                    <div class="fs-4">{{ $pendingArticles }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="card border-0 shadow-sm h-100 bg-dark-subtle">
                            <div class="card-body d-flex align-items-center">
                                <div class="rounded-circle border bg-info bg-opacity-10 text-info d-flex align-items-center justify-content-center me-3" style="width: 52px; height: 52px;">
                                    <i class="bi bi-eye-fill fs-4 mt-1"></i>
                                </div>
                                <div>
                                    <div class="small text-muted">مجموع بازدید</div>
                                    <div class="fs-4">{{ number_format($totalViews) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
                <!-- Stats Cards END -->

                <!-- Intro Box START -->
                <div class="card border shadow-sm mb-2 bg-body-tertiary">
                    <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                        <div>
                            <h5 class="mb-1">مدیریت خبرها در یک نگاه</h5>
                            <p class="mb-0 text-muted small">
                                از این بخش می‌توانید خبرهای خود را مشاهده، ویرایش، حذف یا برای انتشار آماده کنید.
                            </p>
                        </div>
                        <a href="{{ route('dashboard-post-create.page') }}" class="btn btn-outline-primary rounded-3">
                            <i class="fas fa-plus me-1"></i> ثبت خبر جدید
                        </a>
                    </div>
                </div>
            </div>
            <!-- Intro Box END -->

            @if ($articles->isEmpty())

                <div class="d-flex justify-content-center mt-5">
                    <div class="card border-2 shadow-sm p-4 text-center" style="max-width: 650px; width: 100%;">
                        <div class="card-body py-5">
                            <div class="mb-3">
                                <span class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-circle" style="width: 90px; height: 90px;">
                                    <i class="bi bi-newspaper fs-1"></i>
                                </span>
                            </div>
                            <h5 class="fs-5 mb-2">هنوز خبری منتشر نکرده‌اید</h5>
                            <p class="text-muted mb-4">
                                اولین خبر خود را ثبت کنید تا در اینجا لیست اخبار، آمار و مدیریت کامل آن‌ها را ببینید.
                            </p>
                            <a href="{{ route('dashboard-post-create.page') }}" class="btn btn-primary px-4 rounded-3">
                                <i class="fas fa-plus me-1"></i> افزودن اولین خبر
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="d-flex justify-content-between align-items-center mb-3 mt-4">
                    <div class="text-muted small">
                        نمایش {{ $articles->count() }} خبر در این صفحه
                    </div>
                    <div class="text-muted small">
                        کل بازدیدها: {{ number_format($totalViews) }}
                    </div>
                </div>

                <div class="p-3 border border-2 rounded-3 shadow-sm overflow-hidden mb-3">
                    <div class="card border shadow-sm overflow-hidden">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-center" style="width: 70px">تصویر</th>
                                        <th>عنوان</th>
                                        <th class="text-center">دسته‌بندی</th>
                                        <th class="text-center">وضعیت</th>
                                        <th class="text-center">بازدید</th>
                                        <th class="text-center">تاریخ انتشار</th>
                                        <th class="text-center" style="width: 130px">عملیات</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($articles as $article)
                                        <tr>
                                            <td class="text-center">
                                                <img class="border border-2"
                                                     src="{{ asset($article->main_image) }}"
                                                     alt="{{ $article->title }}"
                                                     style="width: 56px; height: 40px; object-fit: cover; border-radius: 6px;">
                                            </td>

                                            <td>
                                                <div class="fw-semibold text-truncate mt-2" style="max-width: 300px;">
                                                    {{ $article->title }}
                                                </div>
                                                @if (!empty($article->tags))
                                                    <div class="mt-1 mb-2">
                                                        @php
                                                            $tags = is_array($article->tags) ? $article->tags : explode(',', $article->tags);
                                                        @endphp
                                                        @foreach ($tags as $tag)
                                                            @if (trim($tag))
                                                                <span class="badge bg-secondary bg-opacity-10 text-secondary small me-1">{{ trim($tag) }}</span>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                <span class="badge bg-info bg-opacity-10 text-info">
                                                    <i class="fas fa-circle me-1 small"></i>
                                                    {{ $article->category?->title ?? 'بدون دسته‌بندی' }}
                                                </span>
                                            </td>

                                            <td class="text-center">
                                                @if ($article->is_show)
                                                    <span class="badge bg-success bg-opacity-10 text-success">
                                                        <i class="fas fa-check-circle me-1"></i>منتشر شده
                                                    </span>
                                                @else
                                                    <span class="badge bg-warning bg-opacity-10 text-warning">
                                                        <i class="fas fa-pause-circle me-1"></i>در انتظار تایید
                                                    </span>
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                <i class="fas fa-eye text-muted me-1"></i>{{ number_format($article->views ?? 0) }}
                                            </td>

                                            <td class="text-center">
                                                <span class="text-muted">
                                                    {{ $article->published_at ? verta($article->published_at)->format('Y/m/d') : verta($article->created_at)->format('Y/m/d') }}
                                                </span>
                                            </td>

                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">
                                                    <a href="{{ route('articles.show', $article) }}" class="btn btn-sm btn-outline-primary rounded-3" title="مشاهده">
                                                        <i class="fas fa-eye mt-1"></i>
                                                    </a>
                                                    <a href="{{ route('dashboard-post-edit.page', $article) }}" class="btn btn-sm btn-outline-success rounded-3" title="ویرایش">
                                                        <i class="fas fa-edit mt-1"></i>
                                                    </a>
                                                    <form action="{{ route('dashboard-post-delete.page', $article) }}" method="POST" class="d-inline" onsubmit="return confirm('آیا از حذف این خبر مطمئن هستید؟');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-3" title="حذف">
                                                            <i class="fas fa-trash-alt mt-1"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                @if ($articles->hasPages())
                    <div class="mt-3">
                        {{ $articles->links() }}
                    </div>
                @endif

            @endif
        </div>
    </section>

@endsection
