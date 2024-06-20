<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::all();

        return view('pages.discount', compact('discounts'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'minimum_purchase' => 'required',
            'total_discount' => 'required'
        ]);

        $discount = Discount::findOrFail($id);
        $discount->update([
            'minimum_purchase' => $request->minimum_purchase,
            'total_discount' => $request->total_discount
        ]);

        Alert::toast('Diskon berhasil diatur', 'success');
        return back();
    }
}
