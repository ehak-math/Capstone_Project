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
}
