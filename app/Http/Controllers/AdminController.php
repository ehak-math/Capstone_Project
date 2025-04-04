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
            'stu_profile' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $path = $this->uploadsIamge($request->file('stu_profile'), $request->stu_fname);

        $student = new Students();
        $student->stu_fname = $request->stu_fname;
        $student->stu_gra_id = $request->stu_grade;
        $student->stu_username = $request->stu_username;
        $student->stu_password = bcrypt($request->stu_password);
        $student->stu_gender = $request->stu_gender;
        $student->stu_dob = $request->stu_dob;
        $student->stu_ph_number = $request->stu_ph_number;
        $student->stu_parent_number = $request->stu_parent_number;
        $student->stu_profile = $path;
        $student->save();
        
        if ($request->hasFile('stu_profile')) {
            $student->stu_profile = $request->file('stu_profile')->store('images', 'public');
        }

        return redirect()->back()->with('success', 'Grade created successfully!');

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
    


}
