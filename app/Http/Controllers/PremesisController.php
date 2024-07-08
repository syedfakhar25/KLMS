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
        $premesis = Premesis::all();
        if ($user->role_id == 1) {
            $premesis = $premesis = $premesis->where(['is_approved'=> 1 ]);;
        } elseif($user->role_id == 2){
            $premesis = $premesis->where(['user_id'=> $user->user_id]);
        } elseif($user->role_id == 3){
            $premesis = $premesis->where(['district'=> $user->district,'is_approved'=> 1]);
        } elseif($user->role_id == 4){
            $premesis = $premesis->where(['tehsil'=> $user->tehsil,'is_approved'=> 1]);
        } elseif($user->role_id == 5){
            $premesis = $premesis->where(['uc'=> $user->uc,'is_approved'=> 1]);
        } elseif($user->role_id == 6){
            $premesis = $premesis->where(['village'=> $user->village,'is_approved'=> 1]);
        }      
    
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
        if($user->role_id){ 
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
