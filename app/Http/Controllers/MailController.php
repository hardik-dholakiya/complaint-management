<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail($to, $subject, $data, $link=null,$template)
    {
        Mail::send($template, ['data'=>$data,'link'=>$link], function ($m) use ($data,$to,$subject) {
            $m->from('hardik20.email@gmail.com','Complaints Management System');
            $m->to($to)->subject($subject);
        });
    }
}
