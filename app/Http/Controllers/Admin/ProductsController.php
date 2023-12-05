<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\ProductDetails;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ProductsController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        $data = Products::all();
        $data_detail = ProductDetails::with('product')->get();
        // dd($data_detail);
        return view('administator.pages.products', compact(
            'categories',
            'data',
            'data_detail'
        ));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'color' => 'required',
            'category_id' => 'required|exists:categories,id',
            'size' => 'required',
            'stock' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all(), 'error');
            return back()->withInput();
        }

        unset($request['_token']);

        $data = new Products();
        $data->fill($request->all());
        $data->save();

        $data_detail = new ProductDetails();
        $data_detail->fill($request->all());
        $data_detail->product_id = $data->id;
        $data_detail->save();

        Alert::toast('Success Add Product', 'success');
        return back();
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'color' => 'required',
            'category_id' => 'required|exists:categories,id',
            'size' => 'required',
            'stock' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all(), 'error');
            return back()->withInput();
        }

        unset($request['_token']);

        $data = Products::findOrFail($request->id);
        $data->fill($request->all());
        $data->save();

        $data_detail = ProductDetails::where('product_id', $data->id)->first();
        $data_detail->fill($request->all());
        $data_detail->save();

        Alert::toast('Success Update Product', 'success');
        return back();
    }

    public function add_detail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'id' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'color' => 'required',
            'category_id' => 'required|exists:categories,id',
            'size' => 'required',
            'stock' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all(), 'error');
            return back()->withInput();
        }

        unset($request['_token']);

        $check_data = ProductDetails::where('product_id', $request->id)
            ->where('color', $request->color)
            ->where('category_id', $request->category_id)
            ->where('size', $request->size)
            ->first();

        if (empty($check_data)) {
            $data_detail = new ProductDetails();
            $data_detail->fill($request->all());
            $data_detail->product_id = $request->id;
            $data_detail->save();
        }

        if ($check_data->stock > $request->stock) {
            $check_data->stock = $request->stock;
            $check_data->save();
        }
        // else {
        //     $check_data->stock += $request->stock;
        //     $check_data->save();
        // }

        Alert::toast('Success Add Detail Product', 'success');
        return back();
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all());
            return back();
        }

        Products::where('id', $request->id)->delete();
        ProductDetails::where('product_id', $request->id)->delete();

        Alert::toast('Success Delete Product', 'success');
        return back();
    }

    public function delete_detail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all());
            return back();
        }

        ProductDetails::where('id', $request->id)->delete();

        Alert::toast('Success Delete Detail Product', 'success');
        return back();
    }
}
