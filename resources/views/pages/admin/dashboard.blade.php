@extends('layouts.layout-dashboard')


{{-- ===(title)=== --}}
@section('title')
    وبلاگ | داشبورد
@endsection


{{-- ====(main)=== --}}
@section('dashboard-content')
    <!-- Main contain START -->
    <section class="py-4 bg-body-custom" style="min-height: 100vh;">
        <div class="container">
            <div class="row g-4">

                <div class="col-12">
                    <!-- Counter START -->
                    <div class="row g-2">

                        <!-- Counter item -->
                        <div class="col-md-6 col-xl-3">
                            <div class="card card-body border p-2">
                                <div class="d-flex align-items-center">
                                    <!-- Icon -->
                                    <div class="icon-xl fs-1 bg-success bg-opacity-10 rounded-3 text-success">
                                        <i class="bi bi-people-fill"></i>
                                    </div>
                                    <!-- Content -->
                                    <div class="ms-3 card-title">

                                        <div class="d-flex justify-content-start align-items-center my-2">
                                            <h2 class="me-2">{{ $userCount > 999 ? rtrim(rtrim(number_format($userCount / 1000, 1), '0'), '.') . 'k' : $userCount }}</h2>
                                            <h3 class="text-reset fs-5">کاربر</h3>
                                        </div>
                                        <a href="{{ route('admin.users.index') }}" class="mb-0 btn-link text-secondary-emphasis fs-6">(مدیریت کاربران)</a>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Counter item -->
                        <div class="col-md-6 col-xl-3">
                            <div class="card card-body border p-2">
                                <div class="d-flex align-items-center">
                                    <!-- Icon -->
                                    <div class="icon-xl fs-1 bg-primary bg-opacity-10 rounded-3 text-primary">
                                        <i class="bi bi-file-earmark-text-fill"></i>
                                    </div>
                                    <!-- Content -->
                                    <div class="ms-3 card-title">
                                        <div class="d-flex justify-content-start align-items-center my-2">
                                            <h2 class="me-2">{{ $articlesCount > 999 ? rtrim(rtrim(number_format($articlesCount / 1000, 1), '0'), '.') . 'k' : $articlesCount }}</h2>
                                            <h3 class="text-reset">خبر</h3>
                                        </div>
                                        <a href="{{ route('admin.articles.index') }}" class="mb-0 btn-link text-secondary-emphasis fs-6">(مدیریت اخبار)</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Counter item -->
                        <div class="col-md-6 col-xl-3">
                            <div class="card card-body border p-2">
                                <div class="d-flex align-items-center">
                                    <!-- Icon -->
                                    <div class="icon-xl fs-1 bg-danger bg-opacity-10 rounded-3 text-danger">
                                        <i class="bi bi-envelope-x"></i>
                                    </div>
                                    <!-- Content -->
                                    <div class="ms-3 card-title">
                                        <div class="d-flex justify-content-start align-items-center my-2">
                                            <h2 class="me-2">{{ $unansweredMessagesCount > 999 ? rtrim(rtrim(number_format($unansweredMessagesCount / 1000, 1), '0'), '.') . 'k' : $unansweredMessagesCount }}</h2>
                                            <h3 class="text-reset fs-5">پیام خوانده نشده</h3>
                                        </div>
                                        <a href="{{ route('admin.contact-messages.index') }}" class="mb-0 btn-link text-secondary-emphasis fs-6">(مدیریت نظرات)</a>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Counter item -->
                        <div class="col-md-6 col-xl-3">
                            <div class="card card-body border p-2">
                                <div class="d-flex align-items-center">
                                    <!-- Icon -->
                                    <div class="icon-xl fs-1 bg-info bg-opacity-10 rounded-3 text-info">
                                        <i class="bi bi-eye"></i>
                                    </div>
                                    <!-- Content -->
                                    <div class="ms-3 card-title">

                                        <div class="d-flex justify-content-start align-items-center my-2">
                                            <h2 class="me-2">{{ $totalViews > 999 ? rtrim(rtrim(number_format($totalViews / 1000, 1), '0'), '.') . 'k' : $totalViews }}</h2>
                                            <h3 class="text-reset fs-5">بازدید از اخبار</h3>
                                        </div>
                                        <a href="#adminViewsChart" class="mb-0 btn-link text-secondary-emphasis fs-6">(نمودار آمار)</a>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Counter END -->
                </div>

                <div class="col-12">
                    <div class="card border">
                        <div class="card-header p-3 border-bottom">
                            <h5 class="mb-0">دسترسی سریع</h5>
                        </div>

                        <div class="card-body">
                            <div class="row justify-content-start justify-content-xl-around g-2">
                                <div class="col-6 col-12 col-sm-4 col-lg-3 col-xl-2">
                                    <a href="{{ route('dashboard-post-create.page') }}" class="btn btn-outline-secondary w-100 p-0 py-2">
                                        <i class="bi bi-plus-circle me-1"></i>
                                        ایجاد خبر
                                    </a>
                                </div>

                                <div class="col-6 col-12 col-sm-4 col-lg-3 col-xl-2">
                                    <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-primary w-100 p-0 py-2">
                                        <i class="bi bi-newspaper me-1"></i>
                                        مدیریت اخبار
                                    </a>
                                </div>

                                <div class="col-6 col-12 col-sm-4 col-lg-3 col-xl-2">
                                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-success w-100 p-0 py-2">
                                        <i class="bi bi-tags me-1"></i>
                                        مدیریت دسته بندی ها
                                    </a>
                                </div>

                                <div class="col-6 col-12 col-sm-4 col-lg-3 col-xl-2 ">
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-warning w-100 p-0 py-2">
                                        <i class="bi bi-people me-1"></i>
                                        مدیریت کاربران
                                    </a>
                                </div>

                                <div class="col-6 col-12 col-sm-4 col-lg-3 col-xl-2 ">
                                    <a href="{{ route('admin.comments.index') }}" class="btn btn-outline-info w-100 p-0 py-2">
                                        <i class="bi bi-chat-left-text me-1"></i>
                                        مدیریت دیدگاه ها
                                    </a>
                                </div>

                                <div class="col-6 col-12 col-sm-4 col-lg-3 col-xl-2">
                                    <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-outline-danger w-100 p-0 py-2">
                                        <i class="bi bi-envelope me-1"></i>
                                        مدیریت پیام‌ها
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-12">
                    <!-- Chart START -->
                    <div class="card border h-100">

                        <!-- Card header -->
                        <div class="card-header p-3 border-bottom d-flex flex-wrap gap-2 align-items-center justify-content-between">
                            <h4 class="card-header-title mb-0">
                                کل بازدیدهای 2 ماه اخیر :
                            </h4>

                            <span class="fw-bold badge bg-info bg-opacity-10 text-info px-4 py-2">
                                <span class="fs-5">{{ number_format($totalTwoMonthsViews) }}</span>
                                <span class="fs-6">بازدید </span>
                            </span>
                        </div>
                        <!-- Card body -->
                        <div class="card-body">
                            <div id="adminViewsChart"></div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card border h-100">
                        <div class="card-header p-3 border-bottom d-flex flex-wrap gap-2 align-items-center justify-content-between">
                            <h4 class="card-header-title mb-0">
                                مدیر های سایت :
                            </h4>

                            <span class="fw-bold badge bg-info bg-opacity-10 text-info px-4 py-2">
                                <span class="fs-5">{{ $adminsCount }}</span>
                                <span class="fs-6">مدیر</span>
                            </span>
                        </div>
                        <!-- Card body -->
                        <div class="card-body">
                            @foreach ($admins as $admin)
                                <div class="my-2 mx-3 border rounded-3">
                                    <div class="p-1">

                                    </div>
                                    <div class="py-1 px-3 d-flex justify-content-between align-items-center">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <img class="rounded-circle border border-2 avatar-preview-btn me-3" src="{{ $admin->avatar_url ?? asset('assets/images/avatar/default.png') }}" alt="" style="width: 60px; height: 60px; object-fit: cover; cursor: pointer;">
                                            <div class="d-flex flex-column justify-content-center align-items-start">
                                                <span class="fs-5 h5">{{ $admin->name }}</span>
                                                <span class="fs-6">{{ $admin->email }}</span>
                                            </div>
                                        </div>
                                        <div class="">
                                            @if (auth()->user()?->email == $admin->email)
                                                <div class="btn btn-sm alert alert-info py-1 px-2">
                                                    این مدیر شما هستید
                                                </div>
                                            @endif

                                            <div class="btn btn-sm {{ !$admin->is_active ? 'alert alert-warning py-1 px-2' : 'alert alert-success py-1 px-2' }}">
                                                {{ !$admin->is_active ? 'مسدود شده' : 'فعال' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <span>{{$admin->name}}</span> --}}
                            @endforeach

                            <div class="mt-5 px-3">
                                {{ $admins->links() }}
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Main contain END -->
@endsection

@push('scripts')
    <script src="{{ asset('assets/vendor/apexcharts/js/apexcharts.min.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const chartPoints = @json($chartPoints ?? []);

            const seriesData = chartPoints.map(item => item.views);
            const categories = chartPoints.map(item => item.full_date);

            // محاسبه موقعیت میانی هر ماه برای قرارگیری تمیز عنوان ماه در محور X
            const monthIndexes = {};
            chartPoints.forEach((item, index) => {
                if (!monthIndexes[item.month_name]) {
                    monthIndexes[item.month_name] = [];
                }
                monthIndexes[item.month_name].push(index);
            });

            const tickPositions = Object.values(monthIndexes).map(indexes =>
                indexes[Math.floor(indexes.length / 2)]
            );

            const options = {
                series: [{
                    name: 'تعداد بازدید',
                    data: seriesData
                }],
                chart: {
                    type: 'area',
                    height: 320,
                    fontFamily: 'inherit',
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
                    width: 2
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
                xaxis: {
                    categories: categories,
                    tickAmount: tickPositions.length,
                    labels: {
                        style: {
                            colors: '#6c757d',
                            fontSize: '12px'
                        },
                        formatter: function(val, timestamp, opts) {
                            const index = opts ? opts.i : -1;
                            if (tickPositions.includes(index) && chartPoints[index]) {
                                return chartPoints[index].month_name;
                            }
                            return '';
                        }
                    },
                    axisTicks: {
                        show: false
                    },
                    axisBorder: {
                        show: false
                    },
                    tooltip: {
                        enabled: false
                    }
                },
                yaxis: {
                    min: 0,
                    forceNiceScale: true,
                    labels: {
                        style: {
                            colors: '#6c757d'
                        },
                        formatter: function(val) {
                            return Math.round(val);
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
                        const views = series[seriesIndex][dataPointIndex];
                        return `
                            <div class="px-3 py-2 text-end" style="direction: rtl;">
                                <div class="fw-bold mb-1">${item.full_date}</div>
                                <div>بازدید: <span class="badge bg-primary">${views}</span></div>
                            </div>
                        `;
                    }
                },
                grid: {
                    borderColor: '#e9ecef',
                    strokeDashArray: 4
                }
            };

            const chart = new ApexCharts(document.querySelector("#adminViewsChart"), options);
            chart.render();
        });
    </script>
@endpush
