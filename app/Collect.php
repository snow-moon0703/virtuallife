<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collect extends Model
{

    public $table = "collect";
    protected $primaryKey = 'member_id';
    public $timestamps    = false;
    protected $fillable   = [
        'm_id', 'p_id', 'c_date',
    ];

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }

}
