<?php

namespace App\Repositories;


use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Webstore;
use App\Models\Income;
use App\Models\Summary;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Auth;


/**
 * Class UserRepository
 * @package App\Repositories
 * @version June 30, 2021, 7:13 am UTC
*/

class CustomerRepository extends BaseRepository
{


    public function withdraw($amount) {
        
        DB::table('transactions')->insert([
            'created_at' => date('Y-m-d H:i:s'),
            'user_id' => auth()->user()->id,
            'amount'  => $amount,
            'trans_type' => 'W',
            'type' => 'Debit',
            'note' => 'Withdraw'
        ]);
        return true;
    }

    public function withdrawAmount() {
        return DB::table('transactions')
        ->where('user_id',auth()->user()->id)
        ->where('trans_type','W')
        ->sum('amount');
    }

    public function getUserByCustomerId($customerId) {
        return Customer::where('customer_id',$customerId)->first();
    }

    public function getUserBussinessByCustomerId($customerId,$pool) {
        return DB::table('customer')
        ->where('customer_id',$customerId)
        ->select('*')
        ->addSelect(['bv_left' => DB::table('distribution_amount')->selectRaw('SUM(amount)')->whereColumn('user_id', '=', 'customer.id')->where('status', '=', 'Active')->where('type', '=', 'left')->where('pool', '=', $pool)])
        ->addSelect(['bv_right' => DB::table('distribution_amount')->selectRaw('SUM(amount)')->whereColumn('user_id', '=', 'customer.id')->where('status', '=', 'Active')->where('type', '=', 'right')->where('pool', '=', $pool)])
        ->addSelect(['matching' => DB::table('distribution_amount')->select('id')->whereColumn('user_id', '=', 'customer.id')->where('status', '=', 'Active')->where('type', '=', 'Matching')->where('pool', '=', $pool)->limit(1)])
        ->first();
    }

    public function createTransaction($data) {
        return DB::table('transactions')->insertGetId($data);
    }

    public function createDistributionAmount($data) {
        return DB::table('distribution_amount')->insert($data);
    }

    public function updateDistributionAmount($userId,$pool) {
        return DB::table('distribution_amount')->where('user_id',$userId)->where('pool',$pool)->update(['status'=>'Redeem']);
    }

    public function addFund($amount) {
        auth()->user()->increment('wallet',$amount);
        return true;
    }

    public function storeSummary($data) {
        return Summary::create($data);
    }

    public function checkTransaction($utr) {
        return Summary::where('utr',$utr)->first(); 
    }

    public function getTransactionByorderId($orderId) {
        return Summary::where('orderId',$orderId)->first(); 
    }

    public function updateSummary($id,$data) {
        return Summary::where('id',$id)->update($data);
    }

    public function addDirectIncome($user) {
        
        $sponsorData = Customer::where('customer_id',$user->direct_customer_id)->first();
        $data = [
            'user_id' => $sponsorData->id,
            'amount' => 100,
            'user_send_by' => $user->id,
            'type' =>'Direct Income',
            'pay_level' => 1,
        ];
        $sponsorData->increment('credit',100);

        if($user->consume == 0) {
            // if($sponsorData->direct >= 3 && $sponsorData->club == 0) {
            //     $sponsorData->club = 1;
            //     $sponsorData->save();
            // }
            $sponsorData->increment('direct');
        }
        return Income::create($data);
    }


    public function addBinaryIncome($user,$pool) {

        $amount = $this->getBinaryIncome($pool)['amount'];
        $type = $this->getBinaryIncome($pool)['type'];
        $data = [
            'user_id' => $user->id,
            'amount'  => $amount,
            'type' => $type,
            'pay_level' => 1,
        ];
        DB::table('customer')->where('id',$user->id)->increment('credit',$amount);
        return Income::create($data);
    }

    public function activateUser($user) {
        if($user->consume == 0) {
            $user->consume = 1;
            $user->user_level = 1;
            $user->package = 299;
            $user->package_used = date('Y-m-d H:i:s');
            $user->save();
        } else {
            $user->user_level = $user->user_level + 1;
            $user->save();
        }
    }

    public function levelIncomeDistribution($user) {
        $level = 7; $payLevel = 1;
        $levelIncome = [2,2,2,2,2,2,2,2,2,2];
        $customerId = $user->direct_customer_id;
        for($p=0;$p < $level;$p++) {
            $user = Customer::where('customer_id',$customerId)->first();
            if(!$user) { break; }
            if($user->consume==0) { continue; }
            $addIncome = [
                'user_id' => $user->id,
                'amount' => $levelIncome[$p],
                'user_send_by' => $user->id,
                'type' =>'Level Income',
                'pay_level' => 1,
            ];
            $user->increment('credit',$levelIncome[$p]);
            Income::create($addIncome);
            $payLevel++;
            $customerId = $user->direct_customer_id;
        }
        return true;
    }

    public function uniLevelAutoPoolIncome($user,$pool) {

        $checkTable = DB::table('autopool')->where('pool',$pool)->first();
        if(!$checkTable) {
            DB::table('autopool')->insert(['user_id'=>1,'parent_id'=>0,'eligible'=>1,'pool'=>$pool]);
        }
        $userId = $user->id;
        $this->uniLevelAutoPoolDistribution($userId,$pool);
    }

    public function uniLevelAutoPoolDistribution($userId,$pool,$eligible=1,$poolId=0) {
        $parentPool = DB::table('autopool')->where('direct','<',2)->where('pool',$pool)->first();
        $dataToStore = [
            'user_id' => $userId,
            'pool_id' => $poolId,
            'parent_id' => $parentPool->id,
            'eligible' => $eligible,
            'pool' => $pool
        ];
        DB::table('autopool')->insert($dataToStore);
        DB::table('autopool')->where('id',$parentPool->id)->increment('direct');

        if($parentPool->direct == 1) {
            if($parentPool->eligible == 1) {
                $amount = $this->getPoolIncomeName($pool)['amount'];
                DB::table('incomes')->insert([
                    'user_id' => $parentPool->user_id,
                    'amount'  => $amount,
                    'user_send_by' => $userId,
                    'type' => $this->getPoolIncomeName($pool)['type'],
                    'pay_level' => 1
                ]);
                Customer::where('id',$parentPool->user_id)->increment('credit',$amount);
            }

            $poolId = ($parentPool->pool_id > 0)?$parentPool->pool_id:$parentPool->id;
            if($parentPool->eligible == 1) {
                $this->uniLevelAutoPoolDistribution($parentPool->user_id, $pool, 0, $poolId);
            } else {
                for($i=1;$i<=2;$i++) {
                    $this->uniLevelAutoPoolDistribution($parentPool->user_id, $pool, 1, $poolId);
                }
            }
        }
    }

    public function getPoolIncomeName($pool) {

        switch ($pool) {
        case 1:
            return  ['amount' => 150,'type' => 'Basic Pool Income'];
            break;
        case 2:
            return  ['amount' => 240,'type' => 'Pro Pool Income'];
            break;
        case 3:
            return  ['amount' => 400,'type' => 'Master Pool Income'];
            break;
        case 4:
            return  ['amount' => 800,'type' => 'Super Pool Income'];
            break;
        case 5:
            return  ['amount' => 1600,'type' => 'Super Fast Pool Income'];
        break;
        case 6:
            return  ['amount' => 3200,'type' => 'Director Pool Income'];
            break;
        default:
            return  ['amount' => 150,'type' => 'Basic Pool Income'];
        }
    }

    public function getBinaryIncome($pool) {


        switch ($pool) {
        case 1:
            return  ['amount' => 10,'type' => 'Basic Binary Income'];
            break;
        case 2:
            return  ['amount' => 50,'type' => 'Pro Binary Income'];
            break;
        case 3:
            return  ['amount' => 100,'type' => 'Master Binary Income'];
            break;
        case 4:
            return  ['amount' => 150,'type' => 'Super Binary Income'];
            break;
        case 5:
            return  ['amount' => 200,'type' => 'Super Fast Binary Income'];
        break;
        case 6:
            return  ['amount' => 400,'type' => 'Director Binary Income'];
            break;
        default:
            return  ['amount' => 10,'type' => 'Basic Binary Income'];
        }
    }

    public function uniLevelAutoPoolDistribution_old($userId,$eligible=1,$poolId=0) {
        $parentPool = DB::table('autopool')->where('direct','<',2)->first();
        $dataToStore = [
            'user_id' => $userId,
            'pool_id' => $poolId,
            'parent_id' => $parentPool->id,
            'eligible' => $eligible
        ];
        DB::table('autopool')->insert($dataToStore);
        DB::table('autopool')->where('id',$parentPool->id)->increment('direct');
        if($parentPool->direct == 0) {
            if($parentPool->eligible == 1) {
                DB::table('incomes')->insert([
                    'user_id' => $parentPool->user_id,
                    'amount'  => 10,
                    'user_send_by' => $userId,
                    'type' => 'Universal Rebirth Pool Pay',
                    'pay_level' => 1
                ]);
                Customer::where('id',$parentPool->user_id)->increment('credit',10);
            }
        } else {
            $poolId = ($parentPool->pool_id > 0)?$parentPool->pool_id:$parentPool->id;

            if($parentPool->eligible == 1) {
                $this->uniLevelAutoPoolDistribution($parentPool->user_id,0,$poolId);
            } else {
                for($i=1;$i<=2;$i++) {
                    $this->uniLevelAutoPoolDistribution($parentPool->user_id,1,$poolId);
                }
            }
        }
    }

    // public function levelIncomeDistribution($package,$level,$levelPercent) {

    //     if(count($levelPercent) != $level )  { return true; }

    //     $customerId = auth()->user()->direct_customer_id;
    //     for($payLevel=1;$payLevel <= $level;$payLevel++) {
    //         $user = DB::table('customer')->where('customer_id',$customerId)->first();
    //         if(!$user) { break; }
    //         if($user->consume==0) { continue; }
    //         if($user->direct >= 3) {
    //             $income = ($levelPercent[$payLevel-1]/100)*$package;
    //             DB::table('incomes')->insert([
    //                 'created_at' => date('Y-m-d H:i:s'),
    //                 'user_id' => $user->id,
    //                 'amount'  => floor($income*100)/100,
    //                 'user_send_by' => auth()->user()->id,
    //                 'type' => 'Level Income',
    //                 'pay_level' => $payLevel,
    //                 'status' => 'Active',
    //             ]);
    //         }
    //         $customerId = $user->direct_customer_id;
    //     }
    //     return true;
    // }

    public function addRoi($user,$tmonth,$amount) {
        return DB::table('roi')->insert([
            'user_id' => $user->id,
            'tmonth' => $tmonth,
            'amount' => $amount,
            'pay_date' => date('Y-m-d',strtotime('+1 week')),
            'status' => 'Active'
        ]);
    }

    public function updateUserAndParentData($amount) {
        
        if(auth()->user()->consume==0) {
            DB::table('customer')->where('customer_id',auth()->user()->direct_customer_id)->increment('direct');
            DB::table('customer')->where('id',auth()->user()->id)->update([
                'consume' => '1',
                'package_used' => date('Y-m-d H:i:s')
            ]);
        }
        DB::table('customer')->where('id',auth()->user()->id)->decrement('credit',$amount);
        DB::table('transactions')->insert([
            'created_at' => date('Y-m-d H:i:s'),
            'user_id' => auth()->user()->id,
            'amount'  => $amount,
            'trans_type' => 'A',
            'type' => 'Debit',
            'note' => 'Buy package'
        ]);
        return true;
    }

    public function getAllTeamMember() {
        
        $collection = collect();
        $customerId[] = auth()->user()->customer_id; 
        $x = 0;
        do {
            $users = DB::table('customer')->whereIn('direct_customer_id',$customerId)->get();
            $customerId = $users->pluck('customer_id');
            $collection = $collection->merge($users);
            //$collection = collect($merged);
            $x++;
        } while (!$customerId->isEmpty());
        return $collection;
    }

    public function getAllBinaryTeamMember() {
        
        $collection = collect();
        $customerId[] = auth()->user()->customer_id; 
        $x = 0;
        do {
            $users = DB::table('customer')->whereIn('parent_customer_id',$customerId)->get();
            $customerId = $users->pluck('customer_id');
            $collection = $collection->merge($users);
            $x++;
        } while (!$customerId->isEmpty());
        return $collection;
    }

    public function getChildUser($customerId) {
        return DB::table('customer')->where('parent_customer_id',$customerId)->get();
    }

    public function getLevelTeamMember($level = null) {
        
        $collection = collect();
        $customerId[] = auth()->user()->customer_id; 
        $x = 1;
        do {
            $users = \DB::table('customer')->whereIn('direct_customer_id',$customerId)->get();
            $customerId = $users->pluck('customer_id');
            $collection = $users;
            if($level == $x) { break; }
            $x++;
        } while (!$customerId->isEmpty()) ;
        return $collection;
    }

    public function getTodaysPurchasedPoolCount($user,$pool) {
        return DB::table('autopool')
        ->where('pool_id',0)
        ->where('user_id',$user->id)
        ->where('pool',$pool)
        ->count();
    }

    public function getLatestPool($userId) {
        return DB::table('autopool')
        ->where('pool_id',0)
        ->where('user_id',$userId)
        ->orderBy('pool','desc')
        ->first();
    }

    public function getOneOrder() {
        return Customer::with('order')->get();
    }
    public function getTodayFundRequest() {
        return DB::table('fund_requests')->where('user_id',auth()->user()->id)->where('created_at','>=',date('Y-m-d 00:00:00'))->first();
    }

    public function addFundRequest($data) {
        return DB::table('fund_requests')->insert($data);
    }
    

    public function placeOrder($data)
    {
        
        $cart = session()->get('cart');
        $order = new Order;
        $order->p_name = $data['f_name'].' '.$data['l_name'];
        $order->user_id = Auth::user()->id;
        $order->p_email = $data['email'];
        $order->p_phone = $data['phone'];
        $order->p_address = $data['address'];
        $order->p_city = $data['city'];
        $order->p_state = $data['state'];
        $order->p_zip = $data['zipcode'];
        $order->status = $data['status'];
        $order->transaction_id = $data['transaction_id'];
        $order->total_amount = array_sum(array_column($cart,'total'));
        $order->comm_dis = array_sum(array_column($cart,'coin'));
        $order->reward = array_sum(array_column($cart,'reward'));
        $order->shipping = array_sum(array_column($cart,'shipping'));
        $order->save();
        
        if ($cart) {
            foreach($cart as $value) {
                $orderItem = new OrderItem;
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $value['id'];
                $orderItem->cost = $value['cost'];
                $orderItem->reward = $value['reward'];
                $orderItem->price = $value['price'];
                $orderItem->quantity = $value['quantity'];
                $orderItem->tax = $value['tax'];
                $orderItem->shipping = $value['shipping'];
                $orderItem->coin = $value['coin'];
                $orderItem->total = $value['total'];
                $orderItem->save();
            }
        }
        return $order;
    }

    public function getCategory(): Collection
    {
        return Category::where('status', 'active')
            ->limit(8)
            ->get();
    }

    public function addPayment($data)
    {
        return DB::table('payments')->insertGetId($data);
    }

    public function updateUser($id,$data)
    {
        return DB::table('customer')->where('id',$id)->update($data);
    }

    public function updateOrder($id,$data)
    {
        return DB::table('orders')->where('id',$id)->update($data);
    }

    public function getAllIncome()
    {
        return DB::table('incomes')->where('user_id',auth()->user()->id)->latest()->get();
    }

    public function checkFirstMatching($userId,$pool)
    {
        return DB::table('incomes')->where('user_id',$userId)
        ->where('type',$this->getBinaryIncome($pool)['type'])->exists();
    }

    public function getRoiList()
    {

        return DB::table('roi as r')
        ->leftJoin('incomes as i','i.description','=','r.id')
        ->where('r.user_id',auth()->user()->id)
        ->select(['r.*',DB::raw('SUM(i.amount) as growth')])
        ->latest('r.created_at')
        ->groupBy('r.id')
        ->get();
    }

    public function getWebStores()
    {
        return DB::table('webstores')->where('web_status','active')->limit(20)->get();
    }

    public function updatePayment($id,$data)
    {
        return DB::table('payments')->where('payment_id',$id)->update($data);
    }

    public function getOrderById($id)
    {
        return Order::with('orderItems')->where('id',$id)->first();
    }

    public function getSearchProduct($keyword,$skip,$limit) {
        $query =Product::Query();
        if($keyword) { $query->where('pname', 'LIKE','%'.$keyword.'%'); }
        $query->where('status','active');
        if (!is_null($skip)) {
            $query->skip($skip);
        }
        if (!is_null($limit)) {
            $query->limit($limit);
        }
        return ['data'=>$query->get(),'count'=>$query->count()];
    }

    public function getPointProduct($point,$skip,$limit) {
        $query =Product::Query();
        $query->where('comm_dis', '>=',$point);
        $query->where('status','active');
        if (!is_null($skip)) {
            $query->skip($skip);
        }
        if (!is_null($limit)) {
            $query->limit($limit);
        }
        return ['data'=>$query->get(),'count'=>$query->count()];
    }

    public function getOnlineStoreById($storeId) {

        return Webstore::where('id', $storeId)
            ->where('web_status', 'active')
            ->first();
    }

    public function getAllOnlineStore($skip,$limit) {
        $query = Webstore::Query();
        $query->where('web_status','active');
        if (!is_null($skip)) {
            $query->skip($skip);
        }
        if (!is_null($limit)) {
            $query->limit($limit);
        }
        return ['data'=>$query->get(),'count'=>$query->count()];
    }
    public function getgetAjaxSearchOnlineStore($keyword) {

        $query = Webstore::Query();
        if($keyword) { $query->where('web_name', 'LIKE','%'.$keyword.'%'); }
        $query->where('web_status','active');
        $query->limit(10);
        return $query->get();
    }

    public function getProductByCategory($categoryId,$skip,$limit) {
        $query =Product::Query();
        if($categoryId) { $query->where('category',$categoryId); }
        $query->where('status','active');
        if (!is_null($skip)) {
            $query->skip($skip);
        }
        if (!is_null($limit)) {
            $query->limit($limit);
        }

        return ['data'=>$query->get(),'count'=>$query->count()];
    }

    public function getAjaxSearchProduct($keyword) {
        $query =Product::Query();
        if($keyword) { $query->where('pname', 'LIKE','%'.$keyword.'%'); }
        $query->where('status','active');
        return $query->get();
    }

    public function getHomeSlider()
    {
        return DB::table('gallery')->where(['visibility'=>'in','status'=>'active','type'=>'slider'])->get();
    }

    public function findBySlug($slug)
    {
        return Product::where('p_id', $slug)
            ->where('status', 'active')
            ->first();
    }

    public function totalProduct()
    {
        return Product::where('status', 'active')
            ->count();
    }

    public function findById(int $id)
    {
        return Product::where('id', $id)
            ->where('status', 'active')
            ->first();
    }

    public function getLatestProduct(): Collection
    {
        return Product::where('status', 'active')
            ->orderBy('id', 'DESC')
            ->limit(20)
            ->get();
    }

    public function getLowestPriceProduct(): Collection
    {
        return Product::where('status', 'active')
            ->orderBy('price', 'ASC')
            ->limit(20)
            ->get();
    }

    

    

    public function getByOrganizationAndRole(int $organizationId, Request $request): Collection
    {
        $roleId    = $request->get('role_id');
        $orderBy   = $request->get('order');
        $direction = $request->get('dir');

        $users = User::with([
            'organizationRoles' => function (BelongsToMany $query) use ($organizationId) {
                $query
                    ->where('organization_id', $organizationId)
                    ->distinct()->get(['id','name']);
            },
            'activity'])
            ->whereHas('organizations', function (Builder $query) use ($organizationId, $roleId) {
                $query->where('organization_id', $organizationId);
                if (!is_null($roleId)) {
                    $query->where('role_id', $roleId);
                }
            });

        if (!is_null($orderBy)) {
            if ($orderBy == 'last_seen') {
                if (!is_null($direction)) {
                    $users->orderBy(UserActivity::select('last_seen')->whereColumn('users.id', 'user_activity.user_id'), $direction);
                } else {
                    $users->orderBy(UserActivity::select('last_seen')->whereColumn('users.id', 'user_activity.user_id'));
                }
            }
        }

        return $users->get(['id','user_first_name', 'user_last_name']);
    }

    public function getNameOnlyTeachersByOrganization($organizationIds): Collection
    {
        $user =  Auth::guard('api')->user();
        
        $roleTeacherId = Role::where('name', Role::ROLE_TEACHER)->value('id');
        
        $teachers = User::whereHas('organizations', function (Builder $query) use ($organizationIds, $roleTeacherId) {
            if (is_array($organizationIds)) {
                $query->whereIn('organization_id', $organizationIds);
            } else {
                $query->where('organization_id', $organizationIds);
            }

            if (!is_null($roleTeacherId)) {
                $query->where('role_id', $roleTeacherId);
            }
        });
        if($user->hasRole('Teacher')){
            $teachers->where('id', $user->id);
            }
        $teachers = $teachers->select(['id', 'user_first_name', 'user_last_name']);

        return $teachers->get();
    }

    public function getStudentsByCourseIds($courseIds, ?Request $request): Collection
    {
        $query = $this->queryByRequest($request);

        $query->rightJoin('student_courses as sc', 'sc.user_id', 'users.id');
        $query->rightJoin('user_organizations as org', 'org.user_id', 'users.id');
        $query->leftJoin('courses as c', 'c.id', 'sc.course_id');
        $query->whereIn('sc.course_id', $courseIds);
        $query->where('users.status',"1");
        $query->where('sc.approved_after_payment', true);
        $query->whereNotNull('sc.user_enrolled_date');
        $query->select([
            'users.id',
            'users.user_first_name',
            'users.user_last_name',
            'users.email',
            'c.course_name',
            'sc.course_id',
            'org.organization_id'
        ]);
        $query->with('activity:user_id,last_seen');

        return $query->get();
    }
    
}
