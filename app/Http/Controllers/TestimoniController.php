<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class TestimoniController extends Controller
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
        $testimoni = Testimoni::all();
        return response() -> json([
            'data' => $testimoni
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */

     public function list()
     {

        $testimoni = Testimoni::all(); 

        $this->middleware('auth');
        return view('testimoni.index',compact('testimoni'));
     }
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
            'nama_testimoni' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg',

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

        $testimoni = Testimoni::create($input);

        return response()->json([ 
            'success'=> true,
            'message' => 'success',
            'data' => $testimoni
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimoni $testimoni)
    {
        return response()->json([
            'success'=> true,
            'message' => 'success',
            'data'=>$testimoni
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimoni $testimoni)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimoni $testimoni)
    {
        $validator = validator::make($request->all(),[
            'nama_testimoni' => 'required',
            'deskripsi' => 'required',

        ]);

        if ($validator->fails()){
            return response()->json(
                $validator->errors(),422
            );
        }

        $input = $request->all();

        if($request->has('gambar')){
            File::delete('uploads/'. $testimoni->gambar);
            $gambar = $request->file('gambar');
            $nama_gambar = time() . rand(1,9) . '.' . $gambar->getClientOriginalExtension();
            $gambar->move('uploads',$nama_gambar);
            $input['gambar'] = $nama_gambar;
        }else{
            unset($input['gambar']);
        }

        $testimoni -> update($input);

        return response()->json([
            'success'=> true,
            'message' => 'success',
            'data' => $testimoni
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimoni $testimoni)
    {                   

        File::delete('uploads/'.$testimoni->gambar);
        $testimoni -> delete();

        return response() -> json([
            'success'=> true,
            'message' => 'success'
        ]);
    }
}
