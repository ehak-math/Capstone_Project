<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;

    protected $table = 'students';
    protected $primaryKey = 'stu_id';
    public $timestamps = false;

    protected $fillable = [
        'stu_fname',
        'stu_gra_id',
        'stu_username',
        'stu_password',
        'stu_gender',
        'stu_dob',
        'stu_ph_number',
        'stu_parent_number',
        'stu_profile',
    ];

    public static function displayStudent()
    {
        $students = self::join('grade', 'students.stu_gra_id', '=', 'grade.gra_id')
            ->get();
        return $students;
    }


    public static function displayStudentById($id)
    {
        $course = self::join('grade', 'students.stu_gra_id', '=', 'grade.gra_id')
            ->join('courses', 'grade.gra_id', '=', 'courses.cou_gra_id')
            ->join('teachers', 'courses.cou_tea_id', '=', 'teachers.tea_id')
            ->leftJoin('subjects', 'teachers.tea_subject', '=', 'subjects.sub_id')
            ->where('students.stu_id', $id) // Uses the correct primary key
            ->select(
                'students.*',
                'grade.gra_class',
                'grade.gra_group',
                'courses.cou_id',
                'courses.cou_gra_id',
                'teachers.tea_fname',
                'teachers.tea_gender',
                'teachers.tea_username',
                'subjects.sub_name',
                'subjects.sub_image'
            )
            ->get();

        return $course;
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'stu_gra_id', 'gra_id');
    }

    public static function insertStudent($data)
    {
        $students = new Students();
        $students->stu_fname = $data['stu_fname'];
        $students->stu_gra_id = $data['stu_gra_id'];
        $students->stu_username = $data['stu_username'];
        $students->stu_password = $data['stu_password'];
        $students->stu_gender = $data['stu_gender'];
        $students->stu_dob = $data['stu_dob'];
        $students->stu_ph_number = $data['stu_ph_number'];
        $students->stu_parent_number = $data['stu_parent_number'];
        $students->stu_profile = $data['stu_profile'];
        $students->save();
    }

    public function updateStudent(Request $request, $id)
    {
        $request->validate([
            'stu_fname' => 'required',
            'stu_username' => 'required',
            'stu_password' => 'required',
            'stu_gender' => 'required',
            'stu_grade' => 'required',
            'stu_ph_number' => 'required',
            'stu_parent_number' => 'required',
            'stu_dob' => 'required',
            'stu_profile' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $student = Students::findOrFail($id);

        // Handle profile image upload if provided
        if ($request->hasFile('stu_profile')) {
            // Delete the old profile image if it exists
            if ($student->stu_profile && Storage::disk('public')->exists($student->stu_profile)) {
                Storage::disk('public')->delete($student->stu_profile);
            }

            // Upload the new profile image
            $path = $this->uploadsIamge($request->file('stu_profile'), $request->stu_fname);
            $student->stu_profile = $path;
        }

        // Update other fields
        $student->stu_fname = $request->stu_fname;
        $student->stu_gra_id = $request->stu_grade;
        $student->stu_username = $request->stu_username;
        $student->stu_password = $request->stu_password;
        $student->stu_gender = $request->stu_gender;
        $student->stu_dob = $request->stu_dob;
        $student->stu_ph_number = $request->stu_ph_number;
        $student->stu_parent_number = $request->stu_parent_number;
        $student->save();

        return redirect()->route('admin.students.index')->with('success', 'Student updated successfully.');
    }
}