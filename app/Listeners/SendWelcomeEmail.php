<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Mail\WelcomeMail;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail
{
    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        // For debugging (use log, not dd)
        Log::info('SendWelcomeEmail triggered for: ' . $event->user->email);
        try{
            Mail::to($event->user->email)->send(new WelcomeMail($event->user));
        }catch(Exception $e){
            Log::info("this is the exception",['exception' => $e->getMessage()]);
        }
    }
}