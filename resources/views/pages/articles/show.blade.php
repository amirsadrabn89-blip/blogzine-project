@extends('layouts.layout-site')

{{-- ===(title)=== --}}
@section('title')
    وبلاگ | خبر
@endsection


@push('styles')
    <style>
        .article-content img {
            display: block;
            max-height: 250px;
            height: auto;
            margin: 1rem auto;
            border-radius: 10px;
            border: 2px solid rgb(51, 51, 51);
        }

        .article-content .ql-align-left {
            text-align: left !important;
        }

        .article-content .ql-align-center {
            text-align: center !important;
        }

        .article-content .ql-align-right {
            text-align: right !important;
        }

        .article-content .ql-align-justify {
            text-align: justify !important;
        }
    </style>
@endpush


{{-- ====(main)=== --}}
@section('site-content')

    <!-- ====================== Inner intro START -->
    <section class="pt-2">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    @if ($isDraftPreview)
                        <div class="d-flex justify-content-center">
                            <div class="alert alert-warning w-75 mt-2 d-flex justify-content-between">
                                <span>این مقاله در حال حاضر برای کاربران عادی غیرفعال هست ، اما مدیر (شما) مجاز به مشاهدۀ آن می باشد.</span>
                                <button type="button"
                                        class="btn-close"
                                        data-bs-dismiss="alert"
                                        aria-label="بستن">
                                </button>
                            </div>
                        </div>
                    @endif

                    <div class="card bg-dark-overlay-5 overflow-hidden card-bg-scale h-400 text-center" style="background-image:url({{ $article->main_image ?? asset('assets/images/avatar/user_natural.png') }}); background-position: center left; background-size: cover;">
                        <!-- Card Image overlay -->
                        <div class="card-img-overlay d-flex align-items-center p-3 p-sm-4">
                            <div class="w-100 my-auto">
                                <!-- Card title -->
                                <h2 class="text-white display-5">{{ $article->title }}</h2>
                                <!-- Card info -->
                                <ul class="nav nav-divider text-white-force align-items-center justify-content-center">
                                    <li class="nav-item">
                                        <div class="nav-link">
                                            <div class="d-flex align-items-center text-white position-relative">
                                                <div class="avatar avatar-sm">
                                                    <img class="avatar-img rounded-circle ratio ratio-1x1 user-profile-trigger" src="{{ $article->user?->avatar_url ?? asset('assets/images/avatar/user_natural.png') }}" alt="avatar" role="button" style="cursor: pointer;" data-user-url="{{ route('users.quick-profile', $article->user_id) }}">
                                                </div>
                                                <span class="ms-2 user-profile-trigger stretched-link text-reset btn-link" role="button" style="cursor: pointer;" data-user-url="{{ route('users.quick-profile', $article->user_id) }}">
                                                    {{ $article->user?->name }}
                                                </span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav-item">{{ verta($article->created_at)->format('%d %B %Y') }}</li>
                                    <li class="nav-item mb-2">{{ $article->read_time }} دقیقه زمان مطالعه</li>
                                </ul>
                                <!-- Card category -->
                                <div class="badge btn btn-outline-info bg-info bg-opacity-25 me-2"><i class="fas fa-circle me-2 small fw-bold"></i>{{ $article->category?->title ?? 'بدون دسته‌بندی' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ====================== Inner intro END -->

    <!-- ======================= Main START -->
    <section class="pt-0 mb-5">
        <div class="container position-relative" data-sticky-container>
            <div class="row">
                <!-- Main Content START -->
                <div class="col-lg-9 single-content">
                    <div class="article-content">
                        <p class="d-block"><span class="dropcap bg-dark text-white px-2 article-content">؛</span>{!! $article->body !!}</p>
                    </div>


                    <hr class="mt-5">
                    <div class="row mt-5 p-2 p-md-3 bg-secondary bg-opacity-10 rounded-4">
                        <span class="col-12 col-sm-6">آیا از این مقالۀ خبری ، رضایت دارید؟</span>
                        <div class="col-12 col-sm-6 d-flex justify-content-end align-items-center">
                            <form action="{{ route('articles.like', $article) }}" method="POST">
                                @csrf

                                <button type="submit" class="btn btn-outline-success me-1 rounded-3">
                                    <i class="bi bi-hand-thumbs-up fs-5"></i>
                                </button>
                            </form>

                            <form action="{{ route('articles.dislike', $article) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger me-3 rounded-3">
                                    <i class="bi bi-hand-thumbs-up dislike-icon fs-5"></i>
                                </button>
                            </form>

                            @auth
                                @php
                                    $isFav = $article->isFavoritedBy(auth()->user());
                                @endphp
                                <button type="button" 
                                        class="btn me-1 rounded-3 btn-favorite {{ $isFav ? ' btn-outline-success' : ' btn-outline-info' }}" 
                                        data-url="{{ route('articles.favorite.toggle', $article) }}"
                                        title="{{ $isFav ? 'حذف از علاقه‌مندی‌ها' : 'افزودن به علاقه‌مندی‌ها' }}">
                                    <i class="bi fs-5 {{ $isFav ? 'bi-bookmark-fill' : 'bi-bookmark' }}"></i>
                                    <span class="fav-text">{{ $isFav ? 'ذخیره شده' : 'ذخیره' }}</span>
                                </button>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-sm btn-outline-secondary" title="برای ذخیره ابتدا وارد شوید">
                                    <i class="bi bi-bookmark"></i>
                                </a>
                            @endauth
                        </div>
                    </div>

                    <!-- Author info START -->
                    <div class="d-flex p-2 p-md-4 my-3 bg-primary bg-opacity-10 rounded-4">
                        <!-- Avatar -->
                        <div class="avatar avatar-xxl me-2 me-md-4 user-profile-trigger" style="cursor: pointer;"  role="button" style="cursor: pointer;" data-user-url="{{ route('users.quick-profile', $article->user_id) }}">
                            <img class="rounded-circle" src="{{ $article->user?->avatar_url ?? asset('assets/images/avatar/user_natural.png') }}" alt="avatar">
                        </div>
                        <!-- Info -->
                        <div>
                            <div class="d-sm-flex align-items-center justify-content-between">
                                <div>
                                    <h4 class="m-0">{{ $article->user?->name ?? 'نویسنده ناشناس' }}</h4>
                                </div>
                            </div>
                            <p class="my-2">{{ $article->user?->bio ?? 'بدون بیوگرافی !' }}</p>
                            <!-- Social icons -->
                            <ul class="nav">
                                <li class="nav-item mx-1">
                                    <a class="nav-link ps-0 pe-2 fs-5 {{ !$article->user?->facebook ? 'disabled' : '' }}" href="{{ $article->user?->facebook ?: '#' }}"
                                        @if ($article->user?->facebook) target="_blank" rel="noopener noreferrer" @endif>
                                        <i class="bi bi-facebook fa-fw" style="font-size: 17px;"></i>
                                    </a>
                                </li>
                                <li class="nav-item mx-1">
                                    <a class="nav-link ps-0 pe-2 fs-5 {{ !$article->user?->linkedin ? 'disabled' : '' }}" href="{{ $article->user?->linkedin ?: '#' }}"
                                        @if ($article->user?->linkedin) target="_blank" rel="noopener noreferrer" @endif>
                                        <i class="fab fa-linkedin fa-fw" style="font-size: 17px;"></i>
                                    </a>
                                </li>
                                <li class="nav-item mx-1">
                                    <a class="nav-link ps-0 pe-2 fs-5 {{ !$article->user?->twitter ? 'disabled' : '' }}" href="{{ $article->user?->twitter ?: '#' }}"
                                        @if ($article->user?->twitter) target="_blank" rel="noopener noreferrer" @endif>
                                        <i class="bi bi-twitter-x fa-fw" style="font-size: 17px;"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Author info END -->

                    <!-- Comments START -->
                    <div class="mt-5 mb-5">
                        <div class="article-main-comment-box pb-3">
                            <h4 class="m-2">نظرات کاربران</h4>
                            @forelse($article->rootComments as $comment)
                                <div class="comment-box shadow mt-3">

                                    <div class="d-flex justify-content-start align-items-center mb-3">
                                        <div class="me-2">
                                            <img class="user_commment_image" src="{{ $comment->user?->avatar_url ?? asset('assets/images/avatar/user_natural.png') }}" alt="">
                                        </div>
                                        <div class="me-2">
                                            <strong>{{ $comment->user?->name ?? 'کاربر حذف شده' }}</strong>
                                        </div>
                                        <div>
                                            <small>
                                                @if ($comment->created_at)
                                                    ({{ $comment->created_at->locale('fa')->diffForHumans() }})
                                                @else
                                                    (زمان ثبت نامشخص)
                                                @endif
                                            </small>
                                        </div>
                                    </div>

                                    @if ($comment->title)
                                        <h5>● {{ $comment->title }}</h5>
                                    @endif

                                    <p>{{ $comment->body }}</p>

                                    @auth
                                        <button type="button" class="reply-btn btn btn-sm btn-link"
                                                data-comment-id="{{ $comment->id }}"
                                                data-user-name="{{ $comment->user?->name ?? 'کاربر حذف شده' }}">
                                            پاسخ
                                        </button>
                                    @endauth

                                    {{-- replies --}}
                                    <div class="reply-box">

                                        @if ($comment->approvedReplies->isNotEmpty())
                                            <div class="reply_box_title shadow-sm ps-3 mb-2">
                                                پاسخ ها
                                            </div>
                                        @endif


                                        <div class="px-5">
                                            @foreach ($comment->approvedReplies as $reply)
                                                <div class="d-flex justify-content-start align-items-center mb-3">
                                                    <div class="me-2">
                                                        <img class="user_commment_reply_image" src="{{ $reply->user?->avatar_url ?? asset('assets/images/avatar/user_natural.png') }}" alt="">
                                                    </div>
                                                    <div class="me-2">
                                                        <strong>{{ $reply->user?->name ?? 'کاربر حذف شده' }}</strong>
                                                    </div>
                                                    <div>
                                                        <small>
                                                            @if ($reply->created_at)
                                                                ({{ $reply->created_at->locale('fa')->diffForHumans() }})
                                                            @else
                                                                (زمان ثبت نامشخص)
                                                            @endif
                                                        </small>
                                                    </div>
                                                </div>

                                                @if ($reply->title)
                                                    <h6>● {{ $reply->title }}</h6>
                                                @endif

                                                <p>{{ $reply->body }}</p>
                                                <hr>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="bg-info bg-opacity-25 px-3 rounded-2
                                ">هنوز نظری ثبت نشده است.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Comments END -->
                    <!-- Reply START -->
                    <div>
                        <h3>ثبت دیدگاه</h3>
                        @guest
                            <p class="text-danger">● برای ثبت نظر ابتدا باید وارد حساب کاربری خود شوید !</p>
                        @endguest
                        <form class="row g-3 mt-2 bg-light p-3 rounded" method="post" action="{{ route('comments.store', $article) }}">
                            @csrf

                            <input type="hidden" name="parent_id" id="parent_id" value="">

                            <div id="reply-info" class="d-none alert alert-secondary p-2">
                                در حال پاسخ به: <span id="reply-user"></span>
                                <button type="button" id="cancel-reply" class="btn btn-sm btn-danger ms-2">لغو پاسخ</button>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">عنوان دیدگاه</label>
                                <input type="text" class="form-control" @guest disabled @endguest name="title" id="title" value="{{ old('title') }}">
                                <label class="small" style="color:rgb(182, 24, 24);">
                                    @error('title')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-12 mt-3">
                                <label class="form-label">متن دیدگاه<sup class="text-danger ms-1">*</sup></label>
                                <textarea class="form-control" @guest disabled @endguest name="body" id="body" rows="3">{{ old('body') }}</textarea>
                                <label class="small" style="color:rgb(182, 24, 24);">
                                    @error('body')
                                        {{ $message }}
                                    @enderror
                                </label>
                            </div>

                            <div class="col-12 mt-5">
                                <button type="submit" class="btn btn-primary" @guest disabled @endguest>ثبت</button>
                            </div>
                        </form>
                    </div>
                    <!-- Reply END -->
                </div>
                <!-- Main Content END -->

                <!-- Right sidebar START -->
                <div class="col-lg-3">
                    <div data-sticky data-margin-top="80" data-sticky-for="991" class="d-flex flex-column justify-content-center align-items-center">
                        <!-- Categories -->
                        <div class="row g-2 mt-4 w-100">
                            <h5>دسته بندی های برتر</h5>

                            @foreach ($topCategories as $category)
                                <div class="d-flex justify-content-between align-items-center topCategories-box rounded p-2 position-relative">
                                    <h6 class="m-0 text-info">{{ $category->title }}</h6>
                                    <a href="{{ route('post-grid-masonry-filter.page', ['category_id' => $category->id]) }}" class="badge bg-info bg-opacity-75 text-white border border-primary text-dark stretched-link">{{ $category->articles_count }}</a>
                                </div>
                            @endforeach
                        </div>

                        <div class="border-bottom border-2 bg-secondary w-100 mt-5 d-block d-lg-none"></div>

                        <!-- Advertisement -->
                        <div class="mt-4 Advertisement">
                            <a href="#" class="d-block card-img-flash">
                                <img src="{{ asset('assets/images/adv.png') }}" alt="">
                            </a>
                        </div>

                        @if ($nextArticle)
                            <div class="bg-light border p-4 text-sm-end rounded d-none d-md-block mt-4">
                                <div class="d-flex align-items-center">
                                    <!-- image -->
                                    <div class="col-4 d-md-block">
                                        <img src="{{ $nextArticle->main_image ?? asset('assets/images/blog/4by3/05.jpg') }}" alt="Image">
                                    </div>
                                    <!-- Title -->
                                    <div class="ms-3 text-start">
                                        <span>خبر بعدی<i class="bi bi-arrow-right ms-3 rtl-flip"></i></span>
                                        <h6 class="m-0">
                                            <a href="{{ route('articles.show', $nextArticle) }}" class=" btn-link text-reset">
                                                {{ $nextArticle->title }}
                                            </a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <!-- Right sidebar END -->
            </div>
        </div>
    </section>
    <!-- ======================= Main END -->

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const replyButtons = document.querySelectorAll('.reply-btn');
            const parentInput = document.getElementById('parent_id');
            const replyInfo = document.getElementById('reply-info');
            const replyUser = document.getElementById('reply-user');
            const cancelReply = document.getElementById('cancel-reply');
            const titleInput = document.getElementById('title');

            if (!parentInput || !replyInfo || !replyUser || !titleInput) {
                return;
            }

            replyButtons.forEach(function(button) {
                button.addEventListener('click', function() {

                    const commentId = this.dataset.commentId;
                    const userName = this.dataset.userName;

                    parentInput.value = commentId;
                    replyUser.textContent = userName;

                    replyInfo.classList.remove('d-none');

                    titleInput.focus();
                });
            });

            if (cancelReply) {
                cancelReply.addEventListener('click', function() {

                    parentInput.value = '';
                    replyUser.textContent = '';

                    replyInfo.classList.add('d-none');
                });
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.btn-favorite').forEach(button => {
                button.addEventListener('click', function () {
                    const btn = this;
                    const url = btn.dataset.url;
                    const icon = btn.querySelector('i');
                    const textSpan = btn.querySelector('.fav-text');

                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success') {
                            if (data.is_favorited) {
                                btn.classList.remove('btn-outline-info');
                                btn.classList.add('btn-outline-success');
                                icon.classList.remove('bi-bookmark');
                                icon.classList.add('bi-bookmark-fill');
                                if (textSpan) textSpan.textContent = 'ذخیره شده';
                            } else {
                                btn.classList.remove('btn-outline-success');
                                btn.classList.add('btn-outline-info');
                                icon.classList.remove('bi-bookmark-fill');
                                icon.classList.add('bi-bookmark');
                                if (textSpan) textSpan.textContent = 'ذخیره';
                            }
                        }
                    })
                    .catch(err => console.error('خطا در ثبت علاقه‌مندی:', err));
                });
            });
        });
    </script>
@endpush
