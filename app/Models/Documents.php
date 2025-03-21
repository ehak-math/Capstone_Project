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
            'doc_date'
        ];
}
