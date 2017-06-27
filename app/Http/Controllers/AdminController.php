<?php

namespace App\Http\Controllers;

use App\Admin;
use App\complaints;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\updatePasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Notifications\ChangePasswordNotification;
use App\Notifications\userNotification;
use App\Repository\Interfaces\AdminRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    protected $adminRepositoryInterface;

    function __construct(AdminRepositoryInterface $adminRepositoryInterface)
    {
        $this->adminRepositoryInterface = $adminRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = $this->adminRepositoryInterface->getall();
        return view('admin.admin_list')->with(['user_list' => $result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.add_admin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddUserRequest $addUserRequest)
    {
        $user = $addUserRequest->except('_token');
        $user['active'] = 1;
        $user['password'] = bcrypt($user['password']);
        $user['new_password'] = $user['password'];
        $result = $this->adminRepositoryInterface->storeUser($user);
        if (!empty($result)) {
            return redirect()->route('admin-list')->withErrors(['message' => ' Admin is successfully create.']);
            $result->notify(new userNotification($result));
        } else {
            return redirect()->back()->withErrors(['message' => ' Admin is Not create successfully.']);
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
        $result = $this->adminRepositoryInterface->search($search);
        return view('admin.admin_list')->with(['user_list' => $result]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $update_user_data)
    {
        $data = $update_user_data->all();
        $result = $this->adminRepositoryInterface->updateData($data['id'], $data);
        if (!empty($result)) {
            return redirect()->route('admin-list')->withErrors(['message' => ' User is successfully updated.']);
        } else {
            return redirect()->back()->withErrors(['message' => ' User is Not update successfully.']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user_id = $request->except('_token');
        $result = $this->adminRepositoryInterface->delete($user_id);
        if (!empty($result)) {
            complaints::where('user_id', $user_id)->where('create_by', 1)->delete();
            return redirect()->route('admin-list')->withErrors(['message' => ' Admin is successfully delete.']);
        } else {
            return redirect()->back()->withErrors(['message' => ' Admin is Not delete successfully.']);
        }

    }

    public function changePassword(updatePasswordRequest $update_password)
    {
        $user = Auth::guard('admin')->user();
        $data = $update_password->except('_token');
        $old_password = $data['oldPassword'];
        $new_password = $data['newPassword'];
        $user['new_password'] = $new_password;
        $new_password = bcrypt($new_password);
        $email = Auth::guard('admin')->user()->email;
        $password = Auth::guard('admin')->user()->password;

        if (Hash::check($old_password, $password)) {
            $result = $this->adminRepositoryInterface->updatePassword($email, $new_password);
            $user->notify(new ChangePasswordNotification($user));
        } else
            $result = null;
        if ($result > 0) {
            return redirect()->route('dashboard')->withErrors(['message' => 'Your password is successfully change.']);
        } else {
            return redirect()->back()->withErrors(['message' => ' Enter valid old Password .']);
        }

    }
}
