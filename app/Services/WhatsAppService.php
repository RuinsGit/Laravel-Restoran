<?php

namespace App\Services;

use Twilio\Rest\Client;

class WhatsAppService
{
    protected $twilio;

    public function __construct()
    {
        $sid = config('services.twilio.sid');
        $token = config('services.twilio.token');
        $this->twilio = new Client($sid, $token);
    }

    public function sendMessage($message)
    {
        $this->twilio->messages->create("whatsapp:+123456789", [
            'from' => "whatsapp:+YOUR_TWILIO_NUMBER",
            'body' => $message,
        ]);
    }
}

