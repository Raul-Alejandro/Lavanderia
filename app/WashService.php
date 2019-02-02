<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WashService extends Model
{
    protected $table = 'wash_services';
    protected $primaryKey = 'id';

    protected $fillable = [
    	'id', 'code', 'name', 'measure', 'cost', 
    ];

    public function requirement(){
    	return $this->HasMany('App\RequirementService','idWashService');
    }
}
