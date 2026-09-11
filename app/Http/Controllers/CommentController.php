<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function store(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title'     => ['nullable', 'string', 'max:200'],
            'body'      => ['required', 'string', 'max:2000'],
            'parent_id' => ['nullable', 'exists:comments,id'],
        ],[
            'title.string'  => '● مقدار ورودی صحیح نمی باشد !',
            'title.max'     => '● حداکثر 200 کاراکتر مجاز می باشد !',

            'body.required' => '● لطفا این فیلد را تکمیل کنید !',
            'body.string'   => '● مقدار ورودی صحیح نمی باشد !',
            'body.max'      => '● حداکثر 2000 کاراکتر مجاز می باشد !',

        ]);

        $comment = Comment::create([
            'article_id' => $article->id,
            'user_id'    => Auth::id(),
            'parent_id'  => $validated['parent_id'] ?? null,
            'title'      => $validated['title'] ?? null,
            'body'       => $validated['body'],
            'is_show'    => 0,
        ]);

        $message = $comment->parent_id 
            ? 'پاسخ شما با موفقیت ثبت شد و پس از تایید مدیریت نمایش داده می‌شود.'
            : 'نظر شما با موفقیت ثبت شد و پس از تایید مدیریت نمایش داده می‌شود.';

        return back()->with('success', $message);
    }
}
