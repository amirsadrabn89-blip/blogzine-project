@extends('layouts.layout-dashboard')


{{-- ===(title)=== --}}
@section('title')
    وبلاگ | پنل مدیریت کاربران
@endsection


{{-- ====(main)=== --}}
@section('dashboard-content')
    <!-- Main contain START -->
    <section class="py-4 bg-body-custom" style="min-height: 100vh;">
        <div class="container">
            <div class="row g-2">

                <h2>پنل مدیریت کاربران
                    <hr>
                </h2>

                <div class="p-2 border border-2 rounded-4">
                    <form method="GET" action="{{ route('admin.users.index') }}" class="d-flex justify-content-between px-3 row g-2">

                        <div class="col-12 col-sm-12 col-md-3 mt-2">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0" style="height: 44px"><i class="fas fa-search text-muted"></i></span>
                                <input type="text" name="search" class="form-control" style="height: 44px" placeholder="جستجو بر اساس نام، ایمیل یا موبایل..." value="{{ request('search') }}">
                            </div>
                        </div>

                        <div class="col-6 col-sm-4 col-md-3 mt-2">
                            <select name="role" class="form-select" style="height: 44px">
                                <option value="">همه نقش‌ها</option>
                                <option value="admin" @selected(request('role') === 'admin')>مدیران (Admins)</option>
                                <option value="user" @selected(request('role') === 'user')>کاربران (Users)</option>
                            </select>
                        </div>

                        <div class="col-6 col-sm-3 col-md-3 mt-2">
                            <select name="status" class="form-select" style="height: 44px">
                                <option value="">همه وضعیت‌ها</option>
                                <option value="active" @selected(request('status') === 'active')>فعال</option>
                                <option value="banned" @selected(request('status') === 'banned')>مسدود شده</option>
                            </select>
                        </div>

                        <div class="col-12 col-sm-4 col-md-3 d-flex gap-2 pt-1 mt-2">
                            <button type="submit" class="btn btn-primary flex-fill text-center" style="height: 38px">
                                <i class="fas fa-filter me-1"></i>فیلتر
                            </button>
                            <a href="{{ url()->current() }}" class="btn btn-outline-secondary" style="height: 38px">پاک کردن</a>
                        </div>
                    </form>
                </div>

                <div class="p-3 border border-2 rounded-3 shadow-sm overflow-hidden">
                    <div class="card border table-responsive">
                        <table class="table table-hover align-middle mb-00 text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>آواتار</th>
                                    <th>نام</th>
                                    <th>ایمیل / موبایل</th>
                                    <th>نقش</th>
                                    <th>وضعیت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td class="text-center">
                                            {{ $users->firstItem() + $key }}
                                        </td>
                                        <td class="text-center">
                                            @php
                                                $avatarSrc = $user->avatar_url ?? asset('assets/images/avatar/default.png');
                                            @endphp
                                            <img src="{{ $avatarSrc }}"
                                                alt="{{ $user->name }}"
                                                class="rounded-circle border avatar-preview-btn"
                                                role="button"
                                                data-bs-toggle="modal"
                                                data-bs-target="#avatarModal"
                                                data-image="{{ $avatarSrc }}"
                                                data-name="{{ $user->name }}"
                                                data-bio="{{ $user->bio ?? 'بیوگرافی ثبت نشده است.' }}"
                                                title="مشاهده پروفایل کاربر"
                                                style="min-width: 45px; min-height: 45px; max-width: 45px; max-height: 45px; object-fit: cover; cursor: pointer;">
                                        </td>
                                        <td class="text-center">{{ $user->name }}</td>
                                        <td class="text-center" dir="ltr">{{ $user->email }} <br> {{ $user->phone_number }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('admin.users.toggleRole', $user) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="btn btn-sm {{ $user->is_admin ? 'btn-danger' : 'btn-success' }}">
                                                    {{ $user->is_admin ? 'تبدیل به کاربر عادی' : 'ارتقا به مدیر' }}
                                                </button>
                                            </form>
                                        </td>
                                        <td class="text-center">
                                            <form action="{{ route('admin.users.toggleBan', $user) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="btn btn-sm {{ $user->is_active ? 'btn-warning' : 'btn-success' }}">
                                                    {{ $user->is_active ? 'مسدود کردن' : 'آزاد سازی' }}
                                                </button>
                                            </form>
                                        </td>
                                        <td class="text-center">
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('آیا مطمئن هستید؟')">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger">حذف حساب</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{ $users->links() }}

            </div>
        </div>
    </section>
    <!-- Main contain END -->

    <!-- Avatar Preview Modal -->
    <div class="modal fade" id="avatarModal" tabindex="-1" aria-labelledby="avatarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header border-0 pb-0">
                    <h6 class="modal-title fs-5 mt-2 ms-2" id="avatarModalLabel"></h6>
                    <button type="button" class="btn-close mt-2 me-2" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-4">
                    <img id="modalAvatarImage" src="" alt="Avatar" class="img-fluid rounded-4 shadow-sm border" style="height: 400px; width: auto; object-fit: contain;">
                </div>

                <div class="pb-4 px-4">
                    <h4>
                        بیوگرافی کاربر :
                    </h4>
                    <div class="w-100 d-flex justify-content-center">
                        <span id="modalUserBio" class="text-center d-inline-block">
                            بیوگرافی ثبت نشده است.
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const avatarModal = document.getElementById('avatarModal');
            if (avatarModal) {
                avatarModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const imageUrl = button.getAttribute('data-image');
                    const userName = button.getAttribute('data-name');
                    const userbio = button.getAttribute('data-bio');

                    const modalTitle = avatarModal.querySelector('#avatarModalLabel');
                    const modalImage = avatarModal.querySelector('#modalAvatarImage');
                    const modalUserBio = avatarModal.querySelector('#modalUserBio');

                    modalTitle.textContent = userName;
                    modalUserBio.textContent = userbio;
                    modalImage.src = imageUrl;
                });
            }
        });
    </script>
@endpush
