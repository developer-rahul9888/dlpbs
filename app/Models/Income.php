<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Income
 * 
 * @property int $id
 * @property int $user_id
 * @property float $amount
 * @property int $user_send_by
 * @property string $type
 * @property int $pay_level
 * @property string $description
 * @property string $status
 * @property Carbon $c_date
 *
 * @package App\Models
 */
class Income extends Model
{
	protected $table = 'incomes';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'amount' => 'float',
		'user_send_by' => 'int',
		'pay_level' => 'int'
	];

	protected $dates = [
		'c_date'
	];

	protected $fillable = [
		'user_id',
		'amount',
		'user_send_by',
		'type',
		'pay_level',
		'description',
		'status',
		'c_date'
	];
}
