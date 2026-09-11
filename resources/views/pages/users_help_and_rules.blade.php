@extends('layouts.layout-site')

@section('title')
    وبلاگ | راهنما و قوانین
@endsection

@section('site-content')
    <main class="py-5 bg-body-custom">
        <div class="container">

            <div class="text-center mb-5">

                <h1 class="news-section-title fw-bold mb-3">
                    راهنما و قوانین سایت
                </h1>

                <div class="border-bottom border-primary border-2 opacity-1 mx-auto" style="width: 150px;">
                </div>

                <p class="mt-3 mb-0">
                    لطفاً پیش از استفاده از امکانات سایت، قوانین و راهنمای زیر را مطالعه کنید.
                </p>
            </div>

            <div class="row g-4">

                <div class="col-lg-6">
                    <div class="h-100 p-4 p-md-5 rounded-4 bg-light border shadow-sm">
                        <span class="badge text-bg-primary mb-3 border">
                            قوانین عمومی
                        </span>

                        <h4 class="fw-bold mb-4">
                            استفاده مسئولانه از سایت
                        </h4>

                        <ul class="lh-lg mb-0 ps-3">
                            <li class="mb-2">
                                استفاده از سایت به‌معنای پذیرش قوانین و مقررات آن است.
                            </li>

                            <li class="mb-2">
                                کاربران موظف‌اند هنگام ثبت‌نام، اطلاعات صحیح و متعلق به خود وارد کنند.
                            </li>

                            <li class="mb-2">
                                حفظ امنیت حساب کاربری، رمز عبور و اطلاعات ورود بر عهده کاربر است.
                            </li>

                            <li class="mb-2">
                                انتشار مطالب توهین‌آمیز، تبلیغاتی، نامرتبط یا دارای محتوای نامناسب مجاز نیست.
                            </li>

                            <li>
                                مدیریت سایت می‌تواند در صورت تخلف، دیدگاه یا حساب کاربری را محدود یا مسدود کند.
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="h-100 p-4 p-md-5 rounded-4 bg-light border shadow-sm">
                        <span class="badge text-bg-success mb-3 border">
                            راهنمای اخبار
                        </span>

                        <h4 class="fw-bold mb-4">
                            مشاهده و دنبال‌کردن مطالب
                        </h4>

                        <ul class="lh-lg mb-0 ps-3">
                            <li class="mb-2">
                                برای مشاهده همه مطالب، از بخش «اخبار» یا دسته‌بندی‌های سایت استفاده کنید.
                            </li>

                            <li class="mb-2">
                                می‌توانید اخبار را براساس عنوان، متن یا دسته‌بندی جستجو و فیلتر کنید.
                            </li>

                            <li class="mb-2">
                                امکان لایک و دیسلایک خبرها فقط برای کاربران واردشده فعال است.
                            </li>

                            <li>
                                خبرهای پیش‌نویس یا غیرفعال برای کاربران عادی نمایش داده نمی‌شوند.
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="h-100 p-4 p-md-5 rounded-4 bg-light border shadow-sm">
                        <span class="badge text-bg-info mb-3 border">
                            قوانین دیدگاه‌ها
                        </span>

                        <h4 class="fw-bold mb-4">
                            ثبت دیدگاه زیر اخبار
                        </h4>

                        <ul class="lh-lg mb-0 ps-3">
                            <li class="mb-2">
                                ثبت دیدگاه فقط برای کاربران واردشده امکان‌پذیر است.
                            </li>

                            <li class="mb-2">
                                دیدگاه‌ها باید مرتبط با موضوع خبر و با لحن محترمانه نوشته شوند.
                            </li>

                            <li class="mb-2">
                                دیدگاه‌های دارای توهین، تبلیغات، لینک نامعتبر یا محتوای نامرتبط تأیید نخواهند شد.
                            </li>

                            <li>
                                پاسخ مدیریت، پس از ثبت، زیر دیدگاه شما نمایش داده می‌شود.
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="h-100 p-4 p-md-5 rounded-4 bg-light border shadow-sm">
                        <span class="badge text-bg-warning mb-3 border">
                            پیام‌های پشتیبانی
                        </span>

                        <h4 class="fw-bold mb-4">
                            ارتباط با پشتیبانی سایت
                        </h4>

                        <ul class="lh-lg mb-0 ps-3">
                            <li class="mb-2">
                                برای هر موضوع، یک پیام جداگانه از صفحه «ارتباط با ما» ارسال کنید.
                            </li>

                            <li class="mb-2">
                                عنوان پیام را واضح و کوتاه انتخاب کنید تا پیگیری آن آسان‌تر باشد.
                            </li>

                            <li class="mb-2">
                                پاسخ مدیریت در بخش «پیام‌های پشتیبانی» داشبورد شما نمایش داده خواهد شد.
                            </li>

                            <li>
                                از ارسال پیام‌های تکراری برای یک موضوع خودداری کنید.
                            </li>
                        </ul>
                    </div>
                </div>

            </div>

            <div class="row justify-content-center mt-5">
                <div class="col-lg-10">
                    <div class="rounded-4 bg-primary bg-opacity-10 border p-4 text-center">
                        <i class="bi bi-info-circle-fill text-primary fs-4"></i>

                        <p class="mb-0 mt-2 lh-lg">
                            هدف ما ایجاد محیطی مفید، محترمانه و قابل اعتماد برای مطالعه و تعامل کاربران است.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
