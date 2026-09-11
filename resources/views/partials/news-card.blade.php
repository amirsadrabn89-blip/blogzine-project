@foreach ($articles as $article)
    <div class="col-12 col-sm-6 col-lg-4 p-2">
        <div class="card mb-4 border p-2 shadow h-100">

            <div class="card-fold position-relative">
                <a href="{{ route('articles.show', $article) }}">
                    <img class="card-img" src="{{ asset($article->main_image) }}" alt="{{ $article->title }}" style="height: 200px; object-fit: cover; width: 100%;">
                </a>
            </div>

            <div class="card-body px-0 pt-3 d-flex flex-column">

                <h4 class="card-title">
                    <a href="{{ route('articles.show', $article) }}" class="btn-link text-reset text-decoration-none">
                        {{ $article->title }}
                    </a>
                </h4>

                <p class="card-text flex-grow-1">
                    {{ Str::limit(strip_tags($article->body), 140) }}
                    
                    @if (!$article->is_show)
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="alert alert-warning w-75 rounded-3 p-2 text-center">
                                این خبر در حال حاضر برای کاربران عادی قابل مشاهده نمی باشد.
                            </div>
                        </div>
                    @endif
                    
                </p>

                <div class="d-flex justify-content-start my-2">
                    @php
                        $likes = $article->likes_count ?? 0;
                        $dislikes = $article->dislikes_count ?? 0;
                        $totalReactions = $likes + $dislikes;

                        $satisfaction = $totalReactions > 0 ? ($likes / $totalReactions) * 5 : 0;
                        $roundedSatisfaction = round($satisfaction * 2) / 2;

                        $fullStars = floor($roundedSatisfaction);
                        $hasHalfStar = $roundedSatisfaction - $fullStars == 0.5;
                        $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);
                    @endphp

                    <div class="article-rating text-warning d-flex align-items-center small" dir="ltr">
                        @for ($i = 0; $i < $fullStars; $i++)
                            <i class="fas fa-star"></i>
                        @endfor

                        @if ($hasHalfStar)
                            <i class="fas fa-star-half-alt"></i>
                        @endif

                        @for ($i = 0; $i < $emptyStars; $i++)
                            <i class="far fa-star text-muted"></i>
                        @endfor
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-between pt-2 border-top">
                    <ul class="nav nav-divider align-items-center text-uppercase small m-0 p-0">
                        <li class="nav-item">
                            <span class="nav-link text-reset p-0 pe-2">
                                {{ $article->user?->name ?? 'نویسنده نامشخص' }}
                            </span>
                        </li>
                        <li class="nav-item">
                            {{ verta($article->created_at)->format('j F، Y') }}
                        </li>
                    </ul>
                    <div class="badge btn btn-outline-info me-2 text-info">
                        <i class="fas fa-circle me-1 small fw-bold"></i>{{ $article->category?->title ?? 'بدون دسته‌بندی' }}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endforeach
