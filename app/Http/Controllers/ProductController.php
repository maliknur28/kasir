<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\StockProduct;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(5);

        return view('pages.product', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products,name|uppercase',
            'price' => 'required|numeric',
            'stock' => 'required|numeric'
        ]);

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock
        ]);

        StockProduct::create([
            'product_id' => $product->id,
            'stock_in' => $request->stock
        ]);

        Alert::toast('Produk berhasil disimpan', 'success');
        return back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:products,name|uppercase',
            'price' => 'required|numeric',
            'stock' => 'required|numeric'
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock
        ]);

        $stock = StockProduct::findOrFail($id);
        $stock->update(['stock_in' => $request->stock]);

        Alert::toast('Produk berhasil diubah', 'success');
        return back();
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        Alert::toast('Produk berhasil dihapus', 'success');
        return back();
    }
}
