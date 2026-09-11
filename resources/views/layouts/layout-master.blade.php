<!DOCTYPE html>
<html lang="fa" dir="rtl">

    <head>
        <title>@yield('title', 'وبلاگ')</title>

        <!-- Meta Tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Blogzine">
        <meta name="description" content="Weblog">
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <!-- Dark mode script -->
        <script>
            const storedTheme = localStorage.getItem('theme');

            const getPreferredTheme = () => {
                if (storedTheme) {
                    return storedTheme;
                }
                return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            };

            const setTheme = function(theme) {
                if (theme === 'auto') {
                    document.documentElement.setAttribute('data-bs-theme', (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'));
                } else {
                    document.documentElement.setAttribute('data-bs-theme', theme);
                }
                // رویداد هماهنگی برای ApexCharts و سایر کامپوننت‌ها
                document.dispatchEvent(new CustomEvent('site-theme-changed'));
            };

            setTheme(getPreferredTheme());

            window.addEventListener('DOMContentLoaded', () => {
                const updateActiveButtons = (theme) => {
                    document.querySelectorAll('[data-bs-theme-value]').forEach(btn => {
                        if (btn.getAttribute('data-bs-theme-value') === theme) {
                            btn.classList.add('active');
                        } else {
                            btn.classList.remove('active');
                        }
                    });
                };

                updateActiveButtons(getPreferredTheme());

                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                    const currentStored = localStorage.getItem('theme');
                    if (currentStored !== 'light' && currentStored !== 'dark') {
                        setTheme(getPreferredTheme());
                    }
                });

                // اتصال رویداد کلیک به تمامی دکمه‌های تغییر تم در صفحه
                document.querySelectorAll('[data-bs-theme-value]').forEach(toggle => {
                    toggle.addEventListener('click', (e) => {
                        e.preventDefault();
                        const theme = toggle.getAttribute('data-bs-theme-value');
                        localStorage.setItem('theme', theme);
                        setTheme(theme);
                        updateActiveButtons(theme);
                    });
                });
            });
        </script>


        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <!-- bootstrap -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/swiper-bundle/swiper-bundle.min.css') }}" />

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

        <!-- vendors -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/plyr/plyr.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/apexcharts/css/apexcharts.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/quill/css/quill.snow.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/glightbox/css/glightbox.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/overlay-scrollbar/css/OverlayScrollbars.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/tiny-slider/tiny-slider.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/select2/select2.min.css') }}">

        <!-- Theme CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/style-rtl.css') }}">

        @stack('styles')

        {{-- Alert Message Style --}}
        <style>
            .message_toast {
                position: absolute;
                top: 60px;
                left: 50%;
                transform: translateX(-50%);
                color: #fff;
                z-index: 9999;
                opacity: 1;
                transition: opacity 0.5s ease, transform 0.5s ease;
            }

            .message_toast.fade-out {
                opacity: 0;
                transform: translateX(-50%) translateY(-20px);
            }

            @media (max-width: 766.98px) {
                .message_toast {
                    width: 70%;
                }
            }

            @media (min-width: 768px) {
                .message_toast {
                    width: 50%;
                }
            }

            @media (min-width: 900px) {
                .message_toast {
                    width: 30%;
                }
            }

            .ql-align-center {
                text-align: center !important;
            }

            .ql-align-right {
                text-align: right !important;
            }

            .ql-align-left {
                text-align: left !important;
            }

            .ql-align-justify {
                text-align: justify !important;
            }

            .ql-direction-rtl {
                direction: rtl !important;
                text-align: inherit;
            }

            .ql-direction-ltr {
                direction: ltr !important;
                text-align: inherit;
            }

            .ql-size-small {
                font-size: 0.75em !important;
            }

            .ql-size-large {
                font-size: 1.5em !important;
            }

            .ql-size-huge {
                font-size: 2.5em !important;
            }
        </style>

    </head>

    <body id="main">

        @if (session('success'))
            <div class="container mt-3 message_toast">
                <div class="alert alert-success d-flex justify-content-between">
                    {{ session('success') }}
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="بستن">
                    </button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="container mt-3 message_toast">
                <div class="alert alert-danger d-flex justify-content-between">
                    {{ session('error') }}
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="بستن">
                    </button>
                </div>
            </div>
        @endif



        @yield('layout-content')



        {{-- profile modal --}}
        <div class="modal fade" id="userProfileModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-4 border-0 shadow">
                    <div class="modal-header border-0 pb-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center p-4" id="userProfileModalBody">
                        <div class="spinner-border text-primary" role="status"></div>
                    </div>
                </div>
            </div>
        </div>


        {{-- profile modal scripts --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const modalEl = document.getElementById('userProfileModal');
                if (!modalEl) return;

                const modalBody = document.getElementById('userProfileModalBody');
                let profileModal = null;

                function getModal() {
                    if (!profileModal) profileModal = new bootstrap.Modal(modalEl);
                    return profileModal;
                }

                function showLoader() {
                    modalBody.innerHTML = `
                    <div class="py-4 text-center">
                        <div class="spinner-border text-primary" role="status"></div>
                        <p class="mt-2 text-muted small">در حال بارگذاری اطلاعات...</p>
                    </div>`;
                }

                function renderFollowButton(u) {
                    if (!u.can_follow) return '';

                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.id = 'followBtn';
                    btn.className = u.is_following ?
                        'btn btn-outline-secondary btn-sm rounded-pill px-4' :
                        'btn btn-primary btn-sm rounded-pill px-4';
                    btn.dataset.url = u.toggle_follow_url;
                    btn.innerHTML = u.is_following ?
                        '<i class="bi bi-person-check me-1"></i> دنبال شده' :
                        '<i class="bi bi-person-plus me-1"></i> دنبال کردن';

                    btn.addEventListener('click', function() {
                        toggleFollow(btn);
                    });

                    return btn;
                }

                async function toggleFollow(btn) {
                    const csrfToken = document
                        .querySelector('meta[name="csrf-token"]')
                        ?.getAttribute('content');

                    const targetUrl = btn.dataset.url;

                    if (!csrfToken) {
                        alert('توکن امنیتی یافت نشد. صفحه را دوباره بارگذاری کنید.');
                        return;
                    }

                    if (!targetUrl) {
                        alert('آدرس عملیات دنبال کردن دریافت نشده است.');
                        return;
                    }

                    btn.disabled = true;

                    try {
                        const response = await fetch(targetUrl, {
                            method: 'POST',
                            credentials: 'same-origin',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });

                        const contentType = response.headers.get('content-type') || '';
                        const data = contentType.includes('application/json') ?
                            await response.json() :
                            null;

                        if (!response.ok) {
                            throw new Error(
                                data?.message ||
                                `خطای سرور (${response.status}) در آدرس ${targetUrl}`
                            );
                        }

                        if (data.status !== 'success') {
                            throw new Error(data.message || 'عملیات انجام نشد.');
                        }

                        if (data.is_following) {
                            btn.className =
                                'btn btn-outline-secondary btn-sm rounded-pill px-4';
                            btn.innerHTML =
                                '<i class="bi bi-person-check me-1"></i> دنبال شده';
                        } else {
                            btn.className =
                                'btn btn-primary btn-sm rounded-pill px-4';
                            btn.innerHTML =
                                '<i class="bi bi-person-plus me-1"></i> دنبال کردن';
                        }

                        const counter = document.getElementById('followersCount');

                        if (counter) {
                            counter.textContent = data.followers_count;
                        }
                    } catch (error) {
                        alert(error.message || 'خطا در برقراری ارتباط با سرور.');
                    } finally {
                        btn.disabled = false;
                    }
                }

                document.addEventListener('click', function(e) {
                    const trigger = e.target.closest('.user-profile-trigger');
                    if (!trigger) return;

                    e.preventDefault();
                    e.stopPropagation();

                    const url = trigger.getAttribute('data-user-url');
                    if (!url) return;

                    showLoader();
                    getModal().show();

                    fetch(url)
                        .then(res => res.json())
                        .then(res => {
                            if (res.status === 'private') {
                                modalBody.innerHTML = `
                                <div class="py-3 text-center">
                                    <img src="${res.avatar}" class="rounded-circle border mb-3 shadow-sm" style="width: 80px; height: 80px; object-fit: cover;">
                                    <h5 class="fw-bold mb-3">${res.name}</h5>
                                    <div class="alert alert-warning d-flex align-items-center justify-content-center gap-2 m-0 rounded-3">
                                        <i class="bi bi-shield-lock-fill fs-5"></i>
                                        <span>${res.message}</span>
                                    </div>
                                </div>`;
                                return;
                            }

                            const u = res.data;

                            modalBody.innerHTML = `
                            <div class="py-2 text-center">
                                <img src="${u.avatar}" class="rounded-circle border border-5 shadow-sm mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                                <h5 class="fw-bold mb-1 fs-5">${u.name}</h5>
                                <div class="w-100 border px-3 pt-2 rounded-3 mb-2 mt-3">
                                    <p class="text-muted small mb-3">${u.bio || 'توضیحی ثبت نشده است'}</p>
                                </div>
                                <div class="pt-3 d-flex justify-content-around text-center mb-3">
                                    <div>
                                        <span class="d-block fw-bold fs-5">${u.articles_count ?? 0}</span>
                                        <i class="bi bi-file-earmark-text small text-muted"></i>
                                        <span class="text-muted small">تعداد اخبار</span>
                                    </div>
                                    <div>
                                        <span class="d-block fw-bold fs-5" id="followersCount">${u.followers_count ?? 0}</span>
                                        <i class="bi bi-heart small text-muted"></i>
                                        <span class="text-muted small">دنبال‌کننده</span>
                                    </div>
                                </div>
                                <div id="followBtnContainer"></div>
                            </div>`;

                            const followButton = renderFollowButton(u);
                            if (followButton) {
                                document.getElementById('followBtnContainer').appendChild(followButton);
                            }
                        })
                        .catch(() => {
                            modalBody.innerHTML = `
                            <div class="alert alert-danger m-0 text-center">
                                خطا در دریافت اطلاعات کاربر.
                            </div>`;
                        });
                });
            });
        </script>

        {{-- Bootstrap JS --}}
        <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

        {{-- Vendors --}}
        <script src="{{ asset('assets/vendor/plyr/plyr.js') }}"></script>
        <script src="{{ asset('assets/vendor/overlay-scrollbar/js/OverlayScrollbars.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/quill/js/quill.js') }}"></script>
        <script src="{{ asset('assets/vendor/isotope/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/sticky-js/sticky.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/glightbox/js/glightbox.js') }}"></script>
        <script src="{{ asset('assets/vendor/tiny-slider/tiny-slider-rtl.js') }}"></script>

        <script>
            window.e = window.e || {};
            window.e.trafficstatsChart = function() {};
        </script>

        {{-- Template Functions --}}
        <script src="{{ asset('assets/js/functions.js') }}"></script>

        <script src="{{ asset('assets/vendor/select2/select2.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/swiper-bundle/swiper-bundle.min.js') }}"></script>


        {{-- Alert Message Script --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const toast = document.querySelector('.message_toast');

                if (toast) {
                    setTimeout(function() {
                        toast.classList.add('fade-out');
                        setTimeout(function() {
                            toast.remove();
                        }, 500);
                    }, 4000);
                }
            });
        </script>

        @stack('scripts')

    </body>

</html>
