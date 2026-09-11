<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\RedirectResponse;

class ArticleReactionController extends Controller
{
    public function like(Article $article): RedirectResponse
    {
        $userId = auth()->id();

        $reaction = $article->reactions()
            ->where('user_id', $userId)
            ->first();

        if ($reaction && $reaction->type === 'like') {
            $reaction->delete();

            return back()->with('error', 'لایک شما حذف شد.');
        }

        $article->reactions()->updateOrCreate(
            ['user_id' => $userId],
            ['type' => 'like']
        );

        return back()->with('success', 'لایک شما ثبت شد.');
    }

    public function dislike(Article $article): RedirectResponse
    {
        $userId = auth()->id();

        $reaction = $article->reactions()
            ->where('user_id', $userId)
            ->first();

        if ($reaction && $reaction->type === 'dislike') {
            $reaction->delete();

            return back()->with('error', 'دیس‌لایک شما حذف شد.');
        }

        $article->reactions()->updateOrCreate(
            ['user_id' => $userId],
            ['type' => 'dislike']
        );

        return back()->with('success', 'دیس‌لایک شما ثبت شد.');
    }
}
