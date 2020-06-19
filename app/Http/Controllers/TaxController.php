<?php

namespace App\Http\Controllers;

use App\tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tax = tax::all()->jsonSerialize();
        return response()->json($tax);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'cgst' => ['required'],
            'sgst' => ['required'],
            'igst' => ['required'],

        ]);

        tax::create([
            'cgst' => $request->cgst,
            'sgst' => $request->sgst,
            'igst' => $request->igst,

        ]);
        return response()->json('The tax name created successfully');
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
     * @param  \App\tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function show(tax $tax)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tax = tax::find($id);
        return response()->json($tax);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $tax = tax::find($id);
        $tax->update($request->all());

        return response()->json('The tax successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tax = tax::find($id);
        $tax->delete();
        return response()->json('The tax successfully deleted');
    }
}