<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedules extends Model
{
    //
    use HasFactory;
    protected $table = 'schedules';
    public $timestamps = false;
    protected $pramary = 'sch_id';
    protected $fillable = ['sch_start_time','sch_end_time','sch_day','sch_cou_id'];
}
