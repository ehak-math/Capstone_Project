<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Scores;
use Illuminate\Http\Request;
use App\Models\Attendances;
use App\Models\Attendancesubmit;
use App\Models\Students;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
    public function submitAtt($id)
    {
        if (!session('student')) {
            return redirect()->route('student.login');
        }
        
        $student = session('student');
        $currentTime = Carbon::now('Asia/Phnom_Penh');
        
        // Get active attendance for the course
        $attendance = Attendances::join('courses', 'attendances.att_cou_id', '=', 'courses.cou_id')
            ->where('attendances.att_cou_id', $id)
            // ->where('attendances.att_status', 'Open')
            // ->whereDate('attendances.att_startime', $currentTime->toDateString())
            
            ->first();
        
        $selectAttSub = Attendancesubmit::join('students', 'attendance_submit.att_sub_stu_id', '=', 'students.stu_id')
            ->where('students.stu_id', $student->stu_id)
            ->orderBy('attendance_submit.att_sub_id', 'desc')
            ->select('attendance_submit.*', 'students.*')
            ->first();
            
        // Check if student already submitted attendance
        // if ($attendance->count() > 0) {
        //     foreach ($attendance as $att) {
        //         $existingSubmission = Attendancesubmit::where('att_sub_stu_id', $student->stu_id)
        //             ->where('att_sub_att_id', $att->att_id)
        //             ->first();

        //         if ($existingSubmission) {
        //             $att->already_submitted = true;
        //         } else {
        //             $att->already_submitted = false;
        //         }
        //     }
        // }

        return view('student.courses.submit_attendance', [
            'getId' => $id,
            'attendanceSub' => $attendance,
            'student' => $student,
            'selectAttSub' => $selectAttSub
        ]);
    }

    public function subAttendance(Request $request)
    {
        if (!session('student')) {
            return redirect()->route('student.login');
        }
        try {

            $request->validate([
                'code_sub' => 'required',            
                'cou_id' => 'required',            
                'att_id' => 'required', 
                'att_start' => 'required',
                'att_end' => 'required',
                'att_sub_id' => 'required',          
            ]);

            $student = session('student');
            
            // Check if student already submitted attendance
            $existingSubmission = Attendancesubmit::where('att_sub_stu_id', $student->stu_id)
                ->where('att_sub_att_id', $request->att_id)
                ->first();
            $startTime = $request->att_start;
            $endTime = $request->att_end;
            $currentTime = Carbon::now('Asia/Phnom_Penh');

            // $status =  checkAttendanceStatus($startTime, $endTime, $currentTime); // "Present";
            // if ($currentTime->between($startTime, $endTime)) {
                $status =  "Present";
                DB::table('attendance_submit')
                ->where('att_sub_id', $request->att_sub_id)
                ->update([
                    'att_sub_code' => $request->code_sub,
                    'att_sub_time' =>$currentTime ,
                    'att_sub_status' => $status,
                    'att_sub_stu_id' => $student->stu_id,
                    'att_sub_att_id' => $request->att_id,
                ]);
            // } else if ($currentTime->greaterThan($endTime)) {
            //     $status =  "Late";
            // } else {
            //     $status =  "Absent";
            // }
                
            // if ($existingSubmission) {
            //     throw new \Exception('You have already submitted attendance for this session');
            // }

            // Verify attendance code and status
            // $attendance = Attendances::where('att_id', $request->att_id)
            //     ->where('att_code', $request->code_sub)
            //     ->where('att_status', 'Open')
            //     ->first();

            // if (!$attendance) {
            //     throw new \Exception('Invalid attendance code or attendance session is closed');
            // }

            // Create attendance submission
                // $attendanceSubmit = new Attendancesubmit();
                // $attendanceSubmit->att_sub_stu_id = $student->stu_id;
                // $attendanceSubmit->att_sub_att_id = $request->att_id;
                // $attendanceSubmit->att_sub_code = $request->code_sub;
                // $attendanceSubmit->att_sub_time = $currentTime;
                // $attendanceSubmit->att_sub_status = $status;
                // $attendanceSubmit->save();
                



            return redirect()->back()->with('success', 'Attendance submitted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    function checkAttendanceStatus($startTime, $endTime, $currentTime) 
            {
                
               
            }

            
}
