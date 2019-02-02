<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderUpdate extends Model
{
    protected $table = 'order_updates';
    protected $primaryKey = 'id';

    protected $fillable = [
    	'id', 'name', 'quantity', 'price', 'status', 'idOrder',
    ];

    public function order(){
    	return $this->belongsTo('App\Order','idOrder','id');
    }
}
