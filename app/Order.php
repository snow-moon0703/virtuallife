<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // protected $primaryKey = 'o_id';
    public $timestamps    = false;

    protected $fillable = [
        'o_date', 'o_condition', 'm_id', 'p_id', 'o_price',
    ];

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
