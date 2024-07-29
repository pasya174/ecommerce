<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransactionDetails;
use App\Models\TransactionDetailsOld;
use App\Models\Transactions;
use App\Models\TransactionsOld;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PerbandinganController extends Controller
{
    public function index()
    {
        $data_now = Transactions::with('user')
            ->where('status', 1)
            // ->whereNull('payment_status')
            ->get();

        $data_detail_now = DB::table('transaction_details as td')
            ->select(
                'p.name',
                'p.price',
                'pd.size',
                'pd.color',
                'td.quantity',
                'td.transaction_id',
                // 'td.id'
            )
            ->join('product_details as pd', 'pd.id', '=', 'td.product_details_id')
            ->join('transactions as t', 't.id', '=', 'td.transaction_id')
            ->join('products as p', 'p.id', '=', 'product_id')
            ->whereNull('td.deleted_at')
            ->whereNull('pd.deleted_at')
            ->whereNull('t.deleted_at')
            ->where('t.status', 1)
            ->get();

        foreach ($data_now as $item) {
            if (!$item->kelurahan == 0) {
                $item->kelurahan = $this->village($item->kecamatan);
                $item->kecamatan = $this->district($item->city);
                $item->city = $this->city($item->province);
                $item->province = $this->province($item->province);
            } else {
                $item->kelurahan = '-';
                $item->kecamatan = '-';
                $item->city = '-';
                $item->province = '-';
            }
        }
        // $data_detail_now = TransactionDetails::all();

        $data_old = TransactionsOld::with('user')
            ->where('status', 1)
            // ->whereNull('payment_status')
            ->get();

        $data_detail_old = DB::table('transaction_details_olds as td')
            ->select(
                'p.name',
                'p.price',
                'pd.size',
                'pd.color',
                'td.quantity',
                'td.transaction_id',
                // 'td.id'
            )
            ->join('product_details as pd', 'pd.id', '=', 'td.product_details_id')
            ->join('transactions_olds as t', 't.id', '=', 'td.transaction_id')
            ->join('products as p', 'p.id', '=', 'product_id')
            ->whereNull('td.deleted_at')
            ->whereNull('pd.deleted_at')
            ->whereNull('t.deleted_at')
            ->where('t.status', 1)
            ->get();

        foreach ($data_old as $item) {
            if (!$item->kelurahan == 0) {
                $item->kelurahan = $this->village($item->kecamatan);
                $item->kecamatan = $this->district($item->city);
                $item->city = $this->city($item->province);
                $item->province = $this->province($item->province);
            } else {
                $item->kelurahan = '-';
                $item->kecamatan = '-';
                $item->city = '-';
                $item->province = '-';
            }
        }
        // $data_detail_old = TransactionDetailsOld::all();

        return view('administator.pages.perbandingan', compact(
            'data_now',
            'data_detail_now',
            'data_old',
            'data_detail_old'
        ));
    }

    public function province($id)
    {
        $URL = 'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json';
        $data = collect(Http::get($URL)->json());
        return $data->where('id', $id)->first()['name'];
    }

    public function city($id)
    {
        $URL = 'https://www.emsifa.com/api-wilayah-indonesia/api/regencies/' . $id . '.json';
        $data = collect(Http::get($URL)->json());
        return $data->where('province_id', $id)->first()['name'];
    }

    public function district($id)
    {
        $URL = 'https://www.emsifa.com/api-wilayah-indonesia/api/districts/' . $id . '.json';
        $data = collect(Http::get($URL)->json());
        return $data->where('regency_id', $id)->first()['name'];
    }

    public function village($id)
    {
        $URL = 'https://www.emsifa.com/api-wilayah-indonesia/api/villages/' . $id . '.json';
        $data = collect(Http::get($URL)->json());
        // dd($data);
        return $data->where('district_id', $id)->first()['name'];
    }
}
