<?php

namespace App\Http\Controllers;

use App\associate;
use Illuminate\Http\Request;

class AssociateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $associate = associate::all()->jsonSerialize();
        return response()->json($associate);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'associatename' => ['required'],
            'address' => ['required'],
            'phone' => ['required'],
            'associatefrom' => ['required'],
        ]);

        $latest = associate::latest()->first();

        if (!$latest) {
            $receipt = 'ZA0001';
        } else {
            $string = preg_replace("/[^0-9\.]/", '', $latest->aid);

            $receipt = 'ZA' . sprintf('%04d', $string + 1);
        }

        associate::create([
            'associatename' => $request->associatename,
            'aid' => $receipt,
            'address' => $request->address,
            'phone' => $request->phone,
            'associatefrom' => $request->associatefrom


        ]);
        return response()->json('The client name created successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\associate  $associate
     * @return \Illuminate\Http\Response
     */
    public function show(associate $associate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\associate  $associate
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $associate = associate::find($id);
        return response()->json($associate);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\associate  $associate
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $associate = associate::find($id);
        $associate->update($request->all());

        return response()->json('The associate successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\associate  $associate
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $associate = associate::find($id);
        $associate->delete();
        return response()->json('The  associate successfully deleted');
    }
}