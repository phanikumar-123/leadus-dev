<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send_mail() {
        $otp = rand(1000, 9999);
        $data = array('otp'=> $otp);
        Cache::put($data, now()->addSeconds(20));
        Mail::send('mails.emailConfirm', $data, function ($message) {
            $message->to('ron.bhat0@gmail.com')->subject('Email Verification');
            //$message->from('noreply@leadus.in', 'LeadUs');
            echo "Mail Sent!!";
        });
    }
}
