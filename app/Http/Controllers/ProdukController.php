<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Produk;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{

    public function __construct()
    {
        $this -> middleware('auth')-> only(['list']);
        $this -> middleware('auth:api')-> only(['store','update','destroy']);


        // $this -> middleware('auth:api')->except(['index']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::with('category','subcategory')->get();
        
        
        return response() -> json([
            'data' => $produk
        ]);
    }

    public function list()
    {
        $categories = Category::all(); 
        $subcategories = Subcategory::all(); 

        return view('produk.index',compact('categories','subcategories'));
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
            'id_kategori' => 'required',
            'id_subkategori' => 'required',
            'nama_barang' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'deskripsi' => 'required',
            'harga' => 'required',
            'diskon' => 'required',
            'bahan' => 'required',
            'tags' => 'required',
            'sku' => 'required',
            'ukuran' => 'required',
            'warna' => 'required',

        ]);

        if ($validator->fails()){
            return response()->json(
                $validator->errors(),422
            );
        }

        $input = $request->all();

        if($request->has('gambar')){
            $gambar = $request->file('gambar');
            $nama_gambar = time() . rand(1,9) . '.' . $gambar->getClientOriginalExtension();
            $gambar->move('uploads',$nama_gambar);
            $input['gambar'] = $nama_gambar;
        }

        $produk = Produk::create($input);

        return response()->json([ 
            'success'=> true,
            'message' => 'success',
            'data' => $produk
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        return response()->json([
            'success'=> true,
            'message' => 'success',
            'data'=>$produk
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
        $validator = validator::make($request->all(),[
            'id_kategori' => 'required',
            'id_subkategori' => 'required',
            'nama_barang' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'diskon' => 'required',
            'bahan' => 'required',
            'tags' => 'required',
            'sku' => 'required',
            'ukuran' => 'required',
            'warna' => 'required',

        ]);

        if ($validator->fails()){
            return response()->json(
                $validator->errors(),422
            );
        }

        $input = $request->all();

        if($request->has('gambar')){
            File::delete('uploads/'. $produk->gambar);
            $gambar = $request->file('gambar');
            $nama_gambar = time() . rand(1,9) . '.' . $gambar->getClientOriginalExtension();
            $gambar->move('uploads',$nama_gambar);
            $input['gambar'] = $nama_gambar;
        }else{
            unset($input['gambar']);
        }

        $produk -> update($input);

        return response()->json([
            'success'=> true,
            'message' => 'success',
            'data' => $produk
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {                   

        File::delete('uploads/'.$produk->gambar);
        $produk -> delete();

        return response() -> json([
            'success'=> true,
            'message' => 'success'
        ]);
    }
}
