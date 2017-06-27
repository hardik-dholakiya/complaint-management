<?php

namespace App\Http\Controllers;

use App\complaints;
use App\Repository\Interfaces\ResponseRepositoryInterface;
use App\Response;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    protected $responseRepositoryInterface;

    function __construct(ResponseRepositoryInterface $responseRepositoryInterface)
    {
        $this->responseRepositoryInterface = $responseRepositoryInterface;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['response_text' => 'required|max:255']);
        $response_data = $request->except('_token', 'comment_submit');
        $response_data['is_response'] = 1;
        $response_data['create_by'] = 1;

        $complain_data = complaints::with('user')->where('complaints_id', $response_data['complaint_id'])->first();

        $result = $this->responseRepositoryInterface->store($response_data);

        $user_email = $complain_data['user']->email;
        $email_data['subject'] = $complain_data->complaint_subject;
        $email_data['text'] = $complain_data->complaint_text;
        $email_data['response_text'] = $result->response_text;
        $mail_subject = 'Your Complaint Response';
        $mail = new MailController();
        if (!empty($result)) {
            $mail->sendMail($user_email, $mail_subject, $email_data, url('/') . '/home', 'email.response_notification_email');
            return redirect()->route('complaints-list')->withErrors(['message' => ' Response is successfully posted.']);
        } else {
            return redirect()->back()->withErrors(['message' => ' Response is Not post successfully.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeReply(Request $request)
    {
        $this->validate($request, ['response_text' => 'required|max:255']);
        $reply_data = $request->except('_token', 'reply_submit');
        $reply_data['is_response'] = 0;
        $reply_data['create_by'] = 0;
        $result = $this->responseRepositoryInterface->store($reply_data);
        if (!empty($result)) {
            return redirect()->route('home')->withErrors(['message' => ' Response is successfully posted.']);
        } else {
            return redirect()->back()->withErrors(['message' => ' Response is Not post successfully.']);
        }
    }
}
