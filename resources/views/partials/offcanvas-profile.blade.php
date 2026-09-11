<!-- Profile -->

<div class="offcanvas offcanvas-start w-100" tabindex="-1" id="offcanvas‌Profile" aria-labelledby="offcanvasTopLabel">
    <div class="offcanvas-header">
        <h2 class="offcanvas-title flex-grow-1 text-center fw-bold">پروفایل</h2>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="container">
            <div class="row g-4">
                <!-- Profile cover and info START -->
                <div class="col-12">
                    <div class="card mb-4 position-relative z-index-9">
                        <!-- Cover image -->
                        <div class="py-5 h-200 rounded" style="background-image:url({{ asset('assets/images/blog/16by9/big/07.jpg') }}); background-position: center bottom; background-size: cover; background-repeat: no-repeat;">
                        </div>
                        <div class="card-body pt-3 pb-0">
                            <div class="row d-flex justify-content-between">
                                <!-- Avatar -->
                                <div class="col-sm-12 col-md-auto text-center text-md-start">
                                    <div class="avatar avatar-xxl mt-n5">
                                        <img class="avatar-img rounded-circle border border-white border-3 shadow" src="{{ asset('assets/images/avatar/03.jpg') }}" alt="">
                                    </div>
                                </div>
                                <!-- Profile info -->
                                <div class="col-sm-12 col-md text-center text-md-start d-md-flex justify-content-between align-items-center">
                                    <div>
                                        <h4 class="my-2">مهدی علیزاده <i class="bi bi-patch-check-fill text-info small"></i>
                                        </h4>
                                        <ul class="list-inline">
                                            <li class="list-inline-item"><i class="bi bi-calendar2-plus me-1"></i> تاریخ عضویت 5 بهمن 1400</li>
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
            <div class="row g-4">
                <!-- Left sidebar START -->
                <div class="col-lg-7 col-xxl-8">
                    <!-- Profile START -->
                    <div class="card border mb-4">
                        <div class="card-header border-bottom p-3">
                            <h4 class="card-header-title mb-0">حساب کاربری</h4>
                        </div>
                        <div class="card-body">
                            <!-- Full name -->
                            <div class="mb-3">
                                <label class="form-label">نام کامل</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="مهدی" placeholder="نام">
                                    <input type="text" class="form-control" value="علیزاده" placeholder="نام خانوادگی">
                                </div>
                            </div>
                            <!-- Username -->
                            <div class="mb-3">
                                <label class="form-label">نام کاربری</label>
                                <div class="input-group">
                                    <span class="input-group-text">gmail.com</span>
                                    <input type="text" class="form-control" value="example@752">
                                </div>
                            </div>
                            <!-- Profile picture -->
                            <div class="mb-3">
                                <label class="form-label">تصویر پروفایل</label>
                                <!-- Avatar upload START -->
                                <div class="d-flex align-items-center">
                                    <div class="position-relative me-3">
                                        <!-- Avatar edit -->
                                        <div class="position-absolute top-0 end-0  z-index-9">
                                            <a class="btn btn-sm btn-light btn-round mb-0 mt-n1 me-n1" href="#"> <i class="bi bi-pencil"></i> </a>
                                        </div>
                                        <!-- Avatar preview -->
                                        <div class="avatar avatar-xl">
                                            <img class="avatar-img rounded-circle border border-white border-3 shadow" src="{{ asset('assets/images/avatar/03.jpg') }}" alt="">
                                        </div>
                                    </div>
                                    <!-- Avatar remove button -->
                                    <div class="avatar-remove">
                                        <button type="button" class="btn btn-light">حذف</button>
                                    </div>
                                </div>
                                <!-- Avatar upload END -->
                            </div>
                            <!-- Bio -->
                            <div class="mb-3">
                                <label class="form-label">درباره من</label>
                                <div class="form-text mb-3">توضیحات مختصری برای پروفایل شما</div>
                                <textarea class="form-control" rows="10" cols="10" style="min-height: 300px;">من راهی برای دریافت پول برای سرگرمی مورد علاقه‌ام پیدا کرده‌ام و این کار را در حالی انجام می‌دهم که رویای سفر به دور دنیا را دنبال می‌کنم.</textarea>
                            </div>
                            <!-- Save button -->
                            <div class="d-flex justify-content-end mt-4">
                                <a href="#" class="btn text-secondary border-0 me-2">لغو</a>
                                <a href="#" class="btn btn-primary">ذخیره</a>
                            </div>
                        </div>
                    </div>
                    <!-- Profile END -->
                    <!-- Social links START -->
                    <div class="card border mb-4">
                        <div class="card-header border-bottom p-3">
                            <h4 class="card-header-title mb-0"> شبکه های اجتماعی</h4>
                        </div>
                        <div class="card-body">
                            <!-- Skype -->
                            <div class="mb-3">
                                <label class="form-label">تلگرام</label>
                                <input class="form-control text-end" type="text" value="https://facebook.com">
                            </div>
                            <!-- Email -->
                            <div class="mb-3">
                                <label class="form-label">اینستاگرام</label>
                                <input class="form-control text-end" type="email" value="https://www.linkedin.com">
                            </div>
                            <!-- Address -->
                            <div class="mb-3">
                                <label class="form-label">لینکداین</label>
                                <input class="form-control text-end" type="text" value="https://twitter.com">
                            </div>
                            <!-- Save button -->
                            <div class="d-flex justify-content-end mt-4">
                                <a href="#" class="btn btn-primary">ذخیره</a>
                            </div>
                        </div>
                    </div>
                    <!-- Social links END -->
                </div>
                <!-- Left sidebar END -->

                <!-- Right sidebar START -->
                <div class="col-lg-5 col-xxl-4">
                    <!-- Profile Setting START -->
                    <div class="card border mb-4">
                        <div class="card-header border-bottom p-3">
                            <h4 class="card-header-title mb-0">تنظیمات حساب کاربری</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-check form-switch form-check-md mb-3">
                                <input class="form-check-input" type="checkbox" id="availabilityCheck" checked="">
                                <label class="form-check-label" for="availabilityCheck">نمایش اطلاعات پروفایل</label>
                            </div>
                        </div>
                    </div>
                    <!-- Profile Setting END -->

                    <!-- Update password START -->
                    <div class="card border mb-4">
                        <div class="card-header border-bottom p-3">
                            <h4 class="card-header-title mb-0">تغییر رمز عبور</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">رمز عبور فعلی</label>
                                <input class="form-control" type="password" placeholder="*********">
                            </div>
                            <!-- New password -->
                            <div class="mb-3">
                                <label class="form-label" id="psw-strength-message"></label>
                                <div class="input-group">
                                    <input class="form-control fakepassword" type="password" id="psw-input" placeholder="*********">
                                    <span class="input-group-text p-0">
                                        <i class="fakepasswordicon far fa-eye cursor-pointer p-2 w-40px"></i>
                                    </span>
                                </div>
                                <div class="rounded mt-1" id="psw-strength"></div>
                            </div>
                            <!-- New password -->
                            <div>
                                <label class="form-label">رمز عبور جدید</label>
                                <input class="form-control" type="password" placeholder="*********">
                            </div>
                            <div class="d-flex justify-content-end mt-4">
                                <a href="#" class="btn btn-primary">ذخیره</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
