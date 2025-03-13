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
}
