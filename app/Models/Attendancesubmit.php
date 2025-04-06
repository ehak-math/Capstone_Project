<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendancesubmit extends Model
{
    //
    use HasFactory;
    protected $table = 'attendance_submit';
    public $timestamps = false;
    protected $pramary = 'att_sub_id';
    protected $fillable =['att_sub_code',
    'att_sub_time',
    'att_sub_status',
    'att_sub_stu_id',
    'att_sub_att_id',
    'att_sub_sch_id',
    'att_sub_date',
    ];
}
