<?php

namespace App\Http\Controllers;

use App\Models\Owenership;
use Illuminate\Http\Request;

class OwnershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ownership = Owenership::all();

        return response()->json(
            ['ownership' => $ownership],
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

        $ownership = Owenership::create($request->all());
        // dd($ownership);
        return response()->json(
            ['ownership' => $ownership],
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
        $ownership = Owenership::where('premesis_id', $id)
        ->orderBy('created_at', 'desc') 
        ->get();
        return response()->json([
            $id => ['ownership' => $ownership]
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
        $ownership = Owenership::find($id);
        $ownership->update($request->all());

        return response()->json(
            ['ownership' => $ownership],
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
        $ownership = Owenership::find($id);
        $ownership->delete();

        return response()->json(['message' => 'Ownership deleted successfully']);
    }
}
