<?php

namespace App\Http\Controllers;

use App\complaints;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\updatePasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Notifications\ChangePasswordNotification;
use App\Notifications\userNotification;
use App\Repository\Interfaces\ComplaintRepositoryInterface;
use App\Repository\Interfaces\UserRepositoryInterface;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $userRepositoryInterface;
    protected $complaintRepositoryInterface;

    function __construct(UserRepositoryInterface $userRepositoryInterface, ComplaintRepositoryInterface $complaintRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
        $this->complaintRepositoryInterface = $complaintRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $user = $this->userRepositoryInterface->getall();
        return view('admin.user_list')->with(['user_list' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.add_user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\AddUserRequest $addUserRequest
     * @return \Illuminate\Http\Response
     */
    public function store(AddUserRequest $addUserRequest)
    {
        $user = $addUserRequest->except('_token', 'password_confirmation');
        $user['active'] = 1;
        $user['password'] = bcrypt($user['password']);
        $user['new_password'] = $user['password'];
        $result = $this->userRepositoryInterface->storeUser($user);
        if (!empty($result)) {
            $result->notify(new userNotification($result));
            return redirect()->route('user-list')->withErrors(['message' => ' User is successfully create.']);
        } else {
            return redirect()->back()->withErrors(['message' => ' User is Not create successfully.']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $this->validate($request, [
            'search' => 'required|max:255'
        ]);
        $search = $request->input('search');
        $result = $this->userRepositoryInterface->search($search);
        return view('admin.user_list')->with(['user_list' => $result]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $updateUserRequest)
    {
        $data = $updateUserRequest->all();
        $result = $this->userRepositoryInterface->updateData($data['id'], $data);
        if (!empty($result)) {
            return redirect()->route('user-list')->withErrors(['message' => ' User is successfully updated.']);
        } else {
            return redirect()->back()->withErrors(['message' => ' User is Not update successfully.']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user_id = $request->except('_token');
        $result = $this->userRepositoryInterface->delete($user_id);
        if (!empty($result)) {
            $complaint_result = $this->complaintRepositoryInterface->deleteByUserId($user_id);
            if (!empty($complaint_result)) {
                return redirect()->route('user-list')->withErrors(['message' => ' User is successfully delete.']);
            }
        } else {
            return redirect()->back()->withErrors(['message' => ' User is Not delete successfully.']);
        }
    }

    public function changePassword(updatePasswordRequest $update_password)
    {
        $user = Auth::user();
        $data = $update_password->except('_token');
        $old_password = $data['oldPassword'];
        $new_password = $data['newPassword'];
        $user['new_password'] = $new_password;
        $new_password = bcrypt($new_password);
        $email = Auth::user()->email;
        $password = Auth::user()->password;
        if (Hash::check($old_password, $password)) {
            $user->notify(new ChangePasswordNotification($user));
            $result = $this->userRepositoryInterface->updatePassword($email, $new_password);
        } else
            $result = null;
        if ($result > 0) {
            return redirect()->route('home')->withErrors(['message' => 'Your password is successfully change.']);
        } else {
            return redirect()->back()->withErrors(['message' => ' Enter valid old Password .']);
        }
    }
}
