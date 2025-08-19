<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Student;



class studentController extends Controller
{
    // list all students
    public function index()
    {
        $students = Student::all();

        if ($students->isEmpty()) {
            $data = [
                'message' => 'No students found',
                'status' => 404
            ];
            return response()->json($data, 200);
        }
        return response()->json($students, 200);
    }

    // crerate student
    public function create(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:students',
            'phone' => 'required|string',
            'language' => 'required|in:English,Spanish,French,Portuguese',

        ]);

        if ($validate->fails()) {
            $data = [
                'message' => 'Invalid data',
                'errors' => $validate->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }

        $student = Student::create($request->all());
        if (!$student) {
            $data = [
                'message' => 'Error creating student',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'message' => 'Student created',
            'status' => 201,
            'student' => $student
        ];
        return response()->json($data, 201);
    }

   
}
