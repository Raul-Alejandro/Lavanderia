<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $table = 'promotions';
    protected $primaryKey = 'id';

    protected $fillable = [
    	'id', 'name', 'description', 'status',
    ];

    public function requirements(){
    	return $this->hasMany('App\RequirementService','idPromotion');
    }

    /*public function orders(){
    	return $this->hasMany('App\PromotionOrder','idPromotion');
    }*/
}
