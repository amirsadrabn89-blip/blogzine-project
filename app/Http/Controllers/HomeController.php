<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {

        // Technology Category
        $technologyCategory = Category::query()
            ->where('slug', 'technology')
            ->firstOrFail();

        // Technology Articles
        $technologyArticles = Article::query()
            ->where('is_show', 1)
            ->where('category_id', $technologyCategory->id)
            ->latest()
            ->take(10)
            ->get();

        // Sport Category
        $sportCategory = Category::query()
            ->where('slug', 'sport')
            ->firstOrFail();

        // Sport Articles
        $sportArticles = Article::query()
            ->where('is_show', 1)
            ->where('category_id', $sportCategory->id)
            ->latest()
            ->take(10)
            ->get();

        // 5 newest & published news
        $latestArticles = Article::query()
            ->where('is_show', 1)
            ->with('category')
            ->latest()
            ->take(5)
            ->get();

        // active categories with most published news
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

        // 10 news with most views
        $popularArticles = Article::query()
            ->where('is_show', 1)
            ->with('category')
            ->withCount([
                'reactions as likes_count' => function ($query) {
                    $query->where('type', 'like');
                }
            ])
            ->orderByDesc('likes_count')
            ->take(4)
            ->get();

        $editorSelectedArticles = Article::query()
            ->where('is_show', 1)
            ->with(['category', 'user'])
            ->withCount([
                'reactions as likes_count' => function ($query) {
                    $query->where('type', 'like');
                }
            ])
            ->orderByDesc('likes_count')
            ->latest()
            ->take(10)
            ->get();

        return view('pages.index', compact(
            'latestArticles',
            'popularCategories',
            'popularArticles',
            'technologyArticles',
            'sportArticles',
            'technologyCategory',
            'technologyArticles',
            'sportCategory',
            'sportArticles',
            'editorSelectedArticles'
        ));
    }
}
