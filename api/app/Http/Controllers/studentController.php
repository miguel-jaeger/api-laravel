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
            'name' => 'required|max:255',
            'email' => 'required|email|unique:students',
            'phone' => 'required|digits:10',
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

    // show student
    public function show($id)
    {

        $student = Student::find($id);
        if (!$student) {
            $data = [
                'message' => 'Student not found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'student' => $student,
            'status' => 200
        ];
        return response()->json($student, 200);
    }

    // delete student
    public function delete($id)
    {
        $student = Student::find($id);
        if (!$student) {
            $data = [
                'message' => 'Student not found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $student->delete();
        $data = [
            'message' => 'Student deleted',
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    // update student
    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Student not found',
                'status' => 404
            ], 404);
        }

        // Validación (ignora el email del mismo registro)
        $validate = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:students,email,' . $id,
            'phone' => 'required|digits:10',
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

        // Actualizar datos
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->language = $request->language;
        $student->save();

        return response()->json([
            'message' => 'Student updated',
            'status' => 200,
            'student' => $student
        ], 200);
    }

    // update partials
    public function updatePartials(Request $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            $data = [
                'message' => 'Student not found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        // Validación
        $validate = Validator::make($request->all(), [
            'name' => 'max:255',
            'email' => 'email|unique:students,email,' . $id,
            'phone' => 'digits:10',
            'language' => 'in:English,Spanish,French,Portuguese',
        ]);

        if ($validate->fails()) {
            $data = [
                'message' => 'Invalid data',
                'errors' => $validate->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if($request->has('email')) {
            $student->email = $request->email;
        }

        if($request->has('name')) {
            $student->name = $request->name;
        }

        if($request->has('phone')) {
            $student->phone = $request->phone;
        }

        if($request->has('language')) {
            $student->language = $request->language;
        }

        $student->save();

        $data = [
            'message' => 'Student updated',
            'status' => 200,
            'student' => $student
        ];
        return response()->json($data, 200);
       
    }
}
