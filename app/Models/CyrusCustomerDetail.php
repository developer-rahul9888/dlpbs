<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class CyrusCustomerDetail extends Model
{
	protected $table = 'cyrus_customer_details';
	public $timestamps = false;

	protected $casts = [];

	protected $fillable = [
		'user_id',
		'first_name',
		'last_name',
		'dob',
		'pincode',
		'address',
		'bank',
		'account_type',
		'account_no',
		'account_name',
		'ifsc',
		'mobile',
		'pan',
		'aadhar',
		'status'
	];
}
