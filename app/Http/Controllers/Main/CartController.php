<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\TransactionDetails;
use App\Models\Transactions;
use App\Models\User;
use App\Traits\MyTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    use MyTrait;

    public function index()
    {
        $active = 'cart';
        $cart = $this->cart_data();
        $data = TransactionDetails::whereHas('transaction', function ($query) {
            $query->where('user_id', Auth::user()->id)->where('status', 0);
        })->first();
        if (!empty($data)) {
            $total_amount = $this->total_amount($data->transaction_id);
        } else {
            $total_amount = 0;
        }

        $point_user = User::where('id', Auth::user()->id)->first()['points'];
        return view('website.pages.cart', compact('active', 'cart', 'total_amount', 'point_user'));
    }
}
