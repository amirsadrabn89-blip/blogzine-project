<div class="offcanvas offcanvas-end border-light" tabindex="-1" id="offcanvasMenu">
    <div class="offcanvas-header justify-content-end">
        <button type="button" onclick="closedSidebar()" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column pt-0">
        <div>
            <img class="light-mode-item my-3" src="{{ asset('assets/images/logo.svg') }}" alt="logo">
            <img class="dark-mode-item my-3 mb-5" src="{{ asset('assets/images/logo-light.svg') }}" alt="logo">
            <!-- Nav END -->
            <div class="d-flex flex-column justify-content-center align-items-center">
                <div class="card-img-flash rounded-circle mb-2">
                    <img class="offcanvas-avatar avatar-img p-1" src="{{ auth()->user()?->avatar_url }}" alt="">
                </div>
                <p class="fw-bold" style="font-size: 17px;">{{ auth()->user()?->name }}</p>
                <ul class="nav d-flex flex-row-reverse justify-content-around">
                    <li class="nav-item offcanvas-social-icon d-flex justify-content-center align-items-center ms-3 bg-light">
                        <a class="nav-link d-flex {{ !auth()->user()?->facebook ? 'disabled' : '' }}" href="{{ auth()->user()?->facebook ?: '#' }}"
                           @if (auth()->user()?->facebook) target="_blank" rel="noopener noreferrer" @endif>
                            <i class="bi bi-facebook fa-fw" style="font-size: 22px;"></i>
                        </a>
                    </li>
                    <li class="nav-item offcanvas-social-icon d-flex justify-content-center align-items-center ms-3 bg-light">
                        <a class="nav-link d-flex {{ !auth()->user()?->linkedin ? 'disabled' : '' }}" href="{{ auth()->user()?->linkedin ?: '#' }}"
                           @if (auth()->user()?->linkedin) target="_blank" rel="noopener noreferrer" @endif>
                            <i class="fab fa-linkedin fa-fw" style="font-size: 22px;"></i>
                        </a>
                    </li>
                    <li class="nav-item offcanvas-social-icon d-flex justify-content-center align-items-center ms-3 bg-light">
                        <a class="nav-link d-flex {{ !auth()->user()?->twitter ? 'disabled' : '' }}" href="{{ auth()->user()?->twitter ?: '#' }}"
                           @if (auth()->user()?->twitter) target="_blank" rel="noopener noreferrer" @endif>
                            <i class="bi bi-twitter-x fa-fw" style="font-size: 20px;"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="my-4">
                <ul class="nav d-flex flex-column offcanvas-dash-nav">

                    <li class="nav-item my-1 offcanvas-dash-nav-usuale-li"><a class="nav-link" style="font-size: 17px;" href="  @if (auth()->user()?->is_admin) {{ route('admin.dashboard.page') }}
                                                                                                                                        @else
                                                                                                                                    {{ route('user.dashboard.page') }} @endif
                                                                                                                                    ">پیشخوان من</a>
                    </li>
                    <li class="nav-item my-1 offcanvas-dash-nav-usuale-li"><a class="nav-link" style="font-size: 17px;" href="{{ route('profile.edit') }}">حساب کاربری</a></li>
                    @if (auth()->user()?->is_admin)
                        <li class="nav-item my-1 offcanvas-dash-nav-usuale-li mt-4"><a class="nav-link" style="font-size: 17px;" href="{{ route('admin.users.index') }}">پنل مدیریت کاربران</a></li>
                        <li class="nav-item my-1 offcanvas-dash-nav-usuale-li"><a class="nav-link" style="font-size: 17px;" href="{{ route('admin.categories.index') }}">پنل مدیریت دسته بندی ها</a></li>
                        <li class="nav-item my-1 offcanvas-dash-nav-usuale-li"><a class="nav-link" style="font-size: 17px;" href="{{ route('admin.articles.index') }}">پنل مدیریت اخبار</a></li>
                        <li class="nav-item my-1 offcanvas-dash-nav-usuale-li"><a class="nav-link" style="font-size: 17px;" href="{{ route('admin.comments.index') }}">پنل مدیریت دیدگاه ها</a></li>
                        <li class="nav-item my-1 offcanvas-dash-nav-usuale-li"><a class="nav-link" style="font-size: 17px;" href="{{ route('admin.contact-messages.index') }}">پنل مدیریت پیام های کاربران</a></li>
                    @endif
                    @if (!auth()->user()?->is_admin)
                    <li class="nav-item my-1 offcanvas-dash-nav-usuale-li mt-4"><a class="nav-link" style="font-size: 17px;" href="{{ route('post-grid-masonry-filter.page') }}">همۀ اخبار</a></li>
                        <li class="nav-item my-1 offcanvas-dash-nav-usuale-li"><a class="nav-link" style="font-size: 17px;" href="{{ route('user.my-articles.page') }}">خبر های من</a></li>
                        <li class="nav-item my-1 offcanvas-dash-nav-usuale-li"><a class="nav-link" style="font-size: 17px;" href="{{ route('dashboard-post-create.page') }}">ایجاد خبر</a></li>
                    @endif
                    @if (auth()->user()?->is_admin)
                        <li class="nav-item my-1 offcanvas-dash-nav-usuale-li mt-4"><a class="nav-link" style="font-size: 17px;" href="{{ route('admin.help-and-rules.page') }}">راهنما و قوانین سایت</a></li>
                    @else
                        <li class="nav-item my-1 offcanvas-dash-nav-usuale-li mt-4"><a class="nav-link" style="font-size: 17px;" href="{{ route('users_help-and-rules.page') }}">راهنما و قوانین سایت</a></li>
                    @endif
                    <li class="nav-item my-1 offcanvas-dash-nav-log-out-li">
                        @auth
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="nav-link text-danger bg-transparent border border-0" style="font-size: 17px;">خروج از حساب کاربری</button>
                            </form>
                        @endauth
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
