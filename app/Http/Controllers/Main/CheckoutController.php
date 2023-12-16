<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Transactions;
use App\Models\User;
use App\Traits\MyTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class CheckoutController extends Controller
{
    use MyTrait;

    public function index()
    {
        $active  = 'checkout';
        $cart = $this->cart_data();

        if (empty($cart[0])) {
            abort(404);
        }

        $data = Transactions::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $province = collect(Http::get('https://emsifa.github.io/api-wilayah-indonesia/api/provinces.json')->json());
        return view('website.pages.checkout', compact('active', 'cart', 'province', 'data'));
    }

    public function city($id)
    {
        $URL = 'https://www.emsifa.com/api-wilayah-indonesia/api/regencies/' . $id . '.json';
        $data = collect(Http::get($URL)->json());
        return response()->json($data);
    }

    public function district($id)
    {
        $URL = 'https://www.emsifa.com/api-wilayah-indonesia/api/districts/' . $id . '.json';
        $data = collect(Http::get($URL)->json());
        return response()->json($data);
    }

    public function village($id)
    {
        $URL = 'https://www.emsifa.com/api-wilayah-indonesia/api/villages/' . $id . '.json';
        $data = collect(Http::get($URL)->json());
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:transactions,id',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email:rfc,dns',
            'phone_number' => 'required',
            'province' => 'required',
            'city' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all());
            return back()->withInput();
        }

        unset($request['_token']);
        $data = Transactions::findOrFail($request->id);
        $data->fill($request->all());

        if ($data->temp_points_used == 20) {
            $data->points_used -= 500;
        }

        if ($data->temp_points_used == 30) {
            $data->points_used -= 3000;
        }

        if ($data->temp_points_used == 50) {
            $data->points_used -= 5000;
        }
        // $data->status = 1;
        $data->save();

        $user = User::where('email', $data->email)->first();
        if ($data->temp_points_used == 20) {
            $user->points -= 500;
        }

        if ($data->temp_points_used == 30) {
            $user->points -= 3000;
        }

        if ($data->temp_points_used == 50) {
            $user->points -= 5000;
        }

        $user->save();

        // $user = User::findOrFail(Auth::user()->id);

        Alert::toast('Checkout Successfully', 'success');
        return redirect()->route('catalogue');
    }
}
