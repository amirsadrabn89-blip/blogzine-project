<header class="navbar-light navbar-sticky header-static shadow">
    <div class="navbar-top d-none d-lg-block small">
        <!-- Divider -->
        <div class="border-bottom border-2 border-primary opacity-1"></div>
    </div>
    <!-- Logo Nav START -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo START -->
            <a class="navbar-brand" href="{{ route('index.page') }}">
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

                    <!-- Nav item 1 Demos -->
                    <li class="nav-item dropdown">
                        <a class="nav-link {{ request()->routeIs('index.page') ? 'text-primary' : '' }}" href="{{ route('index.page') }}">خانه</a>
                    </li>

                    <!-- Nav item 1 Demos -->
                    <li class="nav-item dropdown">
                        <a class="nav-link {{ request()->routeIs('post-grid-masonry-filter.page') ? 'text-primary' : '' }}" href="{{ route('post-grid-masonry-filter.page') }}">اخبار</a>
                    </li>

                    <!-- Nav item -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="postMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">دسته بندی ها</a>
                        <ul class="dropdown-menu p-0 rounded-3" aria-labelledby="postMenu">
                            <!-- dropdown submenu -->
                            @foreach ($categories as $category)
                                <li>
                                    <a class="dropdown-item border-bottom justify-content-between rounded-3" href="{{ route('post-grid-masonry-filter.page', ['category_id' => $category->id]) }}">
                                        <div class="me-3"><span class="me-2">●</span>{{ $category->title }}</div>
                                        <span class="badge btn btn-outline-info bg-info text-secondary-emphasis bg-opacity-25 categories-dropdown-badge me-1 rounded-3">{{ $category->articles_count }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link {{ request()->routeIs('about_us.page') ? 'text-primary' : '' }}" href="{{ route('about_us.page') }}">دربارۀ ما</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link {{ request()->routeIs('contact_us.page') ? 'text-primary' : '' }}" href="{{ route('contact_us.page') }}">ارتباط با ما</a>
                    </li>
                </ul>
            </div>
            <!-- Main navbar END -->

            <!-- Nav Search -->
            <div class="ms-2 btn-primary-soft border p-0 mb-1 d-flex justify-content-between align-items-center rounded-5" style="height: 40px">
                <div class="nav-item dropdown dropdown-toggle-icon-none nav-search">
                    <a class="nav-link dropdown-toggle px-2 py-1 mt-1 text-reset mx-1" role="button" href="#" id="navSearch" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-search fs-5"> </i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end shadow rounded-4 p-2" aria-labelledby="navSearch">
                        <form action="{{ route('post-grid-masonry-filter.page') }}" method="GET" class="input-group">
                            <input class="form-control border-primary rounded-start-3" type="search" name="search" value="{{ request('search') }}" placeholder="جستجو در عنوان اخبار..." aria-label="Search" required>
                            <button class="btn btn-primary m-0 rounded-end-3" type="submit">جستجو</button>
                            <span class="small ms-1 mt-1">
                                جست و جو در عنوان یا نام نویسندۀ اخبار
                            </span>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Nav right START -->
            <div class="nav flex-nowrap align-items-center ms-3">
                <!-- Nav Button -->
                <div class="btn-primary-soft border mb-1 d-flex justify-content-between align-items-center rounded-5" style="height: 40px" id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown" data-bs-display="static">
                    <div class="nav-item pt-2 pb-1 px-2 ms-1" style="margin-top: -6px;">
                        <!-- Dark mode options START -->
                        <div class="nav-item dropdown">
                            <!-- Switch button -->
                            <button class=" bg-transparent text-primary text-reset border-0 pt-1 pb-0">
                                <i class="bi bi-moon"></i> / <i class="bi bi-sun fs-5"></i>
                            </button>
                            <!-- Dropdown items -->
                            <ul class="dropdown-menu min-w-auto dropdown-menu-end rounded-3 p-0" aria-labelledby="bd-theme">
                                <li class="mb-1 border-bottom rounded-3 py-1">
                                    <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="light">
                                        <svg width="16" height="16" fill="currentColor" class="bi bi-brightness-high-fill fa-fw mode-switch me-1" viewBox="0 0 16 16">
                                            <path d="M12 8a4 4 0 1 1-8 0 4 4 0 0 1 8 0zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z">
                                            </path>
                                            <use href="#"></use>
                                        </svg>روشن
                                    </button>
                                </li>
                                <li class="mb-1 border-bottom rounded-3 py-1">
                                    <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-moon-stars-fill fa-fw mode-switch me-1" viewBox="0 0 16 16">
                                            <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z">
                                            </path>
                                            <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z">
                                            </path>
                                            <use href="#"></use>
                                        </svg>تیره
                                    </button>
                                </li>
                                <li class="border-bottom rounded-3 py-1">
                                    <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-half fa-fw mode-switch me-1" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"></path>
                                            <use href="#"></use>
                                        </svg>خودکار
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <!-- Dark mode options END -->
                    </div>
                </div>

                <!-- Offcanvas menu toggler -->
                <div class="nav-item align-self-end ms-2">
                    @guest
                        <a class="text-reset" href="{{ route('login') }}">
                            <div class="btn btn-primary-soft border p-2 d-flex justify-content-between align-items-center rounded-5 px-3 mt-1" style="height: 40px">
                                ورود / ثبت‌نام
                            </div>
                        </a>
                    @endguest

                    @auth

                        <!-- Profile dropdown START -->
                        <div class="nav-item dropdown mt-1">
                            <!-- Avatar -->

                            <div class="btn btn-primary-soft border p-0 d-flex justify-content-between align-items-center rounded-5 ps-3" onclick="openedSidebar()" data-bs-toggle="offcanvas" href="#offcanvasMenu" role="button" aria-controls="offcanvasMenu">
                                <div class="pt-1"><i class="bi bi-list fs-4"></i></div>
                                <a class="avatar avatar-sm p-0 ms-2 border rounded-circle" href="#">
                                    <img class="avatar-img rounded-circle" src="{{ auth()->user()->avatar_url }}" alt="avatar" data-bs-target="#offcanvasMenu">
                                </a>
                            </div>

                            <!-- Profile dropdown START -->
                            <ul class="dropdown-menu dropdown-animation dropdown-menu-end shadow pt-3" aria-labelledby="profileDropdown">
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
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person fa-fw me-2"></i>ویرایش پروفایل</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-gear fa-fw me-2"></i>تنظیمات</a> </li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-info-circle fa-fw me-2"></i>راهنما</a></li>
                                <li>
                                    @auth
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger bg-transparent border border-0"><i class="bi bi-power fa-fw me-2"></i>خروج</button>
                                        </form>
                                    @endauth
                                </li>
                                <li class="dropdown-divider mb-3"></li>
                                <li>
                                    <div class="dropdown-item">
                                        <!-- Dark mode options START -->
                                        <div class="nav-item dropdown ms-3">
                                            <!-- Switch button -->
                                            <button class="modeswitch" type="button" aria-expanded="false" data-bs-toggle="dropdown" data-bs-display="static">
                                                <svg class="theme-icon-active">
                                                    <use href="#"></use>
                                                </svg>
                                            </button>
                                            <!-- Dropdown items -->
                                            <ul class="dropdown-menu min-w-auto dropdown-menu-end" aria-labelledby="bd-theme">
                                                <li class="mb-1">
                                                    <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="light">
                                                        <svg width="16" height="16" fill="currentColor" class="bi bi-brightness-high-fill fa-fw mode-switch me-1" viewBox="0 0 16 16">
                                                            <path d="M12 8a4 4 0 1 1-8 0 4 4 0 0 1 8 0zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z">
                                                            </path>
                                                            <use href="#"></use>
                                                        </svg>روشن
                                                    </button>
                                                </li>
                                                <li class="mb-1">
                                                    <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-moon-stars-fill fa-fw mode-switch me-1" viewBox="0 0 16 16">
                                                            <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z">
                                                            </path>
                                                            <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z">
                                                            </path>
                                                            <use href="#"></use>
                                                        </svg>تیره
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="auto">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-half fa-fw mode-switch me-1" viewBox="0 0 16 16">
                                                            <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z">
                                                            </path>
                                                            <use href="#"></use>
                                                        </svg>خودکار
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- Dark mode options END -->
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- Profile dropdown END -->

                    @endauth
                </div>
            </div>
            <!-- Nav right END -->
        </div>
    </nav>
    <!-- Logo Nav END -->
</header>
