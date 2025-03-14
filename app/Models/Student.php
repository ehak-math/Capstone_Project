<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;
class Student extends Model
{
    //
    use HasFactory;
    protected $table = 'students';
    protected $primaryKey = 'stu_id';
    public $timestamps = false; // Disable created_at and updated_at
    protected $fillable = [
        'stu_fname',
        'stu_username', 
        'stu_gender' ,
        'stu_grade' ,
        'stu_group' ,
        'stu_ph_number', 
        'stu_parent_number', 
        'stu_profile' ,
        'stu_dob' ,
        'stu_password', 
    ];
}
