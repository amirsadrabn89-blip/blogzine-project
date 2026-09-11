@extends('layouts.layout-dashboard')

@section('title')
    وبلاگ | راهنمای مدیر
@endsection

@section('dashboard-content')
    <main class="py-4 bg-body-custom">
        <div class="container">

            <div class="mb-4">
                <h2 class="fw-bold">
                    راهنما و قوانین مدیریت سایت
                </h2>

                <hr>

                <p class="mb-0">
                    نکات مهم برای مدیریت اخبار، کاربران، دیدگاه‌ها، دسته‌بندی‌ها و پیام‌های پشتیبانی.
                </p>
            </div>

            <div class="row g-4">

                <div class="col-lg-6">
                    <div class="h-100 rounded-4 bg-light border shadow-sm p-4">
                        <span class="badge text-bg-primary mb-3 border">
                            مدیریت اخبار
                        </span>

                        <h5 class="fw-bold mb-3">
                            ثبت و انتشار محتوا
                        </h5>

                        <ul class="lh-lg mb-0 ps-3">
                            <li class="mb-2">
                                پیش از انتشار، عنوان، متن، دسته‌بندی و تصویر خبر را بررسی کنید.
                            </li>

                            <li class="mb-2">
                                از عنوان‌های واضح، کوتاه و مرتبط با محتوای خبر استفاده کنید.
                            </li>

                            <li class="mb-2">
                                خبرهای ناقص را به‌صورت پیش‌نویس نگه دارید تا برای کاربران نمایش داده نشوند.
                            </li>

                            <li>
                                هنگام ویرایش خبر منتشرشده، از تغییرات ناخواسته در محتوا یا دسته‌بندی جلوگیری کنید.
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="h-100 rounded-4 bg-light border shadow-sm p-4">
                        <span class="badge text-bg-success mb-3 border">
                            مدیریت دسته‌بندی‌ها
                        </span>

                        <h5 class="fw-bold mb-3">
                            ساختاردهی اخبار
                        </h5>

                        <ul class="lh-lg mb-0 ps-3">
                            <li class="mb-2">
                                برای دسته‌بندی‌ها نام‌های کوتاه، مشخص و غیرتکراری انتخاب کنید.
                            </li>

                            <li class="mb-2">
                                پیش از حذف دسته‌بندی، بررسی کنید خبری به آن وابسته نباشد.
                            </li>

                            <li class="mb-2">
                                غیرفعال‌کردن دسته‌بندی باعث می‌شود کاربران عادی آن را در بخش‌های عمومی نبینند.
                            </li>

                            <li>
                                از ساخت دسته‌بندی‌های بسیار مشابه یا پراکنده خودداری کنید.
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="h-100 rounded-4 bg-light border shadow-sm p-4">
                        <span class="badge text-bg-info mb-3 border">
                            مدیریت دیدگاه‌ها
                        </span>

                        <h5 class="fw-bold mb-3">
                            بررسی و پاسخ به کاربران
                        </h5>

                        <ul class="lh-lg mb-0 ps-3">
                            <li class="mb-2">
                                فقط دیدگاه‌های مرتبط، محترمانه و مناسب را تأیید کنید.
                            </li>

                            <li class="mb-2">
                                دیدگاه‌های توهین‌آمیز، تبلیغاتی یا نامرتبط را نمایش ندهید.
                            </li>

                            <li class="mb-2">
                                در پاسخ‌ها لحن محترمانه، دقیق و کوتاه را رعایت کنید.
                            </li>

                            <li>
                                پاسخ مدیر زیر دیدگاه کاربر نمایش داده می‌شود؛ بنابراین پیش از ثبت، متن را بررسی کنید.
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="h-100 rounded-4 bg-light border shadow-sm p-4">
                        <span class="badge text-bg-danger mb-3 border">
                            مدیریت کاربران
                        </span>

                        <h5 class="fw-bold mb-3">
                            دسترسی‌ها و امنیت حساب‌ها
                        </h5>

                        <ul class="lh-lg mb-0 ps-3">
                            <li class="mb-2">
                                نقش مدیر را فقط به افراد مورد اعتماد بدهید.
                            </li>

                            <li class="mb-2">
                                قبل از مسدودکردن کاربر، دلیل و سابقه فعالیت او را بررسی کنید.
                            </li>

                            <li class="mb-2">
                                حذف حساب کاربر را فقط در موارد ضروری انجام دهید؛ زیرا ممکن است اطلاعات وابسته داشته باشد.
                            </li>

                            <li>
                                اطلاعات کاربران، شامل ایمیل و شماره تماس، محرمانه است و نباید منتشر شود.
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="h-100 rounded-4 bg-light border shadow-sm p-4">
                        <span class="badge text-bg-warning mb-3 border">
                            پیام‌های پشتیبانی
                        </span>

                        <h5 class="fw-bold mb-3">
                            پاسخ‌گویی به پیام‌ها
                        </h5>

                        <ul class="lh-lg mb-0 ps-3">
                            <li class="mb-2">
                                پیام‌های در انتظار پاسخ را به‌صورت منظم بررسی کنید.
                            </li>

                            <li class="mb-2">
                                پاسخ را روشن، دقیق و مرتبط با موضوع پیام کاربر بنویسید.
                            </li>

                            <li class="mb-2">
                                پس از ارسال پاسخ، وضعیت پیام به «پاسخ داده شده» تغییر می‌کند و کاربر آن را در داشبورد خود می‌بیند.
                            </li>

                            <li>
                                هنگام ویرایش پاسخ قبلی، توجه کنید تغییر جدید بلافاصله برای کاربر نمایش داده می‌شود.
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="h-100 rounded-4 bg-primary bg-opacity-10 border p-4">
                        <span class="badge text-bg-secondary mb-3 border">
                            نکات مهم مدیریتی
                        </span>

                        <h5 class="fw-bold mb-3">
                            مسئولیت مدیریت سایت
                        </h5>

                        <ul class="lh-lg mb-0 ps-3">
                            <li class="mb-2">
                                پیش از هر حذف یا تغییر مهم، از درست‌بودن عملیات مطمئن شوید.
                            </li>

                            <li class="mb-2">
                                عملیات مدیریتی باید با هدف حفظ کیفیت، نظم و امنیت سایت انجام شود.
                            </li>

                            <li class="mb-2">
                                از اطلاعات پنل مدیریت و حساب مدیر در اختیار دیگران قرار ندهید.
                            </li>

                            <li>
                                در صورت مشاهده خطا یا رفتار غیرعادی، ابتدا از انجام تغییرات بیشتر خودداری کنید.
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection
