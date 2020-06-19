<?php

namespace App\Http\Controllers;

use App\contractor;
use Illuminate\Http\Request;

class ContractorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contractor = contractor::all()->jsonSerialize();
        return response()->json($contractor);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'contractorname' => ['required'],
            'address' => ['required'],
            'phone' => ['required'],
            'contractfrom' => ['required'],

        ]);

        $latest = contractor::latest()->first();

        if (!$latest) {
            $receipt = 'ZO0001';
        } else {
            $string = preg_replace("/[^0-9\.]/", '', $latest->oid);

            $receipt = 'ZO' . sprintf('%04d', $string + 1);
        }

        contractor::create([
            'contractorname' => $request->contractorname,
            'oid' => $receipt,
            'address' => $request->address,
            'phone' => $request->phone,
            'contractfrom' => $request->contractfrom

        ]);
        return response()->json('The contractor name created successfully');
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
     * @param  \App\contractor  $contractor
     * @return \Illuminate\Http\Response
     */
    public function show(contractor $contractor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\contractor  $contractor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contractor = contractor::find($id);
        return response()->json($contractor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\contractor  $contractor
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $contractor = contractor::find($id);
        $contractor->update($request->all());

        return response()->json('The contractor successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\contractor  $contractor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contractor = contractor::find($id);
        $contractor->delete();
        return response()->json('The  contractor successfully deleted');
    }
}