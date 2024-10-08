<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\controller;

use App\Models\Department;
use App\Http\Requests\DepartmentRequest;
use Session;


class DepartmentController extends Controller
{
    public function index()
    {
         $departments = Department::all();  
         return response()->json(['data' => $departments], 200); // Status code OK
         //return view('departments.index', compact('departments'));
    }

//     public function create()
//     {
//         // $departments = Department::all();
//         $departments = Department::all();  
//          return view('Departments.create', compact('departments'));
//     }


    public function store(DepartmentRequest $request)
    {
         $department  = Department::create($request->all());


         return response()->json(['data' => $department], 201); // Status code created
     //     Session::flash('message', 'Your Book Has Been Created Successfully'); 
     //     return redirect('departments');
    }


    

}
