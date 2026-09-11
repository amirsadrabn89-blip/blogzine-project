<?php

namespace App\Listeners;

use App\Events\SmsConsentUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleSmsConsentUpdate
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
    public function handle(SmsConsentUpdated $event): void
    {
        //
    }
}
