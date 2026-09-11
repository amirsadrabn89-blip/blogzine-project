# 🚀 Amirsadra Dev | Personal Portfolio & Blog

> وبلاگ تخصصی و پورتفولیوی پروژه‌های توسعه وب، پیاده‌سازی شده با **Laravel 13** و معماری ماژولار.
>
> 🌐 **دامنه:** [amirsadra-dev.ir](https://amirsadra-dev.ir)

---

## 🛠 Tech Stack & Technologies

![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.3+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-ES6+-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)

---

## ✨ Features & Modules | امکانات و ماژول‌ها

- **سیستم مدیریت محتوا (CMS/Blog):**
  - ایجاد، ویرایش و دسته‌بندی مقالات با ادیتور غنی Quill.
  - فیلترینگ ایجکس و گرید Masonry برای دسترسی سریع به مطالب.
  - سیستم دیدگاه‌ها با تاییدیه ادمین و پاسخ‌دهی چندسطحی.
- **داشبورد مدیریت و آمار:**
  - نمودارهای تحلیلی و بازدیدها با ApexCharts.
  - مدیریت پیام‌های کاربران (`contact_messages`) و ثبت نظرات.
- **احراز هویت و امنیت:**
  - مدیریت کاربران، سطوح دسترسی و پروفایل کاربری.
  - اعتبارسنجی دقیق فرم‌ها و امنیت در برابر حملات متداول وب.
- **بهینه‌سازی و فرانت‌اند:**
  - ریسپانسیو کامل با Bootstrap 5.
  - تقویم و تاریخ‌های شمسی با پکیج Verta.
  - سیستم پیامک کاوه‌نگار (Kavenegar SMS).

---

## 📁 Projects Showcase | ویترین پروژه‌ها

| پروژه | تکنولوژی‌ها | توضیحات | لینک |
| :--- | :--- | :--- | :--- |
| **وبلاگ و سامانه مقالات** | Laravel 13, Blade, MySQL | پنل مدیریت، تگ‌گذاری، سیستم کامنت و آمار | [مشاهده](#) |
| *پروژه بعدی* | *—* | *به‌زودی اضافه می‌شود...* | *—* |

---

## 🚀 Installation & Local Setup | راه‌اندازی محلی
```bash
# کلون کردن مخزن
git clone https://github.com/amirsadrabn89-blip/amirsadra-dev.git
cd amirsadra-dev

# نصب وابستگی‌های بک‌اند و فرانت‌اند
composer install
npm install

# تنظیم فایل محیطی و کلید برنامه
cp .env.example .env
php artisan key:generate

# اجرای مایگریشن‌ها
php artisan migrate

# ساخت استایل‌ها و اجرای سرور لوکال
npm run build
php artisan serve
