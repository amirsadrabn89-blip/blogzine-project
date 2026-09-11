@extends('layouts.layout-dashboard')

{{-- ===(title)=== --}}
@section('title')
    وبلاگ | ایجاد خبر
@endsection

{{-- ===(styles)=== --}}
@push('styles')
    <style>
        /* Quill Editor Styling */
        #quilleditor .ql-editor {
            min-height: 280px;
            direction: rtl;
            text-align: right;
            font-family: inherit;
            font-size: 15px;
            line-height: 1.8;
            border-bottom-left-radius: 0.5rem;
            border-bottom-right-radius: 0.5rem;
        }

        #quilleditor .ql-toolbar.ql-snow {
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
            border-color: var(--bs-border-color, #343a40) !important;
            background-color: rgba(255, 255, 255, 0.03);
            direction: rtl;
            text-align: right;
        }

        #quilleditor.ql-container.ql-snow {
            border-bottom-left-radius: 0.5rem;
            border-bottom-right-radius: 0.5rem;
            border-color: var(--bs-border-color, #343a40) !important;
        }

        #quilleditor .ql-editor.ql-blank::before {
            right: 15px;
            left: auto;
            text-align: right;
            font-style: normal;
            opacity: 0.6;
        }

        #quilleditor .ql-editor img {
            display: block;
            max-width: 200px;
            width: auto !important;
            height: auto !important;
            margin: 15px auto;
            object-fit: contain;
            border-radius: 8px;
        }

        @media (max-width: 766.98px) {
            .ql-editor img {
                max-width: 180px;
            }
        }

        /* Drag & Drop Upload Zone */
        .image-upload-wrapper {
            border: 2px dashed var(--bs-border-color, #495057);
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.015);
            cursor: pointer;
        }

        .image-upload-wrapper:hover {
            border-color: var(--bs-primary);
            background: rgba(var(--bs-primary-rgb), 0.04);
        }

        .image-preview-container {
            max-height: 220px;
            overflow: hidden;
            border-radius: 8px;
            position: relative;
        }

        .image-preview-container img {
            width: 100%;
            max-height: 220px;
            object-fit: cover;
        }

        /* Tag Input Styles */
        .tag-box-wrapper {
            transition: all 0.25s ease;
            min-height: 48px;
        }

        .tag-box-wrapper:focus-within {
            border-color: var(--bs-primary) !important;
            box-shadow: 0 0 0 0.25rem rgba(var(--bs-primary-rgb), 0.15);
        }

        .tag-item {
            transition: all 0.2s ease-in-out;
            animation: tagFadeIn 0.25s ease-out;
        }

        @keyframes tagFadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
@endpush

{{-- ====(main)=== --}}
@section('dashboard-content')
    <!-- ======================= Main contain START -->
    <section class="py-4 bg-body-custom">
        <div class="container">
            <!-- Header Title -->
            
            <div class="row py-3 align-items-center">
                <div class="col-12 col-md-8 d-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="fw-bold mb-1 fs-4">ایجاد خبر جدید</h4>
                        <span class="small text-muted fs-6">اطلاعات و محتوای خبر خود را وارد کرده و پس از تکمیل منتشر کنید.</span>
                    </div>
                </div>

                <div class="col-12 col-md-4 d-flex align-items-center justify-content-end mt-3">
                    <a href="{{ route('user.dashboard.page') }}" class="btn btn-sm btn-light rounded-pill shadow-sm fs-6 border">
                        <i class="bi bi-arrow-right-circle me-1"></i> بازگشت به پیشخوان من
                    </a>
                </div>
            </div>

            <div class="container">
                <div class="border-bottom bg-body-custom"></div>
            </div>

            <div class="row pt-5">
                <div class="col-12">
                    <div class="card border shadow-sm rounded-3">
                        <div class="card-body p-4">
                            <!-- Form START -->
                            <form id="create-news-form" method="POST" action="{{ route('dashboard-post-create.store') }}" enctype="multipart/form-data">

                                @csrf

                                <!-- Main form -->
                                <div class="row g-3">

                                    <!-- Title -->
                                    <div class="col-12">
                                        <div class="mb-2">
                                            <label for="con-name" class="form-label fw-semibold">عنوان خبر<sup class="text-danger ms-1">*</sup></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-body text-muted border-end-0 rounded-3 rounded-end-0"><i class="bi bi-type fs-6"></i></span>
                                                <input id="con-name" name="title" type="text" class="form-control ps-3 rounded-3 rounded-start-0" placeholder="عنوان مقاله یا خبر را وارد کنید..." value="{{ old('title') }}">
                                            </div>
                                            @error('title')
                                                <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Main toolbar & Editor -->
                                    <div class="col-12">
                                        <div class="mb-2">
                                            <label class="form-label fw-semibold">متن خبر<sup class="text-danger ms-1">*</sup></label>

                                            <!-- Editor container -->
                                            <div class="bg-body border rounded-3 rounded-top-0" id="quilleditor"></div>

                                            <!-- Hidden Input for Laravel -->
                                            <input type="hidden" name="body" id="body-input">

                                            <label class="mt-1 small text-danger" id="body-error">
                                                @error('body')
                                                    {{ $message }}
                                                @enderror
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Image Upload -->
                                    <div class="col-12">
                                        <div class="mb-2">
                                            <label class="form-label fw-semibold">تصویر شاخص خبر<sup class="text-danger ms-1">*</sup></label>

                                            <div class="image-upload-wrapper border rounded-3 p-4 text-center position-relative" id="uploadDropzone">
                                                <input id="main_image" class="d-none" type="file" name="main_image" accept="image/jpeg,image/png,image/gif,image/webp">

                                                <div id="uploadPlaceholder">
                                                    <div class="icon-lg bg-primary bg-opacity-10 text-primary rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                                        <i class="bi bi-cloud-arrow-up fs-4"></i>
                                                    </div>
                                                    <h6 class="mb-1" id="main-image-label">برای انتخاب عکس کلیک کنید</h6>
                                                    <p class="small text-muted mb-0">فرمت‌های مجاز: JPG، JPEG، PNG، WEBP (ابعاد پیشنهادی: 600px * 450px)</p>
                                                </div>

                                                {{-- Live Preview Box --}}
                                                <div id="previewContainer" class="image-preview-container d-none">
                                                    <img id="imagePreview" src="#" alt="پیش‌نمایش تصویر">
                                                    <button type="button" id="removeImageBtn" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2 rounded-circle" style="z-index: 5;" title="حذف تصویر">
                                                        <i class="bi bi-x-lg"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            @error('main_image')
                                                <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Tag Input -->
                                    <div class="col-12 col-md-7">
                                        <div class="mb-2">
                                            <label class="form-label fw-semibold">برچسب‌ها <span class="text-muted small fw-normal">(حداکثر ۶ برچسب)</span></label>

                                            <div class="tag-box-wrapper border rounded-3 p-2 d-flex flex-wrap align-items-center gap-2 bg-body" id="tagBox">
                                                @if (isset($article) && !empty($article->tags))
                                                    @foreach ($article->tags as $oldTag)
                                                        @if (trim($oldTag))
                                                            <span class="tag-item badge bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center gap-2 px-3 py-2 rounded-pill fs-6 border border-primary border-opacity-25">
                                                                {{ trim($oldTag) }}
                                                                <button type="button" class="btn-remove-tag bg-transparent border-0 p-0 text-primary ms-1" title="حذف">
                                                                    <i class="bi bi-x-lg small"></i>
                                                                </button>
                                                            </span>
                                                            <input type="hidden" name="tags[]" value="{{ trim($oldTag) }}">
                                                        @endif
                                                    @endforeach
                                                @endif

                                                <input type="text" id="tagInput" class="form-control form-control-sm border-0 shadow-none flex-grow-1 bg-transparent text-body" style="min-width: 140px;" placeholder="تایپ کنید و + را بزنید..." autocomplete="off">
                                                <button type="button" id="addTagBtn" class="btn btn-sm btn-primary rounded-circle d-flex align-items-center justify-content-center shadow" style="width: 32px; height: 32px;">
                                                    <i class="bi bi-plus-lg"></i>
                                                </button>
                                            </div>

                                            <small id="tagError" class="text-danger d-none mt-1">● حداکثر ۶ تگ مجاز است !</small>
                                        </div>
                                    </div>

                                    <!-- Category -->
                                    <div class="col-12 col-md-5">
                                        <div class="mb-2">
                                            <label for="category_id" class="form-label fw-semibold">دسته‌بندی<sup class="text-danger ms-1">*</sup></label>
                                            <select class="form-select rounded-3" name="category_id" id="category_id">
                                                <option value="">انتخاب دسته‌بندی...</option>

                                                @foreach ($categories as $category)
                                                    <option
                                                            value="{{ $category->id }}"
                                                            @selected(old('category_id') == $category->id)>
                                                        {{ $category->title }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('category_id')
                                                <span class="text-danger small d-block mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Submit button -->
                                    <div class="col-12 text-center mt-4">
                                        <button class="btn btn-primary btn-lg px-5 rounded-pill shadow-sm" type="submit">
                                            <i class="bi bi-check2-circle me-1"></i> ایجاد و انتشار خبر
                                        </button>
                                    </div>

                                </div>
                            </form>
                            <!-- Form END -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======================= Main contain END -->
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
                    const editorElement = document.getElementById('quilleditor');
                    const form = document.getElementById('create-news-form');
                    const bodyInput = document.getElementById('body-input');

                    if (!editorElement || !form || !bodyInput) return;

                    // ---------- Quill Toolbar setup ----------
                    const toolbarOptions = [
                        [{
                            'header': [1, 2, 3, 4, false]
                        }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{
                            'color': []
                        }, {
                            'background': []
                        }],
                        [{
                            'align': []
                        }],
                        [{
                            'list': 'ordered'
                        }, {
                            'list': 'bullet'
                        }],
                        ['blockquote', 'code-block'],
                        ['link', 'image'],
                        ['clean']
                    ];

                    const quill = new Quill('#quilleditor', {
                        theme: 'snow',
                        modules: {
                            toolbar: {
                                container: toolbarOptions,
                                handlers: {
                                    image: function() {
                                        const input = document.createElement('input');
                                        input.type = 'file';
                                        input.accept = 'image/jpeg,image/png,image/gif,image/webp';
                                        input.click();

                                        input.addEventListener('change', async function() {
                                            const file = input.files && input.files[0];
                                            if (!file) return;

                                            const formData = new FormData();
                                            formData.append('image', file);

                                            try {
                                                const response = await fetch('{{ route('articles.upload-image') }}', {
                                                    method: 'POST',
                                                    headers: {
                                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
                                                        'Accept': 'application/json',
                                                        'X-Requested-With': 'XMLHttpRequest'
                                                    },
                                                    body: formData
                                                });

                                                const data = await response.json();
                                                if (!response.ok) throw new Error(data.message || 'آپلود تصویر ناموفق بود.');

                                                const range = quill.getSelection(true);
                                                quill.insertEmbed(range.index, 'image', data.url, 'user');
                                                quill.setSelection(range.index + 1, 0);
                                            } catch (error) {
                                                console.error(error);
                                                alert('آپلود تصویر با خطا مواجه شد.');
                                            }
                                        }, {
                                            once: true
                                        });
                                    }
                                }
                            }
                        }
                    });

                    // RTL configuration
                    quill.format('direction', 'rtl');
                    quill.format('align', 'right');

                    // Submit handler
                    form.addEventListener('submit', function(event) {
                        const text = quill.getText().trim();
                        if (!text) {
                            event.preventDefault();
                            bodyInput.value = '';
                            alert('لطفاً متن خبر را تکمیل کنید.');
                            return;
                        }
                        bodyInput.value = quill.root.innerHTML;
                    });

                    // ---------- Image Preview & Upload Handling ----------
                    const fileInput = document.getElementById('main_image');
                    const imageLabel = document.getElementById('main-image-label');
                    const uploadPlaceholder = document.getElementById('uploadPlaceholder');
                    const previewContainer = document.getElementById('previewContainer');
                    const imagePreview = document.getElementById('imagePreview');
                    const removeImageBtn = document.getElementById('removeImageBtn');

                    if (fileInput) {
                        fileInput.addEventListener('change', function() {
                            const file = this.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    imagePreview.src = e.target.result;
                                    uploadPlaceholder.classList.add('d-none');
                                    previewContainer.classList.remove('d-none');
                                }
                                reader.readAsDataURL(file);
                            }
                        });
                    }

                    if (removeImageBtn) {
                        removeImageBtn.addEventListener('click', function(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            fileInput.value = '';
                            imagePreview.src = '#';
                            previewContainer.classList.add('d-none');
                            uploadPlaceholder.classList.remove('d-none');
                            if (imageLabel) imageLabel.textContent = 'برای انتخاب عکس کلیک کنید';
                        });
                    }

                    const uploadDropzone = document.getElementById('uploadDropzone');

                    if (uploadDropzone && fileInput) {
                        uploadDropzone.addEventListener('click', function(e) {
                            if (e.target.closest('#removeImageBtn')) return;
                            fileInput.click();
                        });
                    }

                    // ============================================================
                    //            TAG INPUT logic (Create Page – clean version)
                    // ============================================================
                    const tagBox = document.getElementById('tagBox');
                    const tagInput = document.getElementById('tagInput');
                    const addTagBtn = document.getElementById('addTagBtn');
                    const tagError = document.getElementById('tagError');

                    if (!tagBox || !tagInput || !addTagBtn || !tagError) return;

                    const MAX_TAGS = 6;
                    const errorText = '● حداکثر ۶ تگ مجاز است !';

                    function countTags() {
                        return tagBox.querySelectorAll('input[name="tags[]"]').length;
                    }

                    function showTagError() {
                        tagError.textContent = errorText;
                        tagError.classList.remove('d-none');
                    }

                    function hideTagError() {
                        tagError.classList.add('d-none');
                    }

                    function createTag(value) {
                        if (countTags() >= MAX_TAGS) {
                            showTagError();
                            return;
                        }

                        hideTagError();

                        const span = document.createElement('span');
                        span.className = 'tag-item badge bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center gap-2 px-3 py-2 rounded-pill fs-6 border border-primary border-opacity-25';
                        span.innerHTML = value +
                            '<button type="button" class="btn-remove-tag bg-transparent border-0 p-0 text-primary ms-1" title="حذف"><i class="bi bi-x-lg small"></i></button>';

                        const hidden = document.createElement('input');
                        hidden.type = 'hidden';
                        hidden.name = 'tags[]';
                        hidden.value = value;

                        span.querySelector('.btn-remove-tag').addEventListener('click', function() {
                            span.remove();
                            hidden.remove();
                            hideTagError();
                        });

                        tagBox.insertBefore(hidden, tagInput);
                        tagBox.insertBefore(span, tagInput);
                    }

                    function addTag() {
                        const value = tagInput.value.trim();
                        if (!value) return;

                        const exists = Array.from(tagBox.querySelectorAll('input[name="tags[]"]'))
                            .some(input => input.value.toLowerCase() === value.toLowerCase());
                        if (exists) {
                            tagInput.value = '';
                            return;
                        }

                        createTag(value);
                        tagInput.value = '';
                        tagInput.focus();
                        }

                        // Initial tags removal (rendered from DB / old())
                        tagBox.querySelectorAll('.btn-remove-tag').forEach(btn => {
                            btn.addEventListener('click', function() {
                                const span = btn.closest('.tag-item');
                                const hidden = span.nextElementSibling;
                                if (hidden && hidden.name === 'tags[]') hidden.remove();
                                span.remove();
                                hideTagError();
                            });
                        });

                        addTagBtn.addEventListener('click', addTag);

                        tagInput.addEventListener('keydown', function(e) {
                            if (e.key === 'Enter') {
                                e.preventDefault();
                                addTag();
                            }
                        });

                    });
    </script>
@endpush
