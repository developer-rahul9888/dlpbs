<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class Summary extends Model
{
	protected $table = 'summary';
	public $timestamps = false;

	protected $fillable = [
		'user_id',
		'orderId',
		'txnAmount',
		'txnId',
		'bankTxnId',
		'paymentMode',
		'txnDate',
		'utr',
		'sender_name',
		'sender_note',
		'payee_vpa',
		'signature',
		'qrData',
		'qrImage',
		'txid',
		'status'
	];
}
