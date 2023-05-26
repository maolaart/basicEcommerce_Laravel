<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{

    public function __construct()
    {
        $this -> middleware('auth:api')->except(['index']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $review = Review::all();
        return response() -> json([
            'data' => $review
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
            'id_produk' => 'required',
            'review' => 'required',
            'rating' => 'required',

        ]);

        if ($validator->fails()){
            return response()->json(
                $validator->errors(),422
            );
        }

        $input = $request->all();
        $review = Review::create($input);

        return response()->json([ 
            'data' => $review
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        return response()->json([
            'data'=>$review
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        $validator = validator::make($request->all(),[
            'id_member' => 'required',
            'id_produk' => 'required',
            'review' => 'required',
            'rating' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json(
                $validator->errors(),422
            );
        }

        $input = $request->all();
        $review -> update($input);

        return response()->json([
            'message' => 'success',
            'data' => $review
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {                   
        $review -> delete();

        return response() -> json([
            'message' => 'success'
        ]);
    }
}
