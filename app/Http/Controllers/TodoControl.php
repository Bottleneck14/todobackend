<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoControl extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=Todo::where('email',Auth::user()->email)->get();

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=[
            'status'=>'false',
            'daftar'=>$request->daftar,
            'email'=>Auth::user()->email
        ];

        Todo::create($data);

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data=Todo::find($id);

        $data->status=$request->status;

        $data->save();

        return response()->json([
            'message'=>'data di edit'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data=Todo::find($id);

        $data->delete();

        return response()->json([
            'message'=>'data di hapus'
        ]);
    }
}
