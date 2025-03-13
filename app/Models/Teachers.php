<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;

class Teachers extends Model
{
    use HasFactory;

    protected $table = 'teachers';
    protected $primaryKey = 'tea_id';

    protected $fillable = [
        'tea_fname',
        'tea_username',
        'tea_gender',
        'tea_subject',
        'tea_ph_number',
        'tea_dob',
        'tea_password'
    ];
}
