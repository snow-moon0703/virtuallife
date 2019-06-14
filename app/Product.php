<?php

namespace App;

use App\Collect;
use App\Order;
use App\Review;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    public $table         = "product";
    // protected $primaryKey = 'p_id';
    public $timestamps    = false;
    public $incrementing  = false;

    public function product_image()
    {
        return $this->hasMany('App\Product_image', 'product_id');
    }
    // public function product_image_one()
    // {
    //     return $this->hasMany('App\Product_image', 'id');
    // }

    public function review()
    {
        return $this->hasMany('App\Review', 'product_id');
    }

    public function type()
    {
        return $this->belongsTo('App\Type', 'type_id', 'id');
    }

    public function creator()
    {
        return $this->belongsTo('App\Creator', 'creator_id', 'id');
    }

    public function collect_ch($id, $m_id)
    {
        $collect = Collect::where([['member_id', $m_id], ['product_id', $id]])->first();
        if ($collect) {
            return true;
        }
        return false;
    }

    public function order_ch($id, $m_id)
    {
        $p_id  = substr($id, 0, -4);
        $order = Order::where([['member_id', $m_id], ['product_id', 'like', $p_id . '____']])->first();
        if ($order) {
            return true;
        }
        return false;
    }

    public function review_ch($m_id, $p_id)
    {
        $p_id   = substr($p_id, 0, -4);
        $review = Review::where([['member_id', $m_id], ['product_id', 'like', $p_id . '____']])->first();
        if ($review) {
            return true;
        }
        return false;
    }

}
