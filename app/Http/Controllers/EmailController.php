<?php

namespace App\Http\Controllers;

use App\Mail\SendingEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    //
    public function kirim()
    {
        $text = [
            'subject' => 'RS sehat'
        ];
        Mail::to('user@gmail.com')->send(new SendingEmail($text));
        // return new SendingEmail();
    }
}
