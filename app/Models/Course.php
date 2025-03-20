<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    use HasFactory;
    protected $table = 'courses';
    public $timestamps = false;
    protected $pramary = 'cou_id';
    protected $fillable = ['cou_tea_id','cou_gra_id'];
}
