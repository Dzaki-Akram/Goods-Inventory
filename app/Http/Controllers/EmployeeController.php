<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    // tampilkan data
    public function index()
    {
        return response()->json(Employee::all());
    }

    // store penyimpanan data employee
    public function store(Request $request)
    {
        $request->validate([
            'name_employee' => 'required|string|max:100',
            'age' => 'required|integer',
            'position' => 'required|string|max:100',
            'salary' => 'required|numeric|min:0'
    ]);

    $employee = Employee::create([
        'name_employee' => $request->name_employee,
        'age' => $request->age,
        'position' => $request->position,
        'salary' => $request->salary,

    ]);

    return response()->json([
        'Message' => 'Employee data saved successfully',
        'Employee' => $employee
    ], 201);

    }

    // destroy data employee per id
    public function destroy($id)
    {
        Employee::destroy($id);
        return response()->json(['messsage' => 'Employee data has been successfully deleted']);
    }

    // update data employee berdasarkan id
    public function update(Request $request, $id) {

        // validasi input
        $request->validate([
            'name_employee' => 'required|string|max:100',
            'age' => 'required|integer',
            'position' => 'required|string|max:100',
            'salary' => 'required|numeric|min:0'
        ]);

        // cari employee berdasarkan id
        $employee = Employee::find($id);
        if(!$employee) {
            return response()->json([
                'messsage' => 'Data not found',
            ], 404);
        }

        // update data employee
        $employee->update([
            'name_employee' => $request->name_employee,
            'age' => $request->age,
            'position' => $request->position,
            'salary' => $request->salary,
        ]);

        return response()->json([
            'messsage' => 'Employee data updated successfully',
            'Employee' => $employee,
        ],200);
    }
}