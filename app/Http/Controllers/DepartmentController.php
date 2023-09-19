<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return response()->json($departments);
    }

    public function store(Request $request)
    {
        $rules = ['name' => 'required|string|min:1|max:100'];
        $validator = Validator::make($request->input(), $rules);


        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }
        $department = new Department($request->input());
        $department->save();
        return response()->json([
            'status' => true,
            'errors' => 'Department created duccessfully'
        ], 200);
    }

    public function show(Department $department)
    {
        return response()->json(['status' => true,'data' => $department]);
    }

    public function update(Request $request, Department $department)
    {
        $rules = ['name' => 'required|string|min:1|max:100'];
        $validator = Validator::make($request->input(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }
        $department->update($request->input());
        return response()->json([
            'status' => true,
            'errors' => 'Department update duccessfully'
        ], 200);
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return response()->json([
            'status' => true,
            'errors' => 'Department deleted duccessfully'
        ], 200);
        
    }
}