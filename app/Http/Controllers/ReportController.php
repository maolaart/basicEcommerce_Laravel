<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{

    public function __construct()
    {
        $this -> middleware('auth')-> only(['index']);
        $this -> middleware('auth:api')-> only(['get_reports']);

        // $this -> middleware('auth:api')->except(['index']);
    }

    public function get_reports(Request $request)
    {
        // dd($request -> sampai);

        $report = DB::table('order_details') 
        ->join('produks','produks.id','=','order_details.id_produk')
        ->select(DB::raw('
        order_details.created_at as tgl,
        nama_barang,
        count(*) as jumlah_dibeli, 
        harga,
        SUM(total) as pendapatan,
        SUM(jumlah)  as total_q'))
        ->whereRaw("date(order_details.created_at) >= ' $request->dari'")
        ->whereRaw("date(order_details.created_at) <= ' $request->sampai'")
        ->groupBy('id_produk', 'nama_barang', 'harga','order_details.created_at')
        -> get();

        return response()->json([
            'data' => $report
        ]);
    }
    public function index(Request $request)
    {
        // dd($request -> sampai);
        return view('reports.index');
    }
}
