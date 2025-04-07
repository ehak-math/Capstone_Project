<?php

namespace App\Http\Controllers;

use App\Models\Admins;
use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\Teachers;
use App\Models\Team;
use App\Models\Grade;
use App\Models\Course;
use App\Models\Scores;
use App\Models\Schedules;
use App\Models\Attendances;
use App\Models\Attendancesubmit;
use App\Models\Subjects;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use phpDocumentor\Reflection\Types\Nullable;

class AdminController extends Controller
{
    // admin.login

    public function dashboard()
    {
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


    //admin.student
    function uploadsIamge($data, $pathname)
    {
        if ($data) {
            $file = $data;

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
            'stu_fname' => 'required',
            'stu_username' => 'required|string|max:255|unique:students,stu_username',
            'stu_password' => 'required|string|min:6',
            'stu_gender' => 'required|in:Male,Female',
            'stu_grade' => 'required',
            'stu_ph_number' => 'required|numeric|digits_between:7,15',
            'stu_parent_number' => 'required|numeric|digits_between:7,15',
            'stu_dob' => 'required',
            'stu_profile' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // Made stu_profile nullable
        ]);

        $path = null; // Default to null if no profile image is uploaded

        if ($request->hasFile('stu_profile')) {
            $path = $this->uploadsIamge($request->file('stu_profile'), $request->stu_fname);
        }

        $student = new Students();
        $student->stu_fname = $request->stu_fname;
        $student->stu_gra_id = $request->stu_grade;
        $student->stu_username = $request->stu_username;
        $student->stu_password = bcrypt($request->stu_password);
        $student->stu_gender = $request->stu_gender;
        $student->stu_dob = $request->stu_dob;
        $student->stu_ph_number = $request->stu_ph_number;
        $student->stu_parent_number = $request->stu_parent_number;
        $student->stu_profile = $path; // Assign the path (or null if no file uploaded)
        $student->save();

        return redirect()->back()->with('success', 'Student created successfully!');
    }


    function displayOnStu()
    {
    
        $students = Students::displayStudent();
        $grades = Grade::displayGrade();
        return view('admin.students.index', ['students' => $students, 'grades' => $grades]);

    }

    public function deleteStudent($id)
    {
        $student = Students::findOrFail($id);
        $student->delete();

        return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully.');
    }

    public function updateStudent(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'stu_fname' => 'required|string|max:255',
            'stu_username' => 'required|string|max:255',
            'stu_gender' => 'required|string',
            'stu_grade' => 'required|integer',
            'stu_ph_number' => 'required|string|max:15',
            'stu_parent_number' => 'required|string|max:15',
            'stu_dob' => 'required|date',
            'stu_profile' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'stu_status' => 'required|in:1,0',
        ]);

        // Find the student by ID
        $student = Students::findOrFail($id);

        // Handle profile image upload if provided
        if ($request->hasFile('stu_profile')) {
            // Delete the old profile image if it exists
            if ($student->stu_profile && Storage::disk('public')->exists($student->stu_profile)) {
                Storage::disk('public')->delete($student->stu_profile);
            }

            // Upload the new profile image
            $path = $request->file('stu_profile')->store('profile-images', 'public');
            $student->stu_profile = $path;
        }

        // Update other fields
        $student->stu_fname = $request->stu_fname;
        $student->stu_username = $request->stu_username;
        $student->stu_gender = $request->stu_gender;
        $student->stu_gra_id = $request->stu_grade;
        $student->stu_ph_number = $request->stu_ph_number;
        $student->stu_parent_number = $request->stu_parent_number;
        $student->stu_dob = $request->stu_dob;
        $student->stu_status = $request->stu_status;

        // Save the updated student
        $student->save();

        // Redirect back with a success message
        return redirect()->route('admin.students.index')->with('success', 'Student updated successfully.');
    }


    //search
    public function searchStudents(Request $request)
    {
        $query = Students::query();

        // Search by username, full name, or phone number
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('stu_username', 'LIKE', '%' . $search . '%')
                    ->orWhere('stu_fname', 'LIKE', '%' . $search . '%')
                    ->orWhere('stu_ph_number', 'LIKE', '%' . $search . '%');
            });
        }

        // Filter by gender
        if ($request->has('gender') && !empty($request->gender)) {
            $query->where('stu_gender', $request->gender);
        }

        // Filter by grade
        if ($request->has('grade') && !empty($request->grade)) {
            $query->where('stu_gra_id', $request->grade);
        }

        // Include related grade data
        $students = $query->with('grade')->get();

        // Return the filtered students as JSON
        return response()->json($students);
    }

    //admin.teacher

    public function displayTeacher()
    {
        $teachers = Teachers::with('subject')->get();
        $subjects = Subjects::all(); // Fetch all subjects
        return view('admin.teachers.index', compact('teachers', 'subjects'));
    }

    function addTeacher(Request $request)
    {
        $request->validate([
            'tea_fname' => 'required',
            'tea_username' => 'required',
            'tea_password' => 'required',
            'tea_gender' => 'required',
            'tea_subject' => 'required',
            'tea_ph_number' => 'required|numeric|digits_between:7,15',
            'tea_dob' => 'required',
            'tea_profile' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $path = $this->uploadsIamge($request->file('tea_profile'), $request->tea_fname);

        $teacher = new Teachers();
        $teacher->tea_fname = $request->tea_fname;
        $teacher->tea_username = $request->tea_username;
        $teacher->tea_password = $request->tea_password;
        $teacher->tea_gender = $request->tea_gender;
        $teacher->tea_subject = $request->tea_subject;
        $teacher->tea_ph_number = $request->tea_ph_number;
        $teacher->tea_dob = $request->tea_dob;
        $teacher->tea_profile = $path;
        $teacher->save();

        if ($request->hasFile('tea_profile')) {
            $teacher->tea_profile = $request->file('tea_profile')->store('images', 'public');
        }

        return redirect()->back()->with('success', 'Teacher created successfully!');
    }

    public function updateTeacher(Request $request, $id)
    {
        $request->validate([
            'tea_fname' => 'required',
            'tea_username' => 'required',
            'tea_gender' => 'required',
            'tea_subject' => 'required',
            'tea_ph_number' => 'required',
            'tea_dob' => 'required',
            'tea_profile' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $teacher = Teachers::findOrFail($id);

        if ($request->hasFile('tea_profile')) {
            if ($teacher->tea_profile && Storage::disk('public')->exists($teacher->tea_profile)) {
                Storage::disk('public')->delete($teacher->tea_profile);
            }

            $path = $request->file('tea_profile')->store('profile-images', 'public');
            $teacher->tea_profile = $path;
        }

        $teacher->tea_fname = $request->tea_fname;
        $teacher->tea_username = $request->tea_username;
        $teacher->tea_gender = $request->tea_gender;
        $teacher->tea_subject = $request->tea_subject;
        $teacher->tea_ph_number = $request->tea_ph_number;
        $teacher->tea_dob = $request->tea_dob;
        $teacher->save();

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher updated successfully.');
    }

    public function deleteTeacher($id)
    {
        $teacher = Teachers::findOrFail($id);
        $teacher->delete();

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher deleted successfully.');
    }

    public function searchTeachers(Request $request)
    {
        $query = Teachers::query();

        // Filter by name or username
        if ($request->has('search') && $request->search !== '') {
            $query->where(function ($q) use ($request) {
                $q->where('tea_fname', 'like', '%' . $request->search . '%')
                    ->orWhere('tea_username', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by gender
        if ($request->has('gender') && !empty($request->gender)) {
            $query->where('tea_gender', $request->gender);
        }

        // Filter by subject (Ensure it matches exactly)
        if ($request->has('subject') && !empty($request->subject)) {
            $query->whereHas('subject', function ($q) use ($request) {
                $q->where('sub_name', $request->subject);
            });
        }

        // Fetch the filtered teachers with their related subject
        $teachers = $query->with('subject')->get();

        return response()->json($teachers);
    }

    // admin courses
    public function displayCourses()
    {
        // Fetch subjects, courses, and grades
        $subjects = Subjects::all();
        $grades = Grade::all();
        $teachers = Teachers::all();
        $courses = Course::join('teachers', 'courses.cou_tea_id', '=', 'teachers.tea_id')
            ->join('subjects', 'teachers.tea_subject', '=', 'subjects.sub_id') // Join teachers with subjects
            ->join('grade', 'courses.cou_gra_id', '=', 'grade.gra_id')
            ->select(
                'courses.*',
                'teachers.tea_fname',
                'subjects.sub_name',
                'grade.gra_class',
                'grade.gra_group'
            )
            ->get();

        return view('admin.courses.index', compact('subjects', 'grades', 'teachers', 'courses'));
    }

    public function addCourse(Request $request)
    {
        $request->validate([
            'cou_tea_id' => 'required',
            'cou_gra_id' => 'required',
        ]);

        $course = new Course();
        $course->cou_tea_id = $request->cou_tea_id;
        $course->cou_gra_id = $request->cou_gra_id;
        $course->save();

        return redirect()->back()->with('success', 'Course created successfully!');
    }

    public function deleteCourse($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Course deleted successfully!');
    }

    public function viewCourseDetail($id)
    {
        $course = Course::findOrFail($id);
        $teacher = Teachers::with('subject')->findOrFail($course->cou_tea_id);
        $grade = Grade::where('gra_id', $course->cou_gra_id)->firstOrFail();

        $students = Students::where('stu_gra_id', $grade->gra_id)->get();

        $scores = Scores::where('sco_cou_id', $id)->get();

        return view('admin.courses.view_details', compact('course', 'teacher', 'grade', 'students', 'scores'));
    }

    public function updateCourse(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'cou_tea_id' => 'required',
            'cou_gra_id' => 'required',
        ]);

        // Find the course by ID
        $course = Course::findOrFail($id);

        // Update the course fields
        $course->cou_tea_id = $request->cou_tea_id;
        $course->cou_gra_id = $request->cou_gra_id;

        // Save the updated course
        $course->save();

        // Redirect back with a success message
        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully!');
    }

    // grade and subject
    public function displayGradeSubject()
    {
        $grades = Grade::all()->sortByDesc('gra_class');
        $subjects = Subjects::all();
        return view('admin.grade_subject.index', compact('grades', 'subjects'));
    }

    public function addGrade(Request $request)
    {
        $request->validate([
            'gra_group' => 'required',
            'gra_class' => 'required',
        ]);

        $grade = new Grade();
        $grade->gra_group = strtoupper($request->gra_group);
        $grade->gra_class = $request->gra_class;
        $grade->save();

        return redirect()->back()->with('success', 'Grade created successfully!');
    }

    public function deleteGrade($id)
    {
        $grade = Grade::findOrFail($id);
        $grade->delete();

        return redirect()->back()->with('success', 'Grade deleted successfully!');
    }

    public function updateGrade(Request $request, $id)
    {
        $request->validate([
            'gra_group' => 'required',
            'gra_class' => 'required',
        ]);

        $grade = Grade::findOrFail($id);
        $grade->gra_group = strtoupper($request->gra_group);
        $grade->gra_class = $request->gra_class;
        $grade->save();

        return redirect()->back()->with('success', 'Grade updated successfully!');
    }

    public function addSubject(Request $request)
    {
        $request->validate([
            'sub_name' => 'required',
        ]);

        $subject = new Subjects();
        $subject->sub_name = $request->sub_name;
        $subject->save();

        return redirect()->back()->with('success', 'Subject created successfully!');
    }

    public function deleteSubject($id)
    {
        $subject = Subjects::findOrFail($id);
        $subject->delete();

        return redirect()->back()->with('success', 'Subject deleted successfully!');
    }
    public function updateSubject(Request $request, $id)
    {
        $request->validate([
            'sub_name' => 'required',
        ]);

        $subject = Subjects::findOrFail($id);
        $subject->sub_name = $request->sub_name;
        $subject->save();

        return redirect()->back()->with('success', 'Subject updated successfully!');
    }


    // admin.schedule

    public function displaySchedule()
    {
        $schedules = Schedules::join('courses', 'schedules.sch_cou_id', '=', 'courses.cou_id')
            ->join('teachers', 'courses.cou_tea_id', '=', 'teachers.tea_id')
            ->join('subjects', 'teachers.tea_subject', '=', 'subjects.sub_id') // Join teachers with subjects
            ->join('grade', 'courses.cou_gra_id', '=', 'grade.gra_id')
            ->select(
                'schedules.*',
                'courses.cou_tea_id',
                'courses.cou_gra_id',
                'subjects.sub_name',
                'teachers.tea_fname',
                'grade.gra_class',
                'grade.gra_group'
            )
            ->orderBy('schedules.sch_day', 'asc')
            ->get();
        $teachers = Teachers::all();
        $grades = Grade::all();
        $subjects = Subjects::all();
        $courses = Course::all();
        return view('admin.schedule.index', compact('schedules', 'teachers', 'subjects', 'grades', 'courses'));
    }

    public function addSchedule(Request $request)
    {
        $request->validate([
            'sch_cou_id' => 'required',
            'sch_day' => 'required',
            'sch_start_time' => 'required',
            'sch_end_time' => 'required',
        ]);

        $schedule = new Schedules();
        $schedule->sch_cou_id = $request->sch_cou_id;
        $schedule->sch_day = $request->sch_day;
        $schedule->sch_start_time = $request->sch_start_time;
        $schedule->sch_end_time = $request->sch_end_time;
        $schedule->save();

        return redirect()->back()->with('success', 'Schedule created successfully!');
    }

    public function deleteSchedule($id)
    {
        $schedule = Schedules::findOrFail($id);
        $schedule->delete();

        return redirect()->back()->with('success', 'Schedule deleted successfully!');
    }

    public function updateSchedule(Request $request, $id)
    {
        $request->validate([
            'sch_cou_id' => 'required',
            'sch_day' => 'required',
            'sch_start_time' => 'required',
            'sch_end_time' => 'required',
        ]);

        $schedule = Schedules::findOrFail($id);
        $schedule->sch_cou_id = $request->sch_cou_id;
        $schedule->sch_day = $request->sch_day;
        $schedule->sch_start_time = $request->sch_start_time;
        $schedule->sch_end_time = $request->sch_end_time;
        $schedule->save();

        return redirect()->back()->with('success', 'Schedule updated successfully!');
    }


}
