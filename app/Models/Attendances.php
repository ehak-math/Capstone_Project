<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendances extends Model
{
    //
    use HasFactory;
    protected $table = 'attendances';
    public $timestamps = false;
    protected $pramary = 'att_id';
    protected $fillable =
    ['att_student_id',
    'att_code',
    'att_veryfy_code',
    'att_startime',
    'att_subtime',
    'att_endtime',
    'att_cou_id',
    'att_status'
    ];
    public static function displayAttendance()
    {
        $attendance = self::join('students', 'attendances.att_student_id','=','students.stu_id')
                ->join('courses', 'attendances.att_cou_id','=','courses.cou_id')
                ->get();
        return $attendance;
    }
    public static function insertAttendance($data){
        $attendance = new Attendances();
        $attendance->att_student_id = $data['att_student_id'];
        $attendance->att_code = $data['att_code'];
        $attendance->att_veryfy_code = $data['att_veryfy_code'];
        $attendance->att_startime = $data['att_startime'];
        $attendance->att_subtime = $data['att_subtime'];
        $attendance->att_endtime = $data['att_endtime'];
        $attendance->att_cou_id = $data['att_cou_id'];
        $attendance->att_status = $data['att_status'];
        $attendance->save();
        
    }
    
}
