<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $table = 'grade'; // Table name
    public $timestamps = false; // Disable timestamps
    protected $primaryKey = 'gra_id';
    protected $fillable = ['gra_class', 'gra_team_id', 'gra_group'];

    public static function displayGrade()
    {
        $grades = self::all();
        return $grades;
    }

    public static function insertGrade($data)
    {
        $grade = new Grade();
        $grade->gra_class = $data['gra_class'];
        $grade->gra_team_id = $data['gra_team_id'];
        $grade->gra_group = $data['gra_group'];
        $grade->save();
    }
}