<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Discount;
use App\Models\Transaction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'Petugas')->count();
        $products = Product::count();
        $discounts = Discount::pluck('total_discount');
        $transactions = Transaction::count();        
        
        return view('pages.home', compact('users', 'products', 'discounts', 'transactions'));
    }
}
