<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public $table         = "article";
    // protected $primaryKey = 'a_id';
    public $timestamps    = false;

    protected $fillable = [
        'm_id', 'a_title', 'a_content', 'a_date',
    ];
    public function creator()
    {
        return $this->belongsTo('App\Creator', 'creator_id', 'id');
    }

    public function message()
    {
        return $this->hasMany('App\Message', 'article_id', 'id');
    }
}
