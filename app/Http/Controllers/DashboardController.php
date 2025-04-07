<?php

namespace App\Http\Controllers;
use App\Models\Teachers;
use App\Models\Students;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    // Sample: Get teacher gender count
    $totalTeachers = Teachers::count();
    $totalStudents = Students::count();
    $maleTeachers = Teachers::where('tea_gender', 'Male')->count();
    $femaleTeachers = Teachers::where('tea_gender', 'Female')->count();

    // Sample: Get student gender count
    $maleStudents = Students::where('stu_gender', 'Male')->count();
    $femaleStudents = Students::where('stu_gender', 'Female')->count();

    // Pass data to view
    return view('admin.dashboard', [
        'teacherGender' => [$maleTeachers, $femaleTeachers],
        'studentGender' => [$maleStudents, $femaleStudents],
        'totalTeachers' => $totalTeachers,
        'totalStudents' => $totalStudents,
        'maleTeachers' => $maleTeachers,
        'femaleTeachers' => $femaleTeachers,
        'maleStudents' => $maleStudents,
        'femaleStudents' => $femaleStudents,
    ]);
}

}
