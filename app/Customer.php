<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'id';

    protected $fillable = [
    	'id', 'name', 'phone', 'idSucursal',
    ];

    public function orders(){
    	return $this->hasMany('App\Order','idOrder');
    }

    public function sucursal(){
    	return $this->belongsTo('App\Sucursal','idSucursal','id');
    }
}
