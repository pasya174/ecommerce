<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait MyTrait
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
                ->where('t.status', 0)
                ->whereNull('td.deleted_at')
                ->whereNull('pd.deleted_at')
                ->whereNull('p.deleted_at')
                ->whereNull('t.deleted_at')
                ->get();
        }

        return $data;
    }

    public function total_amount($id)
    {
        $total_amount = array();

        $data = DB::table('transaction_details as td')
            ->select('p.price', 'td.quantity')
            ->join('transactions as t', 't.id', '=', 'td.transaction_id')
            ->join('product_details as pd', 'pd.id', '=', 'td.product_details_id')
            ->join('products as p', 'p.id', '=', 'pd.product_id')
            ->where('t.id', $id)
            ->groupBy('td.id')
            ->get();
        foreach ($data as $item) {
            array_push($total_amount, $item->price * $item->quantity);
        }
        return array_sum($total_amount);
    }
}
