<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\ProductDetails;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ProductsController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        $data = Products::orderBy('created_at', 'asc')->get();
        $data_detail = ProductDetails::with('product')->get();
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
            'image' => 'required|image|mimes:jpeg,png,jpg,webp',
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all(), 'error');
            return back()->withInput();
        }

        $image = $request->file('image');
        $image_name = bin2hex(time() . '-admin-' . $request->description) . '.' . $image->getClientOriginalExtension();

        Storage::putFileAs('public/uploads/images/products/', $image, $image_name);

        unset($request['_token']);

        $data = new Products();
        $data->fill($request->all());
        $data->save();

        $data_detail = new ProductDetails();

        $data_detail->fill($request->all());
        $data_detail->product_id = $data->id;
        $data_detail->image = $image_name;
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
            'image_product' => 'nullable|image|mimes:jpeg,png,jpg'
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all(), 'error');
            // dd($validator->messages()->all(),  $request->all());
            return back()->withInput();
        }

        unset($request['_token']);

        $data = Products::findOrFail($request->id);
        $data->fill($request->all());
        $data->save();

        $data_detail = ProductDetails::where('product_id', $data->id)->first();
        $data_detail->fill($request->all());
        if ($request->hasFile('image_product')) {

            $image = $request->file('image_product');
            $image_name = bin2hex(time() . '-admin-' . $data->description) . '.' . $image->getClientOriginalExtension();

            File::delete(public_path("/storage/uploads/images/products/" . $data_detail->image));
            Storage::putFileAs('public/uploads/images/products/', $image, $image_name);

            $data_detail->image = $image_name;
        }
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
            'image' => 'required|image|mimes:jpeg,png,jpg,webp',
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all(), 'error');
            return back()->withInput();
        }

        $image = $request->file('image');
        $image_name = bin2hex(time() . '-admin-' . $request->description) . '.' . $image->getClientOriginalExtension();

        Storage::putFileAs('public/uploads/images/products/', $image, $image_name);

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
            $data_detail->image = $image_name;
            $data_detail->save();
        }
        // dd($request->stock, $check_data->stock);
        if (!empty($check_data) && $check_data->stock > $request->stock) {
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
        $data_detail = ProductDetails::where('product_id', $request->id)->get();
        foreach ($data_detail as $item) {
            File::delete(public_path("/storage/uploads/images/products/" . $item->image));
            $item->delete();
        }


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

        $data_detail = ProductDetails::where('id', $request->id)->first();
        File::delete(public_path("/storage/uploads/images/products/" . $data_detail->image));

        $data_detail->delete();

        Alert::toast('Success Delete Detail Product', 'success');
        return back();
    }
}
