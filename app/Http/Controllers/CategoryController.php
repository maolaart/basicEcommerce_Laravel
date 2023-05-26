<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this -> middleware('auth')-> only(['list']);
        $this -> middleware('auth:api')-> only(['store','update','destroy']);

        // $this -> middleware('auth')->except(['index']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $categories = Category::all();
        return response() -> json([
            'data' => $categories
        ]);
    }

    public function list()
    {
        $this->middleware('auth');
        return view('kategori.index');
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
            'nama_kategori' => 'required',
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

        $category = Category::create($input);

        return response()->json([ 
            'success'=> true,
            'message' => 'success',
            'data' => $category
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return response()->json([
            'data'=>$category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validator = validator::make($request->all(),[
            'nama_kategori' => 'required',
            'deskripsi' => 'required',

        ]);

        if ($validator->fails()){
            return response()->json(
                $validator->errors(),422
            );
        }

        $input = $request->all();

        if($request->has('gambar')){
            File::delete('uploads/'. $category->gambar);
            $gambar = $request->file('gambar');
            $nama_gambar = time() . rand(1,9) . '.' . $gambar->getClientOriginalExtension();
            $gambar->move('uploads',$nama_gambar);
            $input['gambar'] = $nama_gambar;
        }else{
            unset($input['gambar']);
        }

        $category -> update($input);

        return response()->json([
            'success'=> true,
            'message' => 'success',
            'data' => $category
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {             
        // $this -> middleware('auth:api');      

        File::delete('uploads/'.$category->gambar);
        $category -> delete();

        return response() -> json([
            'success'=> true,
            'message' => 'success'
        ]);
    }
}
