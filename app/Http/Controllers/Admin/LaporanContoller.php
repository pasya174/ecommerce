<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class LaporanContoller extends Controller
{
    public function detail($user_id)
    {
        $data = $this->data(null, null, $user_id);
        $data_detail = $this->data_detail();

        $filter_date = false;
        if (!empty($_REQUEST['date'])) {
            $date = $_REQUEST['date'];

            $data = $this->data($date);
            $data_detail = $this->data_detail($date);
            $filter_date = $date;
        }

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

        return view('administator.pages.laporan-detail', compact(
            'data',
            'data_detail',
            'filter_date'
        ));
    }

    public function index()
    {
        $data = $this->data();
        $data_detail = $this->data_detail();

        $filter_date = false;
        if (!empty($_REQUEST['date'])) {
            $date = $_REQUEST['date'];

            $data = $this->data($date);
            $data_detail = $this->data_detail($date);
            $filter_date = $date;
        }

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

        return view('administator.pages.laporan', compact(
            'data',
            'data_detail',
            'filter_date'
        ));
    }

    public function print($id)
    {
        $data = $this->data(null, $id);
        $data_detail = $this->data_detail(null, $id);
        // dd($data, $data_detail);

        return view('administator.pages.print', compact('data', 'data_detail'));
    }

    public function data($date = null, $id = null, $user_id = null)
    {
        if ($user_id != null) {
            $query = Transactions::with('user')
                ->where('status', 1)
                ->whereNotNull('payment_status');
            $query->where('user_id', $user_id);
        } else {
            $query = Transactions::selectRaw('*, SUM(total_amount) as total_amount')
                ->with('user')
                ->where('status', 1)
                ->whereNotNull('payment_status');
            $query->groupBy('user_id');
        }

        if (!empty($id)) {
            $query->where('id', $id);
        }

        if (!empty($date)) {
            $query->whereDate('created_at', $date);
        }

        $data = $query->get();
        // dd($data);

        return $data;
    }

    public function data_detail($date = null, $id = null)
    {
        $query = DB::table('transaction_details as td')
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
            ->where('t.status', 1);

        if (!empty($id)) {
            $query->where('t.id', $id);
        }

        if (!empty($date)) {
            $query->whereDate('td.created_at', $date);
        }

        $data = $query->get();

        return $data;
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
