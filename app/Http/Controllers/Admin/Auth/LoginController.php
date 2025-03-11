<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return view('administator.auth.pages.login');
        }
        return back();
    }

    public function post_login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:rfc,dns',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            Alert::error($validator->messages()->all());
            return redirect()->route('auth.login.index');
        }

        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (!User::where('email', $data['email'])->where('role', 'admin')->first()) {
            Alert::toast('Tidak ada Akses', 'error');
            return back();
        }

        if (!Auth::attempt($data)) {
            Session::flash('error', 'Email or Password is wrong');
            Alert::toast('Email or Password is wrong', 'error');
            return redirect()->route('auth.login.index')->withInput();
        }

        return redirect()->route('product.index');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
