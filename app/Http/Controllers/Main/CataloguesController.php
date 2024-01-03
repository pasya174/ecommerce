<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\ProductDetails;
use App\Traits\MyTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CataloguesController extends Controller
{
    use MyTrait;

    public function index()
    {
        $active = 'product';
        $products_modal = ProductDetails::with('product')->get();
        $cart = $this->cart_data();
        $products_all = ProductDetails::with('product')->groupBy('product_id')->limit(10)->get();
        $products_modal = ProductDetails::with('product')->get();
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
        return view('website.pages.catalogues', compact(
            'active',
            'products_modal',
            'cart',
            'products_all',
            'products_modal',
            'product_review',
        ));
    }
}
