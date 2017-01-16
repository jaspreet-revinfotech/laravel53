<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmergencyPlanTemplate extends Model
{
    protected $table = 'emergency_plan_templates'; 
    protected $fillable = [
	'tenant_id', 'organisation_id', 'facility_id','slug','name','description','display_sequence','required','template','sortOrder'
	];
}
