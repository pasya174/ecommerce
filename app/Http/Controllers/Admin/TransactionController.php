<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransactionDetails;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class TransactionController extends Controller
{
    public function index()
    {
        $data = Transactions::with('user')
            ->where('status', 1)
            ->get();
        foreach ($data as $item) {
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
        // dd($data);
        // $data_detail = TransactionDetails::with('product_details')
        //     ->whereHas('transaction', function ($query) {
        //         $query->where('status', 1);
        //     })->get();
        $data_detail = DB::table('transaction_details as td')
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
        // dd($data, $data_detail);
        return view('administator.pages.transaction', compact('data', 'data_detail'));
    }

    public function isAccept(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all(), 'error');
            return back();
        }

        $data = Transactions::findOrFail($request->id);
        if ($data->payment_status == true) {
            $data->payment_status = false;
        } else {
            $data->payment_status = true;
        }

        $data->save();

        Alert::toast('Change Accept Successfully', 'success');
        return back();
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
