<?php

namespace App\Http\Controllers;

use App\Admin;
use App\complaints;
use App\Http\Requests\AddComplaint;
use App\Notifications\ComplaintNotification;
use App\Repository\Interfaces\ComplaintRepositoryInterface;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintsController extends Controller
{
    protected $complaints;
    protected $complaint_interface;
    function __construct(complaints $complaints ,ComplaintRepositoryInterface $complaint_interface)
    {
        $this->complaints = $complaints;
        $this->complaint_interface=$complaint_interface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $complaint_list = $this->complaint_interface->getByUser($user_id);
        return view('complaint.complaint_list')->with(['complaint_list' => $complaint_list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function complaintsList()
    {
        $complaint_list = $this->complaint_interface->getall();
        return view('admin.complaint_list')->with(['complaint_list' => $complaint_list]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddComplaint $complain_request)
    {
        $data = $complain_request->except('_token');
        $data['user_id'] = Auth::user()->id;
        $data['create_by'] = 0;
        $result = $this->complaint_interface->store($data);

        $admin=Admin::all();
        $i=1;
        $email_id[0]=Auth::user()->email;
        foreach ($admin as $key=>$admin_detail)
        {
            $email_id[$i]=$admin_detail->email;
            $i++;
        }
        $subject = 'Post new Complain';
        $mail = new MailController();
        $link=url('/')."/home";
        $mail->sendMail($email_id, $subject, $result, $link,'email.create_complaint_notification_email');
        if (!empty($result)) {
            return redirect()->route('home')->withErrors(['message' => ' Complaint is successfully create.']);
        } else {
            return redirect()->back()->withErrors(['message' => ' Complaint is Not create successfully.']);
        }
    }

    public function storeComplaint(Request $request)
    {
        $data = $request->except('_token');
        $data['user_id'] = Auth::guard('admin')->user()->id;
        $data['create_by'] = 1;
        $result = $this->complaint_interface->store($data);
        if (!empty($result)) {
            return redirect()->route('complaints-list')->withErrors(['message' => ' Complaint is successfully create.']);
        } else {
            return redirect()->back()->withErrors(['message' => ' Complaint is Not create successfully.']);
        }
    }

}
