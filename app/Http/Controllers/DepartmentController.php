<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Department;
use App\Models\Book;
use App\Http\Requests\DepartmentRequest;
use Session;


class DepartmentController extends Controller
{
    public function index()
    {
         $departments = Department::all();  
         return view('departments.index', compact('departments'));
       // View::share('$departments', '$departments->name');
    }

//////////////////////////
    public function create()
    {
        // $departments = Department::all();
        $departments = Department::all();  

         return view('Departments.create', compact('departments'));
    }



    public function store(DepartmentRequest $request)
    {
         //dd($request->all());
         $department  = Department::create($request->all());
         //dd($department);
         Session::flash('message', 'Your Book Has Been Created Successfully'); 
         return redirect('departments');
    }


    

}
