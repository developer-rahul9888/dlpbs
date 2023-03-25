<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PinRequest
 * 
 * @property int $id
 * @property string $name
 * @property string $customer_id
 * @property string $email
 * @property string $tr_pin
 * @property string $amount
 * @property string $phone
 * @property string $bank_name
 * @property string $bank_branch
 * @property string $account_no
 * @property string $ifsc_code
 * @property string $neft
 * @property string $image
 * @property string $pins
 * @property string $package
 * @property string $comment
 * @property string $reply
 * @property string $status
 * @property Carbon $date
 *
 * @package App\Models
 */
class FundRequest extends Model
{
	protected $table = 'fund_requests';
	public $timestamps = false;

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'name',
		'customer_id',
		'email',
		'tr_pin',
		'amount',
		'phone',
		'bank_name',
		'bank_branch',
		'account_no',
		'ifsc_code',
		'neft',
		'image',
		'pins',
		'package',
		'comment',
		'reply',
		'status',
		'date'
	];
}
