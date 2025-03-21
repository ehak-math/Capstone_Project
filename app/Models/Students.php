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


}
