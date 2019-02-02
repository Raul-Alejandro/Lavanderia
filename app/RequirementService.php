<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequirementService extends Model
{
    protected $table = 'requirement_services';
    protected $primaryKey = 'id';

    protected $fillable = [
    	'id', 'quantity', 'type', 'idWashService', 'idIronService', 'idDryService', 'idPromotion',
    ];

    public function promotion(){
    	return $this->belongsTo('App\Promotion','idPromotion','id');
    }

    public function washService(){
    	return $this->belongsTo('App\WashService','idWashService','id');
    }

    public function ironService(){
    	return $this->belongsTo('App\IronService','idIronService','id');
    }

    public function dryService(){
    	return $this->belongsTo('App\DryCleanerService','idDryService','id');
    }
}
