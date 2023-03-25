<?php



namespace App\Repositories;







use App\Models\Category;

use App\Models\Customer;

use App\Models\Order;

use App\Models\OrderItem;

use App\Models\Webstore;

use App\Models\Redeem;

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



class AdminRepository

{



    public function getAllUserCount() {

        return  DB::table('customer')->count();

    }



    public function getAllUser() {

        return  DB::table('customer')->get();

    }



    public function getTrusteeClubUser() {

        return  DB::table('customer')->where('club','>',0)->get();

    }



    public function getUserById($id) {

        return  Customer::where('id',$id)->first();

    }



    public function getUserCyrusDetailById($userId) {

        return  DB::table('cyrus_customer_details')->where('user_id',$userId)->first();

    }



    public function cloneRedeem($redeemId) {

        $redeem = Redeem::find($redeemId);

        $redeem->redeem_status = 'Regenerated';

        $redeem->save();

        $newRedeem = $redeem->replicate();

        $newRedeem->redeem_status = 'Pending';

        return $newRedeem->save();

    }



    public function getAllPurchases() {

        return  DB::table('transactions as t')

        ->leftJoin('customer as c','c.id','=','t.user_id')

        ->where('trans_type','A')

        ->select(['t.*','c.customer_id','c.full_name'])

        ->get();

    }



    public function getAllRedeemRequestList() {

        return  DB::table('redeem as r')

        ->leftJoin('customer as c','c.id','=','r.user_id')

        ->select(['r.*','c.customer_id','c.full_name'])

        ->where('r.redeem_status','<>','Regerated')

        ->latest()

        ->get();

    }

    public function getAllbankDetailsList() {

        return  DB::table('cyrus_customer_details as r')

        ->leftJoin('customer as c','c.id','=','r.user_id')

        ->select(['r.*','c.customer_id','c.full_name'])

        ->latest()

        ->get();

    }

    public function deleteBankDetail($id) {
        return DB::table('cyrus_customer_details')->whereId($id)->delete();
    }

    public function getRedeemRequestById($id) {

        return  DB::table('redeem as r')

        ->where('r.id',$id)

        ->leftJoin('customer as c','c.id','=','r.user_id')

        ->select(['r.*','c.customer_id','c.full_name','c.bank_name','c.branch','c.account_no','c.ifsc','c.bank_img'])

        ->first();

    }



    public function updateRedeemRequest($id,$status) {

        return  DB::table('redeem')->where('id',$id)->update(['redeem_status'=>$status]);

    }

    

    public function getTransferHistory() {

        return  DB::table('transactions as t')

        ->leftJoin('customer as c','c.id','=','t.user_id')

        ->where('trans_type','C')

        ->select(['t.*','c.customer_id','c.full_name'])

        ->get();

    }



    public function getUniversalPool($pool) {

        return  DB::table('autopool as t')

        ->leftJoin('customer as c','c.id','=','t.user_id')

        ->select(['t.*','c.customer_id','c.full_name','c.customer_id'])

        ->where('pool',$pool)

        ->get();

    }



    public function getAllFundRequest() {

        return  DB::table('customer')->get();

    }



    



    public function getFundRequestById($id) {

        return  DB::table('fund_requests as f')

        ->where('f.id',$id)

        ->leftJoin('customer as c','c.id','=','f.user_id')

        ->select(['f.*','c.customer_id','c.full_name'])

        ->first();

    }



    public function getAllPendingRequestCount() {

        return  DB::table('fund_requests')->where('status','Pending')->count();

    }



    public function updateFundRequest($id,$status) {

        return  DB::table('fund_requests')->where('id',$id)->update(['status'=>$status]);

    }

    public function updateUser($id,$data) {

        if(isset($data['password']) && !empty($data['password'] )) {

            $data['password'] = md5($data['password']);

        }

        return  DB::table('customer')->where('id',$id)->update($data);

    }



    public function getAllFundRequestList() {

        return  DB::table('fund_requests as f')

        ->leftJoin('customer as c','c.id','=','f.user_id')

        ->select(['f.*','c.customer_id','c.full_name'])

        ->get();

    }



    public function getAllActiveUserCount() {

        return  DB::table('customer')->where('consume','>',0)->count();

    }



    public function getAllDeactiveUserCount() {

        return  DB::table('customer')->where('consume',0)->count();

    }



    public function addFund($username,$amount) {

        DB::table('customer')->where('customer_id',$username)->increment('wallet',$amount);

        $user = DB::table('customer')->where('customer_id',$username)->first();



        if($user) {

            DB::table('transactions')->insert([

                'user_id' => $user->id,

                'amount' => $amount,

                'trans_type' => 'C',

                'type' => 'Credit',

                'note' => 'Fund given by senior.'

            ]);

        }

        return true;

    }



    public function getClosingPayouts() {

        return  DB::table('incomes as i')

        ->where('i.status','Active')

        ->groupBy('i.user_id')

        ->leftJoin('customer as c','c.id','=','i.user_id')

        ->select([DB::raw('SUM(i.amount) as amount'),'i.user_id','c.id','c.customer_id','c.full_name','c.email','c.phone'])

        ->get();

    }



    public function getPayouts($status) {

        return  DB::table('payouts as p')->latest('id')

        ->where('p.status',$status)

        ->leftJoin('customer as c','c.id','=','p.user_id')

        ->select(['p.amount','p.created_at','c.id','c.customer_id','c.full_name','c.email','c.phone','c.bank_name','c.account_no','c.ifsc'])

        ->get();

    }



    public function getRoiList() {

        return  DB::table('roi as r')

        ->leftJoin('customer as c','c.id','=','r.user_id')

        ->select(['r.*','c.customer_id','c.full_name','c.email','c.phone'])

        ->latest()

        ->get();

    }

    

    public function addPayout($data) {

        return  DB::table('payouts')->insert($data);

    }



    public function availIncome($ids) {

        return  DB::table('incomes')->whereIn('user_id',$ids)->update(['status'=>'Approved']);

    }

}

