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
        return view('admin.student', ['students' => $students]);
    }

}
