<?php


namespace App\Services\Admin;


use App\Mail\UserInviteMail;
use App\Model\SentMail;
use Illuminate\Support\Facades\Mail;

class MailServices
{
    public function organizationUserMail($request)
    {
//        $this->validate($request,[
//           'account_name' => 'required',
//            'email' => 'required|email',
//        ]);

        $mail = new SentMail();
        $mail->account_id = $request->account_id;
        $mail->email = $request->email;
        $mail->save();
        Mail::to($mail->email)->send(new UserInviteMail($mail));
    }
}
