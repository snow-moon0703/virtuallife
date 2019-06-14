<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product_image extends Model
{
    public $table         = "product_image";
    protected $primaryKey = 'product_id';
    public $timestamps    = false;
    public $incrementing  = false;
    //public $incrementing  = false;
    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }
}
