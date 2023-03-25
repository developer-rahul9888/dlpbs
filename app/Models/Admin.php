<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Income;

/**
 * Class Customer
 * 
 * @property int $id
 * @property string $f_name
 * @property string $l_name
 * @property string $email
 * @property string $pass_word
 * @property string $tr_pin
 * @property string $parent_customer_id
 * @property string $customer_id
 * @property string $direct_customer_id
 * @property string $position
 * @property string $phone
 * @property string $bsacode
 * @property string $rank
 * @property int $percentage
 * @property string $image
 * @property string $gender
 * @property string $dob
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $country
 * @property int $pincode
 * @property string $nominee
 * @property string $nominee_rel
 * @property string $nominee_dob
 * @property string $pancard
 * @property string $panimage
 * @property string $applied_pan
 * @property string $aadhar
 * @property string $aadharimage
 * @property string $b_aadhar_img
 * @property string $applied_aadhar
 * @property string $bank_name
 * @property string $bank_img
 * @property string $back_adhar_img
 * @property string $bank_prof_img
 * @property string $branch
 * @property string $account_name
 * @property string $account_type
 * @property string $account_no
 * @property string $bank_city
 * @property string $bank_state
 * @property string $ifsc
 * @property string $status
 * @property string $var_status
 * @property string $repurchase
 * @property float $bliss_amount
 * @property int $points
 * @property int $reward_wallet
 * @property int $cashback_amount
 * @property int $user_level
 * @property int $capping
 * @property int $consume
 * @property int $direct
 * @property int $left_direct
 * @property int $right_direct
 * @property float $sbv
 * @property int $package
 * @property string $package_used
 * @property int $franchise
 * @property int $booster
 * @property int $reward
 * @property Carbon $rdate
 *
 * @package App\Models
 */
class Admin extends Authenticatable
{
	protected $table = 'admins';
    
	public $timestamps = false;

	protected $casts = [];

	protected $fillable = [
		'first_name',
		'last_name',
		'email_addres',
		'user_name',
		'password',
		'user_level',
        'phone',
        'permission'
		
	];

	public function incomes(){
		return $this->hasMany(Income::class, 'user_id', 'id');
	}

	public function levelIncome(){
		return $this->hasMany(Income::class, 'user_id', 'id')
		->leftJoin('customer','customer.id','=','incomes.user_id')
		->select(['incomes.*','customer.customer_id','customer.direct_customer_id','customer.full_name'])
		->where('type','Level Income');
	}

	public function directTeam(){
		return $this->hasMany(Customer::class, 'direct_customer_id', 'customer_id');
	}

}
