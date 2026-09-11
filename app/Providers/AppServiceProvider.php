<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\Article;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
    
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        View::composer('partials.main-header', function ($view) {
            $categories = Category::query()
                ->withCount('articles')
                ->get();

            $view->with('categories', $categories);
        });

        View::composer(['layouts.layout-dashboard' , 'pages.admin.dashboard'], function ($view) {
            $pendingContactMessagesCount = ContactMessage::query()
                ->where('status', 0)
                ->count();

            $view->with('pendingContactMessagesCount', $pendingContactMessagesCount);
        });

        View::composer('partials.main-footer', function ($view) {
        $latestArticles = Article::query()
            ->where('is_show', 1)
            ->with('category')
            ->latest()
            ->take(5)
            ->get();

        $popularCategories = Category::query()
            ->where('is_show', 1)
            ->withCount([
                'articles as articles_count' => function ($query) {
                    $query->where('is_show', 1);
                }
            ])
            ->orderByDesc('articles_count')
            ->take(6)
            ->get();

        $view->with(compact('latestArticles', 'popularCategories'));
    });

    }
}
