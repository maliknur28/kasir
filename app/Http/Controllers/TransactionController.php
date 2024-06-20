<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class TransactionController extends Controller
{
    public function create()
    {
        $products = Product::all();
        $members = Member::all();
        $transactionDetails = TransactionDetail::whereNull('transaction_id')
            // ->get()
            ->paginate(5);

        return view('pages.transaction.transaction', compact('products', 'members', 'transactionDetails'));
    }

    public function getDiscount(Request $request)
    {
        $id_member = $request->id_member;
        $subtotal = $request->subtotal;

        $member = Member::find($id_member);

        if ($member) {
            if ($subtotal >= $member->discount->minimum_purchase) {
                return response()->json(['total_discount' => $member->discount->total_discount]);
            } else {
                return response()->json(['total_discount' => 0]);
            }
        } else {
            return response()->json(['error' => ' tidak ditemukan'], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate(['pay' => 'required']);

        $user_id = Auth::user()->id;

        $transactionData = [
            'time' => now(),
            'user_id' => $user_id,
            'total_price' => $request->total_price,
            'pay' => $request->pay,
            'back' => $request->back
        ];

        if ($request->has('id_member')) {
            $transactionData['member_id'] = $request->id_member;
        }

        $transaction = Transaction::create($transactionData);

        $transactionDetails = TransactionDetail::whereNull('transaction_id')->get();

        foreach ($transactionDetails as $transactionDetail) {
            $transactionDetail->transaction_id = $transaction->id;
            $transactionDetail->save();
        }

        $transactionDetails = TransactionDetail::where('transaction_id', $transaction->id)->get();

        Alert::toast('Transaksi berhasil disimpan', 'success');
        return view('pages.transaction.partials.struk', compact('transaction', 'transactionDetails'));
    }
}
