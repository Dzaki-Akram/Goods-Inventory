<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{

    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }


    public function create()
    {
        return view('employees.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name_employee' => 'required|string|max:100',
            'age' => 'required|integer',
            'position' => 'required|string|max:100',
            'salary' => 'required|numeric|min:0'
        ]);

        Employee::create($request->all());

        return redirect()->route('employees.index')->with('message', 'Employee added successfully.');
    }


    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.create', compact('employee'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name_employee' => 'required|string|max:100',
            'age' => 'required|integer',
            'position' => 'required|string|max:100',
            'salary' => 'required|numeric|min:0'
        ]);

        $employee = Employee::findOrFail($id);
        $employee->update($request->all());

        return redirect()->route('employees.index')->with('message', 'Employee updated successfully.');
    }


    public function destroy($id)
    {
        Employee::destroy($id);
        return redirect()->route('employees.index')->with('message', 'Employee deleted successfully.');
    }
}
