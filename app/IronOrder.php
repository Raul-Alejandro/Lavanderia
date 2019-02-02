<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IronOrder extends Model
{
    protected $table = 'iron_orders';
    protected $primaryKey = 'id';

    protected $fillable = [
    	'id', 'quantity', 'promotion', 'free', 'service', 'cost', 'idOrder',
    ];

    public function order(){
    	return $this->belongsTo('App\Order','idOrder','id');
    }

    /*public function service(){
    	return $this->belongsTo('App\IronService','idService','id');
    }*/
}
