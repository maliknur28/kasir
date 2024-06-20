<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use App\Models\StockProduct;
use RealRashid\SweetAlert\Facades\Alert;

class TransactionDetailController extends Controller
{
    public function getProduct(Request $request)
    {
        $product = Product::where('id', $request->id_product)->first();

        if ($product) {
            return response()->json(['data' => $product]);
        } else {
            return response()->json(['error' => 'Produk tidak ditemukan'], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_product' => 'required',
            'qty' => 'required|min:1'
        ]);

        $stock = Product::where('stock', '>=', $request->qty)->first();

        if (!$stock) {
            Alert::toast('Kuantitas melebihi stok produk', 'error');
            return back();
        }

        $stock_out = StockProduct::findOrFail($request->id_product);
        $stock_out->update(['stock_out' => $request->qty]);

        $transactionDetail = TransactionDetail::where('product_id', $request->id_product)
            ->whereNull('transaction_id')
            ->first();

        if ($transactionDetail) {

            $transactionDetail->qty += $request->qty;
            $transactionDetail->subtotal += $request->subtotal;
            $transactionDetail->save();

        } else {

            TransactionDetail::create([
                'product_id' => $request->id_product,
                'qty' => $request->qty,
                'subtotal' => $request->subtotal
            ]);
        }

        Alert::toast('Detail transaksi berhasil disimpan', 'success');
        return back();
    }

    public function destroy($id)
    {
        $transactionDetail = TransactionDetail::findOrFail($id);
        $transactionDetail->delete();

        Alert::toast('Detail transaksi berhasil dihapus', 'success');
        return back();
    }
}
