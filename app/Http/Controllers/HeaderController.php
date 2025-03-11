<?php

namespace App\Http\Controllers;

use App\Models\Header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class HeaderController extends Controller
{
    public function index()
    {
        $data = Header::all();
        return view('administator.pages.layouts.header', compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image_header' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all());
            return back()->withInput();
        }

        $data = new Header();
        $data->name = $request->name;

        if ($request->hasFile('image_header')) {

            $image = $request->file('image_header');
            $image_name = bin2hex(time() . '-admin-' . $request->name) . '.' . $image->getClientOriginalExtension();

            File::delete(public_path("/storage/uploads/images/headers/" . $request->name));
            Storage::putFileAs('public/uploads/images/headers/', $image, $image_name);
            $data->image = $image_name;
        }

        $data->save();

        Alert::toast('Add Header Successfully', 'success');
        return back();
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
            'image_header' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all());
            return back()->withInput();
        }

        $data = Header::findOrFail($request->id);
        $data->name = $request->name;

        if ($request->hasFile('image_header')) {

            $image = $request->file('image_header');
            $image_name = bin2hex(time() . '-admin-' . $data->name) . '.' . $image->getClientOriginalExtension();

            File::delete(public_path("/storage/uploads/images/headers/" . $data->image));
            Storage::putFileAs('public/uploads/images/headers/', $image, $image_name);
            $data->image = $image_name;
        }

        $data->save();

        Alert::toast('Update Header Successfully', 'success');
        return back();
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => "required"
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all());
            return back();
        }

        $data = Header::findOrFail($request->id);
        File::delete(public_path("/storage/uploads/images/headers/" . $data->image));
        $data->delete();

        Alert::toast('Delete Header Successfully', 'success');
        return back();
    }
}
