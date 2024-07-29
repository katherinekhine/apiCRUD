<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Student::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
        ], [
            'required' => "You need to fill :attribute,"
        ]);
        if ($validated->fails()) {
            return response()->json($validated->messages());
        } else {
            $student = Student::create($request->all());
            return response()->json($student);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return response()->json($student, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
        ], [
            'required' => "You must fill the update :attribute",
        ]);
        if ($validated->fails()) {
            return response()->json($validated->messages());
        } else {
            $student->update($request->all());
            return response()->json($student);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return response()->json('success');
    }
}
