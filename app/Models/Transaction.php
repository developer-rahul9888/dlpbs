<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TransactionWallet
 * 
 * @property int $id
 * @property string $user_id
 * @property string $send_to
 * @property string $send_by
 * @property string $type
 * @property string $wallet_type
 * @property string $description
 * @property float $amount
 * @property int $credit
 * @property int $debit
 * @property string $status
 * @property string $bank_tran
 * @property Carbon $rdate
 *
 * @package App\Models
 */
class Transaction extends Model
{
	protected $table = 'transactions';
	public $timestamps = false;

	protected $casts = [];

	protected $fillable = [
		'user_id',
		'send_by',
		'type',
		'amount',
		'status',
		'trans_type',
	];
}
