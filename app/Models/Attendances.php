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
    [
    'att_code',
    'att_startime',
    'att_endtime',
    'att_cou_id',
    'att_status'
    ];
    // public static function displayAttendance()
    // {
    //     $attendance = self::join('students', 'attendances.att_student_id','=','students.stu_id')
    //             ->join('courses', 'attendances.att_cou_id','=','courses.cou_id')
    //             ->get();
    //     return $attendance;
    // }
    
    
}
