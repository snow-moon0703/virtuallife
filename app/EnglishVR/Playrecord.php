<?php

namespace App\EnglishVR;

use Illuminate\Database\Eloquent\Model;

class Playrecord extends Model
{
    public $table         = "playrecord";
    protected $primaryKey = 'p_id';
    public $timestamps    = false;
    protected $connection = 'mysql2';

    public function levelrecord()
    {
        return $this->belongsTo('App\EnglishVR\Levelrecord', 'lv1_id', 'l_id');
    }
    public function levelrecord2()
    {
        return $this->belongsTo('App\EnglishVR\Levelrecord', 'lv2_id', 'l_id');
    }
    public function levelrecord3()
    {
        return $this->belongsTo('App\EnglishVR\Levelrecord', 'lv3_id', 'l_id');
    }
}
