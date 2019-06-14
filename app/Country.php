<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public $table         = "country";
    // protected $primaryKey = 'co_id';
    public $timestamps    = false;

    public function user()
    {
        return $this->belongsTo('App\User', 'member_id');
    }
}
