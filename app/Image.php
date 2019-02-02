<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';
    protected $primaryKey = 'id';

    protected $fillable = [
    	'id', 'route', 'idSucursal',
    ];

    public function sucursal(){
    	return $this->belongsTo('App\Sucursal','idSucursal','id');
    }
}
