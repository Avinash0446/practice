<?php

namespace App\Listeners;

use App\Events\LoginEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

class SendLoginSms 
{
    use InteractsWithQueue;

    protected $twilio;
    protected $smsTemplate;

    public function __construct()
    {
        $sid = config('services.twilio.twilio_sid');
        $token = config('services.twilio.twilio_auth_token');
        $this->smsTemplate = config('services.twilio.twilio_sms_template', 'You have successfully logged in!');

        $this->twilio = new Client($sid, $token);
        Log::info(["sid" => $sid, 'token' => $token, 'twilio' => $this->smsTemplate]);
    }

    /**
     * Handle the event.
     */
    public function handle(LoginEvent $event): void
    {Log::info("SendLoginSms listener triggered", ['user_id' => $event->user->id]);
        if (!$event->user) {
            Log::warning('User has no phone number, skipping SMS.');
            return; // Skip if no phone
        }

        $to ='+917717248838'; // e.g., '+917717248838'
        $message = "Hello {$event->user->name}, you have successfully logged in!";

        try {
            $this->twilio->messages->create($to, [
                'from' => config('services.twilio.twilio_from'), 
                'body' => $message,
            ]);

            Log::info("Login SMS sent to user", ['user_id' => $event->user->id, 'to' => $to]);
        } catch (\Exception $e) {
            Log::error("Failed to send SMS", ['error' => $e->getMessage()]);
        }
    }
}