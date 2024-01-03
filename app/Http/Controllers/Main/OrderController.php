<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\ProductDetails;
use App\Models\TransactionDetails;
use App\Models\Transactions;
use App\Traits\MyTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    use MyTrait;
    public function index()
    {
        $active = 'order';
        $data = Transactions::where('payment_status', true)
            ->where('user_id', Auth::user()->id)
            ->get();

        $data_detail = TransactionDetails::whereHas('transaction', function ($query) {
            $query->where('payment_status', true)
                ->where('user_id', Auth::user()->id);
        })->get();

        $data_detail = DB::table('transaction_details as td')
            ->select(
                'p.name',
                'p.price',
                'pd.image',
                'td.quantity',
                'td.transaction_id',
                'td.id',
            )
            ->join('product_details as pd', 'pd.id', '=', 'td.product_details_id')
            ->join('products as p', 'p.id', '=', 'pd.id')
            ->join('transactions as t', 't.id', '=', 'td.transaction_id')
            ->where('t.status', 1)
            ->where('t.user_id', Auth::user()->id)
            ->whereNull('td.deleted_at')
            ->whereNull('pd.deleted_at')
            ->whereNull('p.deleted_at')
            ->get();

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

        $products_modal = ProductDetails::with('product')->paginate(10);
        $cart = $this->cart_data();
        return view('website.pages.order', compact(
            'active',
            'data',
            'data_detail',
            'products_modal',
            'cart',
            'product_review',
        ));
    }

    public function give_review(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:transaction_details,id',
            'review' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all(), 'error');
            return back()->withInput();
        }

        $data = TransactionDetails::find($request->id);
        $data->review = $request->review;
        $data->save();

        Alert::toast('Thanks for Review', 'success');
        return back();
    }
}
