<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teachers;
use App\Models\Subjects;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    //

    function displayTeacher(){
        $teachers = Teachers::all();
        $teacher_id = Teachers::find(3);
        $subjects = Subjects::all();
        return view('admin.teacher', ['teach' => $teachers , 'teacherId' => $teacher_id , 'sub' => $subjects]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tea_fname' => 'required',
            'tea_username' => 'required|unique:teachers',
            'tea_gender' => 'required',
            'tea_subject' => 'required',
            'tea_ph_number' => 'required',
            'tea_dob' => 'required|date',
            'tea_password' => 'required|min:6'
        ]);

        Teachers::create([
            'tea_fname' => $request->tea_fname,
            'tea_gender' => $request->tea_gender,
            'tea_subject' => $request->tea_subject,
            'tea_username' => $request->tea_username,
            'tea_dob' => $request->tea_dob,
            'tea_ph_number' => $request->tea_ph_number,
            'tea_password' => Hash::make('default123')
        ]);
        return redirect()->route('admin.teacher')
            ->with('success', 'Teacher created successfully.');
    }

    public function updateTeacher(Request $request, $id ){
        $validated = $request->validate([
            'tea_fname' => 'required',
            'tea_username' => 'required|unique:teachers',
            'tea_gender' => 'required',
            'tea_subject' => 'required',
            'tea_ph_number' => 'required',
            'tea_dob' => 'required|date',
            'tea_password' => 'required|min:6'
        ]);

        $teachers = Teachers::findOrfail($id);

        $updateTeacher = [
            'tea_fname' => $request->tea_fname ,
            'tea_username' => $request->tea_username,
            'tea_gender' => $request->tea_gender,
            'tea_subject' => $request->tea_subject,
            'tea_ph_number' => $request->tea_ph_number,
            'tea_dob' => $request->tea_dob,
            'tea_password' => $request->tea_password
        ];
        $teachers->update($updateTeacher);

        return redirect()->route('admin.teacher')
            ->with('success', 'Teacher updated successfully');


    }


}
