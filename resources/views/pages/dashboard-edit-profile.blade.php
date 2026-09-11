@extends('layouts.layout-dashboard')


{{-- ===(title)=== --}}
@section('title')
    وبلاگ | ویرایش پروفایل
@endsection


@push('styles')
    <style>
        .cancle-btn:hover {
            background-color: rgba(255, 0, 0, 0.75);
        }
    </style>
@endpush

{{-- ====(main)=== --}}
@section('dashboard-content')
    <!-- Main contain START -->
    <section class="py-4 bg-body-custom" style="min-height: 100vh;">
        <div class="container">
            <div class="row g-4">
                <!-- Profile cover and info START -->
                <div class="col-12">
                    <div class="card mb-4 position-relative z-index-9 border">
                        <!-- Cover image -->
                        <div class="py-5 h-200 rounded-3 m-2" style="background-image:url({{ asset('assets/images/blog/16by9/big/07.jpg') }}); background-position: center bottom; background-size: cover; background-repeat: no-repeat;"></div>
                        <div class="card-body pt-3 pb-0">
                            <div class="row d-flex justify-content-between pb-2">
                                <!-- Avatar -->
                                <div class="col-sm-12 col-md-auto text-center text-md-start">
                                    <div class="avatar avatar-xxl mt-n5">
                                        <img class="avatar-img rounded-circle border border-white border-3 shadow-lg" src="{{ $user->avatar_url }}" alt="">
                                    </div>
                                </div>
                                <!-- Profile info -->
                                <div class="col-sm-12 col-md text-center text-md-start d-md-flex justify-content-between align-items-center">
                                    <div>
                                        <h4 class="my-2 d-flex">
                                            {{ $user->name }}
                                            @if ($user->is_admin)
                                                <i class="bi bi-patch-check-fill text-info small ms-1"></i>
                                            @endif
                                        </h4>
                                        <ul class="list-inline">
                                            <li class="list-inline-item"><i class="bi bi-calendar2-plus me-1"></i> تاریخ عضویت {{ verta($user->created_at)->format('d F Y') }}</li>
                                        </ul>
                                        <p class="m-0"></p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Profile info END -->
            </div>

            @if ($is_admin)
                <div class="d-flex justify-content-center">
                    <div class="alert alert-info w-75 d-flex justify-content-between">
                        <span>شما مدیر این سایت می باشید.</span>
                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="alert"
                                aria-label="بستن">
                        </button>
                    </div>
                </div>
            @endif

            <div class="row g-4">
                <!-- Left sidebar START -->
                <div class="col-lg-7 col-xxl-8">
                    <!-- Profile START -->
                    <form method="POST" action="{{ route('profile.update.account') }}" enctype="multipart/form-data" id="accountForm">

                        @csrf
                        @method('PUT')


                        <div class="card border mb-4">
                            <div class="card-header border-bottom p-3">
                                <h4 class="card-header-title mb-0">حساب کاربری</h4>
                            </div>

                            <div class="card-body">
                                <!-- Name -->
                                <div class="mb-3">
                                    <label class="form-label">نام</label>
                                    <div class="input-group">
                                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}">
                                    </div>
                                    <label class="small" style="color:rgb(182, 24, 24);">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>

                                <!-- Username -->
                                <div class="mb-3">
                                    <label class="form-label">نام کاربری</label>
                                    <div class="input-group">
                                        <input name="username" type="text" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $user->username) }}">
                                    </div>
                                    @if ($errors->has('username'))
                                        <label class="small" style="color:rgb(182, 24, 24);">
                                            @error('username')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    @else
                                        <small class="text-secondary">کاراکتر های مجاز : ( حروف بزرگ و کوچک انگلیسی / _ / عدد ) </small>
                                    @endif
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label class="form-label">ایمیل</label>
                                    <div class="input-group mb-0">
                                        <input name="email" type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}">
                                    </div>
                                    <label class="small" style="color:rgb(182, 24, 24);">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>

                                <!-- Phone number -->
                                <div class="mb-3">
                                    <label class="form-label">شماره تماس</label>
                                    <div class="input-group mb-0">
                                        <input name="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" dir="ltr" value="{{ old('phone_number', auth()->user()->raw_phone) }}">
                                    </div>
                                    <label class="small" style="color:rgb(182, 24, 24);">
                                        @error('phone_number')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>

                                <!-- Avatar -->
                                <div class="mb-3">
                                    <label class="form-label">تصویر پروفایل</label>

                                    <input type="file" id="avatarInput" name="avatar" accept="image/*" class="d-none">
                                    <input type="hidden" id="removeAvatarFlag" name="remove_avatar" value="0">

                                    <!-- Avatar upload START -->
                                    <div class="d-flex align-items-center">
                                        <div class="position-relative me-3">
                                            <!-- Avatar edit -->
                                            <div class="position-absolute top-0 end-0 z-index-9">
                                                <button type="button" class="btn btn-sm btn-light btn-round mb-0 mt-n1 me-n1" onclick="document.getElementById('avatarInput').click();">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                            </div>
                                            <!-- Avatar preview -->
                                            <div class="avatar avatar-xl bg-info bg-opacity-25 rounded-circle" onclick="document.getElementById('avatarInput').click();" style="cursor: pointer;">
                                                <img id="avatarPreview" class="rounded-circle avatar-xl" src="{{ $user->avatar_url }}" alt="">
                                            </div>
                                        </div>
                                        <!-- Avatar remove button -->
                                        <div class="avatar-remove">
                                            <button type="button" class="btn btn-light" id="removeAvatarBtn">حذف</button>
                                        </div>
                                    </div>
                                    <!-- Avatar upload END -->
                                    @if ($errors->has('avatar'))
                                        <label class="small" style="color:rgb(182, 24, 24);">
                                            @error('avatar')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    @else
                                        <small class="text-secondary">حداکثر حجم مجاز : 2 مگابایت</small>
                                    @endif
                                </div>

                                <!-- Gender -->
                                <div class="mb-3 mt-1">
                                    <label class="form-label">جنسیت</label>
                                    <select class="js-example-basic-single form-select w-100" id="gender" name="gender">
                                        <option value="doNotWantSay" {{ old('gender', $user->gender) == 'doNotWantSay' ? 'selected' : '' }}>ترجیح می دهم نگویم</option>
                                        <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>مرد</option>
                                        <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>زن</option>
                                        <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>سایر</option>
                                    </select>

                                    <label class="mt-2 small" style="color:rgb(182, 24, 24);">
                                        @error('gender')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>

                                <!-- Job title -->
                                <div class="mb-3">
                                    <label class="form-label">عنوان شغلی</label>
                                    <input name="job_title" class="form-control @error('job_title') is-invalid @enderror" type="text" value="{{ old('job_title', $user->job_title) }}">

                                    <label class="mt-2 small" style="color:rgb(182, 24, 24);">
                                        @error('job_title')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>

                                <!-- province -->
                                <div class="mb-3">
                                    <label class="form-label">استان</label>
                                    <select class="js-example-basic-single form-select w-100" name="province">
                                        <option value="" {{ old('province', $user->province) == '' ? 'selected' : '' }}>(استان خود را انتخاب کنید)</option>
                                        <option value="AZ_E" {{ old('province', $user->province) == 'AZ_E' ? 'selected' : '' }}>آذربایجان شرقی</option>
                                        <option value="AZ_W" {{ old('province', $user->province) == 'AZ_W' ? 'selected' : '' }}>آذربایجان غربی</option>
                                        <option value="ARD" {{ old('province', $user->province) == 'ARD' ? 'selected' : '' }}>اردبیل</option>
                                        <option value="ESF" {{ old('province', $user->province) == 'ESF' ? 'selected' : '' }}>اصفهان</option>
                                        <option value="ALB" {{ old('province', $user->province) == 'ALB' ? 'selected' : '' }}>البرز</option>
                                        <option value="ILAM" {{ old('province', $user->province) == 'ILAM' ? 'selected' : '' }}>ایلام</option>
                                        <option value="BOSH" {{ old('province', $user->province) == 'BOSH' ? 'selected' : '' }}>بوشهر</option>
                                        <option value="TEH" {{ old('province', $user->province) == 'TEH' ? 'selected' : '' }}>تهران</option>
                                        <option value="CHAR_BAKH" {{ old('province', $user->province) == 'CHAR_BAKH' ? 'selected' : '' }}>چهارمحال و بختیاری</option>
                                        <option value="KHO_JO" {{ old('province', $user->province) == 'KHO_JO' ? 'selected' : '' }}>خراسان جنوبی</option>
                                        <option value="KHO_RA" {{ old('province', $user->province) == 'KHO_RA' ? 'selected' : '' }}>خراسان رضوی</option>
                                        <option value="KHO_SH" {{ old('province', $user->province) == 'KHO_SH' ? 'selected' : '' }}>خراسان شمالی</option>
                                        <option value="KHOZ" {{ old('province', $user->province) == 'KHOZ' ? 'selected' : '' }}>خوزستان</option>
                                        <option value="ZAN" {{ old('province', $user->province) == 'ZAN' ? 'selected' : '' }}>زنجان</option>
                                        <option value="SEM" {{ old('province', $user->province) == 'SEM' ? 'selected' : '' }}>سمنان</option>
                                        <option value="SIS_BAL" {{ old('province', $user->province) == 'SIS_BAL' ? 'selected' : '' }}>سیستان و بلوچستان</option>
                                        <option value="FARS" {{ old('province', $user->province) == 'FARS' ? 'selected' : '' }}>فارس</option>
                                        <option value="GHAZ" {{ old('province', $user->province) == 'GHAZ' ? 'selected' : '' }}>قزوین</option>
                                        <option value="GHOM" {{ old('province', $user->province) == 'GHOM' ? 'selected' : '' }}>قم</option>
                                        <option value="KORD" {{ old('province', $user->province) == 'KORD' ? 'selected' : '' }}>کردستان</option>
                                        <option value="KERM" {{ old('province', $user->province) == 'KERM' ? 'selected' : '' }}>کرمان</option>
                                        <option value="KERM_SHAH" {{ old('province', $user->province) == 'KERM_SHAH' ? 'selected' : '' }}>کرمانشاه</option>
                                        <option value="KAH_BOV" {{ old('province', $user->province) == 'KAH_BOV' ? 'selected' : '' }}>کهکیلویه و بویراحمد</option>
                                        <option value="GOL" {{ old('province', $user->province) == 'GOL' ? 'selected' : '' }}>گلستان</option>
                                        <option value="GIL" {{ old('province', $user->province) == 'GIL' ? 'selected' : '' }}>گیلان</option>
                                        <option value="LOR" {{ old('province', $user->province) == 'LOR' ? 'selected' : '' }}>لرستان</option>
                                        <option value="MAZ" {{ old('province', $user->province) == 'MAZ' ? 'selected' : '' }}>مازندران</option>
                                        <option value="MARK" {{ old('province', $user->province) == 'MARK' ? 'selected' : '' }}>مرکزی</option>
                                        <option value="HOR" {{ old('province', $user->province) == 'HOR' ? 'selected' : '' }}>هرمزگان</option>
                                        <option value="HAM" {{ old('province', $user->province) == 'HAM' ? 'selected' : '' }}>همدان</option>
                                        <option value="YAZD" {{ old('province', $user->province) == 'YAZD' ? 'selected' : '' }}>یزد</option>
                                    </select>

                                    <label class="mt-2 small" style="color:rgb(182, 24, 24);">
                                        @error('province')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>

                                @if (!auth()->user()?->is_admin)
                                    <!-- Bio -->
                                    <div class="mb-3">
                                        <label class="form-label">بیوگرافی</label>
                                        <textarea name="bio" class="form-control @error('bio') is-invalid @enderror" @if (auth()->user()?->is_admin) disabled @endif style="height: 110px" rows="3">{{ old('bio', $user->bio) }}</textarea>

                                        @if ($errors->has('bio'))
                                            <label class="small" style="color:rgb(182, 24, 24);">
                                                @error('bio')
                                                    {{ $message }}
                                                @enderror
                                            </label>
                                        @else
                                            <small class="text-secondary">توضیحات مختصری برای پروفایل شما</small>
                                        @endif
                                    </div>
                                @endif

                                <!-- Save button -->
                                <div class="d-flex justify-content-end mt-4">
                                    <a href="{{ route('profile.edit') }}" class="btn btn-secondary border-0 me-2 cancle-btn">لغو</a>
                                    <input type="submit" class="btn btn-primary" value="ذخیره"></input>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Profile END -->
                    <!-- Social links START -->
                    <form method="POST" action="{{ route('profile.update.socials') }}">

                        @csrf
                        @method('PUT')

                        <div class="card border mb-4">
                            <div class="card-header border-bottom p-3">
                                <h4 class="card-header-title mb-0"> شبکه های اجتماعی</h4>
                            </div>
                            <div class="card-body">
                                <!-- Skype -->
                                <div class="mb-3">
                                    <label class="form-label">Facebook</label>
                                    <input name="facebook" class="form-control @error('facebook') is-invalid @enderror" type="text" value="{{ old('facebook', $user->facebook) }}">

                                    <label class="mt-2 small" style="color:rgb(182, 24, 24);">
                                        @error('facebook')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>
                                <!-- Email -->
                                <div class="mb-3">
                                    <label class="form-label">Linkedin</label>
                                    <input name="linkedin" class="form-control @error('linkedin') is-invalid @enderror" type="text" value="{{ old('linkedin', $user->linkedin) }}">

                                    <label class="mt-2 small" style="color:rgb(182, 24, 24);">
                                        @error('linkedin')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>
                                <!-- Address -->
                                <div class="mb-3">
                                    <label class="form-label">Twitter</label>
                                    <input name="twitter" class="form-control @error('twitter') is-invalid @enderror" type="text" value="{{ old('twitter', $user->twitter) }}">

                                    <label class="mt-2 small7" style="color:rgb(182, 24, 24);">
                                        @error('twitter')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>
                                <!-- Save button -->
                                <div class="d-flex justify-content-end mt-4">
                                    <input type="submit" class="btn btn-primary" value="ذخیره"></input>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Social links END -->
                </div>
                <!-- Left sidebar END -->


                <!-- Right sidebar START -->
                <div class="col-lg-5 col-xxl-4">

                    @if (!$is_admin)
                        <!-- Profile Setting START -->
                        <div class="card border mb-4">
                            <div class="card-header border-bottom p-3">
                                <h4 class="card-header-title mb-0">تنظیمات حساب کاربری</h4>
                            </div>
                            <form method="POST" action="{{ route('profile.update.settings') }}">

                                @csrf
                                @method('PUT')

                                <div class="card-body">
                                    <div class="form-check form-switch form-check-md mb-3">
                                        <input name="showProfile" class="form-check-input" type="checkbox" id="showProfile" {{ old('showProfile', $user->showProfile) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="showProfile">نمایش اطلاعات پروفایل برای دیگران</label>
                                    </div>
                                    <div class="form-check form-switch form-check-md mb-3">
                                        <input name="smsConsent" class="form-check-input" type="checkbox" id="smsConsent" {{ old('smsConsent', $user->smsConsent) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="smsConsent">تمایل به دریافت پیامک</label>
                                    </div>
                                    <div class="form-check form-switch form-check-md mb-3">
                                        <input name="newsConsent" class="form-check-input" type="checkbox" id="newsConsent" {{ old('newsConsent', $user->newsConsent) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="newsConsent">تمایل به دریافت اخبار جدید</label>
                                    </div>

                                    <!-- Save button -->
                                    <div class="d-flex justify-content-end mt-4">
                                        <input type="submit" class="btn btn-primary" value="ذخیره"></input>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Profile Setting END -->
                    @endif

                    <!-- Update password START -->
                    <form method="POST" action="{{ route('profile.update.password') }}">

                        @csrf
                        @method('PUT')

                        <div class="card border mb-4">
                            <div class="card-header border-bottom p-3">
                                <h4 class="card-header-title mb-0">تغییر رمز عبور</h4>
                            </div>
                            <div class="card-body">
                                <div class="mb-2">
                                    <label class="form-label">رمز عبور فعلی</label>
                                    <input class="form-control @error('current_password') is-invalid @enderror" name="current_password" type="password">

                                    <label class="mt-2 mb-3 small" style="color:rgb(182, 24, 24);">
                                        @error('current_password')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>
                                <!-- New password -->
                                <div class="mb-2">
                                    <label class="form-label">رمز عبور جدید</label>
                                    <input class="form-control @error('password') is-invalid @enderror" name="password" id="password" type="password">
                                    <div id="password-strength" class="mb-1 d-flex gap-1 w-100">
                                        <div class="strength-password-part" id="strength_password_1"></div>
                                        <div class="strength-password-part" id="strength_password_2"></div>
                                        <div class="strength-password-part" id="strength_password_3"></div>
                                        <div class="strength-password-part" id="strength_password_4"></div>
                                        <div class="strength-password-part" id="strength_password_5"></div>
                                    </div>

                                    <label class="mt-2 mb-3 small" style="color:rgb(182, 24, 24);">
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                    <div class="rounded mt-1" id="psw-strength"></div>
                                </div>
                                <!-- New password -->
                                <div>
                                    <label class="form-label">تکرار رمز عبور جدید</label>
                                    <input class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" type="password">

                                    <label class="mt-2 small" style="color:rgb(182, 24, 24);">
                                        @error('password_confirmation')
                                            {{ $message }}
                                        @enderror
                                    </label>
                                </div>
                                <div class="d-flex justify-content-end mt-4">
                                    <input type="submit" class="btn btn-primary" value="ذخیره"></input>
                                </div>
                            </div>
                        </div>
                    </form>

                    @if ($is_admin)
                        <!-- Management Panels START -->
                        <div class="card border mb-4">
                            <div class="card-header border-bottom p-3">
                                <h4 class="card-header-title mb-0">پنل های مدیریتی</h4>
                            </div>

                            <ul class="nav d-flex flex-column offcanvas-dash-nav p-2">
                                <a class="" style="color: #888b92" href="{{ route('admin.users.index') }}">
                                    <li class="nav-item my-1 offcanvas-dash-nav-usuale-li d-flex justify-content-between align-items-center">پنل مدیریت کاربران<i class="bi bi-people-fill fs-5 mt-1"></i></li>
                                </a>
                                <a class="" style="color: #888b92" href="{{ route('admin.categories.index') }}">
                                    <li class="nav-item my-1 offcanvas-dash-nav-usuale-li d-flex justify-content-between align-items-center">پنل مدیریت دسته بندی ها<i class="bi bi-tags fs-5 mt-1"></i></li>
                                </a>
                                <a class="" style="color: #888b92" href="{{ route('admin.articles.index') }}">
                                    <li class="nav-item my-1 offcanvas-dash-nav-usuale-li d-flex justify-content-between align-items-center">پنل مدیریت اخبار<i class="bi bi-newspaper fs-5 mt-1"></i></li>
                                </a>
                                <a class="" style="color: #888b92" href="{{ route('admin.comments.index') }}">
                                    <li class="nav-item my-1 offcanvas-dash-nav-usuale-li d-flex justify-content-between align-items-center">پنل مدیریت دیدگاه ها<i class="bi bi-chat-left-text fs-5 mt-1"></i></li>
                                </a>
                                <a class="" style="color: #888b92" href="{{ route('admin.contact-messages.index') }}">
                                    <li class="nav-item my-1 offcanvas-dash-nav-usuale-li d-flex justify-content-between align-items-center">پنل مدیریت پیام های کاربران<i class="bi bi-envelope fs-5 mt-1"></i></li>
                                </a>
                            </ul>

                        </div>
                    @endif
                    <!-- Management Panels END -->

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

        });

        // password strength profile
        document.addEventListener("DOMContentLoaded", function() {
            const passwordInput = document.getElementById("password");

            const parts = [
                document.getElementById("strength_password_1"),
                document.getElementById("strength_password_2"),
                document.getElementById("strength_password_3"),
                document.getElementById("strength_password_4"),
                document.getElementById("strength_password_5")
            ];

            passwordInput.addEventListener("input", function() {
                const password = passwordInput.value;
                let score = 0;

                if (password.length > 0) {
                    if (password.length >= 8) score++;
                    if (/[a-z]/.test(password)) score++;
                    if (/[A-Z]/.test(password)) score++;
                    if (/[0-9]/.test(password)) score++;
                    if (/[^a-zA-Z0-9]/.test(password)) score++;
                }

                parts.forEach(part => {
                    if (part) part.style.backgroundColor = "rgba(0, 0, 0, 0.2)";
                });

                let color = "";
                switch (score) {
                    case 1:
                        color = "#dc3545";
                        break;
                    case 2:
                        color = "#fd7e14";
                        break;
                    case 3:
                        color = "#ffc107";
                        break;
                    case 4:
                        color = "#9acd32";
                        break;
                    case 5:
                        color = "#198754";
                        break;
                }

                for (let i = 0; i < score; i++) {
                    if (parts[i]) {
                        parts[i].style.backgroundColor = color;
                    }
                }
            });
        });

        // avatar scripts
        document.getElementById('avatarInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('avatarPreview').src = e.target.result;
                }
                reader.readAsDataURL(file);

                document.getElementById('removeAvatarFlag').value = '0';
            }
        });

        document.getElementById('removeAvatarBtn').addEventListener('click', function() {

            document.getElementById('avatarInput').value = '';

            document.getElementById('avatarPreview').src = "{{ asset('assets/images/avatar/user_natural.png') }}";

            document.getElementById('removeAvatarFlag').value = '1';
        });
    </script>
@endpush
