<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Income;
use App\Models\Transaction;
use App\Models\FundRequest;

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
class Customer extends Authenticatable
{
	protected $table = 'customer';
	public $timestamps = false;

	protected $casts = [
		'percentage' => 'int',
		'pincode' => 'int',
		'bliss_amount' => 'float',
		'points' => 'int',
		'reward_wallet' => 'int',
		'cashback_amount' => 'int',
		'user_level' => 'int',
		'capping' => 'int',
		'consume' => 'int',
		'direct' => 'int',
		'left_direct' => 'int',
		'right_direct' => 'int',
		'sbv' => 'float',
		'package' => 'int',
		'franchise' => 'int',
		'booster' => 'int',
		'reward' => 'int'
	];

	protected $dates = [
		'rdate'
	];

	protected $fillable = [
		'f_name',
		'l_name',
		'full_name',
		'email',
		'pass_word',
		'tr_pin',
		'parent_customer_id',
		'customer_id',
		'direct_customer_id',
		'placement',
		'phone',
		'bsacode',
		'rank',
		'percentage',
		'image',
		'gender',
		'dob',
		'address',
		'city',
		'state',
		'country',
		'pincode',
		'nominee',
		'nominee_rel',
		'nominee_dob',
		'pancard',
		'panimage',
		'applied_pan',
		'aadhar',
		'aadharimage',
		'b_aadhar_img',
		'applied_aadhar',
		'bank_name',
		'bank_img',
		'back_adhar_img',
		'bank_prof_img',
		'branch',
		'account_name',
		'account_type',
		'account_no',
		'bank_city',
		'bank_state',
		'ifsc',
		'status',
		'var_status',
		'repurchase',
		'bliss_amount',
		'points',
		'reward_wallet',
		'cashback_amount',
		'user_level',
		'capping',
		'consume',
		'direct',
		'club',
		'left_direct',
		'right_direct',
		'sbv',
		'package',
		'package_used',
		'token',
	];

	public function incomes(){
		return $this->hasMany(Income::class, 'user_id', 'id')->latest();
	}

	public function transaction(){
		return $this->hasMany(Transaction::class, 'user_id', 'id')->latest();
	}

	public function redeem(){
		return $this->hasMany(Redeem::class, 'user_id', 'id')->latest();
	}

	public function fundRequest(){
		return $this->hasMany(FundRequest::class, 'user_id', 'id')->latest();
	}

	public function cyrusDetail(){
		return $this->hasOne(CyrusCustomerDetail::class, 'user_id', 'id');
	}

	public function brainsecret(){
		return $this->hasOne(Brainsecret::class, 'user_id', 'id');
	}

	public function roi(){
		return $this->hasOne(Roi::class, 'user_id', 'id');
	}

	public function sponsor(){
		return $this->belongsTo(Customer::class, 'direct_customer_id', 'customer_id');
	}

	public function directIncome(){
		return $this->hasMany(Income::class, 'user_id', 'id')
		->leftJoin('customer','customer.id','=','incomes.user_send_by')
		->select(['incomes.*','customer.customer_id','customer.direct_customer_id','customer.full_name'])
		->latest()
		->where('type','Direct Income')->latest();
	}

	public function levelIncome(){
		return $this->hasMany(Income::class, 'user_id', 'id')
		->leftJoin('customer','customer.id','=','incomes.user_send_by')
		->select(['incomes.*','customer.customer_id','customer.direct_customer_id','customer.full_name'])
		->latest()
		->where('type','Level Income')->latest();
	}

	public function basicPoolIncome(){
		return $this->hasMany(Income::class, 'user_id', 'id')
		->leftJoin('customer','customer.id','=','incomes.user_send_by')
		->select(['incomes.*','customer.customer_id','customer.direct_customer_id','customer.full_name'])
		->latest()
		->where('type','Basic Pool Income')->latest();
	}

	public function proPoolIncome(){
		return $this->hasMany(Income::class, 'user_id', 'id')
		->leftJoin('customer','customer.id','=','incomes.user_send_by')
		->select(['incomes.*','customer.customer_id','customer.direct_customer_id','customer.full_name'])
		->latest()
		->where('type','Pro Pool Income')->latest();
	}

	public function proBinaryIncome(){
		return $this->hasMany(Income::class, 'user_id', 'id')
		->leftJoin('customer','customer.id','=','incomes.user_send_by')
		->select(['incomes.*','customer.customer_id','customer.direct_customer_id','customer.full_name'])
		->latest()
		->where('type','Pro Binary Income')->latest();
	}

	public function masterPoolIncome(){
		return $this->hasMany(Income::class, 'user_id', 'id')
		->leftJoin('customer','customer.id','=','incomes.user_send_by')
		->select(['incomes.*','customer.customer_id','customer.direct_customer_id','customer.full_name'])
		->latest()
		->where('type','Master Pool Income')->latest();
	}

	public function masterBinaryIncome(){
		return $this->hasMany(Income::class, 'user_id', 'id')
		->leftJoin('customer','customer.id','=','incomes.user_send_by')
		->select(['incomes.*','customer.customer_id','customer.direct_customer_id','customer.full_name'])
		->latest()
		->where('type','Master Binary Income')->latest();
	}

	public function superPoolIncome(){
		return $this->hasMany(Income::class, 'user_id', 'id')
		->leftJoin('customer','customer.id','=','incomes.user_send_by')
		->select(['incomes.*','customer.customer_id','customer.direct_customer_id','customer.full_name'])
		->latest()
		->where('type','Super Pool Income')->latest();
	}

	public function superBinaryIncome(){
		return $this->hasMany(Income::class, 'user_id', 'id')
		->leftJoin('customer','customer.id','=','incomes.user_send_by')
		->select(['incomes.*','customer.customer_id','customer.direct_customer_id','customer.full_name'])
		->latest()
		->where('type','Super Binary Income')->latest();
	}

	public function superFastPoolIncome(){
		return $this->hasMany(Income::class, 'user_id', 'id')
		->leftJoin('customer','customer.id','=','incomes.user_send_by')
		->select(['incomes.*','customer.customer_id','customer.direct_customer_id','customer.full_name'])
		->latest()
		->where('type','Super Fast Pool Income')->latest();
	}

	public function superFastBinaryIncome(){
		return $this->hasMany(Income::class, 'user_id', 'id')
		->leftJoin('customer','customer.id','=','incomes.user_send_by')
		->select(['incomes.*','customer.customer_id','customer.direct_customer_id','customer.full_name'])
		->latest()
		->where('type','Super Fast Binary Income')->latest();
	}

	public function directorPoolIncome(){
		return $this->hasMany(Income::class, 'user_id', 'id')
		->leftJoin('customer','customer.id','=','incomes.user_send_by')
		->select(['incomes.*','customer.customer_id','customer.direct_customer_id','customer.full_name'])
		->latest()
		->where('type','Director Pool Income')->latest();
	}

	public function directorBinaryIncome(){
		return $this->hasMany(Income::class, 'user_id', 'id')
		->leftJoin('customer','customer.id','=','incomes.user_send_by')
		->select(['incomes.*','customer.customer_id','customer.direct_customer_id','customer.full_name'])
		->latest()
		->where('type','Director Binary Income')->latest();
	}

	public function salaryIncome(){
		return $this->hasMany(Income::class, 'user_id', 'id')
		->leftJoin('customer','customer.id','=','incomes.user_send_by')
		->select(['incomes.*','customer.customer_id','customer.direct_customer_id','customer.full_name'])
		->latest()
		->where('type','Salary Income')->latest();
	}

	public function binaryIncome(){
		return $this->hasMany(Income::class, 'user_id', 'id')
		->leftJoin('customer','customer.id','=','incomes.user_send_by')
		->select(['incomes.*','customer.customer_id','customer.direct_customer_id','customer.full_name'])
		->latest()
		->where('type','Binary Income')->latest();
	}

	public function weeklyFixIncome(){
		return $this->hasMany(Income::class, 'user_id', 'id')
		->leftJoin('customer','customer.id','=','incomes.user_send_by')
		->select(['incomes.*','customer.customer_id','customer.direct_customer_id','customer.full_name'])
		->latest()
		->where('type','Weekly Fix Income')->latest();
	}

	public function directTeam(){
		return $this->hasMany(Customer::class, 'direct_customer_id', 'customer_id')->latest();
	}

	/**
     * Add a mutator to ensure hashed passwords
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = md5($password);
    }

}
