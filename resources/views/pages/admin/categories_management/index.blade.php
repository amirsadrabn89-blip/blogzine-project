@extends('layouts.layout-dashboard')


{{-- ===(title)=== --}}
@section('title')
    وبلاگ | پنل مدیریت دسته بندی ها
@endsection


{{-- ====(main)=== --}}
@section('dashboard-content')
    <!-- Main contain START -->
    <section class="py-4 bg-body-custom" style="min-height: 100vh;">
        <div class="container">

            <div class="row pb-4">
                <div class="col-12">
                    <h2>پنل مدیریت دسته بندی ها
                        <hr>
                    </h2>
                    <!-- Title -->
                    <div class="d-sm-flex justify-content-sm-end align-items-center">
                        <a href="#create_new_category" class="btn btn-sm btn-outline-primary rounded-3 mb-0">
                            <i class="fas fa-plus me-2"></i>ثبت دسته بندی جدید
                        </a>
                    </div>
                </div>
            </div>
            <div>

                <div class="category_management_table_box custom-scrollbar p-3 border border-2 rounded-4 ">
                    <div class="row g-2">

                        @forelse ($categories as $category)
                            <div class="col-md-6 col-xl-4 ">
                                <!-- Category item START -->
                                <div class="card border h-100">
                                    <!-- Card header -->
                                    <div class="card-header border-bottom p-3 d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="p-2 shadow bg-body rounded-circle">🏷️</div>
                                            <h4 class="mb-0 ms-3">{{ $category->title }}</h4>
                                        </div>
                                        <form action="{{ route('admin.categories.toggle-status', $category) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit" class="btn btn-sm {{ $category->is_show ? 'btn-outline-success' : 'btn-outline-secondary' }}" title="تغییر وضعیت نمایش">
                                                <i class="bi {{ $category->is_show ? 'bi-eye' : 'bi-eye-slash' }}"></i>
                                                {{ $category->is_show ? 'فعال' : 'غیرفعال' }}
                                            </button>
                                        </form>
                                    </div>

                                    <!-- Card body START -->
                                    <div class="card-body p-3">
                                        <p>{{ $category->description }}</p>

                                        <!-- Followers and Post -->
                                        <div class="d-flex justify-content-between">
                                            <!-- Total post -->
                                            <div>
                                                <hr class="w-75">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <h6 class="mb-2 fw-light me-2">کل اخبار مربوط به این دسته بندی:</h6>
                                                    <h5 class="mb-2 btn btn-outline-light p-0 px-2">{{ $category->articles_count }}</h5>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <!-- Card body END -->

                                    <!-- Card footer -->
                                    <div class="card-footer border-top text-center p-3 d-flex gap-2">
                                        <a href="{{ route('admin.categories.index', ['edit' => $category->id]) }}#category_form_card" class="btn btn-sm btn-outline-warning w-100">
                                            <i class="bi bi-pencil-square me-1"></i> ویرایش
                                        </a>
                                        <a href="{{ route('admin.articles.index', ['category_id' => $category->id]) }}" class="btn btn-sm btn-primary-soft w-100">
                                            مشاهده اخبار
                                        </a>
                                    </div>
                                </div>
                                <!-- Category item END -->
                            </div>

                        @empty

                            <div class="container">
                                <div class="d-flex align-items-center justify-content-center mt-5 border border-2 rounded-4">
                                    <div class="d-flex flex-column align-items-center justify-content-center p-4 p-md-5">
                                        <span class="fs-5">متاسفانه خبری برای این فیلتر یافت نشد !</span>
                                        <span class="fs-6 mt-1">می توانید از فیلتر دسته بندی استفاده کنید.</span>
                                    </div>
                                </div>
                            </div>
                        @endforelse

                    </div>
                </div>

                <hr class="my-5">

                @php
                    $isEdit = !empty($editingCategory);
                @endphp

                <div class="col-12 mt-5" id="category_form_card">
                    <div class="border py-3 rounded-3 card">
                        <div class="px-4 d-flex justify-content-between align-items-center">
                            <h3 id="create_new_category">
                                {{ $isEdit ? 'ویرایش دسته‌بندی: ' . $editingCategory->title : 'ایجاد دسته بندی جدید' }}
                            </h3>
                            @if ($isEdit)
                                <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-secondary">
                                    انصراف از ویرایش
                                </a>
                            @endif
                        </div>
                        <hr>
                        <div class="px-4 py-3">
                            <form action="{{ $isEdit ? route('admin.categories.update', $editingCategory) : route('admin.categories.store') }}" method="POST" id="accountForm">
                                @csrf
                                @if ($isEdit)
                                    @method('PUT')
                                @endif

                                <div class="row mb-3">
                                    <div class="col-12 col-sm-6">
                                        <label class="form-label" for="title">عنوان دسته بندی (فارسی)</label>
                                        <input class="form-control mb-1 @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title', $editingCategory->title ?? '') }}">
                                        @error('title')
                                            <label class="small text-danger">{{ $message }}</label>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <label class="form-label" for="slug">اسلاگ دسته بندی (انگلیسی)</label>
                                        <input class="form-control mb-1 @error('slug') is-invalid @enderror" type="text" name="slug" id="slug" value="{{ old('slug', $editingCategory->slug ?? '') }}">
                                        @error('slug')
                                            <label class="small text-danger">{{ $message }}</label>
                                        @else
                                            <small class="text-secondary">اسلاگ، یک شناسه انگلیسی منحصر‌به‌فرد است.</small>
                                        @enderror
                                    </div>

                                    <div class="col-12 mt-3">
                                        <label class="form-label" for="description">توضیحات</label>
                                        <textarea class="form-control mb-1 @error('description') is-invalid @enderror" style="min-height: 80px" name="description" id="description">{{ old('description', $editingCategory->description ?? '') }}</textarea>
                                        @error('description')
                                            <label class="small text-danger">{{ $message }}</label>
                                        @else
                                            <small class="text-secondary">توضیحات باید حداکثر 200 کاراکتر باشد.</small>
                                        @enderror
                                    </div>

                                    <div class="form-check form-switch form-check-md mt-4 ms-3">
                                        <label class="form-check-label" for="is_show">آیا این دسته بندی نمایش داده شود؟</label>
                                        <input name="is_show" class="form-check-input" type="checkbox" id="is_show" value="1" {{ old('is_show', $editingCategory->is_show ?? true) ? 'checked' : '' }}>
                                    </div>
                                </div>

                                <!-- Action buttons -->
                                <div class="d-flex justify-content-end mt-4">
                                    @if ($isEdit)
                                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary me-2">لغو</a>
                                    @else
                                        <a href="" id="cancelBtn" class="btn bg-secondary border-0 me-2 disabled" style="pointer-events: none;">لغو</a>
                                    @endif
                                    <button type="submit" class="btn btn-primary">
                                        {{ $isEdit ? 'ذخیره تغییرات' : 'ذخیره' }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Main contain END -->
@endsection

@push('scripts')
    <script>
        // dirty state detection account form
        (function() {
            const form = document.getElementById('accountForm');
            const cancelBtn = document.getElementById('cancelBtn');

            if (!form || !cancelBtn) return;

            function activateCancelButton() {
                cancelBtn.classList.remove('disabled', 'bg-secondary');
                cancelBtn.classList.add('bg-danger');
                cancelBtn.style.pointerEvents = 'auto';
            }

            const fields = form.querySelectorAll('input, select, textarea');

            fields.forEach(function(field) {

                const eventType = (field.tagName === 'SELECT') ? 'change' : 'input';

                field.addEventListener(eventType, activateCancelButton);
            });

            cancelBtn.addEventListener('click', function(e) {
                if (cancelBtn.classList.contains('bg-danger')) {
                    const confirmLeave = confirm('تغییراتی که اعمال کردید ذخیره نشده. مطمئنید می‌خواید لغو کنید؟');
                    if (!confirmLeave) {
                        e.preventDefault();
                    }
                }
            });

        })();
    </script>
@endpush
