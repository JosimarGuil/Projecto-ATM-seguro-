<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
class SendController extends Controller
{
    public function sendMessage($client,$atm)
    {
        $at= 
        $account_sid = env("TWILIO_ACCOUNT_SID");
        $auth_token = env("TWILIO_AUTH_TOKEN");
        $twilio_number = env("TWILIO_PHONE_NUMBER");
        $client = new Client($account_sid, $auth_token);
        $client->messages->create("+244940927292", 
                [   'from' => $twilio_number,
                    'body' => 'Aviso! tentaiva de invasão de conta'] 
                );
    }
}
