<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
	protected $table = 'customer'; 
	protected $fillable = [
	'First_name', 'Last_name', 'email','phone'
	];
}
