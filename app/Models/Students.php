<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    //
    use HasFactory;
    protected $table = 'students';
     protected $pramary = 'stu_id';
    public $timestamps = false;


    protected $fillable = [
        'stu_fname',
        'stu_gra_id',
        'stu_username',
        'stu_password',
        'stu_gender',
        'stu_dob',
        'stu_ph_number',
        'stu_parent_number',
        'stu_profile'
    ];

    public static function displayStudent()
    {
        $students = self::join('grade', 'students.stu_gra_id','=','grade.gra_id')
                ->get();
        return $students;
    }
    public static function insertStudent($data){
        $students = new Students();
        $students->stu_fname = $data['stu_fname'];
        $students->stu_gra_id = $data['stu_gra_id'];
        $students->stu_username = $data['stu_username'];
        $students->stu_password = $data['stu_password'];
        $students->stu_gender = $data['stu_gender'];
        $students->stu_dob = $data['stu_dob'];
        $students->stu_ph_number = $data['stu_ph_number'];
        $students->stu_parent_number = $data['stu_parent_number'];
        $students->stu_profile = $data['stu_profile'];
        $students->save();
        
    }

}
