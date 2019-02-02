<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromotionOrder extends Model
{
    protected $table = 'promotion_orders';
    protected $primaryKey = 'id';

    protected $fillable = [
    	'id', 'name', 'description', 'idOrder', 
    ];

    /*public function promotion(){
    	return $this->belongsTo('App\Promotion','idPromotion','id');
    }*/

    public function order(){
    	return $this->belongsTo('App\Order','idOrder','id');
    }
}
