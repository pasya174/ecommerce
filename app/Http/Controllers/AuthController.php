<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function post_login_user(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:rfc,dns',
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

        $user = Auth::user();
        $last_point_date = $user->last_point_date;
        $current_date = now()->toDateString();

        if ($last_point_date != $current_date) {
            $newPoint = $user->points += 5;
            $totalPoint = $user->total_points += 5;
            $user->update([
                'points' => $newPoint,
                'total_points' => $totalPoint,
                'last_point_date' => $current_date
            ]);
        }

        Alert::toast('Login Success', 'success');
        return back();
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all());
            return back()->withInput();
        }

        $data = new User();
        $data->fill($request->all());
        $data->password = Hash::make($request->password);
        $data->save();

        Alert::toast('Successfully Register', 'success');
        return back();
    }

    public function logout()
    {
        Auth::logout();
        Alert::toast('Success Logout', 'success');
        return back();
    }
}
