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
    protected $primaryKey = 'sch_id';
    protected $fillable = ['sch_start_time','sch_date','sch_end_time','sch_day','sch_cou_id'];

    public static function displaySchedule()
    {
        $listSchedule= self::join('courses','courses.cou_id','=','schedules.sch_cou_id')
            ->join('teachers','teachers.tea_id','=','courses.cou_tea_id')
            ->join('subjects','subjects.sub_id' ,'=', 'teachers.tea_id')
            ->get();
        return $listSchedule;
    }
    public static function insertSchedule($data){
        $schedule = new Schedules();
        $schedule->sch_start_time = $data['sch_start_time'];
        $schedule->sch_end_time = $data['sch_end_time'];
        $schedule->sch_day = $data['sch_day'];
        $schedule->sch_cou_id = $data['sch_cou_id'];
        $schedule->save();
        
    }
}
