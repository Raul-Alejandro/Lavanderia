<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'inventories';
    protected $primaryKey = 'id';

    protected $fillable = [
    	'id', 'product', 'measure', 'quantity', 'idSucursal',
    ];

    public function sucursal(){
    	return $this->belongsTo('App\Sucursal','idSucursal','id');
    }

    public function updates(){
    	return $this->HasMany('App\InventoryUpdates','idInventory');
    }
}
