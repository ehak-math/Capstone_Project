<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
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

    public function courses()
    {
        return $this->hasMany(Course::class, 'cou_sub_id', 'sub_id');
    }

    public function teachers()
    {
        return $this->hasMany(Teachers::class, 'sub_id', 'id');
    }


    public static function insertSubject($data){
        $subject = new Subjects();
        $subject->sub_name = $data['sub_name'];
        $subject->sub_image = $data['sub_image'];
        $subject->save();
    }

    

    public static function updateSubject($id, $data)
    {
        $subject = self::findOrFail($id);
        
        if (isset($data['sub_name'])) {
            $subject->sub_name = $data['sub_name'];
        }
        
        if (isset($data['sub_image'])) {
            $subject->sub_image = $data['sub_image'];
        }
        
        $subject->save();
        return $subject;
    }
}
