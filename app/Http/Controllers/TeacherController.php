<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Teachers;
use App\Models\Subject;
use App\Models\Attendances;
use Carbon\Carbon;

use App\Models\Course;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
// test function
    public function showsubject(){
        $subjects = Subject::displaySubject();
        $teachers = Teachers::displayTeacher();
        return view('listadmin', ['subjects' => $subjects, 'teachers' => $teachers]);

    }
    function uploads($data){
        if ($data) {
            $file =$data;
            
            // Create unique filename
            $imageName = 'sub_name' . '_' . time() . '.' . $file->getClientOriginalExtension();
            
            // Store file in public/images directory
            $path = $file->storeAs('images', $imageName, 'public');
        }
        return $path;

    }
    public function store(Request $request)
    {
        $request->validate([
            'sub_name' => 'required',
            'sub_image' => 'required|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $path = $this->uploads($request->file('sub_image'));
        
        if (!$path) {
            return redirect()->back()
                ->with('error', 'Failed to upload image')
                ->withInput();
        }

        $data = [
            'sub_name' => $request->sub_name,
            'sub_image' => $path
        ];

        Subject::insertSubject($data);
        return redirect()->back()->with('success', 'Subject created successfully!');
    }

    public function editsubject($id)
    {
        $subject = Subject::findOrFail($id);
        return view('editteacher', compact('subject'));
    }

    public function update(Request $request, $id)
    {
        try {
            // Validate request
            $validated = $request->validate([
                'sub_name' => 'required|unique:subjects,sub_name,' . $id . ',sub_id',
                'sub_image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
            ]);

            // Find the subject first
            $subject = Subject::findOrFail($id);

            // Prepare update data
            $data = [
                'sub_name' => $request->sub_name
            ];

            // Handle image upload if new image provided
            if ($request->hasFile('sub_image')) {
                // Delete old image if exists
                if ($subject->sub_image && Storage::disk('public')->exists($subject->sub_image)) {
                    Storage::disk('public')->delete($subject->sub_image);
                }

                // Upload new image
                $path = $this->uploads($request->file('sub_image'));
                if (!$path) {
                    throw new \Exception('Failed to upload new image');
                }
                $data['sub_image'] = $path;
            }

            // Update using the model's static method
            Subject::updateSubject($id, $data);

            // Changed redirect to go back to listadmin view
            return redirect()->action([TeacherController::class, 'showsubject'])
                ->with('success', 'Subject updated successfully');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating subject: ' . $e->getMessage())
                ->withInput();
        }
    }

    // the main function 


    public function TeacherLoginForm()
    {
        return view('teacher.teacher_login');
    }
    public function TeacherLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $username = $request->input('username');
        $password = $request->input('password');
        
        $teacher = Teachers::where('tea_username', $username)->first();
        
        if (!$teacher || $password !== $teacher->tea_password) {
            return redirect()->back()
                ->with('error', 'Username or Password is incorrect');
        }   

        $request->session()->put('teacher', $teacher);
        
        return redirect()->route('teacher.dashboard');  // Fixed route name
    }

    function teacherDashbord(){
        // Check if teacher is logged in
        if (!session('teacher')) {
            return redirect()->route('teacher.login');
        }
        $teacher = session('teacher');
        $showTeacher = Teachers::displayTeacher($teacher->tea_id);
        return view('teacher.dashboard', ['teacher' => $teacher , 'Teacher' => $showTeacher]);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('teacher');
        return redirect()->route('teacher.login');
    }
    function teacherAttendance($id)
    {
        // Check if teacher is logged in
        if (!session('teacher')) {
            return redirect()->route('teacher.login');
        }
        
        $teacher = session('teacher');
        
        // Get schedule information
        $displayschedule = Course::join('schedules', 'courses.cou_id', '=', 'schedules.sch_cou_id')
            ->join('teachers', 'courses.cou_tea_id', '=', 'teachers.tea_id')
            ->join('subjects', 'teachers.tea_subject', '=', 'subjects.sub_id')
            ->where('courses.cou_id', $id)
            ->select([
                'courses.cou_id',
                'schedules.sch_start_time',
                'schedules.sch_end_time',
                'schedules.sch_day',
                'teachers.tea_fname',
                'subjects.sub_name'
            ])
            ->first();

        // Get course information
        $getcourse = Course::where('cou_id', $id)->first();

        // Get today's attendance if exists
        $today = Carbon::now()->format('l');
        $currentAttendance = Attendances::where('att_cou_id', $id)
            // ->whereDate('att_startime', Carbon::today())
            ->first();

        // Create new attendance if it doesn't exist and if it's the correct day
        if (!$currentAttendance && $displayschedule && $displayschedule->sch_day === $today) {
            $code = Str::upper(Str::random(6));
            $startTime = Carbon::now();
            $endTime = Carbon::now()->addMinutes(10);

            $currentAttendance = Attendances::create([
                'att_code' => $code,
                'att_startime' => $startTime,
                'att_endtime' => $endTime,
                'att_cou_id' => $id,
                'att_status' => "Open"
            ]);
        }

        return view('teacher.courses.attendance', [
            'att_dis' => $displayschedule,
            'course' => $getcourse,
            'attendance' => $currentAttendance
        ]);
    }
    function openatt(Request $request){
        // Check if teacher is logged in
        
        $request->validate([
            'course_id' => 'required'
        ]);
        $code = Str::upper(Str::random(6));
        $startTime = Carbon::now();
        $endTime = Carbon::now()->addMinutes(10);

        $open = Attendaces::create([
            'att_code' => $code,
            'att_startime' => $startTime,
            'att_endtime' => $endTime,
            'att_cou_id' => $request->course_id,
            'att_status' => "Open"
        ]);
        return redirect()->back()->with('success', 'Attendance marked successfully!');
    }
    
    function teacherCourse(){
        // Check if teacher is logged in
        if (!session('teacher')) {
            return redirect()->route('teacher.login');
        }
        $teacher = session('teacher');
        $showTeacher = Course::displayCourseByTeacher($teacher->tea_id);
        return view('teacher.courses.course', ['Teacher' => $showTeacher]);
    }
}
