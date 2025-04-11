<?php

namespace App\Http\Controllers;
use App\Models\Students;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Teachers;
use App\Models\Subject;
use App\Models\Attendances;
use App\Models\Attendancesubmit;
use App\Models\Documents;
use App\Models\Schedules;
use App\Models\Scores;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Course;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    // test function
    public function showsubject()
    {
        $subjects = Subject::displaySubject();
        $teachers = Teachers::displayTeacher();
        return view('listadmin', ['subjects' => $subjects, 'teachers' => $teachers]);

    }
    function uploads($data)
    {
        if ($data) {
            $file = $data;

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
        return view('auth.teacher_login');
    }
    public function TeacherLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
    
        $username = $request->input('username');
        $password = $request->input('password');
    
        // Find teacher by username
        $teacher = Teachers::where('tea_username', $username)->first();
    
        // Check if teacher exists and password matches
        if (!$teacher || $password !== $teacher->tea_password) {
            return back()->withErrors([
                'username' => 'Username or Password is incorrect.',
            ])->withInput();
        }
    
    
        // Store teacher info in session
        $request->session()->put('teacher', $teacher);
    
        return redirect()->route('teacher.dashboard')->with('success', 'Login successful!');
    }
    


    public function teacherDashboard()
    {
        if (!session('teacher')) {
            return redirect()->route('teacher.login');
        }
    
        $teacher = session('teacher');
    
        $students = Students::join('grade', 'students.stu_gra_id', '=', 'grade.gra_id')
            ->join('courses', 'grade.gra_id', '=', 'courses.cou_gra_id')
            ->where('courses.cou_tea_id', $teacher->tea_id)
            ->select('students.stu_gender', 'students.stu_id')
            ->get();
    
        $totalStudents = $students->unique('stu_id')->count();
        $maleCount = $students->where('stu_gender', 'Male')->count();
        $femaleCount = $students->where('stu_gender', 'Female')->count();
    
        // 👇 Fetch only documents uploaded by this teacher (if filtered), or all
        $documents = Documents::join('courses', 'documents.doc_cou_id', '=', 'courses.cou_id')
            ->where('courses.cou_tea_id', $teacher->tea_id)
            ->select('documents.*')
            ->get();
    
        return view('teacher.dashboard', [
            'teacher' => $teacher,
            'maleCount' => $maleCount,
            'femaleCount'=> $femaleCount,
            'teaStudentGender' => [$maleCount, $femaleCount],
            'totalStudents' => $totalStudents,
            'documents' => $documents // 👈 Pass to view
        ]);
    }
    
    

    public function logout(Request $request)
    {
        $request->session()->forget('teacher');
        return redirect()->route('teacher.login');
    }

    function teacherAttendance($id)
    {
        if (!session('teacher')) {
            return redirect()->route('teacher.login');
        }

        $teacher = session('teacher');

        // cheack if sch_cou_id = cou_id

        $selectatt = Schedules::join('courses', 'courses.cou_id', '=', 'schedules.sch_cou_id')
            ->where('courses.cou_id', $id)
            ->get();
        $currentday = Carbon::today('Asia/Phnom_Penh')->format('Y-m-d'); // Format as date string
        // $currentday = '2025-04-07'; // Format as date string

        $getatt = Attendances::join('schedules', 'schedules.sch_id', '=', 'attendances.att_sch_id')
        ->where('schedules.sch_cou_id', $id)
        ->where('att_date', $currentday)
        ->first();

        // Get schedule information
        // $displayschedule = Course::join('schedules', 'courses.cou_id', '=', 'schedules.sch_cou_id')
        //     ->join('teachers', 'courses.cou_tea_id', '=', 'teachers.tea_id')
        //     ->join('subjects', 'teachers.tea_subject', '=', 'subjects.sub_id')
        //     ->where('courses.cou_id', $id)
        //     // ->groupBy('courses.cou_id')
        //     // ->orderBy('schedules.sch_day', 'asc')
        //     // ->orderBy('schedules.sch_start_time', 'desc')
        //     ->select([
        //         'courses.cou_id',
        //         'schedules.sch_start_time',
        //         'schedules.sch_end_time',
        //         'schedules.sch_day',
        //         'teachers.tea_fname',
        //         'subjects.sub_name'
        //     ])
        //     ->get();


        // Get course information
        $getcourse = Course::join('teachers', 'courses.cou_tea_id', '=', 'teachers.tea_id')
        ->join('subjects', 'teachers.tea_subject', '=', 'subjects.sub_id')
        ->where('cou_id', $id)
        ->select('courses.*', 'subjects.sub_name') // Selecting the subject name from subjects table
        ->first();
    
    

        // $selectStudentSubmit = Attendancesubmit::get();

        // Get today's attendance if exists
        // $currentAttendance = Attendances::join('schedules' , 'attendances.att_cou_id','=', 'schedules.sch_cou_id')
        //     ->where('att_cou_id', $id)
        //     ->whereDate('att_startime', Carbon::today('Asia/Phnom_Penh'))
        //     ->orderBy('att_id' , 'desc')
        //     ->first();

        // $getCodeAtt =  Attendances::where('att_cou_id', $id)
        // ->whereDate('att_startime', Carbon::today('Asia/Phnom_Penh'))
        // ->select('att_code')
        // ->first();
        // $currentdayi = '2025-04-04'; // Format as date string

        $selectAttSub = Attendancesubmit::join('students', 'attendance_submit.att_sub_stu_id', '=', 'students.stu_id')
            ->join('schedules', 'attendance_submit.att_sub_sch_id', '=', 'schedules.sch_id')
            // ->where('students.stu_id', $student->stu_id)
            // ->where('attendance_submit.att_sub_att_id', $subAttendance->att_id)
            ->where('attendance_submit.att_sub_date', $currentday)
            // ->orderBy('attendance_submit.att_sub_id', 'desc')
            // ->select('attendance_submit.*', 'students.*')
            ->get();

        return view('teacher.courses.attendance', [
            'att_dis' => $selectatt,
            'course' => $getcourse,
            'getatt' => $getatt,
            'selectAttSub' => $selectAttSub,
            'teacher' => $teacher,
            // 'attendance' => $currentAttendance,
            // 'selectStudentSubmit' => $selectStudentSubmit,

        ]);
    }
    public function openatt(Request $request)
    {
        try {
            if (!session('teacher')) {
                return redirect()->route('teacher.login');
            }

            $request->validate([
                'sch_id' => 'required',
                'course_id' => 'required'
            ]);
            $currentday = Carbon::today('Asia/Phnom_Penh')->format('Y-m-d'); // Format as date string
            // $status = "Open";
            // Check if attendance already exists for today
            $existingAttendance = Attendances::join('schedules', 'attendances.att_sch_id', '=', 'schedules.sch_id')
                ->where('schedules.sch_id', $request->sch_id)
                ->whereDate('attendances.att_date', $currentday)
                ->first();

            if ($existingAttendance) {
                throw new \Exception('Attendance already exists for today');
            } else {

                // Create new attendance
                $code = Str::upper(Str::random(6));
                $startTime = Carbon::now('Asia/Phnom_Penh');
                $endTime = Carbon::now('Asia/Phnom_Penh')->addMinutes(5);

                Attendances::create([
                    'att_code' => $code,
                    'att_startime' => $startTime,
                    'att_endtime' => $endTime,
                    'att_sch_id' => $request->sch_id,
                    'att_date' => $currentday,
                    'att_status' => 'Open'
                ]);
            }

            // create submit attendance for see student
            $selectedStudent = Course::join('grade', 'courses.cou_gra_id', '=', 'grade.gra_id')
                ->join('students', 'grade.gra_id', '=', 'students.stu_gra_id')
                ->where('courses.cou_id', $request->course_id)
                ->select('students.stu_id')->get();

            foreach ($selectedStudent as $student) {
                Attendancesubmit::create([
                    'att_sub_stu_id' => $student->stu_id,
                    'att_sub_date' => $currentday,
                    'att_sub_sch_id' => $request->sch_id,
                ]);
            }


            return redirect()->back()->with('success', 'Attendance opened successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to open attendance: ' . $e->getMessage());
        }
    }

    //     public function openatt(Request $request)
// {
//     try {
//         if (!session('teacher')) {
//             return redirect()->route('teacher.login');
//         }

    //         $request->validate([
//             'sch_id' => 'required',
//             'course_id' => 'required'
//         ]);

    //         $currentday = Carbon::today('Asia/Phnom_Penh')->format('Y-m-d');

    //         // Check if attendance already exists for today
//         $existingAttendance = Attendances::join('schedules', 'attendances.att_sch_id', '=', 'schedules.sch_id')
//             ->where('schedules.sch_id', $request->sch_id)
//             ->whereDate('attendances.att_date', $currentday)
//             ->first();

    //         if ($existingAttendance) {
//             throw new \Exception('Attendance already exists for today');
//         }

    //         // Begin database transaction
//         DB::beginTransaction();
//         try {
//             // Create new attendance
//             $code = Str::upper(Str::random(6));
//             $startTime = Carbon::now('Asia/Phnom_Penh');
//             $endTime = Carbon::now('Asia/Phnom_Penh')->addMinutes(1);

    //             $attendance = Attendances::create([
//                 'att_code' => $code,
//                 'att_startime' => $startTime,
//                 'att_endtime' => $endTime,
//                 'att_sch_id' => $request->sch_id,
//                 'att_date' => $currentday,
//                 'att_status' => 'Open'
//             ]);

    //             // Get all students in the course
//             $students = Course::join('grade', 'courses.cou_gra_id', '=', 'grade.gra_id')
//                 ->join('students', 'grade.gra_id', '=', 'students.stu_gra_id')
//                 ->where('courses.cou_id', $request->course_id)
//                 ->select('students.stu_id')
//                 ->get();

    //             // Create attendance submissions for each student
//             $attendanceSubmissions = [];
//             foreach ($students as $student) {
//                 $attendanceSubmissions[] = [
//                     'att_sub_stu_id' => $student->stu_id,
//                     'att_sub_sch_id' => $request->sch_id,
//                     'att_sub_att_id' => $attendance->att_id, // Link to the created attendance
//                     // 'created_at' => now(),
//                     // 'updated_at' => now()
//                 ];
//             }

    //             // Bulk insert attendance submissions
//             if (!empty($attendanceSubmissions)) {
//                 Attendancesubmit::insert($attendanceSubmissions);
//             }

    //             DB::commit();
//             return redirect()->back()->with('success', 'Attendance opened successfully!');

    //         } catch (\Exception $e) {
//             DB::rollback();
//             throw $e;
//         }

    //     } catch (\Exception $e) {
//         return redirect()->back()->with('error', 'Failed to open attendance: ' . $e->getMessage());
//     }
// }

    function teacherCourse()
    {
        // Check if teacher is logged in
        if (!session('teacher')) {
            return redirect()->route('teacher.login');
        }
        $teacher = session('teacher');
        $showTeacher = Course::displayCourseByTeacher($teacher->tea_id);
        return view('teacher.courses.course', ['Teacher' => $showTeacher]);
    }

    public function closeatt(Request $request)
    {
        try {
            $request->validate([
                'att_sch_id' => 'required',
                'attendance_id' => 'required',
                // 'att_day' => 'required',
                // 'att_time' => 'required'
            ]);

            $attendance = Attendances::where('att_sch_id', $request->att_sch_id)
                ->where('att_id', $request->attendance_id)
                // ->whereDate('attendances.att_date',$currentday)
                ->first();
            // if (!$attendance) {
            //     throw new \Exception('Attendance record not found');
            // }

            // if ($attendance->att_status !== 'Open') {
            //     throw new \Exception('Attendance is already closed');
            // }

            // Update attendance status
            DB::table('attendances')
                ->where('att_id', $request->attendance_id)
                ->update([
                    'att_status' => 'None',
                    'att_endtime' => Carbon::now('Asia/Phnom_Penh')
                ]);

            $message = $request->input('auto_close') ?
                'Attendance closed automatically due to time expiration' :
                'Attendance closed successfully';

            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to close attendance: ' . $e->getMessage());
        }
    }

    public function showDocument()
    {
        $teacher = session('teacher');
        if (!$teacher) {
            return redirect()->route('teacher.login')->with('error', 'Teacher session not found');
        }

        $select = Course::join('teachers', 'courses.cou_tea_id', '=', 'teachers.tea_id')
            ->join('subjects', 'teachers.tea_subject', '=', 'subjects.sub_id')
            ->where('teachers.tea_id', $teacher->tea_id)
            ->select([
                'courses.cou_id',
                'teachers.tea_fname',
                'subjects.sub_name'
            ])
            ->get();
        // $select = Course::all();

        $documents = Documents::join('courses', 'courses.cou_id', '=', 'documents.doc_cou_id')
        ->join('teachers', 'courses.cou_tea_id', '=', 'teachers.tea_id')
        ->join('subjects', 'teachers.tea_subject', '=', 'subjects.sub_id')
        ->where('courses.cou_tea_id', $teacher->tea_id)
        ->get();

        return view('teacher.document', compact('select', 'documents', 'teacher'));
    }
    function uploadsfile($data, $name)
    {
        if ($data) {
            $file = $data;

            // Create unique filename
            $imageName = $name . '_' . time() . '.' . $file->getClientOriginalExtension();

            // Store file in public/images directory
            $path = $file->storeAs('documents', $imageName, 'public');
        }
        return $path;
    }
    public function uploadDocument(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf|max:2048',
            'description' => 'required',
            'tittle' => 'required',
            'course' => 'required',
            'typeOfdoc' => 'required',
        ]);

        $path = $this->uploadsfile($request->file('file'), $request->tittle);

        if (!$path) {
            return redirect()->back()
                ->with('error', 'Failed to upload file')
                ->withInput();
        }

        $doc = new Documents();
        $doc->doc_type = $request->typeOfdoc;
        $doc->doc_name = $request->tittle;
        $doc->doc_deatial = $request->description;
        $doc->doc_cou_id = $request->course;
        $doc->doc_date = Carbon::now('Asia/Phnom_Penh');
        $doc->doc_file = $path; // Assuming you have a column for the file path
        $doc->save();


        return redirect()->back()->with('success', 'File uploaded successfully!');
    }
    // function to download document
    public function downloadDocument($id)
    {
        $document = Documents::findOrFail($id);
        $path = storage_path('app/public/' . $document->doc_file);

        if (file_exists($path)) {
            return response()->download($path, $document->doc_title);
        }

        return redirect()->back()->with('error', 'File not found.');
    }

    public function deleteDocument($id)
    {
        $document = Documents::findOrFail($id);

        // Delete file from storage
        Storage::disk('public')->delete($document->doc_file);

        // Delete record from database
        $document->delete();

        return redirect()->back()->with('success', 'Document deleted successfully.');
    }

    public function displayStudent() {
        if (!session('teacher')) {
            return redirect()->route('teacher.login');
        }
        $teacher = session('teacher');
        $showTeacher = Course::displayCourseByTeacher($teacher->tea_id);
        return view('teacher.courses.student', ['Teacher' => $showTeacher]);
    
    }

    function teacherScore($id)
    {
        if (!session('teacher')) {
            return redirect()->route('teacher.login');
        }
        $getcourse = Course::join('teachers', 'courses.cou_tea_id', '=', 'teachers.tea_id')
        ->join('subjects', 'teachers.tea_subject', '=', 'subjects.sub_id')
        ->where('cou_id', $id)
        ->select('courses.*', 'subjects.sub_name') // Selecting the subject name from subjects table
        ->first();

    
        $teacher = session('teacher');
        $getScoreBymonth = Scores::join('courses', 'scores.sco_cou_id', '=', 'courses.cou_id')
            ->join('students', 'students.stu_id', '=', 'scores.sco_stu_id')
            ->join('teachers', 'teachers.tea_id', '=', 'courses.cou_tea_id')
            ->where('scores.sco_cou_id', $id)->get();

        $selectallStudent = Course::join('grade', 'courses.cou_gra_id', '=', 'grade.gra_id')
            ->join('students', 'grade.gra_id', '=', 'students.stu_gra_id')
            // ->join('scores' , 'scores.sco_stu_id', '=', 'students.stu_id')
            ->where('courses.cou_id', $id)
            ->get();

        $selectallpoint = Course::join('grade', 'courses.cou_gra_id', '=', 'grade.gra_id')
        ->join('students', 'grade.gra_id', '=', 'students.stu_gra_id')
        ->join('scores', 'scores.sco_stu_id', '=', 'students.stu_id')
        ->where('courses.cou_id', $id)
        ->orderByRaw("FIELD(sco_month, 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December')")
        ->get();
// =======
//             ->join('students', 'grade.gra_id', '=', 'students.stu_gra_id')
//             ->join('scores', 'scores.sco_stu_id', '=', 'students.stu_id')
//             ->where('courses.cou_id', $id)
//             ->get();
// >>>>>>> c2b06d77f2e4aaff8d7a5d5da5a4f111d69fa141

        return view('teacher.courses.score', [
            'teacher' => $teacher,
            'course' => $getcourse,
            'score' => $getScoreBymonth,
            'selectallStudent' => $selectallStudent,
            'selectallpoint' => $selectallpoint,
        ]);
    }

    public function addscore(Request $request)
    {
        $request->validate([
            'sco_id' => 'required',
            'cou_id' => 'required',
            'stu_id' => 'required',
            'sco_point' => 'required'
        ]);

        // Check if the score already exists for the student in the course
        // $existingScore = Scores::where('sco_cou_id', $request->sco_cou_id)
        //     ->where('sco_stu_id', $request->sco_stu_id)
        //     ->where('sco_month', $request->sco_month)
        //     ->first();
        // if ($existingScore) {
        //     return redirect()->back()->with('error', 'Score already exists for this student in this course and month.');
        // }
        DB::table('scores')
            ->where('sco_id', $request->sco_id)
            ->update([
                'sco_point' => $request->sco_point,
            ]);


        return redirect()->back()->with('success', 'Score added successfully!');
    }

    public function createscore(Request $request)
    {
        $request->validate([
            'sco_month' => 'required',
            'cou_id' => 'required',
        ]);

        // Check if the score already exists for the student in the course
        $existingScore = Scores::where('sco_cou_id', $request->cou_id)
            ->where('sco_month', $request->sco_month)
            ->first();
        if ($existingScore) {
            return redirect()->back()->with('error', 'Score already exists for this student in this course and month.');
        }

        $selectedStudent = Course::join('grade', 'courses.cou_gra_id', '=', 'grade.gra_id')
            ->join('students', 'grade.gra_id', '=', 'students.stu_gra_id')
            ->where('courses.cou_id', $request->cou_id)
            ->select('students.stu_id')->get();

        foreach ($selectedStudent as $student) {
            Scores::create([
                'sco_month' => $request->sco_month,
                'sco_cou_id' => $request->cou_id,
                'sco_stu_id' => $student->stu_id
            ]);


        }

        // $data = [
        //     'sco_point' => $request->sco_point,
        //     'sco_month' => $request->sco_month,
        //     'sco_cou_id' => $request->sco_cou_id,
        //     'sco_stu_id' => $request->sco_stu_id
        // ];

        // Scores::create($data);
        return redirect()->back()->with('success', 'Score created successfully!');
    }

    public function showSchedule()
    {


        $teacher = session('teacher');
        if (!$teacher) {
            return redirect()->route('teacher.login')->with('error', 'Teacher session not found');
        }
        // $disSchedule= Schedules::join('courses','courses.cou_id','=','schedules.sch_cou_id')
        //     ->join('teachers','teachers.tea_id','=','courses.cou_tea_id')
        //     ->join('subjects','subjects.sub_id' ,'=', 'teachers.tea_id')
        //     ->join('grade','grade.gra_id','=','courses.cou_gra_id')
        //     ->join('students','students.stu_gra_id','=','grade.gra_id')
        //     ->where('students.stu_id', $student->stu_id)
        //     ->select('schedules.*', 'courses.*', 'teachers.*', 'subjects.*', 'grade.gra_class')
        //     ->get();
        $schedules = Schedules::join('courses', 'schedules.sch_cou_id', '=', 'courses.cou_id')
            ->join('teachers', 'courses.cou_tea_id', '=', 'teachers.tea_id')
            ->join('subjects', 'teachers.tea_subject', '=', 'subjects.sub_id')
            ->join('grade', 'courses.cou_gra_id', '=', 'grade.gra_id')
            ->where('teachers.tea_id', $teacher->tea_id)
            ->select('schedules.*', 'teachers.*', 'subjects.*', 'grade.*')
            ->orderByRaw("FIELD(sch_day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')")
            ->orderBy('sch_start_time', 'asc')
            ->get();
        // $schedules = Students::getScheduleByStudent($student->stu_id);
        return view('teacher.scheldule', [
            'schedules' => $schedules,
            'teacher' => $teacher
        ]);
    }
    function showAttendance(){
        $teacher = session('teacher');
        if (!$teacher) {
            return redirect()->route('teacher.login')->with('error', 'Teacher session not found');
        }
        $attendances = Attendancesubmit::join('students', 'attendance_submit.att_sub_stu_id', '=', 'students.stu_id')
            ->join('schedules', 'attendance_submit.att_sub_sch_id', '=', 'schedules.sch_id')
            ->join('courses', 'schedules.sch_cou_id', '=', 'courses.cou_id')
            ->join('teachers', 'courses.cou_tea_id', '=', 'teachers.tea_id')
            ->join('subjects', 'teachers.tea_subject', '=', 'subjects.sub_id')
            ->join('grade', 'courses.cou_gra_id', '=', 'grade.gra_id')
            ->select(
            'attendance_submit.*', 
            'students.stu_fname', 
            'students.stu_id', 
            'courses.cou_id', 
            'teachers.tea_fname', 
            'grade.gra_class',
            'grade.gra_group',
            'subjects.sub_name',
            )
            ->where('teachers.tea_id', $teacher->tea_id)
            ->get();

        
        return view('teacher.attendance', [
            'attendances' => $attendances,
            'teacher' => $teacher
        ]);

    }
    function showTopStudent(){
        $teacher = session('teacher');
        if (!$teacher) {
            return redirect()->route('teacher.login')->with('error', 'Teacher session not found');
        }
        // $topStudents = Students::join('attendance_submit', 'students.stu_id', '=', 'attendance_submit.att_sub_stu_id')
        //     ->join('schedules', 'attendance_submit.att_sub_sch_id', '=', 'schedules.sch_id')
        //     ->join('courses', 'schedules.sch_cou_id', '=', 'courses.cou_id')
        //     ->join('teachers', 'courses.cou_tea_id', '=', 'teachers.tea_id')
        //     ->join('subjects', 'teachers.tea_subject', '=', 'subjects.sub_id')
        //     ->join('grade', 'courses.cou_gra_id', '=', 'grade.gra_id')
        //     ->select(
        //         'students.*',
        //         'attendance_submit.*',
        //         'courses.cou_id',
        //         'teachers.tea_fname',
        //         'grade.gra_class',
        //         'grade.gra_group',
        //         'subjects.sub_name',
        //         'attendance_submit.att_sub_status',
        //     )
        //     ->where('teachers.tea_id', $teacher->tea_id)
        //     ->orderBy('attendance_submit.att_sub_date', 'desc')
        //     ->get();
        $topStudents = Students::join('scores', 'students.stu_id', '=', 'scores.sco_stu_id')
            ->join('courses', 'scores.sco_cou_id', '=', 'courses.cou_id')
            ->join('teachers', 'courses.cou_tea_id', '=', 'teachers.tea_id')
            ->join('subjects', 'teachers.tea_subject', '=', 'subjects.sub_id')
            ->join('grade', 'courses.cou_gra_id', '=', 'grade.gra_id')
            ->select(
                'students.*',
                'scores.*',
                'courses.cou_id',
                'teachers.tea_fname',
                'grade.gra_class',
                'grade.gra_group',
                'subjects.sub_name'
            )
            ->where('teachers.tea_id', $teacher->tea_id)
            ->orderBy('scores.sco_point', 'desc')
            ->get();
        return view('teacher.topstudent', [
            'topStudent' => $topStudents,
            'teacher' => $teacher
        ]);
    }
}
