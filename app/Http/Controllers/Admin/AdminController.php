<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ContactMessage;
use App\Models\User;
use App\Models\ArticleView;
use GuzzleHttp\Psr7\Query;
use Hekmatinasser\Verta\Verta;

class AdminController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $articles = $user->articles()
            ->with('category')
            ->latest()
            ->get();

        $unansweredMessagesCount = ContactMessage::whereNull('replied_at')->count();
        $userCount = User::count();
        $articlesCount = Article::count();
        
        $totalViews = ArticleView::count();

        $startDate = now()->subDays(59)->startOfDay();
        $endDate = now()->endOfDay();

        $viewsPerDay = ArticleView::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as aggregate')
            ->groupBy('date')
            ->pluck('aggregate', 'date')
            ->toArray();

        $chartPoints = [];
        $totalTwoMonthsViews = 0;

        $cursor = $startDate->copy();
        while ($cursor <= $endDate) {
            $dateKey = $cursor->format('Y-m-d');
            $count = $viewsPerDay[$dateKey] ?? 0;
            $totalTwoMonthsViews += $count;

            $v = new Verta($cursor);

            $chartPoints[] = [
                'day_key'        => $dateKey,
                'views'          => $count,
                'month_name'     => $v->format('F'),
                'full_date'      => $v->format('Y/m/d'),
                'is_month_start' => ($v->day === 1),
            ];

            $cursor->addDay();
        }

        $browserLabels = ['Chrome', 'Firefox', 'Safari', 'Edge', 'سایر'];
        $browserSeries = [58, 22, 12, 5, 3];



        $admins = User::where('is_admin', true)->paginate(6);
        $adminsCount = User::where('is_admin', true)->count();


        return view('pages.admin.dashboard', compact(
            'user',
            'articles',
            'userCount',
            'articlesCount',
            'unansweredMessagesCount',
            'totalViews',
            'totalTwoMonthsViews',
            'chartPoints',
            'browserLabels',
            'browserSeries',
            'adminsCount',
            'admins'
        ));
    }
}
