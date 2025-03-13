<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Subjects extends Model
{
    use HasFactory;
    protected $table = 'subjects';
    protected $primaryKey = 'sub_id';
    protected $fillable = [
        'sub_name',
    ];
}
