<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';

    protected $fillable = [
    	'id', 'idCustomer', 'delivery_date', 'delivered', 'descount', 'status', 'total', 'balance', 'payment_type', 'charge', 'idUser', 'idSucursal',
    ];

    public function washOrders(){
    	return $this->hasMany('App\WashOrder','idOrder');
    }

    public function ironOrders(){
    	return $this->HasMany('App\IronOrder','idOrder');
    }

    public function dryCleanerOrders(){
    	return $this->hasMany('App\DryCleanerOrder', 'idOrder');
    }

    public function updates(){
        return $this->hasMany('App\OrderUpdate','idOrder');
    }

    public function promotion(){
        return $this->hasOne('App\PromotionOrder', 'idOrder');
    }

    public function sucursal(){
    	return $this->belongsTo('App\Sucursal','idSucursal','id');
    }

    public function user(){
        return $this->belongsTo('App\User','idUser','id');
    }

    public function customer(){
        return $this->belongsTo('App\Customer','idCustomer','id');
    }
}
