<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scores extends Model
{
    //
    use HasFactory;
    protected $table = 'scores';
    protected $primaryKey = 'sco_id';
    public $timestamps = false;
    protected $fillable = [
        'sco_point',
        'sco_month',
        'sco_cou_id',
        'sco_stu_id'
    ];

    public static function getAllScores(){
        $score = self::all();
        return $score;
    }

    public static function getAllScoresByMonth($month){
//        TODO
    }
    public static function getAllScoresByStudent($StuID){
        $sco_stu = self::join('courses', 'scores.sco_cou_id', '=', 'courses.cou_id')            ->join('grade', 'courses.cou_gra_id','=','grade.gra_id')
            ->join('students', 'scores.sco_stu_id','=' , 'students.stu_id')
            ->join('teachers', 'courses.cou_tea_id', '=', 'teachers.tea_id')
            ->join('subjects', 'teachers.tea_subject','=','subjects.sub_id')
            ->where('scores.sco_stu_id','=',$StuID)
            ->select(
                'scores.*',
                'grade.gra_class',
                'grade.gra_group',
                'subjects.sub_name',
                'subjects.sub_image',
                'teachers.tea_fname',
                'courses.cou_gra_id',
                'students.stu_fname'
            )
            ->get();
    return $sco_stu;
    }

}
