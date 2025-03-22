<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //
    use HasFactory;
    protected $table = 'subjects';
    protected $primaryKey = 'sub_id';
    public $timestamps = false;
    protected $fillable = [
        'sub_name',
        'sub_image'
    ];
    
}
