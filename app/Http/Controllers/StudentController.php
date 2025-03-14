<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    //
     function displayStudent()
    {
        $students = Student::all();
        $student = Student::where('stu_id', 1)->first(); // Or any specific student you want to edit
        return view('admin.student', ['students' => $students , 'student' => $student ]);
    }
    public function storeStudent(Request $request)
    {
        $validated = $request->validate([
            'stu_fname' => 'required',
            'stu_username' => 'required',
            'stu_gender' => 'required',
            'stu_grade' => 'required',
            'stu_group' => 'required',
            'stu_ph_number' => 'required',
            'stu_parent_number' => 'required',
            'stu_profile' => 'required',
            'stu_dob' => 'required|date',
            'stu_password' => 'required|min:6'
        ]);

        Student::create([
            'stu_fname' => $request->stu_fname,
            'stu_username' => $request->stu_username,
            'stu_grade' => $request->stu_grade,
            'stu_group' => $request->stu_group,
            'stu_ph_number' => $request->stu_ph_number,
            'stu_parent_number' => $request->stu_parent_number,
            'stu_profile' => $request->stu_profile,
            'stu_dob' => $request->stu_dob,
            'stu_gender' => $request->stu_gender,
            'stu_password' => Hash::make('default123')
        ]);
        return redirect()->route('admin.student')
            ->with('success', 'Student created successfully.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'stu_fname' => 'required',
            'stu_username' => 'required|unique:students,stu_username,'.$id.',stu_id',
            'stu_gender' => 'required',
            'stu_grade' => 'required',
            'stu_group' => 'required',
            'stu_ph_number' => 'required',
            'stu_parent_number' => 'required',
            'stu_dob' => 'required|date'
        ]);

        $student = Student::findOrFail($id);
        
        $updateData = [
            'stu_fname' => $request->stu_fname,
            'stu_username' => $request->stu_username,
            'stu_gender' => $request->stu_gender,
            'stu_grade' => $request->stu_grade,
            'stu_group' => $request->stu_group,
            'stu_ph_number' => $request->stu_ph_number,
            'stu_parent_number' => $request->stu_parent_number,
            'stu_dob' => $request->stu_dob
        ];

        if ($request->hasFile('stu_profile')) {
            $updateData['stu_profile'] = $request->file('stu_profile')->store('profiles', 'public');
        }

        $student->update($updateData);

        return redirect()->route('admin.student')
            ->with('success', 'Student updated successfully.');
    }
}
