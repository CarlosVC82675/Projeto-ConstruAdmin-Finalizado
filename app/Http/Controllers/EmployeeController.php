<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Obras;

class EmployeeController extends Controller
{

    public function showHierarchy($id) {
        $employee = Employee::find($id);
        $subordinates = $employee->subordinates;

        return view('employee',compact('subordinates'));
    }

    public function assignRole($EmployeeId, $ObrasId)
    {
        $employee = Employee::find($EmployeeId);
        $obra = Obras::find($ObrasId);

        if ($employee && $obra) {
            $employee->obras()->attach($obra->id);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
