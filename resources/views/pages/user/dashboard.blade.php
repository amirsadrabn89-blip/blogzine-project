@extends('layouts.layout-dashboard')


{{-- ===(title)=== --}}
@section('title')
    وبلاگ | پیشخوان من
@endsection


{{-- ====(main)=== --}}
@section('dashboard-content')
    <!-- Author single START -->
    <section class="pb-4 bg-body-custom">
        <div class="container">
            <div class="row justify-content-center g-4">
                <div class="col-12">
                    <!-- Grid START -->
                    <div class="row g-4 justify-content-center">

                        <!-- Grid item -->
                        <div class="col-sm-6 col-md-4 col-xl-3">
                            <div class="card card-body bg-success bg-opacity-15 py-3 px-4 h-100">
                                <span class="d-flex justify-content-start align-items-center"><i class="bi bi-file-earmark-text me-2 fs-4 h4 mt-1"></i>
                                    <h6 class="h4">تعداد اخبار من</h6>
                                </span>
                                <h2 class="fs-2 text-success">{{ $articlesCount }}</h2>
                                <div class="mt-auto"><a href="#NewsList" class="btn btn-link text-reset p-0 mb-0">مشاهده اخبار</a></div>
                            </div>
                        </div>

                        <!-- Grid item -->
                        <div class="col-sm-6 col-md-4 col-xl-3">
                            <div class="card card-body bg-info bg-opacity-10 py-3 px-4 h-100">
                                <span class="d-flex justify-content-start align-items-center"><i class="bi bi-eye me-2 fs-4 h4 mt-1"></i>
                                    <h6 class="h4">بازدید کل از اخبار من</h6>
                                </span>
                                <h2 class="fs-2 text-info">{{ number_format($totalViews) }}</h2>
                                <div class="mt-auto"><a href="#MonthlyIncomeReport" class="btn btn-link text-reset p-0 mb-0">مشاهده نمودار</a></div>
                            </div>
                        </div>

                        <!-- Grid item -->
                        <div class="col-sm-6 col-md-4 col-xl-3">
                            <div class="card card-body bg-warning bg-opacity-15 py-3 px-4 h-100">
                                <span class="d-flex justify-content-start align-items-center"><i class="bi bi-chat-left-text me-2 fs-4 h4 mt-1"></i>
                                    <h6 class="h4"> دیدگاه‌های جدید دریافتی</h6>
                                </span>
                                <h2 class="fs-2 text-warning">{{ number_format($unreadCommentsCount) }}</h2>
                                <button type="button" class="btn p-0 mb-0 text-start" data-bs-toggle="modal" data-bs-target="#myArticlesStatsModal">
                                    <div class="mt-auto btn-link text-reset d-inline-block">مشاهده لیست دیدگاه ها</div>
                                </button>
                            </div>
                        </div>

                        <!-- Grid item -->
                        <div class="col-sm-6 col-md-4 col-xl-3">
                            <div class="card card-body bg-danger bg-opacity-25 py-3 px-4 h-100">
                                <span class="d-flex justify-content-start align-items-center"><i class="bi bi-heart me-2 fs-4 h4 mt-1"></i>
                                    <h6 class="h4">دنبال کننده های من</h6>
                                </span>

                                <h2 class="fs-2 text-danger">{{ auth()->user()->followers()->count() }}</h2>
                                <div class="mt-auto"><a href="#" class="btn btn-link text-reset p-0 mb-0"></a></div>
                            </div>
                        </div>

                    </div>
                    <!-- Grid END -->
                </div>

                <div class="col-lg-8">
                    <!-- Chart START -->
                    <div class="card border h-100">
                        <!-- Card header -->
                        <div class="card-header border-bottom d-flex justify-content-between align-items-center p-3">
                            <h4 class="card-header-title mb-0">درباره من</h4>
                            <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-primary mb-0"><i class="bi bi-pen me-2"></i>ویرایش پروفایل</a>
                        </div>

                        <!-- Card body -->
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-sm-between align-items-center mb-4">
                                <!-- Avatar detail -->
                                <div class="d-flex align-items-center">
                                    <!-- Avatar -->
                                    <div class="avatar avatar-lg">
                                        <img class="avatar-img rounded-circle border border-white border-3 shadow" src="{{ auth()->user()?->avatar_url ?? asset('assets/images/avatar/user_natural.png') }}" alt="">
                                    </div>
                                    <!-- Info -->
                                    <div class="ms-3">
                                        <h5 class="mb-0">{{ auth()->user()?->name }}</h5>
                                        <p class="mb-0 small">{{ auth()->user()?->job_title }}</p>
                                    </div>
                                </div>
                                <!-- Tags -->
                                <div class="d-flex flex-column mt-2 mt-sm-0">
                                    <h6 class="py-2 px-3 bg-danger bg-opacity-10 rounded border border-danger"><i class="bi bi-person-heart me-3 border-end border-danger pe-3 text-danger"></i><span>{{ auth()->user()->followers()->count() }} دنبال کننده</span></h6>
                                    <h6 class="py-2 px-3 bg-info bg-opacity-10 rounded border border-info"><i class="bi bi-newspaper me-3 border-end border-info pe-3 text-info"></i><span>{{ number_format($articlesCount) }} خبر</span></h6>
                                </div>
                            </div>

                            <!-- Information START -->
                            <div class="row">
                                <!-- Information item -->
                                <div class="col-md-6">
                                    <ul class="list-group list-group-borderless">
                                        <!-- Full Name -->
                                        <li class="list-group-item">
                                            <span>نام:</span>
                                            <span class="h6 mb-0">{{ auth()->user()?->name }}</span>
                                        </li>
                                        <!-- User Name -->
                                        <li class="list-group-item">
                                            <span>نام کاربری:</span>
                                            <span class="h6 mb-0">{{ auth()->user()?->username }}</span>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Information item -->
                                <div class="col-md-6">
                                    <ul class="list-group list-group-borderless">
                                        <!-- Email ID -->
                                        <li class="list-group-item">
                                            <span>ایمیل:</span>
                                            <span class="h6 mb-0">{{ auth()->user()?->email }}</span>
                                        </li>
                                        <!-- Mobile Number -->
                                        <li class="list-group-item">
                                            <span>شماره همراه:</span>
                                            <span class="h6 mb-0" dir="ltr">{{ auth()->user()?->masked_phone }}</span>
                                        </li>
                                        <!-- Joining Date -->
                                        <li class="list-group-item">
                                            <span>تاریخ عضویت:</span>
                                            <span class="h6 mb-0">{{ verta(auth()->user()?->created_at)->format('d F Y') }}</span>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Information item -->
                                <div class="col-12">
                                    <ul class="list-group list-group-borderless">
                                        <!-- Description -->
                                        <li class="list-group-item">
                                            <span>توضیحات:</span>
                                            <p class="h6 mb-0 mt-2">{{ auth()->user()?->bio }}</p>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Information END -->
                        </div>
                    </div>
                    <!-- Chart END -->
                </div>

                <div class="col-12 col-lg-4">
                    <!-- Popular blog START -->
                    <div class="card border h-100">
                        <!-- Card header -->
                        <div class="card-header p-3">
                            <h4 class="card-header-title mb-0">محبوب ترین اخبار</h4>
                        </div>

                        <!-- Card body START -->
                        <div class="card-body p-3">

                            <div class="row h-100 ">

                                @foreach ($popularArticles as $article)
                                    <div class="col-12 border-top p-2 h-25 d-flex align-items-center">
                                        <div class="d-flex align-items-center position-relative">
                                            <img class="w-60 rounded" style="height: 50px" src="{{ $article->main_image ?? asset('assets/images/avatar/user_natural.png') }}" alt="article main image">
                                            <div class="ms-3">
                                                <a href="#" class="h6 stretched-link">{{ $article->title }}</a>
                                                <p class="small mb-0"><i class="far fa-eye me-1"></i> {{ $article->views }} بازدید</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                        </div>
                        <!-- Card body END -->

                        <!-- Card footer -->
                        <div class="card-footer border-top text-center p-3">
                            <a href="{{ route('post-grid-masonry-filter.page') }}">مشاهده همه اخبار</a>
                        </div>

                    </div>
                    <!-- Popular blog END -->
                </div>

                {{-- <div class="col-md-6 col-lg-4">
                        <!-- Recent comment START -->
                        <div class="card border h-100">
                            <!-- Card header -->
                            <div class="card-header border-bottom p-3">
                                <h4 class="card-header-title mb-0">آخرین نظرات</h4>
                            </div>

                            <!-- Card body START -->
                            <div class="card-body p-3">

                                <div class="row">
                                    <!-- Comment item -->
                                    <div class="col-12">
                                        <div class="d-flex align-items-center position-relative">
                                            <!-- Avatar -->
                                            <div class="avatar avatar-lg flex-shrink-0">
                                                <img class="avatar-img rounded-2" src="{{ asset('assets/images/avatar/06.jpg') }}" alt="avatar">
                                            </div>
                                            <!-- Info -->
                                            <div class="ms-3">
                                                <p class="mb-1"> <a class="h6 fw-normal stretched-link" href="#"> وقتی ثروت‌ های بزرگ به دست برخی مردم می‌افتد... </a></p>
                                                <div class="d-flex justify-content-between">
                                                    <p class="small mb-0">با الهام کریمی</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Divider -->
                                    <hr class="my-3">

                                    <!-- Comment item -->
                                    <div class="col-12">
                                        <div class="d-flex align-items-center position-relative">
                                            <!-- Avatar -->
                                            <div class="avatar avatar-lg flex-shrink-0">
                                                <img class="avatar-img rounded-2" src="{{ asset('assets/images/avatar/08.jpg') }}" alt="avatar">
                                            </div>
                                            <!-- Info -->
                                            <div class="ms-3">
                                                <p class="mb-1"> <a class="h6 fw-normal stretched-link" href="#"> وقتی ثروت‌ های بزرگ به دست برخی مردم می‌افتد... </a></p>
                                                <div class="d-flex justify-content-between">
                                                    <p class="small mb-0">با سارا موحد</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Divider -->
                                    <hr class="my-3">

                                    <!-- Comment item -->
                                    <div class="col-12">
                                        <div class="d-flex align-items-center position-relative">
                                            <!-- Avatar -->
                                            <div class="avatar avatar-lg flex-shrink-0">
                                                <img class="avatar-img rounded-2" src="{{ asset('assets/images/avatar/04.jpg') }}" alt="avatar">
                                            </div>
                                            <!-- Info -->
                                            <div class="ms-3">
                                                <p class="mb-1"> <a class="h6 fw-normal stretched-link" href="#"> وقتی ثروت‌ های بزرگ به دست برخی مردم می‌افتد </a></p>
                                                <div class="d-flex justify-content-between">
                                                    <p class="small mb-0">با سهراب رضایی</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Divider -->
                                    <hr class="my-3">

                                    <!-- Comment item -->
                                    <div class="col-12">
                                        <div class="d-flex align-items-center position-relative">
                                            <!-- Avatar -->
                                            <div class="avatar avatar-lg flex-shrink-0">
                                                <img class="avatar-img rounded-2" src="{{ asset('assets/images/avatar/05.jpg') }}" alt="avatar">
                                            </div>
                                            <!-- Info -->
                                            <div class="ms-3">
                                                <p class="mb-1"> <a class="h6 fw-normal stretched-link" href="#"> وقتی ثروت‌ های بزرگ به دست برخی مردم می‌افتد </a></p>
                                                <div class="d-flex justify-content-between">
                                                    <p class="small mb-0">با نگین جوان</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Card body END -->
                        </div>
                        <!-- Recent comment END -->
                    </div> --}}

                <div class="col-12" id="MonthlyIncomeReport">
                    <div class="card border shadow-sm rounded-4 overflow-hidden">

                        <div class="d-flex align-items-center justify-content-between gap-2 border-bottom">
                            <span class="badge bg-info bg-opacity-10 text-info fs-6 px-3">
                                <span class="fs-5">
                                    {{ number_format($totalTwoMonthsViews ?? 0) }}
                                </span>
                                بازدید در 2 ماه اخیر
                            </span>

                            <span class="badge bg-info bg-opacity-10 text-info fs-6 px-3">
                                <span class="fs-5">
                                    {{ number_format($totalViews) }}
                                </span>
                                بازدید کل
                            </span>
                        </div>

                        <div class="card-body">
                            <div id="myArticlesViewsChart" class="mt-2"></div>
                        </div>

                    </div>
                </div>

                <div class="col-12 col-sm-8 mb-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative hover-top-card">
                        <div class="position-absolute top-0 start-0 end-0 bg-primary" style="height: 4px;"></div>

                        <div class="card-body p-4 d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-3" style="width: 48px; height: 48px;">
                                        <i class="bi bi-newspaper fs-4"></i>
                                    </div>
                                    @isset($articlesCount)
                                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold fs-6">
                                            {{ $articlesCount }} خبر
                                        </span>
                                    @endisset
                                </div>

                                <h4 class="fw-bold mb-2">خبرهای من</h4>
                                <p class="small text-muted mb-0">مشاهده، ویرایش و مدیریت وضعیت انتشار اخبار شما</p>
                            </div>

                            <div class="mt-4 pt-3 border-top border-secondary border-opacity-10 d-flex align-items-center justify-content-between">
                                <a href="{{ route('user.my-articles.page') }}" class="btn btn-sm btn-primary rounded-pill px-3 d-flex align-items-center gap-1">
                                    <span>مشاهده لیست اخبار من</span>
                                    <i class="bi bi-arrow-left small mt-1 ms-1"></i>
                                </a>

                                <a href="{{ route('dashboard-post-create.page') }}" class="btn btn-sm btn-outline-secondary rounded-circle" style="width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center;" title="ثبت خبر جدید">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Main contain END -->

    <div class="modal fade" id="myArticlesStatsModal" tabindex="-1" aria-labelledby="myArticlesStatsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="myArticlesStatsModalLabel">
                        آمار خبرهای من
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                </div>

                <div class="modal-body" id="myArticlesStatsContent">

                    <div class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">
                                در حال دریافت اطلاعات...
                            </span>
                        </div>

                        <p class="text-muted mt-3 mb-0">
                            در حال دریافت خبرهای شما...
                        </p>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        بستن
                    </button>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/vendor/apexcharts/js/apexcharts.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chartElement = document.querySelector('#myArticlesViewsChart');
            if (!chartElement) return;

            if (typeof ApexCharts === 'undefined') {
                console.error('ApexCharts library is not loaded!');
                return;
            }

            const chartPoints = @json($chartPoints ?? []);
            const seriesData = chartPoints.map(item => Number(item.views || 0));
            const categories = chartPoints.map(item => item.full_date);

            // محاسبه ایندکس میانه هر ماه برای نمایش نام ماه در محور X
            const monthIndexes = {};
            chartPoints.forEach((item, index) => {
                if (!monthIndexes[item.month_name]) monthIndexes[item.month_name] = [];
                monthIndexes[item.month_name].push(index);
            });

            const tickPositions = Object.values(monthIndexes).map(indexes =>
                indexes[Math.floor(indexes.length / 2)]
            );

            const isDark = document.documentElement.getAttribute('data-bs-theme') === 'dark';

            const options = {
                series: [{
                    name: 'تعداد بازدید',
                    data: seriesData
                }],
                chart: {
                    type: 'area',
                    height: 320,
                    fontFamily: 'Vazirmatn, Tahoma, sans-serif',
                    foreColor: isDark ? '#dee2e6' : '#6c757d',
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: false
                    }
                },
                colors: ['#0d6efd'],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2.5
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.40,
                        opacityTo: 0.05,
                        stops: [0, 95, 100]
                    }
                },
                grid: {
                    borderColor: isDark ? 'rgba(255, 255, 255, 0.1)' : '#e9ecef',
                    strokeDashArray: 4
                },
                xaxis: {
                    type: 'category',
                    categories: categories,
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            fontSize: '13px'
                        },
                        formatter: function(val, timestamp, opts) {
                            const idx = opts ? opts.i : -1;
                            if (tickPositions.includes(idx) && chartPoints[idx]) {
                                return chartPoints[idx].month_name;
                            }
                            return '';
                        }
                    },
                    tooltip: {
                        enabled: false
                    }
                },
                yaxis: {
                    min: 0,
                    forceNiceScale: true,
                    labels: {
                        formatter: function(val) {
                            return Math.round(val).toLocaleString('fa-IR');
                        }
                    }
                },
                tooltip: {
                    theme: 'dark',
                    custom: function({
                        series,
                        seriesIndex,
                        dataPointIndex
                    }) {
                        const item = chartPoints[dataPointIndex];
                        if (!item) return '';
                        const views = series[seriesIndex][dataPointIndex];
                        return `
                    <div class="px-3 py-2 text-end" style="direction: rtl; font-family: inherit;">
                        <div class="fw-bold mb-1">${item.full_date}</div>
                        <div class="text-white-50">تعداد بازدید: <span class="badge bg-primary fs-6">${Number(views).toLocaleString('fa-IR')}</span></div>
                    </div>
                `;
                    }
                },
                noData: {
                    text: 'هنوز بازدیدی در ۲ ماه اخیر ثبت نشده است.',
                    align: 'center',
                    verticalAlign: 'middle',
                    style: {
                        color: '#6c757d',
                        fontSize: '14px'
                    }
                }
            };

            const chart = new ApexCharts(chartElement, options);
            chart.render();

            window.addEventListener('site-theme-changed', function() {
                const dark = document.documentElement.getAttribute('data-bs-theme') === 'dark';
                chart.updateOptions({
                    chart: {
                        foreColor: dark ? '#dee2e6' : '#6c757d'
                    },
                    grid: {
                        borderColor: dark ? 'rgba(255, 255, 255, 0.1)' : '#e9ecef'
                    }
                });
            });
        });
    </script>

    <script>
        const statsModal = document.getElementById('myArticlesStatsModal');
        const statsContent = document.getElementById('myArticlesStatsContent');

        if (statsModal && statsContent) {
            const defaultSpinner = statsContent.innerHTML;

            statsModal.addEventListener('show.bs.modal', function() {
                statsContent.innerHTML = defaultSpinner;

                fetch("{{ route('user.dashboard.my-articles-stats') }}", {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'text/html'
                        }
                    })
                    .then(res => {
                        if (!res.ok) throw new Error('خطای سرور (' + res.status + ')');
                        return res.text();
                    })
                    .then(html => {
                        statsContent.innerHTML = html;
                    })
                    .catch(err => {
                        statsContent.innerHTML = `
                <div class="alert alert-danger text-center my-3">
                    ${err.message || 'خطا در دریافت اطلاعات.'}
                </div>
            `;
                    });
            });
        }
    </script>
@endpush
