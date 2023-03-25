<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class Brainsecret extends Model
{
	protected $table = 'brainsecrets';
	public $timestamps = false;

	protected $fillable = [
		'user_id',
		'name',
		'email',
		'phone',
		'password'
	];
}
