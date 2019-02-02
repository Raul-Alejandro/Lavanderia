<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WashOrder extends Model
{
    protected $table = 'wash_orders';
    protected $primaryKey = 'id';

    protected $fillable = [
    	'id', 'quantity', 'weight', 'free', 'service', 'cost', 'idOrder',
    ];

    public function order(){
    	return $this->belongsTo('App\Order','idOrder','id');
    }

    /*public function service(){
    	return $this->belongsTo('App\WashService','idService','id');
    }*/
}
