<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\ProductDetails;
use App\Models\User;
use App\Traits\MyTrait;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    use MyTrait;
    public function index()
    {
        $active = 'leaderboard';
        $products_modal = ProductDetails::with('product')->paginate(10);
        $cart = $this->cart_data();
        $data = User::orderBy('points', 'desc')->get();
        return view('website.pages.leaderboard', compact('active', 'data', 'products_modal', 'cart'));
    }
}
