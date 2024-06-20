<?php

namespace App\Http\Controllers;

use App\Models\StockProduct;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function transaction()
    {
        $transactions = Transaction::paginate(5);

        return view('pages.reports.report-transaction', compact('transactions'));
    }

    public function stock()
    {
        $stocks = StockProduct::paginate(5);

        return view('pages.reports.report-stock', compact('stocks'));
    }

    // public function report(Request $request)
    // {
    //     if ($request->filled('transaction_report')) {
    //         $transaction_report = Transaction::paginate(5);
    //     } else {
    //         $stock_report = StockProduct::paginate(5);
    //     }

    //     if ($transaction_report) {
    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Laporan transaksi berhasil didapatkan',
    //             'data' => $transaction_report
    //         ]);
    //     } else {
    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Laporan stok berhasil didapatkan',
    //             'data' => $stock_report
    //         ]);
    //     }
    // }

    public function filterTransaction(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $transactions = Transaction::whereBetween('time', [$startDate, $endDate])->get();

        return view('pages.reports.report-transaction', compact('transactions'));
    }

    public function filterStock(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $stocks = StockProduct::whereBetween('created_at', [$startDate, $endDate])->get();

        return view('pages.reports.report-stock', compact('stocks'));
    }
}
