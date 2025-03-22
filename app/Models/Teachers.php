<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class teachers extends Model
{
    //
    use HasFactory;
    protected $table = 'teachers';
    protected $primaryKey = 'tea_id';
    public $timestamps = false;
    protected $fillable = [
        'tea_fname',
        'tea_gender',
        'tea_subject',
        'tea_username',
        'tea_password',
        'tea_dob',
        'tea_ph_number',
        'tea_profile'
    ];

    public static function displayTeacher()
    {
        $teachers = self::join('subjects', 'teachers.tea_subject','=','subjects.sub_id')
            ->get();
        return $teachers;
    }

    public static function insertTeacher($data){
        $teacher = new teachers();
        $teacher->tea_fname = $data['tea_fname'];
        $teacher->tea_gender =  $data['tea_gender'];
        $teacher->tea_subject =  $data['tea_subject'];
        $teacher->tea_username =  $data['tea_username'];
        $teacher->tea_password =  $data['tea_password'];
        $teacher->tea_dob =  $data['tea_dob'];
        $teacher->tea_ph_number =  $data['tea_ph_number'];
        $teacher->tea_profile =  $data['tea_profile'];
        $teacher->save();
    }
    
}
