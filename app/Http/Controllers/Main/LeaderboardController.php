<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\ProductDetails;
use App\Models\User;
use App\Traits\MyTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaderboardController extends Controller
{
    use MyTrait;
    public function index()
    {
        $active = 'leaderboard';
        $products_modal = ProductDetails::with('product')->paginate(10);
        $cart = $this->cart_data();
        $data = User::orderBy('points', 'desc')->get();
        $product_review = DB::table('transaction_details as td')
            ->select(
                'u.username',
                'td.review',
                'td.product_details_id as product_id'
            )
            ->join('transactions as t', 't.id', '=', 'td.transaction_id')
            ->join('users as u', 't.user_id', '=', 'u.id')
            ->whereNotNull('td.review')
            ->whereNull('u.deleted_at')
            ->whereNull('td.deleted_at')
            ->whereNull('t.deleted_at')
            ->get();
        return view('website.pages.leaderboard', compact(
            'active',
            'data',
            'products_modal',
            'cart',
            'product_review',
        ));
    }
}
