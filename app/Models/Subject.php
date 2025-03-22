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

    public static function displaySubject()
    {
        $subjects = self::all();
        return $subjects;
    }

    public static function insertSubject($data){
        $subject = new Subject();
        $subject->sub_name = $data['sub_name'];
        $subject->sub_image = $data['sub_image'];
        $subject->save();
    }
    
}
