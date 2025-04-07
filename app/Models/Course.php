<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    use HasFactory;
    protected $table = 'courses';
    public $timestamps = false;
    protected $primaryKey = 'cou_id';
    protected $fillable = ['cou_gra_id'];

    public static function displayCourse()
    {
        $listcourses = self::join('subjects', 'courses.cou_sub_id', '=', 'subjects.sub_id')
            ->join('teachers', 'courses.cou_tea_id', '=', 'teachers.tea_id')
            ->join('grade', 'courses.cou_gra_id', '=', 'grade.gra_id')
            ->select('courses.*', 'subjects.sub_name', 'teachers.tea_fname', 'grade.gra_group', 'grade.gra_class')
            ->get();
        return $listcourses;
    }

    public function grade()
    {
        return $this->hasMany(Grade::class, 'cou_gra_id', 'gra_id');
    }
    public function teacher()
    {
        return $this->belongsTo(Teachers::class, 'cou_tea_id'); // or the correct foreign key
    }


    public static function insertCourse($data)
    {
        $course = new Course();
        $course->cou_tea_id = $data['cou_tea_id'];
        $course->cou_gra_id = $data['cou_gra_id'];
        $course->save();

    }
    public static function displayCourseByTeacher($id)
    {
        $course = self::join('teachers', 'courses.cou_tea_id', '=', 'teachers.tea_id')
            ->join('subjects', 'teachers.tea_subject', '=', 'subjects.sub_id')
            ->join('grade', 'courses.cou_gra_id', '=', 'grade.gra_id')
            ->select('courses.*', 'teachers.tea_fname', 'grade.gra_class', 'subjects.sub_name', 'grade.gra_group')
            ->where('cou_tea_id', $id)
            ->get();
        return $course;
    }
}
