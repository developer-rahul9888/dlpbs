<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Salary
 * 
 * @property int $id
 * @property int $user_id
 * @property int $amount
 * @property int $tmonth
 * @property string $description
 * @property string $type
 * @property string $status
 * @property Carbon $pay_date
 * @property Carbon $rdate
 *
 * @package App\Models
 */
class Salary extends Model
{
	protected $table = 'salary';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'amount' => 'int',
		'tmonth' => 'int'
	];

	protected $dates = [
		'pay_date',
		'rdate'
	];

	protected $fillable = [
		'user_id',
		'amount',
		'tmonth',
		'description',
		'type',
		'status',
		'pay_date',
		'rdate'
	];
}
