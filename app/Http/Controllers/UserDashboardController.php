<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleView;
use App\Models\Comment;
use App\Models\User;
use App\Models\ContactMessage;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserDashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        $articles = $user->articles()
            ->with('category')
            ->latest()
            ->get();

        $articlesCount = $articles->count();
        $totalViews = $articles->sum('views');
        $latestArticles = $articles->take(5);

        $startDate = now()->subDays(59)->startOfDay();
        $endDate   = now()->endOfDay();

        $viewsPerDay = ArticleView::query()
            ->whereHas('article', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as aggregate')
            ->groupBy('date')
            ->pluck('aggregate', 'date')
            ->toArray();

        $chartPoints = [];
        $totalTwoMonthsViews = 0;

        $cursor = $startDate->copy();
        while ($cursor <= $endDate) {
            $dateKey = $cursor->format('Y-m-d');
            $count   = (int) ($viewsPerDay[$dateKey] ?? 0);
            $totalTwoMonthsViews += $count;

            $v = new Verta($cursor);

            $chartPoints[] = [
                'day_key'    => $dateKey,
                'views'      => $count,
                'month_name' => $v->format('F'),
                'full_date'  => $v->format('Y/m/d'),
            ];

            $cursor->addDay();
        }

        $unreadCommentsCount = Comment::query()
            ->whereHas('article', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->where('is_show', true)
            ->whereNull('read_at')
            ->where(function ($query) use ($user) {
                $query->whereNull('user_id')->orWhere('user_id', '!=', $user->id);
            })
            ->count();

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

        return view('pages.user.dashboard', compact(
            'user',
            'articles',
            'articlesCount',
            'totalViews',
            'totalTwoMonthsViews',
            'latestArticles',
            'chartPoints',
            'unreadCommentsCount',
            'popularArticles'
        ));
    }

    public function myArticlesStats(): View
    {
        $user = Auth::user();

        $validCommentsFilter = function ($query) {
            $query->where('is_show', true)
                ->where(function ($q) {
                    $q->whereNull('parent_id')
                        ->orWhereExists(function ($sub) {
                            $sub->selectRaw(1)
                                ->from('comments as parent_comments')
                                ->whereColumn('parent_comments.id', 'comments.parent_id');
                        });
                });
        };

        $unreadCommentsQuery = function ($query) use ($user, $validCommentsFilter) {
            $validCommentsFilter($query);
            $query->whereNull('read_at')
                ->where(function ($q) use ($user) {
                    $q->whereNull('user_id')
                        ->orWhere('user_id', '!=', $user->id);
                });
        };

        $articles = $user->articles()
            ->with('category')
            ->withCount([
                'reactions as likes_count' => function ($query) {
                    $query->where('type', 'like');
                },
                'reactions as dislikes_count' => function ($query) {
                    $query->where('type', 'dislike');
                },
                'comments as total_comments_count' => $validCommentsFilter,
                'comments as unread_comments_count' => $unreadCommentsQuery,
            ])
            ->latest()
            ->get();

        return view('pages.user.partials.my-articles-stats', compact('articles'));
    }

    public function supportMessages(): View
    {
        $contactMessages = ContactMessage::query()
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('pages.user.dashboard-support-messages', compact('contactMessages')); 
    }

    public function getQuickProfile(User $user)
    {
        $currentUserId = auth()->id();

        if (! $user->showProfile) {
            return response()->json([
                'status' => 'private',
                'message' => 'این کاربر نمایش اطلاعات پروفایل خود را برای دیگران غیرفعال کرده است.',
                'name' => $user->name,
                'avatar' => $user->avatar_url,
            ]);
        }

        return response()->json([
            'status' => 'public',
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'avatar' => $user->avatar_url,
                'bio' => $user->bio ?: 'بیوگرافی ثبت نشده است.',
                'articles_count' => $user->articles()
                    ->where('is_show', true)
                    ->count(),
                'followers_count' => $user->followers()->count(),
                'can_follow' => $user->canBeFollowedBy($currentUserId),
                'is_following' => $user->isFollowedByCurrentUser(),

                'toggle_follow_url' => route(
                    'users.toggle-follow',
                    ['user' => $user]
                ),
            ],
        ]);
    }

    public function toggleFollow(User $user)
    {
        if (! auth()->check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'لطفاً ابتدا وارد حساب کاربری خود شوید.',
            ], 401);
        }

        $me = auth()->user();

        if ($me->id === $user->id) {
            return response()->json([
                'status' => 'error',
                'message' => 'نمی‌توانید خودتان را دنبال کنید.',
            ], 422);
        }

        $isFollowing = $me->followings()->where('following_id', $user->id)->exists();

        if ($isFollowing) {
            $me->followings()->detach($user->id);
            $following = false;
            $message = 'دنبال کردن لغو شد.';
        } else {
            $me->followings()->attach($user->id);
            $following = true;
            $message = 'کاربر دنبال شد.';
        }

        return response()->json([
            'status' => 'success',
            'message' => $message,
            'is_following' => $following,
            'followers_count' => $user->followers()->count(),
        ]);
    }


}
