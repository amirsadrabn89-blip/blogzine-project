<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminCommentController extends Controller
{
    public function index(Request $request): View
    {
        $comments = Comment::query()
            ->with(['article', 'user'])
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;

                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('body', 'like', "%{$search}%")
                        ->orWhereHas('category', function ($categoryQuery) use ($search) {
                            $categoryQuery->where('title', 'like', "%{$search}%");
                        });
                });
            })
            ->when($request->filled('article_id'), function ($query) use ($request) {
                $query->where('article_id', $request->article_id);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $articles = Article::select('id', 'title')->get();

        return view('pages.admin.comments_management.index', compact('comments', 'articles'));
    }

    public function toggleShow(Comment $comment)
    {
        $comment->update([
            'is_show' => ! $comment->is_show,
        ]);

        return back();
    }
}
