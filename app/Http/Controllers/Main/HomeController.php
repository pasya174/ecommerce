<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Header;
use App\Models\ProductDetails;
use App\Models\Products;
use App\Models\TransactionDetails;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{

    public function cart_data()
    {
        $data = null;
        if (Auth::check()) {
            $data = DB::table('transaction_details as td')
                ->select(
                    'td.id as id',
                    'td.quantity as quantity',
                    'pd.image as image',
                    'pd.size as size',
                    'pd.color as color',
                    'p.name as name',
                    'p.description as description',
                    'p.price as price',
                )
                ->join('product_details as pd', 'td.product_details_id', '=', 'pd.id')
                ->join('products as p', 'p.id', '=', 'pd.product_id')
                ->join('transactions as t', 'td.transaction_id', 't.id')
                ->where('user_id', Auth::user()->id)
                ->whereNull('td.deleted_at')
                ->whereNull('pd.deleted_at')
                ->whereNull('p.deleted_at')
                ->whereNull('t.deleted_at')
                ->get();
        }

        return $data;
    }

    public function index()
    {
        $products = ProductDetails::with('product')->groupBy('product_id')->get();
        $categories = Categories::all();
        $products_all = ProductDetails::with('product')->groupBy('product_id')->limit(10)->get();
        $products_modal = ProductDetails::with('product')->get();

        $header = Header::all();

        $cart = $this->cart_data();

        return view('website.pages.index', compact(
            'products',
            'categories',
            'products_all',
            'products_modal',
            'cart',
            'header',
        ));
    }

    public function add_cart(Request $request)
    {
        if (Auth::check()) {
            $validator = Validator::make($request->all(), [
                'product_details_id' => 'required|exists:products,id',
                'size' => 'required|exists:product_details,size',
                'color' => 'required|exists:product_details,color',
                'quantity' => 'required',
            ]);

            if ($validator->fails()) {
                Alert::toast($validator->messages()->all(), 'error');
                return back();
            }

            $data = new Transactions();
            $data->user_id = Auth::user()->id;
            $data->total_amount = Products::where('id', ProductDetails::where('id', $request->product_details_id)->pluck('product_id')[0])->pluck('price')[0] * $request->quantity;
            $data->save();
            $data_detail = new TransactionDetails();
            $data_detail->fill($request->all());
            $data_detail->transaction_id = $data->id;
            $data_detail->save();

            Alert::toast('Add to Cart Successfully', 'success');
            return back();
        }

        Alert::toast('Login required', 'error');
        return back();
    }

    public function catalogues()
    {
        $products_modal = ProductDetails::with('product')->get();
        $cart = $this->cart_data();
        return view('website.pages.catalogues', compact('products_modal', 'cart'));
    }

    public function cart()
    {
        $cart = $this->cart_data();
        // dd($cart);
        return view('website.pages.cart', compact('cart'));
    }

    public function add_quantity($id, $status)
    {
        $data = TransactionDetails::findOrFail($id);
        if ($status == 'min') {
            $data->quantity -= 1;
        } else {
            $data->quantity += 1;
        }
        $data->save();
        return back();
    }

    public function delete_detail_transaction($id)
    {
        $data = TransactionDetails::findOrFail($id);

        $data->delete();
        return back();
    }

    public function checkout()
    {
        $cart = $this->cart_data();
        return view('website.pages.checkout', 'cart');
    }
}
