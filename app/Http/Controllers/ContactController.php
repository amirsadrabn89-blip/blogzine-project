<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => ['required', 'string', 'max:40'],
            'message' => ['required', 'string', 'min:10'],
        ], [

            'subject.required'               => '● لطفا این فیلد را تکمیل کنید!',
            'subject.max'                    => '● عنوان پیام باید حداکثر 40 کاراکتر باشد!',

            'message.required'               => '● لطفا این فیلد را تکمیل کنید!',
            'message.min'                    => '● متن پیام باید حداقل 10 کاراکتر باشد!',

        ]);

        $validated['user_id'] = auth()->id();
        $validated['status'] = 0;
        $validated['name'] = auth()->user()?->name;
        $validated['email'] = auth()->user()?->email;

        ContactMessage::create($validated);

        return back()->with('success', 'پیام شما با موفقیت ارسال شد.');
    }
}
