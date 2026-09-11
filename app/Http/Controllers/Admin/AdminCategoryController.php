<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminCategoryController extends Controller
{
    
    public function index(): View
    {
        $categories = Category::withCount('articles')->get();

        return view('pages.admin.categories_management.index', compact('categories'));
    }

    public function toggleStatus(Category $category)
    {
        $category->update([
            'is_show' => !$category->is_show
        ]);

        return back()->with('success', 'وضعیت نمایش دسته‌بندی با موفقیت تغییر کرد.');
    }
        
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title'           => ['required', 'string', 'max:50'],
            'slug'            => ['required', 'string', 'max:50', 'unique:categories,slug'],
            'description'     => ['nullable', 'string', 'max:200'],
            'is_show'         => ['nullable', 'boolean'],
        ], [

            'title.required'  => '● وارد کردن عنوان دسته‌بندی الزامی است.',
            'title.max'       => '● عنوان دسته بندی باید حداکثر 50 کاراکتر باشد !',

            'slug.required'   => '● وارد کردن اسلاگ الزامی است.',
            'slug.unique'     => '● این اسلاگ قبلاً استفاده شده است.',

            'description.max' => '● توضیحات باید حداکثر 200 کاراکتر باشد !',
        ]);

        Category::create([
            'title'       => $validated['title'],
            'slug'        => $validated['slug'],
            'description' => $validated['description'] ?? null,
            'is_show'     => $request->boolean('is_show'),
        ]);

        return redirect()
        ->route('admin.categories.index')
        ->with('success', 'دسته‌بندی جدید با موفقیت ایجاد شد.');
    }
}
