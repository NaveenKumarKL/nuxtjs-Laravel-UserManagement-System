<?php

namespace App\Http\Controllers;

use App\client;
use Illuminate\Http\Request;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = client::all()->jsonSerialize();
        return response()->json($client);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'companyname' => ['required'],
            'poc' => ['required'],
            'address' => ['required'],
            'phone' => ['required'],
            'servicename' => ['required'],
            'themename' => ['required'],
            'licencecode' => ['required'],
            'renewaldate' => ['required'],

        ]);

        $latest = client::latest()->first();

        if (!$latest) {
            $receipt = 'ZC0001';
        } else {
            $string = preg_replace("/[^0-9\.]/", '', $latest->cid);

            $receipt = 'ZC' . sprintf('%04d', $string + 1);
        }

        client::create([
            'companyname' => $request->companyname,
            'poc' => $request->poc,
            'cid' => $receipt,
            'address' => $request->address,
            'phone' => $request->phone,
            'servicename' => $request->servicename,
            'themename' => $request->themename,
            'licencecode' => $request->licencecode,
            'renewaldate' => $request->renewaldate,

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
     * @param  \App\client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = client::find($id);
        return response()->json($client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\client  $client
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $client = client::find($id);
        $client->update($request->all());

        return response()->json('The Service successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = client::find($id);
        $client->delete();
        return response()->json('The  client successfully deleted');
    }
}