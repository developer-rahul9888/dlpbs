<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Membership
 * 
 * @property int $id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $email_addres
 * @property string|null $user_name
 * @property string|null $pass_word
 * @property int $user_level
 * @property Carbon $register_date
 * @property string $phone
 * @property int $permission
 *
 * @package App\Models
 */
class Membership extends Model
{
	protected $table = 'membership';
	public $timestamps = false;

	protected $casts = [
		'user_level' => 'int',
		'permission' => 'int'
	];

	protected $dates = [
		'register_date'
	];

	protected $fillable = [
		'first_name',
		'last_name',
		'email_addres',
		'user_name',
		'pass_word',
		'user_level',
		'register_date',
		'phone',
		'permission'
	];
}
