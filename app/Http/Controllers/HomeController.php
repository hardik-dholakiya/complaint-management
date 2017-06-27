<?php

namespace App\Http\Controllers;

use App\Admin;
use App\complaints;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function dashboard()
    {
        $total_complaint = complaints::count();
        $total_user = User::count();
        $total_admin = Admin::count();
        return view('admin.home')->with(['total_user' => $total_user, 'total_complaints' => $total_complaint,'total_admin' => $total_admin ]);
    }
}
