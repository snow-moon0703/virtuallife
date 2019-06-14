<?php

namespace App\EnglishVR;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    public $table         = "word";
    protected $primaryKey = 'w_id';
    public $timestamps    = false;
    protected $connection = 'mysql2';
}
