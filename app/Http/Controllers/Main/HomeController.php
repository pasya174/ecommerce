<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Products::all();
        $categories = Categories::all();
        return view('website.pages.index', compact('products', 'categories'));
    }

    public function catalogues()
    {
        return view('website.pages.catalogues');
    }

    public function cart()
    {
        return view('website.pages.cart');
    }

    public function checkout()
    {
        return view('website.pages.checkout');
    }
}
