<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\ArticleView;
use App\Models\Comment;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ArticleController extends Controller
{ 

    public function index(Request $request): View
    {
        $isAdmin = auth()->check() && (bool) auth()->user()->is_admin;
        
        $articles = Article::query()
            ->with(['category', 'user'])
            ->withCount([
                'reactions as likes_count'    => fn ($q) => $q->where('type', 'like'),
                'reactions as dislikes_count' => fn ($q) => $q->where('type', 'dislike'),
            ])
            ->unless($isAdmin, function ($query) {
                $query->where('is_show', true)
                    ->whereHas('category', fn ($q) => $q->where('is_show', true));
            })
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = trim($request->input('search'));

                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('tags', 'like', "%{$search}%")
                        ->orWhereHas('category', function ($categoryQuery) use ($search) {
                            $categoryQuery->where('title', 'like', "%{$search}%");
                        })
                        ->orWhereHas('user', function ($userQuery) use ($search) {
                            $userQuery->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->when($request->filled('category_id'), function ($query) use ($request) {
                $query->where('category_id', $request->category_id);
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        if ($isAdmin) {
            $categories = Category::all();
        } else {
            $categories = Category::where('is_show', true)->get();
        }

        return view('pages.post-grid-masonry-filter', compact('articles', 'categories'));
    }

        public function loadMore(Request $request): JsonResponse
    {
        $isAdmin = auth()->check() && (bool) auth()->user()->is_admin;
        
        $articles = Article::query()
            ->with(['category', 'user'])
            ->withCount([
                'reactions as likes_count'    => fn ($q) => $q->where('type', 'like'),
                'reactions as dislikes_count' => fn ($q) => $q->where('type', 'dislike'),
            ])
            ->unless($isAdmin, function ($query) {
                $query->where('is_show', true)
                    ->whereHas('category', fn ($q) => $q->where('is_show', true));
            })
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = trim($request->input('search'));

                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('tags', 'like', "%{$search}%")
                        ->orWhereHas('category', function ($categoryQuery) use ($search) {
                            $categoryQuery->where('title', 'like', "%{$search}%");
                        })
                        ->orWhereHas('user', function ($userQuery) use ($search) {
                            $userQuery->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->when($request->filled('category_id'), function ($query) use ($request) {
                $query->where('category_id', $request->category_id);
            })
            ->latest()
            ->paginate(12);

        $html = view('partials.news-card', compact('articles'))->render();

        return response()->json([
            'html'      => $html,
            'has_more'  => $articles->hasMorePages(),
            'next_page' => $articles->currentPage() + 1,
        ]);
    }


    public function show(Article $article)
    {
        if (
            ! $article->is_show &&
            ! auth()->user()?->is_admin
        ) {
            return redirect()
                ->route('article_is_draft.page')
                ->with( 'error', 'این مقاله در حال حاضر برای نمایش در دسترس نیست.' );
        }

        $sessionKey = 'article_viewed_' . $article->id;

        if (! session()->has($sessionKey)) {
            DB::transaction(function () use ($article) {
                $article->increment('views');

                ArticleView::create([
                    'article_id' => $article->id,
                    'user_id'    => auth()->id(),
                    'ip_address' => request()->ip(),
                ]);
            });

            session()->put($sessionKey, true);
        }

        $article->load([
            'user',
            'comments' => function ($query) {
                $query
                    ->whereNull('parent_id')
                    ->where('is_show', true)
                    ->orderByDesc('created_at');
            },
            'comments.user',
            'comments.replies' => function ($query) {
                $query
                    ->where('is_show', true)
                    ->orderBy('created_at');
            },
            'comments.replies.user',
        ]);

        $article->loadCount([
            'reactions as likes_count' => function ($query) {
                $query->where('type', 'like');
            },
            'reactions as dislikes_count' => function ($query) {
                $query->where('type', 'dislike');
            },
        ]);

        $isDraftPreview = ! $article->is_show;

        if (auth()->check() && auth()->id() === $article->user_id) {
            Comment::query()
                ->where('article_id', $article->id)
                ->where('is_show', true)
                ->whereNull('read_at')
                ->where(function ($query) use ($article) {
                    $query
                        ->whereNull('user_id')
                        ->orWhere('user_id', '!=', $article->user_id);
                })
                ->update([
                    'read_at' => now(),
                ]);
        }

        $topCategories = Category::withCount(['articles' => function ($query) {
            $query->where('is_show', true);
        }])
            ->orderByDesc('articles_count')
            ->take(5)
            ->get();

        $nextArticle = Article::where('category_id', $article->category_id)
            ->where('id', '>', $article->id)
            ->where('is_show', true)
            ->orderBy('id')
            ->first();

        return view( 'pages.articles.show', compact('article', 'isDraftPreview' , 'topCategories' , 'nextArticle') );
    }

    public function create(): View
    {
        $categories = Category::where('is_show', true)
            ->orderBy('title')
            ->get();

        return view('pages.dashboard-post-create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'min:3', 'max:255'],
            'body'        => ['required', 'string'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'tags'        => ['nullable', 'array', 'max:6'],
            'tags.*'      => ['nullable', 'string', 'max:100'],
            'main_image'  => ['required', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:5120'],
        ], [
            'title.required'       => '● لطفاً این فیلد را تکمیل کنید!',
            'title.min'            => '● عنوان خبر باید حداقل ۳ کاراکتر باشد.',
            'title.max'            => '● عنوان خبر نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',
            'body.required'        => '● لطفاً متن خبر را تکمیل کنید!',
            'category_id.required' => '● لطفاً یک دسته‌بندی را انتخاب کنید!',
            'category_id.exists'   => '● دسته‌بندی انتخاب‌شده معتبر نیست.',
            'main_image.required'  => '● لطفاً یک عکس انتخاب کنید!',
            'main_image.image'     => '● فایل انتخاب‌شده باید تصویر باشد.',
            'main_image.mimes'     => '● فرمت تصویر باید jpg، jpeg، png، gif یا webp باشد.',
            'main_image.max'       => '● حجم تصویر نباید بیشتر از ۵ مگابایت باشد.',
        ]);

        DB::beginTransaction();

        try {
            $mainImagePath = null;

            if ($request->hasFile('main_image')) {
                $mainImagePath = $request->file('main_image')->store('article/main', 'public');
            }

            $body = $validated['body'];

            $plainText = trim(strip_tags($body));
            $wordCount = count(
                preg_split('/\s+/u', $plainText, -1, PREG_SPLIT_NO_EMPTY)
            );

            $readTime = max(1, (int) ceil($wordCount / 200));

            Article::create([
                'user_id'      => auth()->id(),
                'title'        => $validated['title'],
                'category_id'  => $validated['category_id'],
                'tags'         => $this->normalizeTags($validated['tags'] ?? []),
                'body'         => $body,
                'main_image'   => $mainImagePath,
                'is_show'      => false,
                'views'        => 0,
                'read_time'    => $readTime,
                'published_at' => null,
            ]);

            DB::commit();

            return redirect()
                ->route('user.dashboard.page')
                ->with('success', 'خبر با موفقیت ایجاد شد و در وضعیت پیش‌نویس قرار گرفت.');
        } catch (\Throwable $exception) {
            DB::rollBack();

            if (!empty($mainImagePath)) {
                Storage::disk('public')->delete($mainImagePath);
            }

            report($exception);

            return back()
                ->withInput()
                ->with('error', 'در ذخیره خبر خطایی رخ داد.');
        }
    }

    public function edit(Article $article)
    {

        abort_unless(
            $article->user_id === auth()->id(),
            403
        );

        $categories = Category::query()
            ->where(function ($query) use ($article) {
                $query
                    ->where('is_show', true)
                    ->orWhere('id', $article->category_id);
            })
            ->orderBy('title')
            ->get();

        return view('pages.dashboard-post-edit', compact( 'article', 'categories' ));
    }

    public function update(Request $request, Article $article)
    {

        abort_unless(
            $article->user_id === auth()->id(),
            403
        );

        $validated = $request->validate([

            'title'       => ['required','string','max:255',],
            'category_id' => ['required','exists:categories,id',],
            'tags'        => ['nullable', 'array', 'max:6'],
            'tags.*'      => ['nullable', 'string', 'max:100'],
            'body'        => ['required','string',],
        ],[
            'title.required'       => '● لطفا این فیلد را تکمیل کنید !',
            'title.min'            => '● عنوان خبر باید حداقل ۳ کاراکتر باشد.',
            'title.max'            => '● عنوان خبر نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',

            'body.required'        => '● لطفا متن خبر را تکمیل کنید !',

            'category_id.required' => '● لطفا یک دسته بندی را اننتخاب کنید !',
            'category_id.exists'   => '● دسته‌بندی انتخاب‌شده معتبر نیست.',

        ]);

        $article->update([

            'title'       => $validated['title'],
            'category_id' => $validated['category_id'],
            'tags'        => $this->normalizeTags($validated['tags'] ?? []),
            'body'        => $validated['body'],
            'is_show'     => false,
        ]);

        return redirect()
            ->route('user.my-articles.page')
            ->with('success', 'خبر با موفقیت ویرایش شد.');
    }


    private function normalizeTags(array $tags = []): ?array
    {
        $tags = collect($tags)
            ->map(fn ($tag) => trim((string) $tag))
            ->filter()
            ->unique()
            ->take(6)
            ->values()
            ->all();

        return empty($tags) ? null : $tags;
    }

    public function uploadImage(Request $request): JsonResponse
    {
        $request->validate([
            'image' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,gif,webp',
                'max:5120',
            ],
        ]);

        $path = $request
            ->file('image')
            ->store('article/gallery', 'public');

        return response()->json([
            'success' => true,
            'url' => asset('storage/' . $path),
            'path' => $path,
        ]);
    }

    public function destroy(Article $article)
    {
        abort_unless(
            $article->user_id === auth()->id(),
            403
        );

        if ($article->main_image) {
            Storage::disk('public')->delete($article->main_image);
        }

        $article->delete();

        return redirect()
            ->route('user.my-articles.page')
            ->with('success', 'خبر با موفقیت حذف شد.');
    }
    

    public function myArticles()
    {
        $articles = Article::query()
            ->where('user_id', auth()->id())
            ->with('category')
            ->latest()
            ->paginate(5);

        $totalArticles = $articles->count();
        $publishedArticles = $articles->where('is_show', true)->count();
        $pendingArticles = $articles->where('is_show', false)->count();
        $totalViews = $articles->sum('views');

        return view('pages.user.my-articles',
        compact(
            'articles',
            'totalArticles',
            'publishedArticles',   
            'pendingArticles',
            'totalViews'
        ));
    }
}
