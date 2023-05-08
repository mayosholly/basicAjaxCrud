<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index(){
        return view('student/index');
    }

    public function fetchStudent(){
        $students = Student::all();
        return response()->json([
            'students' => $students 
        ]);
    }


    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'course' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }else{
            $student = new Student($validator->validated());
            $student->save();
            return response()->json([
                'status' => 200,
                'message' => 'Successfully added'
            ]);
        }
    }

    public function edit(Student $student){
        if($student){
            return response()->json([
                'status' => 200,
                'student' => $student
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Student not found'
            ]);
        }
     
    }

    public function update(Student $student, Request $request){
        if($student){
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'course' => 'required',
            ]);
    
            if($validator->fails()){
                return response()->json([
                    'status' => 400,
                    'errors' => $validator->messages()
                ]);
            }else{
                $student->update($validator->validated());
                $student->save();
                return response()->json([
                    'status' => 200,
                    'message' => 'Successfully Updated'
                ]);
            }
        }
    }

    public function destroy(Student $student){
        if($student){
            $student->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Successfully Deleted'
            ]);
        }
    }
}
