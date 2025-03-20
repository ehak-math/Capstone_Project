<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    //
    use HasFactory;
    protected $table = 'grade';
    public $timestamps = false;
    protected $pramary = 'gra_id';
    protected $fillable = ['gra_class','gra_team_id' , 'gra_group'];
}
