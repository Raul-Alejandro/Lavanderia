<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryUpdates extends Model
{
    protected $table = 'inventory_updates';
    protected $primaryKey = 'id';

    protected $fillable = [
    	'id', 'type', 'quantity', 'idInventory',
    ];

    public function inventory(){
    	return $this->belongsTo('App\Inventory','idInventory','id');
    }
}
