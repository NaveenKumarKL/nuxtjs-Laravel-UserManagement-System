<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;



class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Employee = Employee::all()->jsonSerialize();
        return response()->json($Employee);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {




        $user = $request->file('image')->getClientOriginalName();
        $fileName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('upload'), $fileName);
        print_r($fileName);



        $latest = Employee::latest()->first();

        if (!$latest) {
            $receipt = 'ZE0001';
        } else {
            $string = preg_replace("/[^0-9\.]/", '', $latest->employeeid);
            $receipt = 'ZE' . sprintf('%04d', $string + 1);
        }



        // $request->file->move(public_path('upload'), $fileName);

        Employee::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'joindate' => $request->joindate,
            'employeeid' => $receipt,
            'phone' => $request->phone,
            'status' => $request->status,
            'image' => $user,
            'renumuration' => $request->renumuration,
            'address' => $request->address,


        ]);
        // return response()->json('The Employee data created successfully');
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
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Employee = Employee::find($id);
        return response()->json($Employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $Employee = Employee::find($id);
        $Employee->update($request->all());

        return response()->json('The Service successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Employee = Employee::find($id);
        $Employee->delete();
        return response()->json('The  Service successfully deleted');
    }
}