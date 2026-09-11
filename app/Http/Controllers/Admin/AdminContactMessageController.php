<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class AdminContactMessageController extends Controller
{
    public function index()
    {
        $contactMessages = ContactMessage::query()
            ->with('user')
            ->orderBy('status', 'asc')
            ->latest('id')
            ->paginate(10);

        return view('pages.admin.contact_messages_management.index', compact('contactMessages'));
    }

    public function saveReply(Request $request, ContactMessage $contactMessage)
    {
        $validated = $request->validate([
            'admin_reply' => ['required', 'string', 'min:5', 'max:5000'],
        ], [
            'admin_reply.required' => '● لطفاً متن پاسخ را وارد کنید.',
            'admin_reply.min' => '● متن پاسخ باید حداقل ۵ کاراکتر باشد.',
            'admin_reply.max' => '● متن پاسخ نمی‌تواند بیشتر از ۵۰۰۰ کاراکتر باشد.',
        ]);

        $contactMessage->update([
            'admin_reply' => $validated['admin_reply'],
            'status' => 1,
            'replied_at' => now(),
        ]);

        return back()->with('success', 'پاسخ پشتیبانی با موفقیت ثبت و برای کاربر قابل مشاهده شد.');
    }
}
