<?php

namespace App\Http\Controllers;

use App\Models\Herd;
use Illuminate\Http\Request;

class HerdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $herd = Herd::all();
        return response()->json(
            ['herd' => $herd],
            200);
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

        $items = $request->input();  
        $herd = [];
    
        foreach ($items['premesis_id'] as $index => $premesisId) {
            $newHerd = Herd::create([
                'premesis_id' =>  $items['premesis_id'][$index],
                'name' => $items['name'][$index],
                'quantity' => $items['quantity'][$index],
            ]);
            $herd[] = $newHerd;
        }
    
        return response()->json(
            ['herd' => $herd],
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
        $herd = Herd::find($id);

        return response()->json(
            ['herd' => $herd],
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
        $herd= Herd::find($id);
        $herd->update($request->all());

        return response()->json(
            ['herd' => $herd],
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
        $ownership= Herd::find($id);
        $ownership->delete();

        return response()->json(['message' => 'Herd deleted successfully']);
    }
}
