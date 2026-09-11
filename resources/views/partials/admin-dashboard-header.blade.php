<header class="navbar-light navbar-sticky header-static border-bottom navbar-dashboard">
    <!-- Logo Nav START -->
    <nav class="navbar navbar-expand-xl">
        <div class="container">
            <!-- Logo START -->
            <a class="navbar-brand me-3" href="index.html">
                <img class="navbar-brand-item light-mode-item" src="{{ asset('assets/images/logo.svg') }}" alt="logo">
                <img class="navbar-brand-item dark-mode-item" src="{{ asset('assets/images/logo-light.svg') }}" alt="logo">
            </a>
            <!-- Logo END -->

            <!-- Responsive navbar toggler -->
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="text-body h6 d-none d-sm-inline-block">منو</span>
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Main navbar START -->
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav navbar-nav-scroll mx-auto">

                    <!-- Nav item -->
                    <li class="nav-item"><a class="nav-link" href="{{ route('index.page') }}"><i class="bi bi-house-door me-1"></i>صفحۀ اصلی</a></li>

                    <!-- Nav item -->
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard.page') }}"><i class="bi bi-person me-1"></i>پیشخوان</a></li>

                    <!-- Nav item -->
                    <li class="nav-item"><a class="nav-link" href="{{ route('profile.edit') }}"><i class="bi bi-person-circle me-1"></i>حساب کاربری</a></li>


                    <!-- Nav item -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="postMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bi bi-pencil me-1"></i>مدیریت اخبار</a>
                        <ul class="dropdown-menu p-0 rounded-3" aria-labelledby="postMenu">
                            <!-- dropdown submenu -->
                            <li> <a class="dropdown-item border-bottom rounded-3" href="{{ route('admin.articles.index') }}">مدیریت خبرها</a> </li>
                            <li> <a class="dropdown-item border-bottom rounded-3" href="{{ route('post-grid-masonry-filter.page') }}">همه خبرها</a> </li>
                            <li> <a class="dropdown-item rounded-3" href="{{ route('admin.categories.index') }}">دسته بندی ها</a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
            <!-- Main navbar END -->

            <!-- Nav right START -->
            <div class="nav flex-nowrap align-items-center">

                <!-- Notification dropdown START -->
                {{-- <div class="nav-item ms-2 ms-md-3 dropdown">
                    <!-- Notification button -->
                    <a class="btn btn-primary-soft border btn-round mb-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                        <i class="bi bi-bell fa-fw"></i>
                    </a>
                    <!-- Notification dote -->
                    <span class="notif-badge animation-blink"></span>

                    <!-- Notification dropdown menu START -->
                    <div
                        class="dropdown-menu dropdown-animation dropdown-menu-end dropdown-menu-size-md p-0 shadow-lg border-0">
                        <div class="card bg-transparent">
                            <div
                                class="card-header bg-transparent border-bottom p-3 d-flex justify-content-between align-items-center">
                                <h6 class="m-0">پیام ها <span class="badge bg-danger bg-opacity-10 text-danger ms-2">2</span></h6>
                                <a class="small" href="#">حذف</a>
                            </div>
                            <div class="card-body p-0">
                                <ul class="list-group list-unstyled list-group-flush">
                                    <!-- Notif item -->
                                    <li>
                                        <a href="#" class="list-group-item-action border-0 border-bottom d-flex p-3">
                                            <div class="me-3">
                                                <div class="avatar avatar-sm">
                                                    <img class="avatar-img rounded-circle" src="{{ asset('assets/images/avatar/08.jpg') }}" alt="avatar">
                                                </div>
                                            </div>
                                            <div>
                                                <h6 class="mb-1">ثبت نام یک کاربر</h6>
                                                <span class="small"> <i class="bi bi-clock"></i> 3 دقیقه پیش</span>
                                            </div>
                                        </a>
                                    </li>

                                    <!-- Notif item -->
                                    <li>
                                        <a href="#" class="list-group-item-action border-0 border-bottom d-flex p-3">
                                            <div class="me-3">
                                                <div class="avatar avatar-sm">
                                                    <img class="avatar-img rounded-circle" src="{{ asset('assets/images/avatar/02.jpg') }}" alt="avatar">
                                                </div>
                                            </div>
                                            <div>
                                                <h6 class="mb-1">حذف یک حساب کاربری</h6>
                                                <span class="small"> <i class="bi bi-clock"></i> 6 دقیقه پیش</span>
                                            </div>
                                        </a>
                                    </li>

                                    <!-- Notif item -->
                                    <li>
                                        <a href="#" class="list-group-item-action border-0 border-bottom d-flex p-3">
                                            <div class="me-3">
                                                <div class="avatar avatar-sm">
                                                    <img class="avatar-img rounded-circle" src="{{ asset('assets/images/avatar/05.jpg') }}" alt="avatar">
                                                </div>
                                            </div>
                                            <div>
                                                <h6 class="mb-1">ثبت دیدگاه جدید</h6>
                                                <span class="small"> <i class="bi bi-clock"></i> 10 دقیقه پیش</span>
                                            </div>
                                        </a>
                                    </li>

                                    <!-- Notif item -->
                                    <li>
                                        <a href="#" class="list-group-item-action border-0 border-bottom d-flex p-3">
                                            <div class="me-3">
                                                <div class="avatar avatar-sm">
                                                    <img class="avatar-img rounded-circle" src="{{ asset('assets/images/avatar/03.jpg') }}" alt="avatar">
                                                </div>
                                            </div>
                                            <div>
                                                <h6 class="mb-1">بروزرسانی تنظیمات کاربری</h6>
                                                <span class="small"> <i class="bi bi-clock"></i> دیروز</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Button -->
                            <div class="card-footer bg-transparent border-0 py-3 text-center position-relative">
                                <a href="#" class="stretched-link">مشاهده تمام فعالیت ها</a>
                            </div>
                        </div>
                    </div>
                    <!-- Notification dropdown menu END -->
                </div> --}}
                <!-- Notification dropdown END -->

                <!-- Profile dropdown START -->
                <div class="nav-item ms-2 ms-md-3 dropdown mt-1">

                    <!-- Avatar -->
                    <div class="btn btn-primary-soft border p-0 d-flex justify-content-between align-items-center rounded-5 ps-3" id="profileDropdown" role="button" data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="pt-1"><i class="bi bi-list fs-4"></i></div>
                        <a class="avatar avatar-sm p-0 ms-2 border rounded-circle" href="#">
                            <img class="avatar-img rounded-circle" src="{{ auth()->user()->avatar_url }}" alt="avatar">
                        </a>
                    </div>

                    <!-- Profile dropdown START -->
                    <ul class="dropdown-menu dropdown-animation dropdown-menu-end shadow pt-3 rounded-3" aria-labelledby="profileDropdown">
                        <!-- Profile info -->
                        <li class="px-3">
                            <div class="d-flex align-items-center">
                                <!-- Avatar -->
                                <div class="avatar me-3">
                                    <img class="avatar-img rounded-circle shadow" src="{{ auth()->user()->avatar_url }}" alt="avatar">
                                </div>
                                <div>
                                    <a class="h6 mt-2 mt-sm-0" href="#">{{ auth()->user()->name }}</a>
                                    <p class="small m-0">{{ auth()->user()->email }}</p>
                                </div>
                            </div>
                            <hr>
                        </li>
                        <!-- Links -->
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person fa-fw me-2"></i>حساب کاربری</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.users.index') }}"><i class="bi bi-people me-2"></i>پنل مدیریت کاربران</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.categories.index') }}"><i class="bi bi-tags me-2"></i>پنل مدیریت دسته بندی ها</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.articles.index') }}"><i class="bi bi-newspaper me-2"></i>پنل مدیریت اخبار</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.comments.index') }}"><i class="bi bi-chat-dots me-2"></i>پنل مدیریت دیدگاه ها</a></li>
                        <li class="d-flex justify-content-between align-items-center"><a class="dropdown-item" href="{{ route('admin.contact-messages.index') }}"><i class="bi bi-envelope me-2"></i>پنل مدیریت پیام های کاربران</a>
                            @if ($pendingContactMessagesCount > 0)
                                <span class="badge text-bg-danger rounded-2 me-3">
                                    {{ $pendingContactMessagesCount }}
                                </span>
                            @endif
                        </li>
                        <hr class="my-1">
                        <li><a class="dropdown-item" href="{{ route('admin.help-and-rules.page') }}"><i class="bi bi-info-circle fa-fw me-2"></i>راهنما و قوانین مدیر</a></li>
                        <li>
                            @auth
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger bg-transparent border border-0"><i class="bi bi-power fa-fw me-2"></i>خروج از حساب کاربری</button>
                                </form>
                            @endauth
                        </li>
                        <li class="dropdown-divider mb-3"></li>
                        <li>
                            <div class="dropdown-item">
                                <!-- Dark mode options inside Profile -->
                        <li class="px-3">
                            <span class="small text-muted d-block mb-2">تغییر تم:</span>
                            <div class="btn-group w-100" role="group">
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-theme-value="light" title="روشن"><i class="bi bi-sun-fill"></i></button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-theme-value="dark" title="تیره"><i class="bi bi-moon-stars-fill"></i></button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-theme-value="auto" title="خودکار"><i class="bi bi-circle-half"></i></button>
                            </div>
                        </li>
                </div>
                </li>
                </ul>
            </div>
            <!-- Profile dropdown END -->
        </div>
        <!-- Profile dropdown END -->

        <!-- Nav right END -->
        </div>
    </nav>
    <!-- Logo Nav END -->
</header>
