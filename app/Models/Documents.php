<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    //
    use  HasFactory;
    protected $table = 'documents';
    protected $primaryKey = 'doc_id';
    public $timestamps = false;
    protected $fillable =
        [
            'doc_type',
            'doc_name',
            'doc_deatial',
            'doc_cou_id',
            'doc_date',
            'doc_file'
        ];
    public static function displayDocument()
    {
        $documents = self::all();
        return $documents;
    }
    public static function insertDocument($data){
        $documents = new Documents();
        $documents->doc_type = $data['doc_type'];
        $documents->doc_name = $data['doc_name'];
        $documents->doc_deatial = $data['doc_deatial'];
        $documents->doc_cou_id = $data['doc_cou_id'];
        $documents->doc_date = $data['doc_date'];
        $documents->save();
        
    }
}
