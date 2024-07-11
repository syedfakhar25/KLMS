<?php

namespace App\Http\Controllers;

use App\Models\Premesis;
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
        $user = Auth::user();
        $premesisQuery = Premesis::query();
        if ($user->role_id == 1) {
            // $premesisQuery->where('is_approved', 0);
        } elseif ($user->role_id == 2) {
            $premesisQuery->where('user_id', $user->id);  // assuming `user_id` is the primary key and not `user_id`
        } elseif ($user->role_id == 3) {
            $premesisQuery->where('district', $user->district)
                          ->where('is_approved', 1);
        } elseif ($user->role_id == 4) {
            $premesisQuery->where('tehsil', $user->tehsil)
                          ->where('is_approved', 1);
        } elseif ($user->role_id == 5) {
            $premesisQuery->where('uc', $user->uc)
                          ->where('is_approved', 1);
        } elseif ($user->role_id == 6) {
            $premesisQuery->where('village', $user->village)
                          ->where('is_approved', 1);
        }
        $premesis = $premesisQuery->get();
        return response()->json(
            ['premises' => $premesis],
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $premise = Premesis::create($request->all());
        $user = Auth::user();
        if($user->role_id!=2){ 
            $premise->is_approved = true;
        }
        $premise->save();
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
        $premise = Premesis::find($id);

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
         $premise= Premesis::find($id);
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
        $premise= Premesis::find($id);
        $premise->delete();

        return response()->json(['message' => 'Premise deleted successfully']);

    }
}
