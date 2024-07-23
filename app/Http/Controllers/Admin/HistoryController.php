<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransactionDetails;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    public function index()
    {
        $data = $this->data();

        return view('administator.pages.history.index', compact('data'));
    }

    public function detail($user_id)
    {
        // $data = $this->data($user_id);

        $data = $this->data_detail($user_id);

        return view('administator.pages.history.detail', compact('data'));
    }

    public function data($user_id = null)
    {
        $query = Transactions::with('user')
            ->where('status', 1)
            ->whereNotNull('payment_status');

        if (!empty($user_id)) {
            $query->where('user_id', $user_id);
        }

        $data = $query->get();

        return $data;
    }

    public function data_detail($user_id = null)
    {
        // $query = DB::table('transaction_details as td')
        //     ->select(
        //         'p.name',
        //         'p.price',
        //         'pd.size',
        //         'pd.color',
        //         'td.quantity',
        //         'td.transaction_id',
        //         // 'td.id'
        //     )
        //     ->join('product_details as pd', 'pd.id', '=', 'td.product_details_id')
        //     ->join('transactions as t', 't.id', '=', 'td.transaction_id')
        //     ->join('products as p', 'p.id', '=', 'product_id')
        //     ->whereNull('td.deleted_at')
        //     ->whereNull('pd.deleted_at')
        //     ->whereNull('t.deleted_at')
        //     ->where('t.status', 1);


        // if (!empty($user_id)) {
        //     $query->where('t.user_id', $user_id);
        // }

        // $data = $query->get();
        $data = TransactionDetails::whereHas('transaction', function ($query) use ($user_id) {
            $query->where('user_id', $user_id)
                ->where('payment_status', true);
        })->get();
        // dd($data);

        return $data;
    }
}
