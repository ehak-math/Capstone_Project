<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scores extends Model
{
    //
    use HasFactory;
    protected $table = 'scores';
    protected $primaryKey = 'sco_id';
    public $timestamps = false;
    protected $fillable = [
        'sco_point',
        'sco_month',
        'sco_cou_id',
        'sco_stu_id'
    ];
}
