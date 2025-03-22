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
    protected $pramary = 'cou_id';
    protected $fillable = ['cou_tea_id','cou_gra_id'];

    public static function displayCourse()
    {
        $listcourses = self::join('teachers', 'courses.cou_tea_id','=','teachers.tea_id')
            ->join('grade', 'courses.cou_gra_id','=','grade.gra_id')
            ->select('courses.*','teachers.tea_fname','grade.gra_class')
            ->get();
        return $listcourses;
    }
    public static function insertCourse($data){
        $course = new Course();
        $course->cou_tea_id = $data['cou_tea_id'];
        $course->cou_gra_id = $data['cou_gra_id'];
        $course->save();
        
    }
}
