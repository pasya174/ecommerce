<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\ProductDetails;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class CategoriesController extends Controller
{
    public function index()
    {
        $data = Categories::all();
        $data_detail = DB::table('product_details as pd')
            ->join('products as p', 'pd.product_id', '=', 'p.id')
            ->select('p.name', 'p.price', 'pd.category_id')
            ->get();
        return view('administator.pages.categories', compact('data', 'data_detail'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all());
            return back()->withInput();
        }

        unset($request['_token']);

        $data = new Categories();
        $data->fill($request->all());
        $data->save();

        Alert::toast('Success Add Category', 'success');
        return back();
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all());
            return back()->withInput();
        }

        unset($request['_token']);

        $data = Categories::findOrFail($request->id);
        $data->fill($request->all());
        $data->save();

        Alert::toast('Success Add Category', 'success');
        return back();
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all());
            return back()->withInput();
        }

        Categories::where('id', $request->id)->delete();

        $product_detail = ProductDetails::where('category_id', $request->id)->first();

        Products::where('id', $product_detail->product_id)->delete();

        ProductDetails::where('category_id', $request->id)->delete();

        Alert::toast('Success Delete Category', 'success');
        return back();
    }
}
