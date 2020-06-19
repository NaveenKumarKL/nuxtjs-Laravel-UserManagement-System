<?php

namespace App\Http\Controllers;

use App\invoice;
use App\client;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoice = invoice::all()->jsonSerialize();
        return response()->json($invoice);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $latest = invoice::latest()->first();
        $year = date('y');


        if (!$latest) {
            $receipt = 'ZTI' . $year . '0001';
            print_r($receipt);
        } else {
            $string = preg_replace("/[^0-9\.]/", '', $latest->invoicenumber);

            $receipt = 'ZTI' . sprintf('%04d', $string + 1);
        }

        invoice::create([
            'clientid' => $request->clientid,
            'invoicetype' => $request->invoicetype,
            'invoicenumber' => $receipt,
            'paymenttype' => $request->paymenttype,
            'paymentstatus' => $request->paymentstatus,
            'totalamount' => $request->totalamount,
            'dueamount' => $request->dueamount,
            'status' => $request->status,


        ]);
        return response()->json('The invoice  created successfully');
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
     * @param  \App\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = client::find($id);
        return response()->json($client);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice = invoice::find($id);
        return response()->json($invoice);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoice $invoice)
    {
        //
    }
}