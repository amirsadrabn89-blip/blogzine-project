<?php

Route::get('/test-route', function () {
    dd('Laravel is working!') ;
});

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleReactionController;
use App\Http\Controllers\UserDashboardController;

// Admin Controllers
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminCommentController;
use App\Http\Controllers\Admin\AdminArticleController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminContactMessageController;

// Auth Controllers
use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Auth\RegisterController as AuthRegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController as AuthForgotPasswordController;

/*
|--------------------------------------------------------------------------
| 1. Public Pages Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('index.page');

Route::view('/offline'             , 'pages.offline')             ->name('offline.page');
Route::view('/about_us'            , 'pages.about_us')            ->name('about_us.page');
Route::view('/contact_us'          , 'pages.contact_us')          ->name('contact_us.page');
Route::view('/article_is_draft'    , 'pages.article_is_draft')    ->name('article_is_draft.page');
Route::view('/users_help-and-rules', 'pages.users_help_and_rules')->name('users_help-and-rules.page');

// Public Article Viewing & Browsing
Route::get('/post-grid-masonry-filter', [ArticleController::class, 'index'])   ->name('post-grid-masonry-filter.page');
Route::get('/articles-load-more'      , [ArticleController::class, 'loadMore'])->name('articles.loadMore');
Route::get('/article/{article}'       , [ArticleController::class, 'show'])    ->name('articles.show');

// Public Writer Profile
Route::get('/users/{user}/quick-profile', [UserDashboardController::class, 'getQuickProfile'])->name('users.quick-profile');


/*
|--------------------------------------------------------------------------
| 2. Auth & Guest Forms Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login' , [AuthLoginController::class, 'index'])    ->name('login');
    Route::post('/login', [AuthLoginController::class, 'checkAuth'])->name('login.check');

    // Register
    Route::get('/register' , [AuthRegisterController::class, 'create'])->name('register');
    Route::post('/register', [AuthRegisterController::class, 'store']) ->name('register.check');

    // Password Reset (OTP-based)
    Route::get('/forgot-password' , [AuthForgotPasswordController::class, 'showPhoneForm'])->name('password.request');
    Route::post('/forgot-password', [AuthForgotPasswordController::class, 'sendOtp'])      ->name('password.email');
    Route::get('/verify-otp'      , [AuthForgotPasswordController::class, 'showOtpForm'])  ->name('password.verify-otp');
    Route::post('/verify-otp'     , [AuthForgotPasswordController::class, 'verifyOtp'])    ->name('password.check-otp');
    Route::get('/reset-password'  , [AuthForgotPasswordController::class, 'showResetForm'])->name('password.reset-form');
    Route::post('/reset-password' , [AuthForgotPasswordController::class, 'resetPassword'])->name('password.update');
});

// Logout (Authenticated Only)
Route::post('/logout', [AuthLoginController::class, 'logout'])->middleware('auth')->name('logout');


/*
|--------------------------------------------------------------------------
| 3. Common Authenticated Routes (Admin & Users)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'banned'])->group(function () {
    // Interactions (Like, Dislike, Comment, Follow)
    Route::post('/articles/{article}/like'    , [ArticleReactionController::class, 'like'])      ->name('articles.like');
    Route::post('/articles/{article}/dislike' , [ArticleReactionController::class, 'dislike'])   ->name('articles.dislike');
    Route::post('/articles/{article}/comments', [CommentController::class, 'store'])             ->name('comments.store');
    Route::post('/users/{user}/toggle-follow' , [UserDashboardController::class, 'toggleFollow'])->name('users.toggle-follow');

    // Favorites
    Route::post('/articles/{article}/favorite', [FavoriteController::class, 'toggle'])->name('articles.favorite.toggle');
    Route::get('/favorites'                   , [FavoriteController::class, 'index']) ->name('favorites.index');

    // Contact Form Submission
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

    // Profile Settings
    Route::get('/dashboard-edit-profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/update-account'        , [ProfileController::class, 'updateAccount']) ->name('profile.update.account');
    Route::put('/update-socials'        , [ProfileController::class, 'updateSocials']) ->name('profile.update.socials');
    Route::put('/update-settings'       , [ProfileController::class, 'updateSettings'])->name('profile.update.settings');
    Route::put('/update-password'       , [ProfileController::class, 'updatePassword'])->name('profile.update.password');
});


/*
|--------------------------------------------------------------------------
| 4. User Workspace Routes (Regular Writers/Users Only)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'user', 'banned'])->group(function () {
    // User Dashboard
    Route::get('/user/dashboard'                  , [UserDashboardController::class, 'index'])          ->name('user.dashboard.page');
    Route::get('/dashboard-support-messages'      , [UserDashboardController::class, 'supportMessages'])->name('user.support-messages.page');
    Route::get('/user/dashboard/my-articles-stats', [UserDashboardController::class, 'myArticlesStats'])->name('user.dashboard.my-articles-stats');

    // User Articles Management (List)
    Route::get('/my-articles', [ArticleController::class, 'myArticles'])->name('user.my-articles.page');

    // Create Article
    Route::get('/dashboard-post-create' , [ArticleController::class, 'create'])->name('dashboard-post-create.page');
    Route::post('/dashboard-post-create', [ArticleController::class, 'store']) ->name('dashboard-post-create.store');

    // Edit & Update Article
    Route::get('/dashboard-post-edit/{article}', [ArticleController::class, 'edit'])  ->name('dashboard-post-edit.page');
    Route::put('/dashboard-post-edit/{article}', [ArticleController::class, 'update'])->name('dashboard-post-edit.update');

    // Delete Article
    Route::delete('/dashboard/articles/{article}', [ArticleController::class, 'destroy'])->name('dashboard-post-delete.page');

    // Quill Image Upload
    Route::post('/dashboard-post-create/upload-image', [ArticleController::class, 'uploadImage'])->name('articles.upload-image');
});


/*
|--------------------------------------------------------------------------
| 5. Admin Panel Routes (Admins Only)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin', 'banned'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard & Rules
    Route::get('/dashboard'      , [AdminController::class, 'index'])->name('dashboard.page');
    Route::view('/help-and-rules', 'pages.admin.help_and_rules')     ->name('help-and-rules.page');

    // User Management
    Route::get('/users_management'                     , [AdminUserController::class, 'index'])     ->name('users.index');
    Route::patch('/users_management/{user}/toggle-role', [AdminUserController::class, 'toggleRole'])->name('users.toggleRole');
    Route::patch('/users_management/{user}/toggle-ban' , [AdminUserController::class, 'toggleBan']) ->name('users.toggleBan');
    Route::delete('/users_management/{user}'           , [AdminUserController::class, 'destroy'])   ->name('users.destroy');

    // Comment Management
    Route::get('/comments_management'                        , [AdminCommentController::class, 'index'])     ->name('comments.index');
    Route::patch('/comments_management/{comment}/toggle-show', [AdminCommentController::class, 'toggleShow'])->name('toggle-show');

    // Article Management
    Route::get('/articles_management'                        , [AdminArticleController::class, 'index'])     ->name('articles.index');
    Route::patch('/articles_management/{article}/toggle-show', [AdminArticleController::class, 'toggleShow'])->name('articles.toggle-show');

    // Category Management
    Route::resource('categories'                       , AdminCategoryController::class);
    Route::patch('/categories/{category}/toggle-status', [AdminCategoryController::class, 'toggleStatus'])->name('categories.toggle-status');

    // Contact Messages Management
    Route::get('/contact-messages-management'                         , [AdminContactMessageController::class, 'index'])    ->name('contact-messages.index');
    Route::patch('/contact-messages-management/{contactMessage}/reply', [AdminContactMessageController::class, 'saveReply'])->name('contact-messages.save-reply');
});
