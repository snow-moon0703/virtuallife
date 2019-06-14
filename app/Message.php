<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public $table         = "message";
    // protected $primaryKey = 'me_id';
    public $timestamps    = false;
    // public $incrementing  = false;

    protected $fillable = [
        'm_id', 'a_id', 'me_content', 'me_date',
    ];

    // public function article()
    // {
    //     return $this->belongsTo('App\Article', 'a_id', 'm_id');
    // }

    public function creator()
    {
        return $this->belongsTo('App\Creator', 'creator_id');
    }

}
