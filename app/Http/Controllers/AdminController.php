<?php

namespace App\Http\Controllers;

use App\Models\Admins;
use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\Teachers;
use App\Models\Team;
use App\Models\Grade;
use App\Models\Course;
use App\Models\Schedules;
use App\Models\Attendances;
use App\Models\Attendancesubmit;
use App\Models\Subjects;
use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;

class AdminController extends Controller
{
//admin.student
    function uploadsIamge($data , $pathname){
        if ($data) {
            $file =$data;

            // Create unique filename
            $imageName = $pathname . '_' . time() . '.' . $file->getClientOriginalExtension();

            // Store file in public/images directory
            $path = $file->storeAs('images', $imageName, 'public');
        }
        return $path;

    }
    function addStudent(Request $request)
    {
        $request->validate([
            'stu_fname' =>  'required',
            'stu_username' =>  'required',
            'stu_password' =>  'required',
            'stu_gender' =>  'required',
            'stu_grade' =>  'required',
            'stu_ph_number' =>  'required',
            'stu_parent_number' =>  'required',
            'stu_dob' =>  'required',
            'stu_profile' =>  'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $path = $this->uploadsIamge($request->file('stu_profile') , $request->stu_fname);

        $student = new Students();
        $student->stu_fname = $request->stu_fname;
        $student->stu_gra_id = $request->stu_grade;
        $student->stu_username = $request->stu_username;
        $student->stu_password = $request->stu_password;
        $student->stu_gender = $request->stu_gender;
        $student->stu_dob = $request->stu_dob;
        $student->stu_ph_number= $request->stu_ph_number;
        $student->stu_parent_number = $request->stu_parent_number;
        $student->stu_profile = $path;
        $student->save();

        return redirect()->back()->with('success', 'Grade created successfully!');

    }
    function showDetails($id){

         $stuById = Students::join('grade', 'students.stu_gra_id','=','grade.gra_id')
//             ->join('teams', 'teams.team_id','=','grade.gra_id')
             ->where('students.stu_id',$id)
             ->first();
//        $stuById = Students::findOrFail($id);
         return $stuById;
    }
    function selectbyId($id)
    {
        $stubyId = $this->showDetails($id);

        return view('admin.student_detial', compact('stubyId'));
    }


    function displayOnStu()
    {
        $students = Students::displayStudent();
        $grades = Grade::displayGrade();
        return view('admin.student', ['students' => $students, 'grades' => $grades]);

    }
//admin.schedule

    function disGrade()
    {
        $listgrade = Grade::all();
        return $listgrade;
    }
    function createGrade(Request $request)
    {
        $request->validate([
            'grade' => 'required',
            'group' => 'required',
        ]);
        $grade = new Grade();
        $grade->gra_class = $request->grade;
        $grade->gra_group = $request->group;
        $grade->save();

        return redirect()->back()->with('success', 'Grade created successfully!');
    }

    function disTeacher(){
        $listTeacher= Teachers::join('subjects', 'teachers.tea_subject', '=', 'subjects.sub_id')
            ->get();
        return $listTeacher;
    }
    function createCourse(Request $request){
        $request->validate([
            'teacher' => 'required',
            'grade' => 'required',
        ]);
        $course = new Course();
        $course->cou_tea_id = $request->teacher;
        $course->cou_gra_id = $request->grade;
        $course->save();

        return redirect()->back()->with('success', 'Course created successfully!');
    }

    function displayCourse(){
        $listCourse= Course::join('teachers', 'courses.cou_tea_id', '=', 'teachers.tea_id')
            ->join('grade','grade.gra_id' ,'=', 'courses.cou_gra_id' )
            ->join('subjects','subjects.sub_id' ,'=', 'teachers.tea_id')
            ->get();
        return $listCourse;
    }
    function disSchedule(){
        $listSchedule= Schedules::join('courses','courses.cou_id','=','schedules.sch_cou_id')
            ->join('teachers','teachers.tea_id','=','courses.cou_tea_id')
            ->join('subjects','subjects.sub_id' ,'=', 'teachers.tea_id')
            ->get();
        return $listSchedule;
    }
    function createSchedule(Request $request){
        $request->validate([
            'sch_start_time' => 'required',
            'schedule_day' => 'required',
            'schedule_course_id' => 'required',
        ]);
        // Convert start time to Carbon instance
        $startTime = Carbon::parse($request->sch_start_time);

        // Set end time to 45 minutes after the start time
        $endTime = (clone $startTime)->addMinutes(45);
        $schedule = new Schedules;
        $schedule->sch_start_time = $startTime;
        $schedule->sch_end_time = $endTime;
        $schedule->sch_day = $request->schedule_day;
        $schedule->sch_cou_id = $request->schedule_course_id;
        $schedule->save();

        return redirect()->back()->with('success', 'Schedule created successfully!');
    }


    function getschedule()
    {
        $listSchedule = Schedules::displaySchedule();
        $gradelist = Grade::displayGrade();
        $listteacher = $this->disTeacher();
        $listcourse = Course::displayCourse();
        return view ('admin.scheldule', [
            'gradelist' => $gradelist,
            'listteacher' => $listteacher ,
            'listcourse' => $listcourse,
            'schedule' => $listSchedule
        ]);
    }

    public function displayAdmin()
    {
        $admin = Admins::disAdmin();
        $images = Storage::disk('public')->files('images');

        return view('listadmin', [
            'admin' => $admin,
            'images' => $images ?? []
        ]);
    }

    public function creatAdmin(Request $request)
    {
        try {
            // Validate request
            $validated = $request->validate([
                'username' => 'required|unique:admins,adm_username',
                'password' => 'required|min:6',
                'profile' => 'required|image|mimes:jpg,png,jpeg|max:2048'
            ]);

            if ($request->hasFile('profile')) {
                $file = $request->file('profile');

                // Create unique filename
                $imageName = $request->username . '_' . time() . '.' . $file->getClientOriginalExtension();

                // Store file in public/images directory
                $path = $file->storeAs('images', $imageName, 'public');

                // Create new admin
                $admin = Admins::create([
                    'adm_username' => $request->username,
                    'adm_password' => $request->password, // Hash password
                    'adm_profile' => $path
                ]);

                return redirect()->back()->with('success', 'Admin created successfully!');
            }

            return redirect()->back()->with('error', 'Profile image is required.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error creating admin: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function createSubject(Request $request)
    {

            // Validate request
            $validated = $request->validate([
                'sub_name' => 'required',
                'sub_image' => 'required|image|mimes:jpg,png,jpeg|max:2048'
            ]);

            if ($request->hasFile('sub_image')) {
                $file = $request->file('sub_image');

                // Create unique filename
                $imageName = $request->sub_name . '_' . time() . '.' . $file->getClientOriginalExtension();

                // Store file in public/images directory
                $path = $file->storeAs('images', $imageName, 'public');
                $data = [
                    'sub_name' => $request->sub_name,
                    'sub_image' => $path
                ];
                // Create new subject
                $subject = Subjects::insertSubject($data);

                return redirect()->back()->with('success', 'Subject created successfully!');
            }


        }


}
