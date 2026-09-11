@extends('layouts.layout-dashboard')

@section('title')
    وبلاگ | پنل مدیریت پیام‌های کاربران
@endsection

@section('dashboard-content')
    <section class="py-4 bg-body-custom" style="min-height: 100vh;">
        <div class="container">
            <div class="row g-2">

                <h2>
                    پنل مدیریت پیام‌های کاربران
                    <hr>
                </h2>

                <div class="p-3 border border-2 rounded-3 shadow-sm overflow-hidden">
                    <div class="card border table-responsive">
                        <table class="table table-hover align-middle mb-0 text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th style="min-width: 150px;">عنوان پیام</th>
                                    <th style="min-width: 250px;">متن پیام</th>
                                    <th style="min-width: 130px;">نام کاربر</th>
                                    <th style="min-width: 180px;">ایمیل / شماره</th>
                                    <th style="min-width: 250px;">پاسخ مدیر</th>
                                    <th style="min-width: 110px;">عملیات</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($contactMessages as $key => $contactMessage)
                                    <tr>
                                        <td>
                                            <div class="p-1">
                                                {{ $contactMessages->firstItem() + $key }}
                                            </div>
                                        </td>

                                        <td class="">
                                            {{ $contactMessage->subject }}
                                        </td>

                                        <td class="text-start">
                                            <div style="max-width: 300px; white-space: normal;">
                                                {{ \Illuminate\Support\Str::limit($contactMessage->message, 50, '...') }}
                                            </div>
                                        </td>

                                        <td>
                                            {{ $contactMessage->name }}
                                        </td>

                                        <td dir="ltr">
                                            <div>
                                                {{ $contactMessage->email }}
                                            </div>

                                            @if ($contactMessage->user?->phone_number)
                                                <div class="mt-1">
                                                    {{ $contactMessage->user->phone_number }}
                                                </div>
                                            @else
                                                <small class="text-muted">
                                                    شماره ثبت نشده
                                                </small>
                                            @endif
                                        </td>

                                        <td class="text-start">
                                            @if ($contactMessage->admin_reply)
                                                <div style="max-width: 300px; white-space: normal;">
                                                    {{ \Illuminate\Support\Str::limit($contactMessage->admin_reply, 50, '...') }}
                                                </div>

                                                @if ($contactMessage->replied_at)
                                                    <small class="d-block text-success mt-2">
                                                        {{ verta($contactMessage->replied_at)->format('Y/m/d - H:i') }}
                                                    </small>
                                                @endif
                                            @else
                                                <span class="badge text-bg-warning">
                                                    هنوز پاسخ داده نشده
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            <button type="button"
                                                    class="btn btn-sm {{ $contactMessage->admin_reply ? 'btn-outline-success' : 'btn-primary' }}"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#replyModal{{ $contactMessage->id }}">

                                                @if ($contactMessage->admin_reply)
                                                    <i class="bi bi-pencil-square"></i>
                                                    ویرایش
                                                @else
                                                    <i class="bi bi-reply-fill"></i>
                                                    پاسخ
                                                @endif
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">
                                            پیامی یافت نشد.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if ($contactMessages->hasPages())
                    <div class="mt-3">
                        {{ $contactMessages->links() }}
                    </div>
                @endif

            </div>
        </div>
    </section>

    @foreach ($contactMessages as $contactMessage)
        <div class="modal fade" id="replyModal{{ $contactMessage->id }}" tabindex="-1" aria-labelledby="replyModalLabel{{ $contactMessage->id }}" aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="replyModalLabel{{ $contactMessage->id }}">

                            @if ($contactMessage->admin_reply)
                                ویرایش پاسخ پیام: {{ $contactMessage->subject }}
                            @else
                                پاسخ به پیام: {{ $contactMessage->subject }}
                            @endif
                        </h5>

                        <button type="button"
                                class="btn-close m-0"
                                data-bs-dismiss="modal"
                                aria-label="بستن">
                        </button>
                    </div>

                    <form action="{{ route('admin.contact-messages.save-reply', $contactMessage) }}" method="POST">

                        @csrf
                        @method('PATCH')

                        <div class="modal-body">

                            <div class="rounded-4 bg-light border p-3 mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge text-bg-info">
                                        پیام کاربر
                                    </span>

                                    <small class="text-muted">
                                        {{ $contactMessage->name }}
                                    </small>
                                </div>

                                <p class="mb-0 lh-lg">
                                    {!! nl2br(e($contactMessage->message)) !!}
                                </p>
                            </div>

                            <div>
                                <label for="admin_reply_{{ $contactMessage->id }}" class="form-label fw-bold">
                                    متن پاسخ پشتیبانی
                                </label>

                                <textarea name="admin_reply" id="admin_reply_{{ $contactMessage->id }}" rows="7" class="form-control" placeholder="پاسخ خود را برای کاربر بنویسید..." required>{{ old('admin_reply', $contactMessage->admin_reply) }}</textarea>

                                <small class="text-muted">
                                    این پاسخ در صفحه پیام‌های پشتیبانی کاربر نمایش داده خواهد شد.
                                </small>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                لغو
                            </button>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-send"></i>

                                @if ($contactMessage->admin_reply)
                                    ذخیره ویرایش پاسخ
                                @else
                                    ارسال پاسخ
                                @endif
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
