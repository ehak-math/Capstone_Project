<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admins extends Model
{
    //
    use HasFactory;
    protected $table = 'admins';
    public $timestamps = false;
    protected $primaryKey = 'adm_id';
    protected $fillable = ['adm_username','adm_password','adm_profile'];

    public static function disAdmin()
    {
        $select = Admins::all() ;
        return $select;
    }


}
