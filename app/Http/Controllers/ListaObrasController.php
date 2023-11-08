<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obras;
use App\Models\Employee;

class ListaObrasController extends Controller
{
    public function showEmployeesForObra($obraId)
    {
        $obra = Obras::find($obraId);

        $employees = $obra->employee;

        echo $employees;
       // dd($employees);
    }

    public function showObraForEmloyees($employeeId)
    {
        $employee = Employee::find($employeeId);

        $obras = $employee->obras;

        return view('site.Obras',compact('obras'));
       // dd($employees);
    }

}
