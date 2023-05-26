<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
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
    public function list()
    {
        $sliders = Slider::all(); 

        return view('slider.index',compact('sliders'));
    }
   
   
     public function index()
    {
        $slider = Slider::all();
        return response() -> json([
            'data' => $slider
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
            'nama_slider' => 'required',
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

        $slider = Slider::create($input);

        return response()->json([ 
            'success'=> true,
            'message' => 'success',
            'data' => $slider
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        return response()->json([
            'success'=> true,
            'message' => 'success',
            'data'=>$slider
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        $validator = validator::make($request->all(),[
            'nama_slider' => 'required',
            'deskripsi' => 'required',

        ]);

        if ($validator->fails()){
            return response()->json(
                $validator->errors(),422
            );
        }

        $input = $request->all();

        if($request->has('gambar')){
            File::delete('uploads/'. $slider->gambar);
            $gambar = $request->file('gambar');
            $nama_gambar = time() . rand(1,9) . '.' . $gambar->getClientOriginalExtension();
            $gambar->move('uploads',$nama_gambar);
            $input['gambar'] = $nama_gambar;
        }else{
            unset($input['gambar']);
        }

        $slider -> update($input);

        return response()->json([
            'success'=> true,
            'message' => 'success',
            'data' => $slider
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {                   

        File::delete('uploads/'.$slider->gambar);
        $slider -> delete();

        return response() -> json([
            'success'=> true,
            'message' => 'success'
        ]);
    }
}
