@forelse ($articles as $article)
    <div class="card border-0 shadow-sm mb-3">
        <div class="card-body">
            <div class="row g-3">

                <div class="col-12 col-md-3">
                    @if ($article->main_image)
                        <img
                             src="{{ $article->main_image }}"
                             alt="{{ $article->title }}"
                             class="img-fluid rounded-3 w-100"
                             style="height: 100px; object-fit: cover;">
                    @else
                        <div
                             class="bg-light rounded-3 d-flex align-items-center justify-content-center"
                             style="height: 100px;">
                            <span class="text-muted">
                                بدون تصویر
                            </span>
                        </div>
                    @endif
                </div>

                <div class="col-12 col-md-9">
                    <h5>
                        <a
                           href="{{ route('articles.show', $article) }}"
                           class="btn-link text-reset">
                            {{ $article->title }}
                        </a>
                    </h5>

                    <p class="text-muted mb-3">
                        {{ \Illuminate\Support\Str::limit(strip_tags($article->body), 160, '...') }}
                    </p>

                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge bg-success-subtle text-success p-2">
                            <i class="bi bi-hand-thumbs-up me-1"></i>

                            {{ number_format($article->likes_count ?? 0) }}
                            لایک
                        </span>

                        <span class="badge bg-danger-subtle text-danger p-2">
                            <i class="bi bi-hand-thumbs-down me-1"></i>

                            {{ number_format($article->dislikes_count ?? 0) }}
                            دیس‌لایک
                        </span>

                        <span class="badge bg-primary-subtle text-primary p-2">
                            <i class="bi bi-chat-dots me-1"></i>

                            {{ number_format($article->total_comments_count ?? 0) }}
                            دیدگاه
                        </span>

                        <span class="badge bg-warning-subtle text-warning-emphasis p-2">
                            <i class="bi bi-bell me-1"></i>

                            {{ number_format($article->unread_comments_count ?? 0) }}
                            خوانده‌نشده
                        </span>
                    </div>

                </div>

            </div>
        </div>
    </div>
@empty
    <div class="alert alert-info mb-0">
        شما هنوز خبری ایجاد نکرده‌اید.
    </div>
@endforelse
