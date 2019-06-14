<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public $table         = "review";
    protected $primaryKey = 'member_id';
    public $timestamps    = false;
    public $incrementing  = false;

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'member_id');
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
