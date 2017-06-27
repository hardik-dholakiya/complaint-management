<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/home', 'ComplaintsController@index')->name('home');
    Route::get('/create-complaint', function () {
        return view('complaint.create_complaint');
    })->name('create-complaint');
    Route::post('/store-complaint', 'ComplaintsController@store')->name('store-complaint');
    Route::post('/store-reply', 'ResponseController@storeReply')->name('store-reply');

    Route::get('/changePassword', function () {
        return view('auth.change_password');
    })->name('changePassword');
    Route::post('/updatePassword', 'UserController@changePassword')->name('updatePassword');

});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', 'AdminAuth\LoginController@showLoginForm');
    Route::post('/login', 'AdminAuth\LoginController@login');
    Route::post('/logout', 'AdminAuth\LoginController@logout');

    Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm');
    Route::post('/register', 'AdminAuth\RegisterController@register');

    Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset');
    Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm');
    Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');

    Route::middleware(['admin'])->group(function () {

        /*Complaint route*/
        Route::get('/', 'ComplaintsController@dashboard');

        Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

        Route::get('/add-complain', function () {
            return view('admin.add_complaint');
        })->name('add-complain');
        Route::post('/store-complaints', 'ComplaintsController@storeComplaint')->name('store-complaints');
        Route::get('/complaints-list', 'ComplaintsController@complaintsList')->name('complaints-list');
        /*End Complaint route*/

        /*Admin route*/
        Route::get('/admin-list', 'AdminController@index')->name('admin-list');
        Route::post('/search-list', 'AdminController@show')->name('search-admin');
        Route::get('/add-admin', 'AdminController@create')->name('add-admin');
        Route::post('/delete-admin', 'AdminController@destroy')->name('delete-admin');
        Route::post('/register-admin', 'AdminController@store')->name('register-admin');
        Route::post('/edit-admin', 'AdminController@update')->name('edit-admin');
        Route::get('/change-password', function () {
            return view('admin.change_password');
        })->name('change-password');
        Route::post('/update-password', 'AdminController@changePassword')->name('update-password');
        /*End Admin route */

        /*User route*/
        Route::get('/user-list', 'UserController@index')->name('user-list');
        Route::get('/add-user', 'UserController@create')->name('add-user');
        Route::post('/delete-user', 'UserController@destroy')->name('delete-user');
        Route::post('/register-user', 'UserController@store')->name('register-user');
        Route::post('/edit-user', 'UserController@update')->name('edit-user');
        Route::post('/search-user', 'UserController@show')->name('search-user');
        /*End User route*/

        Route::post('/store-response', 'ResponseController@store')->name('store-response');
    });
});

