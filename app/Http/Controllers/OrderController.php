<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

    public function __construct()
    {

        $this -> middleware('auth')-> only(['list','list_dikonfirmasi','list_dikemas','list_dikirim','list_diterima','list_selesai']);
        $this -> middleware('auth:api')-> only(['store','update','destroy','ubah_status','baru','dikonfirmasi','dikemas','dikirim','diterima','selesai']);
        // $this -> middleware('auth:api')->except(['index']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = Order::with('member')->get();

        return response() -> json([
            'success'=> true,
            'message' => 'success',
            'data' => $order
        ]);
    }

 
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = validator::make($request->all(),[
            'id_member' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json(
                $validator->errors(),422
            );
        }

        $input = $request->all();
        $order = Order::create($input);

        for ($i=0; $i < count($input['id_produk']) ; $i++) { 
            OrderDetail::create([
                'id_order' =>$order['id'],
                'id_produk' =>$input['id_produk'][$i],
                'jumlah' =>$input['jumlah'][$i],
                'size' =>$input['size'][$i],
                'color' =>$input['color'][$i],
                'total' =>$input['total'][$i],
            ]); 
        }

        return response()->json([ 
            'success'=> true,
            'message' => 'success',
            'data' => $order
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return response()->json([
            'success'=> true,
            'message' => 'success',
            'data'=>$order
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validator = validator::make($request->all(),[
            'id_member' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json(
                $validator->errors(),422
            );
        }

        $input = $request->all();
        $order -> update($input);

        OrderDetail::where('id_order',$order['id'])->delete();

        for ($i=0; $i < count($input['id_produk']) ; $i++) { 
            OrderDetail::create([
                'id_order' =>$order['id'],
                'id_produk' =>$input['id_produk'][$i],
                'jumlah' =>$input['jumlah'][$i],
                'size' =>$input['size'][$i],
                'color' =>$input['color'][$i],
                'total' =>$input['total'][$i],
            ]);
        }

        return response()->json([
            'success'=> true,
            'message' => 'success',
            'data' => $order
        ]);
    }

    public function ubah_status(Request $request, Order $order)
    {
        $order->update([
            'status' => $request->status
        ]);

        return response()->json([
            'success'=> true,
            'message' => 'success',
            'data' => $order
        ]);
    }

  
    public function baru()
    {
        $order = Order::with('member')->where('status','Baru')->get();
        return response() -> json([
            'success'=> true,
            'message' => 'success',
            'data' => $order
        ]);
    }
    public function dikonfirmasi()
    {
        $order = Order::with('member')->where('status','Dikonfirmasi')->get();
        return response() -> json([
            'success'=> true,
            'message' => 'success',
            'data' => $order
        ]);
    }

    public function dikemas()
    {
        $order = Order::with('member')->where('status','Dikemas')->get();
        return response() -> json([
            'success'=> true,
            'message' => 'success',
            'data' => $order
        ]);
    }

    public function dikirim()
    {
        $order = Order::with('member')->where('status','Dikirim')->get();
        return response() -> json([
            'success'=> true,
            'message' => 'success',
            'data' => $order
        ]);
    }

    public function diterima()
    {
        $order = Order::with('member')->where('status','Diterima')->get();
        return response() -> json([
            'success'=> true,
            'message' => 'success',
            'data' => $order
        ]);
    }
    public function selesai()
    {
        $order = Order::with('member')->where('status','Selesai')->get();
        return response() -> json([
            'success'=> true,
            'message' => 'success',
            'data' => $order
        ]);
    }

    public function list()
    {

        return view('pesanan.index');
    }
    
    public function list_dikonfirmasi()
    {

        return view('pesanan.dikonfirmasi');
    }

    public function list_dikemas()
    {

        return view('pesanan.dikemas');
    }

    public function list_dikirim()
    {

        return view('pesanan.dikirim');
    }
    
    public function list_diterima()
    {

        return view('pesanan.diterima');
    }

    public function list_selesai()
    {

        return view('pesanan.selesai');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {                   
        $order -> delete();

        return response() -> json([
            'success'=> true,
            'message' => 'success'
        ]);
    }
}
