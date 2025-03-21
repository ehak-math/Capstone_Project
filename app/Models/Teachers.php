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

}
