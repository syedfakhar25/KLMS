<?php

namespace App\Http\Controllers;

use App\Models\premesis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PremesisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $premises = premesis::all();

        return response()->json(
            ['premises' => $premises],
            200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json(
            ['premises' => $request->all()],
            200);
        $premise = premesis::create($request->all());
        if ($request->hasFile('image')) {
              // Get the image file from the request
            $image = $request->file('image');
            $imagePath = 'images/premises'; 
            
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            $image->move(public_path($imagePath), $imageName);
            
            $imageURL = url($imagePath . '/' . $imageName);
            
            $premise->update(['image' => $imageURL]);
        }
        return response()->json(
            ['premises' => $premise],
            200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $premise = premesis::find($id);

        return response()->json(
            ['premise' => $premise],
            200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $premise= premesis::find($id);
         $premise->update($request->all());

        return response()->json(
            ['premise' => $premise],
            200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $premise= premesis::find($id);
        $premise->delete();

        return response()->json(['message' => 'Premise deleted successfully']);

    }
}
