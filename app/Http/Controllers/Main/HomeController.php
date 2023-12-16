<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Header;
use App\Models\ProductDetails;
use App\Models\Products;
use App\Models\TransactionDetails;
use App\Models\Transactions;
use App\Traits\MyTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{

    use MyTrait;

    public function index()
    {
        $active = 'home';
        $products = ProductDetails::with('product')->groupBy('product_id')->get();
        $categories = Categories::all();
        $products_all = ProductDetails::with('product')->groupBy('product_id')->limit(10)->get();
        $products_modal = ProductDetails::with('product')->get();

        $header = Header::all();

        $cart = $this->cart_data();

        return view('website.pages.index', compact(
            'active',
            'products',
            'categories',
            'products_all',
            'products_modal',
            'cart',
            'header',
        ));
    }
}
