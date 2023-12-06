<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function post_login_user(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            Alert::error($validator->messages()->all());
            return back();
        }

        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (!Auth::attempt($data)) {
            Alert::toast('Email or Password is wrong', 'error');
            return back();
        }

        Alert::toast('Login Success', 'success');
        return back();
    }

    public function logout()
    {
        Auth::logout();
        Alert::toast('Success Logout', 'success');
        return back();
    }
}
