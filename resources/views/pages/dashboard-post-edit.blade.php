@extends('layouts.layout-dashboard')

{{-- ===(title)=== --}}
@section('title')
    وبلاگ | ویرایش خبر
@endsection

{{-- ===(styles)=== --}}
@push('styles')
    <style>
        /* ---------- Quill Editor Styling ---------- */
        #quilleditor .ql-editor {
            min-height: 250px;
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
            border-bottom-right-radius:  ̄0.5rem;
            border-color: var(--bs-border-color, #343a40) !important;
        }

        #quilleditor .ql-editor.ql-blank::before {
            right:** 15px;
            left: auto;
            text-align: right;
            font-style: normal;
            opacity:** 0.6;
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

        @media (max-width:** 766.98px)** {
            .ql-editor img {
                max-width:** 180px;
            }
        }

        /* ---------- Tag Input Styles ---------- */
        .tag-box-wrapper {
            transition: all 0.25s ease;
            min-height:** 48px;
        }

        .tag-box-wrapper:focus-within {
            border-color: var(--bs-primary)** !important;
            box-shadow:**** 0 0 0 0.25rem rgba(var(--bs-primary-rgb),** 0.15);
        }

        .tag-item {
            transition: all 0.2s ease-in-out;
            animation: tagFadeIn 0.25s ease-out;
        }

        @keyframes tagFadeIn {
            from {
                opacity:** 0;
                transform: scale(0.9);
            }
            to {
                opacity:** 1;
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
                        <h4 class="fw-bold mb-1 fs-4">ویرایش خبر</h4>
                        <span class="small text-muted fs-6">تغییرات خود را اعمال کرده و پس از تکمیل ذخیره کنید.</span>
                    </div>
                </div>

                <div class="col-12 col-md-4 d-flex align-items-center justify-content-end ">
                    <a href="{{ route('user.my-articles.page') }}" class="btn btn-sm btn-light rounded-pill shadow-sm fs-6 border">
                        <i class="bi bi-arrow-right-circle me-1"></i> بازگشت به اخبار من
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
                            <form id="edit-news-form" action="{{ route('dashboard-post-edit.update', $article) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Main form -->
                                <div class="row g-3">

                                    <!-- Title -->
                                    <div class="col-12">
                                        <div class="mb-2">
                                            <label for="title" class="form-label fw-semibold">عنوان خبر<sup class="text-danger ms-1">*</sup></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-body text-muted border-end-0 rounded-3 rounded-end-0"><i class="bi bi-type fs-6"></i></span>
                                                <input id="title" name="title" type="text" class="form-control ps-3 rounded-3 rounded-start-0" placeholder="عنوان مقاله یا خبر را وارد کنید..." value="{{ old('title', $article->title) }}">
                                            </div>
                                            <label class="mt-1 small text-danger">
                                                @error('title')
                                                    {{ $message }}
                                                @enderror
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Category & Tags -->
                                    <!-- Tag Input -->
                                    <div class="col-12 col-md-7">
                                        <div class="mb-2">
                                            <label class="form-label fw-semibold">برچسب‌ها <span class="text-muted small fw-normal">(حداکثر ۶ برچسب)</span></label>

                                            <div class="tag-box-wrapper border rounded-3 p-2 d-flex flex-wrap align-items-center gap-2 bg-body" id="tagBox">
                                                @php
                                                    $oldTags = old('tags');
                                                    if (is_null($oldTags)) {
                                                        $tagsList = is_array($article->tags) ? $article->tags : explode(',', $article->tags ?? '');
                                                    } else {
                                                        $tagsList = is_array($oldTags) ? $oldTags : explode(',', $oldTags);
                                                    }
                                                @endphp

                                                @foreach ($tagsList as $tag)
                                                    @if (trim($tag))
                                                        <span class="tag-item badge bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center gap-2 px-3 py-2 rounded-pill fs-6 border border-primary border-opacity-25">
                                                            {{ trim($tag) }}
                                                            <button type="button" class="btn-remove-tag bg-transparent border-0 p-0 text-primary ms-1" title="حذف">
                                                                <i class="bi bi-x-lg small"></i>
                                                            </button>
                                                            <input type="hidden" name="tags[]" value="{{ trim($tag) }}">
                                                        </span>
                                                    @endif
                                                @endforeach

                                                <input type="text" id="tagInput" class="form-control form-control-sm border-0 shadow-none flex-grow-1 bg-transparent text-body"
                                                    style="min-width: 140px;" placeholder="تایپ کنید و + را بزنید..." autocomplete="off">
                                                <button type="button" id="addTagBtn" class="btn btn-sm btn-primary rounded-circle d-flex align-items-center justify-content-center shadow" style="width: 32px; height: 32px;">
                                                    <i class="bi bi-plus-lg"></i>
                                                </button>
                                            </div>

                                            <small id="tagError" class="text-danger d-none mt-1">● حداکثر ۶ تگ مجاز است !</small>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-5">
                                        <div class="mb-2">
                                            <label for="category_id" class="form-label fw-semibold">دسته‌بندی<sup class="text-danger ms-1">*</sup></label>
                                            <select id="category_id" name="category_id" class="form-select rounded-3">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" @selected(old('category_id', $article->category_id) == $category->id)>
                                                        {{ $category->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <span class="text-danger small d-block mt-1">{{ $message }}</span>
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

                                    <!-- Submit button -->
                                    <div class="col-12 text-center mt-4">
                                        <button class="btn btn-primary btn-lg px-5 rounded-pill shadow-sm" type="submit">
                                            <i class="bi bi-check2-circle me-1"></i> ذخیره تغییرات
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
            const form = document.getElementById('edit-news-form');
            const bodyInput = document.getElementById('body-input');
            const csrfToken = document
                .querySelector('meta[name="csrf-token"]')
                ?.getAttribute('content');

            if (!editorElement || !form || !bodyInput) {
                console.error('عناصر موردنیاز ویرایشگر پیدا نشدند.', {
                    editorElement,
                    form,
                    bodyInput
                });
                return;
            }

            if (typeof Quill === 'undefined') {
                console.error('کتابخانه Quill بارگذاری نشده است.');
                return;
            }

            const toolbarOptions = [
                [{ header: [1, 2, 3, 4, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ color: [] }, { background: [] }],
                [{ align: [] }],
                [{ list: 'ordered' }, { list: 'bullet' }],
                ['blockquote', 'code-block'],
                ['link', 'image'],
                ['clean']
            ];

            const quill = new Quill(editorElement, {
                theme: 'snow',
                modules: {
                    toolbar: {
                        container: toolbarOptions,
                        handlers: {
                            image: function() {
                                const fileInput = document.createElement('input');
                                fileInput.type = 'file';
                                fileInput.accept = 'image/jpeg,image/png,image/gif,image/webp';
                                fileInput.click();
                                fileInput.addEventListener('change', async function() {
                                    const file = fileInput.files?.[0];
                                    if (!file) return;

                                    const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                                    if (!allowedTypes.includes(file.type)) {
                                        alert('فرمت تصویر مجاز نیست.');
                                        return;
                                    }

                                    const maximumFileSize = 5 * 1024 * 1024;
                                    if (file.size > maximumFileSize) {
                                        alert('حجم تصویر نباید بیشتر از ۵ مگابایت باشد.');
                                        return;
                                    }

                                    const formData = new FormData();
                                    formData.append('image', file);

                                    try {
                                        const response = await fetch(
                                            @json(route('articles.upload-image')), {
                                                method: 'POST',
                                                headers: {
                                                    'X-CSRF-TOKEN': csrfToken ?? '',
                                                    'Accept': 'application/json',
                                                    'X-Requested-With': 'XMLHttpRequest'
                                                },
                                                body: formData
                                            }
                                        );

                                        let data = {};
                                        try {
                                            data = await response.json();
                                        } catch (jsonError) {
                                            throw new Error('پاسخ نامعتبر از سرور دریافت شد.');
                                        }

                                        if (!response.ok) {
                                            const validationError = data.errors?.image?.[0];
                                            throw new Error(validationError ?? data.message ?? 'آپلود تصویر ناموفق بود.');
                                        }

                                        if (!data.url) {
                                            throw new Error('آدرس تصویر از سرور دریافت نشد.');
                                        }

                                        const selection = quill.getSelection(true);
                                        const insertIndex = selection?.index ?? Math.max(0, quill.getLength() - 1);

                                        quill.insertEmbed(insertIndex, 'image', data.url, 'user');
                                        quill.insertText(insertIndex + 1, '\n', 'user');
                                        quill.setSelection(insertIndex + 2, 0, 'silent');
                                        quill.focus();
                                    } catch (error) {
                                        console.error('خطا در آپلود تصویر:', error);
                                        alert(error.message ?? 'آپلود تصویر با خطا مواجه شد.');
                                    }
                                }, { once: true });
                            }
                        }
                    }
                }
            });

            const previousBody = @json(old('body', $article->body));

            if (typeof previousBody === 'string' && previousBody.trim() !== '') {
                quill.clipboard.dangerouslyPasteHTML(previousBody);
            } else {
                quill.root.setAttribute('dir', 'rtl');
                quill.root.style.textAlign = 'right';
            }

            bodyInput.value = quill.root.innerHTML;

            quill.on('text-change', function() {
                bodyInput.value = quill.root.innerHTML;
            });

            form.addEventListener('submit', function(event) {
                const text = quill.getText().trim();
                const hasImage = Boolean(quill.root.querySelector('img'));

                if (!text && !hasImage) {
                    event.preventDefault();
                    bodyInput.value = '';
                    alert('لطفاً متن خبر را تکمیل کنید.');
                    quill.focus();
                    return;
                }

                bodyInput.value = quill.root.innerHTML;
            });
        });

        // ============================================================
        //            TAG INPUT logic (Edit Page)
        // ============================================================
        document.addEventListener('DOMContentLoaded', function () {
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

        function showTagError(message = errorText) {
            tagError.textContent = message;
            tagError.classList.remove('d-none');
        }

        function hideTagError() {
            tagError.classList.add('d-none');
        }

        function createTag(value) {
            const currentCount = countTags();

            if (currentCount >= MAX_TAGS) {
                showTagError();
                return false;
            }

            hideTagError();

            const tag = document.createElement('span');
            tag.className = 'tag-item badge bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center gap-2 px-3 py-2 rounded-pill fs-6 border border-primary border-opacity-25';
            tag.innerHTML = `
                ${value}
                <button type="button" class="btn-remove-tag bg-transparent border-0 p-0 text-primary ms-1" title="حذف">
                    <i class="bi bi-x-lg small"></i>
                </button>
            `;

            const hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.name = 'tags[]';
            hidden.value = value;

            tag.querySelector('.btn-remove-tag').addEventListener('click', function () {
                tag.remove();
                hidden.remove();
                hideTagError();
            });

            tagBox.insertBefore(hidden, tagInput);
            tagBox.insertBefore(tag, tagInput);

            return true;
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

            const ok = createTag(value);
            if (ok) {
                tagInput.value = '';
                tagInput.focus();
            }
        }

        tagBox.querySelectorAll('.btn-remove-tag').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const tag = btn.closest('.tag-item');
                const hidden = tag.previousElementSibling;

                if (hidden && hidden.name === 'tags[]') {
                    hidden.remove();
                }

                tag.remove();
                hideTagError();
            });
        });

        addTagBtn.addEventListener('click', addTag);

        tagInput.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                addTag();
            }
        });
    });
    </script>
@endpush

