<?php

namespace App\Listeners;

use App\Mail\NewsConsentMail;
use Illuminate\Support\Facades\Mail;
use App\Events\NewsConsentUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class HandleNewsConsentUpdate
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewsConsentUpdated $event): void
    {
        if (! $event->newsConsent) {
            return;
        }

        Mail::to($event->user->email)->send(new NewsConsentMail($event->user));
    }
}
