@extends('layouts.layout-dashboard')

{{-- ===(title)=== --}}
@section('title')
    وبلاگ | پنل مدیریت دیدگاه ها
@endsection

{{-- ====(main)=== --}}
@section('dashboard-content')
    <!-- Main contain START -->
    <section class="py-4 bg-body-custom" style="min-height: 100vh;">
        <div class="container">
            <div class="row g-2">

                <h1 class="w-25">
                    پنل مدیریت دیدگاه ها
                    <hr>
                </h1>

                <div class="p-2 border border-2 rounded-4">
                    <form class="d-flex justify-content-between px-3 row g-2" method="GET" action="{{ url()->current() }}">
                        <div class="col-12 col-sm-12 col-md-6 mt-2">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0" style="height: 44px">
                                    <i class="fas fa-search text-muted"></i>
                                </span>

                                <input
                                        type="text"
                                        name="search"
                                        class="form-control"
                                        style="height: 44px"
                                        placeholder="جستجو در عنوان یا متن..."
                                        value="{{ request('search') }}">
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-3 mt-2">
                            <select name="article_id" class="form-select" style="height: 44px">
                                <option value="">همۀ اخبار</option>

                                @foreach ($articles as $article)
                                    <option value="{{ $article->id }}"
                                            @selected(request('article_id') == $article->id)>
                                        ● {{ $article->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-sm-5 col-md-3 d-flex gap-2 pt-1 mt-2">
                            <button
                                    type="submit"
                                    class="btn btn-primary flex-fill">
                                <i class="fas fa-filter me-1"></i>
                                فیلتر
                            </button>

                            <a href="{{ route('admin.comments.index') }}" class="btn btn-outline-secondary">
                                پاک کردن
                            </a>
                        </div>
                    </form>
                </div>

                <div class="p-3 border border-2 rounded-3 shadow-sm overflow-hidden">
                    <div class="card border table-responsive">
                        <table class="table table-hover align-middle mb-0 text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>عنوان دیدگاه</th>
                                    <th>متن دیدگاه</th>
                                    <th>نام مقاله مربوطه</th>
                                    <th>وضعیت نمایش</th>
                                    <th>مدیریت کاربر</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($comments as $key => $comment)
                                    <tr>
                                        <td>
                                            {{ $comments->firstItem() + $key }}
                                        </td>

                                        <td>
                                            {{ $comment->title }}
                                        </td>

                                        <td>
                                            <span id="short-{{ $comment->id }}">
                                                {{ \Illuminate\Support\Str::limit($comment->body, 50) }}

                                                @if (\Illuminate\Support\Str::length($comment->body) > 50)
                                                    <a
                                                        href="#"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#viewReview"
                                                        data-comment-body="{{ $comment->body }}"
                                                        data-comment-user="{{ $comment->user->name ?? 'کاربر' }}"
                                                        data-comment-date="{{ verta($comment->created_at)->format('Y/m/d H:i') }}"
                                                        data-comment-avatar="{{ $comment->user_avatar_url }}">
                                                        <div class="d-inline-block" title="show more">
                                                            مشاهده بیشتر
                                                        </div>
                                                    </a>
                                                @endif
                                            </span>

                                            <span id="full-{{ $comment->id }}" style="display: none;">
                                                {{ $comment->text }}

                                                <a href="javascript:void(0)" onclick="toggleText({{ $comment->id }})">
                                                    بستن
                                                </a>
                                            </span>
                                        </td>

                                        <td>
                                            @if ($comment->article)
                                                <div class="d-flex justify-content-start align-items-center">
                                                    <div>
                                                        <a class="me-2" href="{{ route('articles.show', ['article' => $comment->article]) }}" title="رفتن به مقاله">
                                                            <i class="bi bi-file-arrow-up fs-5"></i>
                                                        </a>
                                                    </div>

                                                    <div class="w-100">
                                                        {{ $comment->article->title }}
                                                    </div>
                                                </div>
                                            @else
                                                <span class="text-muted small">
                                                    مقاله حذف شده یا در دسترس نیست
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            <form action="{{ route('admin.toggle-show', $comment) }}" method="POST">
                                                @csrf
                                                @method('PATCH')

                                                <button
                                                        type="submit"
                                                        class="btn btn-sm {{ $comment->is_show ? 'btn-success' : 'btn-secondary' }}">
                                                    {{ $comment->is_show ? 'نمایش داده شده' : 'نمایش' }}
                                                </button>
                                            </form>
                                        </td>

                                        <td>
                                            @if ($comment->user)
                                                <a href="{{ route('admin.users.index', [ 'search' => $comment->user->email, ]) }}" class="btn btn-sm btn-outline-primary" title="مدیریت کاربر {{ $comment->user->name }}">
                                                    <i class="bi bi-person-gear me-1"></i>
                                                    مدیریت
                                                </a>
                                            @else
                                                <span class="text-muted small">
                                                    کاربر حذف شده
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td
                                            colspan="6"
                                            class="text-center text-muted py-4">
                                            دیدگاهی یافت نشد.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{ $comments->links() }}

            </div>
        </div>
    </section>

    <!-- Popup modal for review START -->
    <div
        class="modal fade"
        id="viewReview"
        
        
        tabindex="-1"
        aria-labelledby="viewReviewLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="viewReviewLabel">
                        نظرات
                    </h5>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="d-md-flex">

                        <!-- Avatar -->
                        <div class="avatar avatar-md me-4 flex-shrink-0">
                            <img class="avatar-img rounded-circle" id="modal-comment-avatar" src="" alt="avatar">
                        </div>

                        <!-- Text -->
                        <div>
                            <div class="d-sm-flex mt-1 mt-md-0 align-items-center">
                                <h5
                                    class="me-3 mb-0"
                                    id="modal-comment-user"></h5>
                            </div>

                            <!-- Info -->
                            <p class="small mb-2" id="modal-comment-date"></p>

                            <p class="mb-2 text-wrap" style="white-space: normal; word-break: break-word;" id="modal-comment-body"></p>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button
                            type="button"
                            class="btn btn-danger-soft my-0"
                            data-bs-dismiss="modal">
                        بستن
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Popup modal for review END -->
    <!-- Main contain END -->
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const reviewModal = document.getElementById('viewReview');

            if (!reviewModal) {
                return;
            }

            reviewModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;

                if (!button) {
                    return;
                }

                document.getElementById('modal-comment-user').textContent =
                    button.getAttribute('data-comment-user') || 'کاربر';

                document.getElementById('modal-comment-date').textContent =
                    button.getAttribute('data-comment-date') || '';

                document.getElementById('modal-comment-body').textContent =
                    button.getAttribute('data-comment-body') || '';

                document.getElementById('modal-comment-avatar').src =
                    button.getAttribute('data-comment-avatar') || '';
            });
        });
    </script>
@endpush
