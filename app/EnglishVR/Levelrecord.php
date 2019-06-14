<?php

namespace App\EnglishVR;

use Illuminate\Database\Eloquent\Model;

class Levelrecord extends Model
{
    public $table         = "levelrecord";
    protected $primaryKey = 'l_id';
    public $timestamps    = false;
    protected $connection = 'mysql2';

    public function errorrecord()
    {
        return $this->hasMany('App\EnglishVR\Errorrecord', 'l_id', 'l_id');
    }
}
