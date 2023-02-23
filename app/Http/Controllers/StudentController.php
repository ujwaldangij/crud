<?php

namespace App\Http\Controllers;

use App\Models\student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    //
    public function index()
    {
        return view('curd');
    }
    public function show()
    {
        try {
            $stu = student::all();
            if ($stu->collect()->count() <= 0) {
                return response()->json("No record found", 404);
            }
            return response()->json($stu, 200);
        } catch (\Throwable $e) {
            return response()->json($e->getMessage(),500);
        }
    }
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => ["required","min:3"],
            "email" => ["required","email","unique:students,email"]
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),400);
        }

        try {
            $stu = new student();
            $stu->name = $request->name;
            $stu->email = $request->email;
            $stu->save();
            if (!$stu) {
                return response()->json("Record Not Inserted",500);
            }
            return response()->json('Record Inserted',200);
        } catch (\Throwable $e) {
            return response()->json($e->getMessage(),500);
        }
    }
    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name_edit" => ["required","min:3"],
            "email_edit" => ["required","email"]
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),400);
        }

        try {
            $stu = student::where('id',$request->id_edit)->update([
                'name' => $request->name_edit,
                'email' => $request->email_edit,
            ]);
            if (!$stu) {
                return response()->json("Record Not Updated",500);
            }
            return response()->json('Record Updated',200);
        } catch (\Throwable $e) {
            return response()->json($e->getMessage(),500);
        }
    }
    public function delete(Request $request)
    {
        try {
            $stu = student::find($request->id)->delete();
            if (!$stu) {
                return response()->json("Record Not Deleted",500);
            }
            return response()->json('Record Deleted',200);
        } catch (\Throwable $e) {
            return response()->json($e->getMessage(),500);
        }
    }
}
