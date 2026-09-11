<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminArticleController extends Controller
{
    public function index(Request $request): View
    {
        $articles = Article::query()
            ->with('category')
            ->withCount([
                'reactions as likes_count'    => fn ($q) => $q->where('type', 'like'),
                'reactions as dislikes_count' => fn ($q) => $q->where('type', 'dislike'),
            ])
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('tags', 'like', "%{$search}%")
                        ->orWhereHas('category', fn ($c) => $c->where('title', 'like', "%{$search}%"));
                });
            })
            ->when($request->filled('category_id'), function ($query) use ($request) {
                $query->where('category_id', $request->category_id);
            })
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        $categories = Category::all();

        return view('pages.admin.articles_management.index', compact('articles', 'categories'));
    }

    public function toggleShow(Article $article)
    {
        $article->update([
            'is_show' => ! $article->is_show,
        ]);

        return back();
    }
}
