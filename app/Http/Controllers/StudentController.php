<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Scores;
use Illuminate\Http\Request;
use App\Models\Students;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function showLoginForm()
    {
        return view('login_student');
    }

    public function studentLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        $student = Students::where('stu_username', $username)->first();

        // Changed to direct password comparison since passwords are not hashed
        if (!$student || $password !== $student->stu_password) {
            return redirect()->back()
                ->with('error', 'Username or Password is incorrect');
        }

        // Store student data in session
        $request->session()->put('student', $student);

        // Redirect to student dashboard
        return redirect()->route('student.dashboard');
    }

    public function dashboard()
    {
        // Check if student is logged in
        if (!session('student')) {
            return redirect()->route('student.login');
        }

        $student = session('student');
        $showStudent = Students::join('grade', 'students.stu_gra_id', '=', 'grade.gra_id')
            ->where('stu_id', $student->stu_id)
            ->first();
        return view('student.dashboard', ['student' => $student , 'showStudent' => $showStudent]);
    }

    public function displayCourseStudent()
    {
        if (!session('student')) {
            return redirect()->route('student.login');
        }

        $student = session('student');
        $courses = Students::displayStudentById($student->stu_id);

        return view('student.courses.subject', [
            'student' => $student,
            'course' => $courses
        ]);
    }

    public function displayStudentSocre(){
        if (!session('student')) {
            return redirect()->route('student.login');
        }
        $student = session('student');
        $score =  Scores::getAllScoresByStudent($student->stu_id);

        return view('student.score', ['score' => $score, 'student' => $student]);
    }
}
