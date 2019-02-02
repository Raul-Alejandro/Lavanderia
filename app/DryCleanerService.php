<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DryCleanerService extends Model
{
    protected $table = 'dry_cleaner_services';
    protected $primaryKey = 'id';

    protected $fillable = [
    	'id', 'code', 'name', 'cost', 
    ];

    public function requirement(){
    	return $this->HasMany('App\RequirementService','idDryService');
    }
}
