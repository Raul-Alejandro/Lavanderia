<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = 'sucursals';
    protected $primaryKey = 'id';

    protected $fillable = [
    	'id', 'name',
    ];

    public function inventory(){
    	return $this->hasOne('App\Inventory','idSucursal');
    }

    public function images(){
    	return $this->hasMany('App\Image','idSucursal');
    }

    public function users(){
    	return $this->hasMany('App\User','idSucursal');
    }

    public function orders(){
    	return $this->hasMany('App\Order','idSucursal');
    }

    public function customers(){
        return $this->hasMany('App\Customer','idSucursal');
    }
}
