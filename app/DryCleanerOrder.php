<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DryCleanerOrder extends Model
{
    protected $table = 'dry_cleaner_orders';
    protected $primaryKey = 'id';

    protected $fillable = [
    	'id', 'quantity', 'descount', 'service', 'cost', 'idOrder',
    ];

    public function order(){
    	return $this->belongsTo('App\Order','idOrder','id');
    }

    /*public function service(){
    	return $this->belongsTo('App\DryCleanerService','idService','id');
    }*/
}
