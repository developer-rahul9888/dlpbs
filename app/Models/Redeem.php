<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RedeemBliss
 * 
 * @property int $rd_id
 * @property string $bank_tran
 * @property string $balance
 * @property string $redeem
 * @property int $after_tds
 * @property int $user_id
 * @property string $redeem_status
 * @property Carbon $rdate
 * @property string $status
 * @property string $voucher_email
 * @property string $my_bliss_req
 *
 * @package App\Models
 */
class Redeem extends Model
{
	protected $table = 'redeem';
	protected $primaryKey = 'id';
	public $timestamps = false;

	protected $casts = [
		'after_tds' => 'int',
		'user_id' => 'int'
	];

	protected $dates = [];

	protected $fillable = [
		'bank_tran',
		'balance',
		'redeem',
		'reserve',
		'after_tds',
		'user_id',
		'redeem_status',
		'status',
		'data',
		'voucher_email',
		'my_bliss_req'
	];
}
