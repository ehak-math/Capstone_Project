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

    public static function displayGrade()
    {
        $grades = self::all();
        return $grades;
    }
<<<<<<< HEAD
=======

>>>>>>> c0d6700 (honghav)
    public static function insertGrade($data){
        $grade = new Grade();
        $grade->gra_class = $data['gra_class'];
        $grade->gra_team_id = $data['gra_team_id'];
        $grade->gra_group = $data['gra_group'];
        $grade->save();
<<<<<<< HEAD
        
=======
>>>>>>> c0d6700 (honghav)
    }
}   
