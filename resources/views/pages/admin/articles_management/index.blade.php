@extends('layouts.layout-dashboard')


{{-- ===(title)=== --}}
@section('title')
    وبلاگ | پنل مدیریت اخبار
@endsection


{{-- ====(main)=== --}}
@section('dashboard-content')
    <!-- Main contain START -->
    <section class="py-4 bg-body-custom" style="min-height: 100vh;">
        <div class="container">
            <div class="row g-2">

                <h2>پنل مدیریت اخبار
                    <hr>
                </h2>

                <div class="p-2 border border-2 rounded-4">
                    <form class="d-flex justify-content-between px-3 row g-2" method="GET" action="{{ url()->current() }}">

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
                            <a href="{{ url()->current() }}" class="btn btn-outline-secondary" style="height: 38px">پاک کردن</a>
                        </div>
                    </form>
                </div>

                <div class="p-3 border border-2 rounded-3 shadow-sm overflow-hidden">
                    <div class="card border table-responsive">
                        <table class="table table-hover align-middle mb-0 text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>عنوان مقاله</th>
                                    <th>دسته‌بندی</th>
                                    <th>لایک</th>
                                    <th>دیس‌لایک</th>
                                    <th>بازدید</th>
                                    <th>وضعیت نمایش</th>
                                    <th>مدیریت کاربر</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($articles as $article)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="{{ route('articles.show', $article) }}" target="_blank">
                                                {{ $article->title }}
                                            </a>
                                        </td>
                                        <td>
                                            <span class="">
                                                {{ $article->category?->title ?? '___' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-success">
                                                <i class="bi bi-hand-thumbs-up fs-5"></i>
                                                {{ $article->likes_count }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-danger">
                                                <i class="bi bi-hand-thumbs-up dislike-icon fs-5"></i>
                                                {{ $article->dislikes_count }}
                                            </span>
                                        </td>
                                        <td>{{ number_format($article->views) }}</td>
                                        <td>
                                            <form action="{{ route('admin.articles.toggle-show', $article) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm {{ $article->is_show ? 'btn-success' : 'btn-secondary' }}">
                                                    {{ $article->is_show ? 'نمایش داده شده' : 'نمایش' }}
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            @if ($article->user)
                                                <a href="{{ route('admin.users.index', ['search' => $article->user->email]) }}" class="btn btn-sm btn-outline-primary" title="مدیریت کاربر {{ $article->user->name }}">
                                                    <i class="bi bi-person-gear me-1"></i>
                                                    مدیریت
                                                </a>
                                            @else
                                                <span class="text-muted small">کاربر حذف شده</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-4">
                                            مقاله‌ای یافت نشد.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{ $articles->links() }}

            </div>
        </div>
    </section>
    <!-- Main contain END -->
@endsection
