<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Creator extends Model
{
    public $table         = "creator";
    // protected $primaryKey = 'm_id';
    public $timestamps    = false;

    public function user()
    {
        return $this->belongsTo('App\User', 'id', 'id');
    }

    public function product()
    {
        return $this->hasMany('App\Product', 'creator_id');
    }

    public function article()
    {
        return $this->hasMany('App\Article', 'creator_id');
    }

}
