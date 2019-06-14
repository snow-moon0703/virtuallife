<?php

namespace App\EnglishVR;

use Illuminate\Database\Eloquent\Model;

class Errorrecord extends Model
{
    public $table         = "errorrecord";
    protected $primaryKey = 'l_id';
    public $timestamps    = false;
    protected $connection = 'mysql2';

    public function word()
    {
        return $this->belongsTo('App\EnglishVR\Word', 'w_id', 'w_id');
    }
}
