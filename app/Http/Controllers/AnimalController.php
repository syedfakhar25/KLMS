<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animal = Animal::all();

        return response()->json(
            ['animal' => $animal],
            200
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  dd('here');

        $animal = Animal::create($request->all());

        if ($request->hasFile('image')) {
            // Get the image file from the request
            $image = $request->file('image');
            $imagePath = 'images/animal';

            $imageName = time() . '_' . $image->getClientOriginalName();

            $image->move(public_path($imagePath), $imageName);

            $imageURL = url($imagePath . '/' . $imageName);

            $animal->update(['image' => $imageURL]);
        }
        // dd($animal);
        return response()->json(
            ['animal' => $animal],
            200
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
 
        $animal = Animal::where('premesis_id', $id)->get();
        return response()->json([
            $id => ['herd' => $animal]
        ], 200);
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
        $animal = Animal::find($id);
        $animal->update($request->all());

        return response()->json(
            ['animal' => $animal],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $animal = Animal::find($id);
        $animal->delete();

        return response()->json(['message' => 'Animal deleted successfully']);
    }
}
