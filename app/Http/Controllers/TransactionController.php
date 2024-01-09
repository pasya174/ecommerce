<?php

namespace App\Http\Controllers;

use App\Models\ProductDetails;
use App\Models\Products;
use App\Models\TransactionDetails;
use App\Models\Transactions;
use App\Traits\MyTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class TransactionController extends Controller
{
    use MyTrait;
    public function add_cart(Request $request)
    {
        if (Auth::check()) {
            $validator = Validator::make($request->all(), [
                'product_details_id' => 'required|exists:products,id',
                'size' => 'required|exists:product_details,size',
                'color' => 'required|exists:product_details,color',
                'quantity' => 'required',
            ]);

            if ($validator->fails()) {
                Alert::toast($validator->messages()->all(), 'error');
                return back();
            }

            $data = Transactions::where('user_id', Auth::user()->id)->where('status', 0)->first();
            if (!$data) {
                $data = new Transactions();
                $data->user_id = Auth::user()->id;
            }

            $data->save();

            $data_detail = TransactionDetails::where('product_details_id', $request->product_details_id)
                ->where('transaction_id', $data->id)
                ->first();
            if ($data_detail) {
                $data_detail->quantity += (int) $request->quantity;
                $data_detail->save();
            } else {
                $data_detail = new TransactionDetails();
                $data_detail->fill($request->all());
                $data_detail->transaction_id = $data->id;
                $data_detail->save();
            }

            Alert::toast('Add to Cart Successfully', 'success');
            return back();
        }

        Alert::toast('Login required', 'error');
        return back();
    }

    public function add_quantity($id, $status)
    {
        $data = TransactionDetails::findOrFail($id);
        if ($status == 'min') {
            $data->quantity -= 1;
        } else {
            $data->quantity += 1;
        }
        $data->save();
        return back();
    }

    public function cart_store(Request $request)
    {
        // dd($request->all());
        $data = Transactions::where('user_id', Auth::user()->id)->where('status', 0)->first();
        if ($request->has('point_use_checkout')) {
            $data->temp_points_used = $request->point_use_checkout;
        }
        $data->save();

        return redirect()->route('checkout');
    }

    public function delete_detail_transaction($id)
    {
        $data = TransactionDetails::findOrFail($id);

        $data->delete();
        return back();
    }
}
