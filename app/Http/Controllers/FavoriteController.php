<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = auth()->user()
            ->favoriteArticles()
            ->latest()
            ->paginate(9);

        return view('pages.user.favorites', compact('favorites'));
    }    

    public function toggle(Article $article)
    {
        $user = auth()->user();
        $result = $user->favoriteArticles()->toggle($article->id);
        $isFavorited = count($result['attached']) > 0;
        $message = $isFavorited ? 'خبر به علاقه‌مندی‌ها اضافه شد.' : 'خبر از علاقه‌مندی‌ها حذف شد.';

        // اگر درخواست AJAX باشد، جیسون برمی‌گرداند
        if (request()->expectsJson() || request()->ajax()) {
            return response()->json([
                'status' => 'success',
                'is_favorited' => $isFavorited,
                'message' => $message,
            ]);
        }

        // برای فرم‌های معمولی (مثل دکمه حذف)، صفحه را رفرش می‌کند
        return back()->with('success', $message);
    }
}