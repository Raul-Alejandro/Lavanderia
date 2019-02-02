<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IronService extends Model
{
    protected $table = 'iron_services';
    protected $primaryKey = 'id';

    protected $fillable = [
    	'id', 'code', 'name', 'cost', 'promotion_cost',
    ];

    public function requirement(){
    	return $this->HasMany('App\RequirementService','idIronService');
    }
}
