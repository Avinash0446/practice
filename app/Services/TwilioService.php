<?php

namespace App\Services;

class TwilioService
{
    protected $twilio_token;
    protected $twilio_sid;
    protected $twilio_service_token;
    public function __construct()
    {
        $this->twilio_token = config('services.twilio.twilio_token');
        $this->twilio_sid= config('services.twilio.twilio_sid');
        $this->twilio_service_token = config('services.twilio.twilio_service');
    }
}
