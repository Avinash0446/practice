<?php

namespace App\Listeners;

use App\Mail\WelcomeMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail
{
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        Log::info('SendWelcomeEmail listener triggered for: ' . $event->user->email);
        dd($event->user);
        Mail::to($event->user->email)->send(new WelcomeMail($event->user));
    }
}
