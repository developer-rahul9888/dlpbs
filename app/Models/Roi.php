<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Roi
 * @package App\Models
 */
class Roi extends Model
{
	protected $table = 'roi';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'amount' => 'int',
		'tmonth' => 'int'
	];

	protected $fillable = [
		'user_id',
		'amount',
		'tmonth',
		'description',
		'type',
		'status',
		'pay_date'
	];
}
