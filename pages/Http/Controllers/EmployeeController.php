<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
// use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;



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

        $image = request()->file('image');
        $imageName = $image->getClientOriginalName();
        $imageName = time() . '_' . $imageName;
        $image->move(public_path('/images'), $imageName);
        print_r($imageName);

        $latest = Employee::latest()->first();
        print_r($latest);

        if (!$latest) {
            $receipt = 'ZE0001';
        } else {
            $string = preg_replace("/[^0-9\.]/", '', $latest->employeeid);
            $receipt = 'ZE' . sprintf('%04d', $string + 1);
        }
        Employee::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'joindate' => $request->joindate,
            'employeeid' => $receipt,
            'phone' => $request->phone,
            'status' => $request->status,
            'image' => 'images/' . $imageName,
            'renumuration' => $request->renumuration,
            'address' => $request->address,


        ]);
        return response()->json('The Employee data created successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
        $Employee = Employee::find($id);
        // $Employee->update($request->status);
        $update = 'Terminated';
        // DB::table('employees')->where('id', $Employee->id)->update(['status', $update]);
        if ($Employee) {
            $Employee->status =  $update;
            $Employee->save();
        }

        return $Employee;
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

        // to delete photo

        $currentPhoto = $Employee->image;

        if (file_exists($currentPhoto)) {

            @unlink($currentPhoto);
        }

        // This is like $request->all except it doesn't set the avatar
        // You "fill" the new data so that it doesn't call save yet.
        $Employee->fill($request->except('image'));

        // If there is a file, we set the avatar
        if ($request->file('image')) {

            $image = request()->file('image');
            $imageName = $image->getClientOriginalName();
            $imageName = time() . '_' . $imageName;
            $image->move(public_path('/images'), $imageName);
            print_r($imageName);



            $Employee->image = 'images/' . $imageName;
        }

        // Then we just save
        $Employee->save();
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

        $currentPhoto = $Employee->image;



        if (file_exists($currentPhoto)) {

            @unlink($currentPhoto);
        }

        return [
            'message' => 'Data deleted successfully'
        ];
    }
}