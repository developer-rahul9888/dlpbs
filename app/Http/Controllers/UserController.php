<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\CustomerRepository;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Repositories\CyrusRepository;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{

    public function __construct(CustomerRepository $CustomerRepository,CyrusRepository $cyrusRepository) {
        $this->customerRepository = $CustomerRepository;
        $this->cyrusRepository = $cyrusRepository;
    }


    public function index()
    {
        return view('admin.dashboard');
    }

    public function directIncome()
    {
        $incomes = auth()->user()->directIncome;
        return view('admin.direct-income',compact('incomes'));
    }

    public function levelIncome()
    {
        $incomes = auth()->user()->levelIncome;
        return view('admin.level-income',compact('incomes'));
    }

    public function basicPoolIncome()
    {
        $incomes = auth()->user()->basicPoolIncome;
        return view('admin.pool-income',compact('incomes'));
    }

    public function proPoolIncome()
    {
        $incomes = auth()->user()->proPoolIncome;
        return view('admin.pool-income',compact('incomes'));
    }

    public function proBinaryIncome()
    {
        $incomes = auth()->user()->proBinaryIncome;
        return view('admin.binary-income',compact('incomes'));
    }

    public function masterPoolIncome()
    {
        $incomes = auth()->user()->masterPoolIncome;
        return view('admin.pool-income',compact('incomes'));
    }
    
    public function masterBinaryIncome()
    {
        $incomes = auth()->user()->masterBinaryIncome;
        return view('admin.binary-income',compact('incomes'));
    }

    public function superPoolIncome()
    {
        $incomes = auth()->user()->superPoolIncome;
        return view('admin.pool-income',compact('incomes'));
    }

    public function superBinaryIncome()
    {
        $incomes = auth()->user()->superBinaryIncome;
        return view('admin.binary-income',compact('incomes'));
    }

    public function superFastPoolIncome()
    {
        $incomes = auth()->user()->superFastPoolIncome;
        return view('admin.pool-income',compact('incomes'));
    }

    public function superFastBinaryIncome()
    {
        $incomes = auth()->user()->superFastBinaryIncome;
        return view('admin.binary-income',compact('incomes'));
    }

    public function directorPoolIncome()
    {
        $incomes = auth()->user()->directorPoolIncome;
        return view('admin.pool-income',compact('incomes'));
    }

    public function directorBinaryIncome()
    {
        $incomes = auth()->user()->directorBinaryIncome;
        return view('admin.binary-income',compact('incomes'));
    }

    public function salaryIncome()
    {
        $incomes = auth()->user()->salaryIncome;
        return view('admin.salary-income',compact('incomes'));
    }

    public function weeklyFixIncome()
    {
        $incomes = auth()->user()->weeklyFixIncome;
        return view('admin.weekly-fix-income',compact('incomes'));
    }

    public function income()
    {
        $incomes = $this->customerRepository->getAllIncome();
        return view('admin.income',compact('incomes'));
    }

    public function direct()
    {
        return view('admin.direct');
    }

    public function team()
    {
        $allTeam = $this->customerRepository->getAllTeamMember();
        return view('admin.team',compact('allTeam'));
    }

    public function teamBinary()
    {
        $allTeam = $this->customerRepository->getAllBinaryTeamMember();
        return view('admin.team',compact('allTeam'));
    }

    public function treeview($customerId = null)
    {
        $user = auth()->user();

        if(!$customerId) { 
            $customerId = $user->customer_id;
        }
        $user = $this->customerRepository->getUserByCustomerId($customerId);
        
        $myChild = $this->customerRepository->getChildUser($customerId);
        
        $user_1 = $user_2 = $user_3 = $user_4 = $user_5 = $user_6 = $user_7 = $user_8 = $user_9 = $user_10 = $user_11 = $user_12 = $user_13 = $user_14 = $user_15 = [];

        if($myChild) {
            foreach($myChild as $child) {
                if($child->placement == 'Left') { $user_1 =  $child; }
                if($child->placement == 'Right') { $user_2 =  $child; }
            }
        }

        if($user_1) {
            $myChild = $this->customerRepository->getChildUser($user_1->customer_id);
            foreach($myChild as $child) {
                if($child->placement == 'Left') { $user_3 =  $child; }
                if($child->placement == 'Right') { $user_4 =  $child; }
            }
        }

        if($user_2) {
            $myChild = $this->customerRepository->getChildUser($user_2->customer_id);
            foreach($myChild as $child) {
                if($child->placement == 'Left') { $user_5 =  $child; }
                if($child->placement == 'Right') { $user_6 =  $child; }
            }
        }

        if($user_3) {
            $myChild = $this->customerRepository->getChildUser($user_3->customer_id);
            foreach($myChild as $child) {
                if($child->placement == 'Left') { $user_7 =  $child; }
                if($child->placement == 'Right') { $user_8 =  $child; }
            }
        }

        if($user_4) {
            $myChild = $this->customerRepository->getChildUser($user_4->customer_id);
            foreach($myChild as $child) {
                if($child->placement == 'Left') { $user_9 =  $child; }
                if($child->placement == 'Right') { $user_10 =  $child; }
            }
        }

        if($user_5) {
            $myChild = $this->customerRepository->getChildUser($user_5->customer_id);
            foreach($myChild as $child) {
                if($child->placement == 'Left') { $user_11 =  $child; }
                if($child->placement == 'Right') { $user_12 =  $child; }
            }
        }

        if($user_6) {
            $myChild = $this->customerRepository->getChildUser($user_6->customer_id);
            foreach($myChild as $child) {
                if($child->placement == 'Left') { $user_13 =  $child; }
                if($child->placement == 'Right') { $user_14 =  $child; }
            }
        }
        $poolId =2;
        $allTeam = $this->customerRepository->getAllTeamMember();
        return view('admin.treeview',compact('allTeam','poolId','user','user_1','user_2','user_3','user_4','user_5','user_6','user_7','user_8','user_9','user_10','user_11','user_12','user_13','user_14'));
    }


    public function treeviewPool($poolType, $customerId = null)
    {
        $user = auth()->user();
        // $sponsor = $user->sponsor;
        // if($sponsor && $sponsor->club == 0 && $sponsor->direct >= 10 && date('Y-m-d H:i:s') <= date('Y-m-d H:i:s',strtotime('+7 days',strtotime($sponsor->package_used)))) {
        //     $sponsor->club = 1;
        //     $sponsor->save();
        //     $this->customerRepository->addRoi($sponsor,4,150);
        //     die;
        // }
        if(!$customerId) { 
            $customerId = $user->customer_id;
        }
        $user = $this->customerRepository->getUserByCustomerId($customerId);
        
        $myChild = $this->customerRepository->getChildUser($customerId);
        
        $user_1 = $user_2 = $user_3 = $user_4 = $user_5 = $user_6 = $user_7 = $user_8 = $user_9 = $user_10 = $user_11 = $user_12 = $user_13 = $user_14 = $user_15 = [];

        if($myChild) {
            foreach($myChild as $child) {
                if($child->placement == 'Left') { $user_1 =  $child; }
                if($child->placement == 'Right') { $user_2 =  $child; }
            }
        }

        if($user_1) {
            $myChild = $this->customerRepository->getChildUser($user_1->customer_id);
            foreach($myChild as $child) {
                if($child->placement == 'Left') { $user_3 =  $child; }
                if($child->placement == 'Right') { $user_4 =  $child; }
            }
        }

        if($user_2) {
            $myChild = $this->customerRepository->getChildUser($user_2->customer_id);
            foreach($myChild as $child) {
                if($child->placement == 'Left') { $user_5 =  $child; }
                if($child->placement == 'Right') { $user_6 =  $child; }
            }
        }

        if($user_3) {
            $myChild = $this->customerRepository->getChildUser($user_3->customer_id);
            foreach($myChild as $child) {
                if($child->placement == 'Left') { $user_7 =  $child; }
                if($child->placement == 'Right') { $user_8 =  $child; }
            }
        }

        if($user_4) {
            $myChild = $this->customerRepository->getChildUser($user_4->customer_id);
            foreach($myChild as $child) {
                if($child->placement == 'Left') { $user_9 =  $child; }
                if($child->placement == 'Right') { $user_10 =  $child; }
            }
        }

        if($user_5) {
            $myChild = $this->customerRepository->getChildUser($user_5->customer_id);
            foreach($myChild as $child) {
                if($child->placement == 'Left') { $user_11 =  $child; }
                if($child->placement == 'Right') { $user_12 =  $child; }
            }
        }

        if($user_6) {
            $myChild = $this->customerRepository->getChildUser($user_6->customer_id);
            foreach($myChild as $child) {
                if($child->placement == 'Left') { $user_13 =  $child; }
                if($child->placement == 'Right') { $user_14 =  $child; }
            }
        }

        $allTeam = $this->customerRepository->getAllTeamMember();
        return view('admin.treeview-pool',compact('allTeam','user','user_1','user_2','user_3','user_4','user_5','user_6','user_7','user_8','user_9','user_10','user_11','user_12','user_13','user_14'));
    }

    public function levelTeam($level = null,Request $request)
    {
        if($level) {
            $levelTeam = $this->customerRepository->getLevelTeamMember($level);
        } else {
            $levelTeam = $this->customerRepository->getAllTeamMember();
        }
        return view('admin.team-level',compact('levelTeam'));
    }
    
    public function activation()
    {
        return view('admin.activation');
    }

    public function activateAccount(Request $request)
    {
        if($request->isMethod('POST')) {
            $user = auth()->user();

            if(299 > auth()->user()->wallet) {
                return redirect()->back()->withInput($request->all())->withError('Insufficient fund.');
            }
            if($user->consume > 0) {
                return redirect()->back()->withInput($request->all())->withError('Already Activated.');
            }

            auth()->user()->decrement('wallet',299);

            $dataToStore = [
                'created_at' => date('Y-m-d H:i:s'),
                'user_id' => auth()->user()->id,
                'amount'  => 299,
                'trans_type' => 'A',
                'type' => 'Debit',
                'note' => 'Account Activation ( '.$user->customer_id.' )'
            ];
            $this->customerRepository->createTransaction($dataToStore);

            // Direct Income
            $income = $this->customerRepository->addDirectIncome($user);

            if($user->consume == 0) {
                $this->customerRepository->uniLevelAutoPoolIncome($user,1);
            }

            $this->customerRepository->activateUser($user);

            $this->customerRepository->levelIncomeDistribution($user);

            return redirect()->back()->withSuccess('Account activated successfully.');
        }

        return view('admin.activate-account');
    }

    public function activateUser(Request $request)
    {
        if($request->isMethod('POST')) {
            $rules = array(
                'username' => 'required|exists:customer,customer_id'
            );
            $message = [
                'username.required' => 'Customer ID field is required.',
                'username.exists' => 'User does not exist.',
            ];
            $validated = $request->validate($rules,$message);
            $user = $this->customerRepository->getUserByCustomerId($validated['username']);
            if(299 > auth()->user()->wallet) {
                return redirect()->back()->withInput($request->all())->withError('Insufficient fund.');
            }
            if($user->consume > 0) {
                return redirect()->back()->withInput($request->all())->withError('Already Activated.');
            }
            
            auth()->user()->decrement('wallet',299);

            $dataToStore = [
                'created_at' => date('Y-m-d H:i:s'),
                'user_id' => auth()->user()->id,
                'amount'  => 299,
                'trans_type' => 'A',
                'type' => 'Debit',
                'note' => 'Account Activation ( '.$user->customer_id.' )'
            ];
            $this->customerRepository->createTransaction($dataToStore);

            // Direct Income
            $income = $this->customerRepository->addDirectIncome($user);

            if($user->consume == 0) {
                $this->customerRepository->uniLevelAutoPoolIncome($user,1);
            }

            $this->customerRepository->activateUser($user);

            $this->customerRepository->levelIncomeDistribution($user);


            $sponsor = $user->sponsor;
            if($sponsor && $sponsor->club == 0 && $sponsor->direct >= 10 && date('Y-m-d H:i:s') <= date('Y-m-d H:i:s',strtotime('+7 days',strtotime($sponsor->package_used)))) {
                $sponsor->club = 1;
                $sponsor->save();
                $this->customerRepository->addRoi($sponsor,4,150);
            }

            return redirect()->back()->withSuccess('Account activated successfully.');
        }

        return view('admin.activate-user');
    }

    public function activatePool(Request $request)
    {
        // $parentData = $this->customerRepository->getUserBussinessByCustomerId('DBS8888',1);
        // $this->binaryDistribution($parentData,1,auth()->user());
        // dd($parentData);
        if($request->isMethod('POST')) {
            $rules = array(
                'pool' => 'required|numeric|min:1|max:10',
            );
            
            $validated = $request->validate($rules);

            $user = auth()->user();
            $pool = $validated['pool'];

            if($pool == 1) { $amount = 150; } 
            elseif($pool == 2) { $amount = 800; }
            elseif($pool == 3) { $amount = 1600; }
            elseif($pool == 4) { $amount = 3200; }
            elseif($pool == 5) { $amount = 6400; }
            elseif($pool == 6) { $amount = 12800; } 
            else { $amount = 100000000000; }

            $poolData = $this->customerRepository->getLatestPool($user->id);
            
            if(!$poolData) {
                $poolRequired = 'Basic Pool';
            }
            elseif($poolData->pool == 1) {
                $poolRequired = 'Pro Pool';
            }
            elseif($poolData->pool == 2) {
                $poolRequired = 'Master Pool';
            }
            elseif($poolData->pool == 3) {
                $poolRequired = 'Super Pool';
            }
            elseif($poolData->pool == 4) {
                $poolRequired = 'Super Fast Pool';
            }
            else {
                $poolRequired = 'Pro Pool';
            }

            
            
            $purchasedPoolCount = $this->customerRepository->getTodaysPurchasedPoolCount($user,$pool);
            if($purchasedPoolCount > 0) {
                return redirect()->back()->withInput($request->all())->withError('You already purchased this pool');
            }

            if($amount > auth()->user()->wallet) {
                return redirect()->back()->withInput($request->all())->withError('Insufficient fund.');
            }
            if($user->consume == 0) {
                return redirect()->back()->withInput($request->all())->withError('Please activate your ID first.');
            }
            if($poolData->pool < $pool-1) {
                return redirect()->back()->withInput($request->all())->withError('Please upgrade '.$poolRequired.' first.');
            }

            auth()->user()->decrement('wallet',$amount);

            $user->user_level = $pool;
            $user->save();

            $dataToStore = [
                'created_at' => date('Y-m-d H:i:s'),
                'user_id' => auth()->user()->id,
                'amount'  => $amount,
                'trans_type' => 'A',
                'type' => 'Debit',
                'note' => 'Pool Purchased ( '.$user->customer_id.' )'
            ];
            $orderId = $this->customerRepository->createTransaction($dataToStore);
            
            $this->customerRepository->uniLevelAutoPoolIncome($user,$pool);
            // if($validated['pool'] > 0) {
            //     for($i=1;$i<=$validated['pool'];$i++) {
            //         $this->customerRepository->uniLevelAutoPoolIncome($user);
            //     }
            // }
            $parentCustomerId = $user->parent_customer_id;
            $placement = $user->placement;
            $p = 0; $payLevel = 1;
            while($p<1) {
                $parentData = $this->customerRepository->getUserBussinessByCustomerId($parentCustomerId,$pool);
                if(!$parentData || $payLevel > 10) { break; }
                $dataToStore = [
                    'user_id' => $parentData->id,
                    'amount'  => 1,
                    'user_id_send_by' => $user->id,
                    'pay_level' => $payLevel,
                    'status' => 'Active',
                    'order_id' => $orderId,
                    'type' => $placement,
                    'pool' => $pool,
                    'description' => 'Pool Purchased ( '.$user->customer_id.' )'
                ];
                //if($placement == 'left') { $parentData->bv_left = $parentData->bv_left + 1; } else { $parentData->bv_right = $parentData->bv_right + 1; }
                $this->customerRepository->createDistributionAmount($dataToStore);
                $this->binaryDistribution($parentData,$pool,$user);
                $parentCustomerId = $parentData->parent_customer_id;
                $placement = $parentData->placement;
                $payLevel++;
            }

            return redirect()->back()->withSuccess('Pool purchased successfully.');
        }

        return view('admin.activate-pool');
    }

    protected function binaryDistribution($parentData,$pool,$user) {
        if($parentData->consume == 0 || $parentData->bv_left < 1 || $parentData->bv_right < 1 || $parentData->user_level < $pool) { return; }

        $firstMatching = false;
        if($parentData->bv_left > 0 && $parentData->bv_right > 0) {
            if($parentData->bv_left > $parentData->bv_right) { $matching = $parentData->bv_right; $carry = 'left'; }
            else { $matching = $parentData->bv_left; $carry = 'right'; }
        }

        $matchingExists = $this->customerRepository->checkFirstMatching($parentData->id,$pool);

        if($carry == 'left') { $carryForward = $parentData->bv_left - $matching; }
        else { $carryForward = $parentData->bv_right - $matching; }

        // Binary Income
        $income = $this->customerRepository->addBinaryIncome($parentData,$pool);

        $this->customerRepository->updateDistributionAmount($parentData->id,$pool);

        if($matchingExists) { $carryForward = $carryForward = 1; }
        if($carryForward > 0) {
            $orderId = $income->id;
            $dataToStore = [
                'user_id' => $parentData->id,
                'amount'  => $carryForward,
                'user_id_send_by' => $user->id,
                'status' => 'Active',
                'order_id' => $orderId,
                'type' => $carry,
                'pool' => $pool,
                'description' => 'Carry Forward ( Matching '.$matching.' )'
            ];
            $this->customerRepository->createDistributionAmount($dataToStore);
        }
        
    }

    public function redeem(Request $request)
    {   

        if($request->isMethod('POST')) {
            $rules = array(
                'amount' => 'required|numeric|min:300|multiple_of:100'
            );
            $validated = $request->validate($rules);
            $user = auth()->user();
            $bankDetail = $user->cyrusDetail;

            //$redeemToday = $user->redeem()->where('created_at',date('Y-m-d'))->exists();
            //dd($redeemToday);
            if($user->direct == 0) {
                return redirect()->back()->withInput($request->all())->withError('1 Direct compulsory for redeem.');
            }

            if($validated['amount'] > $user->credit) {
                return redirect()->back()->withInput($request->all())->withError('Insufficient Fund.');
            }  

            if(!$bankDetail) {
                return redirect()->back()->withInput($request->all())->withError('Please update your bank detail for withdraw.');
            }
            
            // if(!$redeemToday) {
            //     return redirect()->back()->withInput($request->all())->withError('You cannot withdraw twice a day.');
            // }

            //die;
            // $bankDetail = $user->cyrusDetail;
            // $postFields = [
            //     'MOBILENO' => 7888953469
            // ];
            // $response = $this->cyrusRepository->getBeneficiaryDetails($postFields);
            // dd($response);
            $redeemAmount = round((90/100)*$validated['amount']);

            $dataToStore = [
                'balance' => $user->credit - $validated['amount'],
                'redeem' => $validated['amount'],
                'after_tds'  => $redeemAmount,
                'user_id' => $user->id,
                'redeem_status' => 'Pending',
                'status' => 'Active',
            ];
            $user->decrement('credit',$validated['amount']);
            $redeem = $user->redeem()->create($dataToStore);

            
            $postFields = [
                'CustomerMobile' => $bankDetail->mobile,
                'beneficiaryAccount' => $bankDetail->account_no,
                'beneficiaryIFSC' => $bankDetail->ifsc,
                'orderId' => 'CYRUS-'.$redeem->id,
                'amount' => $redeemAmount,
                'comments' => $user->customer_id
            ];

            $response = $this->cyrusRepository->sendMoney($postFields);
            //dd($response);
            if(!$response['status']) {
                $redeem->data = json_encode($response);
                $redeem->save();
                //return redirect()->back()->withSuccess('Redeem requested successfully. Amount will be credit in your account within 24 hour.');
                return redirect()->back()->withInput($request->all())->withError($response['message']);
            }
            $redeem->data = json_encode($response);
            $redeem->redeem_status = 'Approved';
            $redeem->save();
            return redirect()->back()->withSuccess('Sent successfully');
            //return redirect()->back()->withSuccess('Redeem requested successfully. Amount will be credit in your account within 24 hour.');
        }
        $redeem = auth()->user()->redeem;
        return view('admin.redeem',compact('redeem'));
    }

    // public function loadFund(Request $request)
    // {

    //     if($request->isMethod('POST')) {
    //         $rules = array(
    //             'amount' => 'required|numeric|min:1',
    //             'trx_id' => 'required|unique:summary,txid,Confirmed,status',
    //         );
    //         $message = [
    //             'trx_id.unique' => 'Trasaction Already Captured.',
    //         ];
    //         $validated = $request->validate($rules);

    //         $existTransaction = $this->customerRepository->checkTransaction($validated['trx_id']);
    //         if($existTransaction) {
    //             return redirect()->back()->withError('Transaction already captured.');
    //         }

    //         $dataToStore = [
    //             'user_id' => auth()->user()->id,
    //             'txid' => $validated['trx_id'],
    //             'status' => 'Process'
    //         ];
    //         $summary = $this->customerRepository->storeSummary($dataToStore);
    //         try {
    //             $detail = $this->tron->getTransaction($validated['trx_id']);
    //           } catch (\IEXBase\TronAPI\Exception\TronException $e) {
    //             return redirect()->back()->withError('Paymend Failed.');
    //         }

    //         $rate = session()->get('rate');
    //         $summary->status = 'Confirmed';
    //         $summary->save();

    //         $this->customerRepository->addFund($validated['amount']);
    //         return redirect()->back()->withSuccess('Wallet updated successfully.');
    //     }

    //     $live_rate = file_get_contents('https://min-api.cryptocompare.com/data/price?fsym=INR&tsyms=ETH,TRX,INR,INR');
    //     $json_decode = json_decode($live_rate,true);
	// 	$rate = $json_decode['TRX'];
    //     session()->put('rate',$rate);

    //     return view('admin.load-fund',compact('rate'));
    // }

    public function loadFund(Request $request)
    {
        // $data = array(
        //     "accountID" => 'MGX828',
        //     "token" => 'MGX7bbdd41f8c19c4d1109f01b8f7c3c8cea0f48d76d06e299bec5a241a8c1482b8',
        //     "pay_id" => 10,
        //     "pay_name"=> 'Rahul',
        //     "pay_phone"=> '7888953469',
        //     "pay_amount"=> 10
        // );
        // // print_r($data);
        // $url="https://magixapi.com/upi_payment_gateway/upipay.php";
        // // $response = Http::accept('application/json')->post($url, $data);
        // // dd($response->json());

        // # Initialiaze the curl
        // $ch = curl_init( $url );

        // # Setup request to send json via POST.
        // $payload = json_encode( array( "pay_request"=> $data ) );

        // curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
        // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        // //curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

        // # Return response instead of printing.
        // curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

        // # Send request.
        // $result = curl_exec($ch);

        // curl_close($ch);

        // # Convert the json response into array
        // $data_result = json_decode($result, true);
        // # Retrive & store values of array into variables
        // $api_query = $data_result['query'];
        // $pay_link = $data_result['response']['pay_link'];
        // $api_response_code = $data_result['response']['code'];
        // $api_response_status = $data_result['response']['status'];
        // return redirect($pay_link);

        if($request->isMethod('POST')) {
            $rules = array(
                'txnAmount' => 'required|numeric|min:299',
                //'trx_id' => 'required|unique:summary,txid,Confirmed,status',
            );
            $message = [
                //'trx_id.unique' => 'Trasaction Already Captured.',
            ];
            $validated = $request->validate($rules);


            $user = auth()->user();
            $orderId = time();
            $data = array(
                "token" => 'd0934a-81e19c-3d30cc-324419-46d180',
                "orderId" => $orderId,
                "txnAmount" => $validated['txnAmount'],
                "txnNote"=> $user->customer_id,
                "cust_Mobile"=> $user->phone,
                "cust_Email"=> $user->email
            );

            $url="https://upibiz.com/order/bharatpe_qr_create";
            $response = Http::accept('application/json')->post($url, $data);

            
            if($response->successful() && $response->json('status') == 'SUCCESS') {
                $response = $response->json('result');
                $dataToStore = [
                    'user_id' => auth()->user()->id,
                    'orderId' => $orderId,
                    'txnAmount' => $validated['txnAmount'],
                    'signature'=> $response['signature'],
                    'qrData' => $response['qrData'],
                    'qrImage' => $response['qrImage'],
                    'status' => 'Process'
                ];
                $summary = $this->customerRepository->storeSummary($dataToStore);
                return redirect('user/load-fund/'.$orderId);
            } else {
                return redirect()->back()->withError($response->json('message'));
            }

            // $existTransaction = $this->customerRepository->checkTransaction($validated['trx_id']);
            // if($existTransaction) {
            //     return redirect()->back()->withError('Transaction already captured.');
            // }
            

            // $data = array(
            //     "accountID" => 'MGX828',
            //     "token" => 'MGX7bbdd41f8c19c4d1109f01b8f7c3c8cea0f48d76d06e299bec5a241a8c1482b8',
            //     "pay_id" => 3,
            //     "pay_name"=> 'Rahul',
            //     "pay_phone"=> '7888953469',
            //     "pay_amount"=> 10
            // );
            // // print_r($data);
            // $url="https://magixapi.com/upi_payment_gateway/upipay.php";
            // // $response = Http::accept('application/json')->post($url, $data);
            // // dd($response->json());

            // # Initialiaze the curl
            // $ch = curl_init( $url );

            // # Setup request to send json via POST.
            // $payload = json_encode( array( "pay_request"=> $data ) );

            // curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            // //curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

            // # Return response instead of printing.
            // curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

            // # Send request.
            // $result = curl_exec($ch);

            // curl_close($ch);

            // # Convert the json response into array
            // $data_result = json_decode($result, true);
            // # Retrive & store values of array into variables
            // $api_query = $data_result['query'];
            // $pay_link = $data_result['response']['pay_link'];
            // $api_response_code = $data_result['response']['code'];
            // $api_response_status = $data_result['response']['status'];
            // return redirect($pay_link);

            // die;
            // $summary->status = 'Confirmed';
            // $summary->save();

            $this->customerRepository->addFund($validated['txnAmount']);
            return redirect()->back()->withSuccess('Wallet updated successfully.');
        }

        

        return view('admin.load-fund');
    }
    
    public function loadFundVerify($paymentId, Request $request)
    {
        $summary = $this->customerRepository->getTransactionByorderId($paymentId);

        if(!$summary || $summary->status != 'Process') {
            return redirect('user/load-fund')->withError('Something went wrong.');
        }

        if($request->isMethod('POST')) {
            $rules = array(
                'utr' => 'required|numeric|min:1',
            );
            $validated = $request->validate($rules);
            
            $existTransaction = $this->customerRepository->checkTransaction($validated['utr']);
            if($existTransaction) {
                return redirect()->back()->withError('Transaction already captured.');
            }

            $user = auth()->user();
            $data = array(
                "token" => 'd0934a-81e19c-3d30cc-324419-46d180',
                "secret" => 't1mmLxIASR',
                "utr" => $validated['utr'],
                "orderId"=> $summary->orderId,
                "signature"=> $summary->signature
            );
            //echo '<pre>'; print_r($data); die;
            $url="https://upibiz.com/order/bharatpe_qr_verify";
            $response = Http::accept('application/json')->post($url, $data);
            //dd($response->json());
            if($response->failed()) {
                return redirect()->back()->withError('Something went wrong.');
            }

            if($response->json('status') == 'SUCCESS') {
                $result = $response['result'];
                $summary->txnId = $result['txnId'];
                $summary->bankTxnId = $result['bankTxnId'];
                $summary->paymentMode = $result['paymentMode'];
                $summary->txnDate = $result['txnDate'];
                $summary->utr = $result['utr'];
                $summary->sender_name = $result['sender_name'];
                $summary->sender_note = $result['sender_note'];
                $summary->payee_vpa = $result['payee_vpa'];
                $summary->status = 'Confirmed';
                $summary->save();
                $this->customerRepository->addFund($summary->txnAmount);

                $dataToStore = [
                    'created_at' => date('Y-m-d H:i:s'),
                    'user_id' => $user->id,
                    'amount'  => $summary->txnAmount,
                    'type' => 'Credit',
                    'note' => 'Load Fund by UPI'
                ];
                $this->customerRepository->createTransaction($dataToStore);


                return redirect('user/load-fund')->withSuccess('Wallet updated successfully.');
            } else {
                return redirect()->back()->withError($response->json('message'));
            }   
        }

        return view('admin.load-fund-verify',compact('summary'));
    }

    public function transferFund(Request $request)
    {

        if($request->isMethod('POST')) {
            $rules = array(
                'amount' => 'required|numeric|min:1',
            );
            $validated = $request->validate($rules);

            $amount = $validated['amount'];

            if($amount > auth()->user()->credit) {
                return redirect()->back()->withInput($request->all())->withError('Insufficient fund.');
            }
            
            auth()->user()->decrement('credit',$amount);
            auth()->user()->increment('wallet',$amount);

            $dataToStore = [
                'created_at' => date('Y-m-d H:i:s'),
                'user_id' => auth()->user()->id,
                'amount'  => $amount,
                'trans_type' => 'T',
                'type' => 'Credit',
                'note' => 'Transfer From Credit Wallet'
            ];
            $this->customerRepository->createTransaction($dataToStore);

            // $dataToStore = [
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'user_id' => auth()->user()->id,
            //     'amount'  => $amount,
            //     'trans_type' => 'T',
            //     'wallet_type' => 'C',
            //     'type' => 'Debit',
            //     'note' => 'Transfer To Activation Wallet'
            // ];
            // $this->customerRepository->createTransaction($dataToStore);
            
            return redirect()->back()->withSuccess('Fund transfered successfully.');
        }

        return view('admin.transfer-fund');
    }

    public function fundRequestAdd(Request $request)
    {
        if($request->isMethod('POST')) {
            $rules = array(
                'title' => 'required',
                'amount' => 'required|numeric',
                'file' => 'required|max:10000|mimes:jpeg,jpg,png'
            );
            $message = [
                'file.required' => 'Please choose file to upload.',
            ];
            $validated = $request->validate($rules,$message);
            //$fundRequest = $this->customerRepository->getTodayFundRequest();
            
            $image = '';

           // print_r($_FILES); die;
            if($request->hasFile('file')) {
             //   die;
                $file = $request->file('file');
                //Display File Name
                //$file->getClientOriginalName();
            
                // //Display File Extension
                // $file->getClientOriginalExtension();
            
                // //Display File Real Path
                // $file->getRealPath();
            
                // //Display File Size
                // $file->getSize();
            
                // //Display File Mime Type
                // $file->getMimeType();
            
                //Move Uploaded File
                $destinationPath = 'uploads';
                $file->move($destinationPath,$file->getClientOriginalName());
                $image = $file->getClientOriginalName();
            }
            $data = [
                'user_id' => auth()->user()->id,
                'title' => $validated['title'],
                'amount' => $validated['amount'],
                'image' => $image
            ];
            $this->customerRepository->addFundRequest($data);

            return redirect()->back()->withSuccess('Request sent successfully.');
        }
        return view('admin.fund-request-add');
    }

    public function fundRequest()
    {
        return view('admin.fund-request-list');
    }

    public function fundHistory()
    {

        return view('admin.fund-history');
    }

    public function orders()
    {
        $orders = Auth::user()->orders()->orderBy('id','desc')->get();
        return view('shop.admin.order',compact('orders'));
    }
    public function invoice($invoiceId)
    {
        $categories = $this->customerRepository->getCategory();
        $invoice = Order::with('orderItems')->where('id',$invoiceId)->where('user_id',Auth::user()->id)->first();
        //echo '<pre>'; print_r($invoice->toArray()); echo '</pre>';
        return view('shop.admin.invoice',compact('invoice','categories'));
    }
    public function address()
    {
        $categories = $this->customerRepository->getCategory();
        return view('shop.admin.address',compact('categories'));
    }
    public function payment()
    {
        $categories = $this->customerRepository->getCategory();
        return view('shop.admin.payment',compact('categories'));
    }
    public function wishlist()
    {
        $categories = $this->customerRepository->getCategory();
        return view('shop.admin.wishlist',compact('categories'));
    }
    public function security()
    {
        $categories = $this->customerRepository->getCategory();
        return view('shop.admin.security',compact('categories'));
    }
    public function profile()
    {
        $categories = $this->customerRepository->getCategory();
        return view('shop.admin.profile',compact('categories'));
    }

    // public function password(Request $request)
    // {
    //     if ($request->isMethod('POST')) {
    //         $rules = [
    //             'currentPassword' => 'required',
    //             'password' => 'required',
    //             'confirm_password' => 'required|same:password',
    //         ];
    //         $message = [
    //             'currentPassword.required' => 'Current password field is required.',
    //             'password.required' => 'New password field is required.',
    //         ];
    //         $validated = $request->validate($rules,$message);
    //         if(Auth::user()->pass_word != md5($request->input('currentPassword'))) {
    //             return redirect()->back()->withInput($request->all())->with('error', 'Incorrect old password.');
    //         }
    //         $store = [
    //             'pass_word'=>md5($request->input('password')),
    //         ];
    //         $this->customerRepository->updateUser(Auth::user()->id,$store);
    //         return redirect()->back()->with('success', 'Updated Successfully.');
    //     }
    //     $categories = $this->customerRepository->getCategory();
    //     return view('shop.admin.password',compact('categories'));
    // }

    public function kycEdit(Request $request)
    {
        if ($request->isMethod('POST')) {

            $rules = [
                'pancard' => 'required',
                'aadhar' => 'required',
                'panimage' => 'mimes:png,jpg,jpeg|max:2048',
                'aadharimage' => 'mimes:png,jpg,jpeg|max:2048',
                'b_aadhar_img' => 'mimes:png,jpg,jpeg|max:2048',
            ];
            $message = [
                'pancard.required' => 'Pancard no  is required.',
                'aadhar.required' => 'Aadhar no is required.',
            ];
            $validated = $request->validate($rules,$message);
            $panimage = $aadharimage = $b_aadhar_img = '';

            $store = [
                'pancard'=>$request->input('pancard'),
                'aadhar'=>$request->input('aadhar'),
            ];


            if($request->file('panimage')) {
                $name = $request->file('panimage')->getClientOriginalName();
                $panimage = $request->file('panimage')->getClientOriginalName();
                $extension = $request->file('panimage')->getClientOriginalExtension();
                $panimage = time() . '.'.$extension;
                //$destinationPath = 'files/kyc';
                $destinationPath = 'files/'.auth()->user()->customer_id.'/kyc/';
                $request->file('panimage')->move($destinationPath, $panimage);
                $store['panimage'] = $destinationPath.$panimage;
                $old_image = auth()->user()->panimage;
                if (file_exists($old_image)) {
                    @unlink($old_image);
                }
            }

            if($request->file('aadharimage')) {
                $name = $request->file('aadharimage')->getClientOriginalName();
                $aadharimage = $request->file('aadharimage')->getClientOriginalName();
                $extension = $request->file('aadharimage')->getClientOriginalExtension();
                $aadharimage = time() . '.'.$extension;
                //$destinationPath = 'files/kyc';
                $destinationPath = 'files/'.auth()->user()->customer_id.'/kyc/';
                $request->file('aadharimage')->move($destinationPath, $aadharimage);
                $store['aadharimage'] = $destinationPath.$aadharimage;
                $old_image = auth()->user()->aadharimage;
                if (file_exists($old_image)) {
                    @unlink($old_image);
                }
            }

            if($request->file('b_aadhar_img')) {
                $name = $request->file('b_aadhar_img')->getClientOriginalName();
                $b_aadhar_img = $request->file('b_aadhar_img')->getClientOriginalName();
                $extension = $request->file('b_aadhar_img')->getClientOriginalExtension();
                $b_aadhar_img = time() . '.'.$extension;
                //$destinationPath = 'files/kyc';
                $destinationPath = 'files/'.auth()->user()->customer_id.'/kyc/';
                $request->file('b_aadhar_img')->move($destinationPath, $b_aadhar_img);
                $store['b_aadhar_img'] = $destinationPath.$b_aadhar_img;
                $old_image = auth()->user()->b_aadhar_img;
                if (file_exists($old_image)) {
                    @unlink($old_image);
                }
            }
            
            $this->customerRepository->updateUser(Auth::user()->id,$store);
            return redirect()->back()->withInput($request->all())->with('success', 'Updated Successfully.');
        }
        return view('admin.kyc-edit');
    }

    public function bankEdit(Request $request)
    {
        if ($request->isMethod('POST')) {

            $rules = [
                'bank_name' => 'required',
                'branch' => 'required',
                'account_type' => 'required',
                'account_no' => 'required',
                'ifsc' => 'required',
                'image' => 'mimes:png,jpg,jpeg|max:2048',
            ];
            
            $validated = $request->validate($rules);
            $panimage = $aadharimage = $b_aadhar_img = '';

            $store = [
                'bank_name'=>$request->input('bank_name'),
                'branch'=>$request->input('branch'),
                'account_type'=>$request->input('account_type'),
                'account_no'=>$request->input('account_no'),
                'ifsc'=>$request->input('ifsc'),
            ];


            if($request->file('bank_img')) {
                $name = $request->file('bank_img')->getClientOriginalName();
                $bank_img = $request->file('bank_img')->getClientOriginalName();
                $extension = $request->file('bank_img')->getClientOriginalExtension();
                $bank_img = time() . '.'.$extension;
                $destinationPath = 'files/'.auth()->user()->customer_id.'/kyc/';
                $request->file('bank_img')->move($destinationPath, $bank_img);
                $store['bank_img'] = $destinationPath.$bank_img;
                $old_image = auth()->user()->bank_img;
                if (file_exists($old_image)) {
                    @unlink($old_image);
                }
            }
            
            $this->customerRepository->updateUser(Auth::user()->id,$store);
            return redirect()->back()->withInput($request->all())->with('success', 'Updated Successfully.');
        }
        return view('admin.bank-edit');
    }

    public function bankVerify(Request $request)
    {






        // $postFields = [
        //     'CustomerMobile' => 7888953469,
        //     'beneficiaryAccount' => '0143104000057859',
        //     'beneficiaryIFSC' => 'IBKL0000143',
        //     'orderId' => 123456,
        //     'amount' => 10,
        //     'comments' => 'Test'
        // ];
        // $response = $this->cyrusRepository->sendMoney($postFields);
        // dd($response);
        // $postFields = [
        //     'MOBILENO' => 9888995669
        // ];
        // $response = $this->cyrusRepository->getCustomerDetails($postFields);
        // dd($response);

        

        // $postFields = [
        //     'CustomerMobileNo' => '7888953469',
        //     'beneficiaryAccount' => '0143104000057859',
        //     'beneficiaryIFSC' => 'IBKL0000143',
        //     'orderId' => '0143104000057859',
        // ];

        
        
        // $response = $this->cyrusRepository->beneficiaryAccountVerification($postFields);
        // dd($response);

        // $postFields = [
        //     'MOBILENO' => '7888953469',
        //     'CustomerMobileNo' => '7888953469',
        //     'BankId' => 8.0,
        //     'AccountNo' => '0143104000057859',
        //     'IFSC' => 'IBKL0000143',
        //     'Name' => 'Rahul Singh',
        // ];

        
        
        // $response = $this->cyrusRepository->addBeneficiary($postFields);
        // dd($response);

        if ($request->isMethod('POST')) {
            
            $rules = [
                'first_name' => 'required',
                'last_name' => 'required',
                'dob' => 'required',
                'pincode' => 'required',
                'address' => 'required',
                'bank' => 'required',
                'account_type' => 'required',
                'account_no' => 'required',
                'account_name' => 'required',
                'ifsc' => 'required',
                'mobile' => 'required',
                'pan' => 'required',
                'aadhar' => 'required'
            ];
            
            $validated = $request->validate($rules);

            if($request->missing('otp')) {
                $postFields = [
                    'MOBILENO' => $request->input('mobile'),
                    'FNAME' => $request->input('first_name'),
                    'LNAME' => $request->input('last_name'),
                    'DOB' => $request->input('dob'),
                    'PINCODE' => $request->input('pincode'),
                    'ADDRESS' => $request->input('address'),
                    'Pan' => $request->input('pan'),
                    'Aadhar' => $request->input('aadhar'),
                ];
                $response = $this->cyrusRepository->customerRegistration($postFields);
                if(!$response['status']) {
                    return redirect()->back()->withInput($request->all())->withError('Something went wrong. Try again later.');
                }
                return redirect('user/bank/verify/otp')->withInput($request->all())->withSuccess('Please enter OTP.');
                
            }

            if($request->has('otp')) {
                //echo '<pre>'; print_r($request->all());
                $postFields = [
                    'MOBILENO' => $request->input('mobile'),
                    'OTP' => $request->input('otp'),
                ];
                $response = $this->cyrusRepository->otpVerify($postFields);
                //dd($response);
                if(!$response['status']) {
                    return redirect()->back()->withInput($request->all())->withError('OTP is not valid.');
                }
                $postFields = [
                    'MOBILENO' => $request->input('mobile'),
                    'Pan' => $request->input('pan'),
                    'Aadhar' => $request->input('aadhar'),
                ];
                
                $response = $this->cyrusRepository->kycDetails($postFields);
                if(!$response['status']) {
                    return redirect()->back()->withInput($request->all())->withError('Issue in kyc details');
                }

                $postFields = [
                    'CustomerMobileNo' => $request->input('mobile'),
                    'beneficiaryAccount' => $request->input('account_no'),
                    'beneficiaryIFSC' => $request->input('ifsc'),
                    'orderId' => 'VER-'.rand(1111,9999),
                ];
        
                $response = $this->cyrusRepository->beneficiaryAccountVerification($postFields);
                if(!$response['status']) {
                    return redirect()->back()->withInput($request->all())->withError('Bank detail invalid.');
                }

                
                $postFields = [
                    'MOBILENO' => $request->input('mobile'),
                    'CustomerMobileNo' => $request->input('mobile'),
                    'BankId' => $request->input('bank'),
                    'AccountNo' => $request->input('account_no'),
                    'IFSC' => $request->input('ifsc'),
                    'Name' => $request->input('account_name'),
                ];
                
                $response = $this->cyrusRepository->addBeneficiary($postFields);
                if(!$response['status']) {
                    return redirect()->back()->withInput($request->all())->withError('Something went wrong. Try again later.');
                }
                //dd($response);
                $user = auth()->user();
                $dataToStore = [
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'dob' => $request->input('dob'),
                    'pincode' => $request->input('pincode'),
                    'address' => $request->input('address'),
                    'bank' => $request->input('bank'),
                    'account_type' => $request->input('account_type'),
                    'account_no' => $request->input('account_no'),
                    'account_name' => $request->input('account_name'),
                    'ifsc' => $request->input('ifsc'),
                    'mobile' => $request->input('mobile'),
                    'pan' => $request->input('pan'),
                    'aadhar' => $request->input('aadhar')
                ];
                $user->cyrusDetail()->updateOrCreate(['user_id'=>$user->id],$dataToStore);
                return redirect('user/bank/verify')->withInput($request->all())->with('success', 'Updated Successfully.');
            }
            
            //$this->customerRepository->updateUser(Auth::user()->id,$store);
            
        }
        $bankDetail = auth()->user()->cyrusDetail;
        $bankList = $this->cyrusRepository->getBankList();
        return view('admin.bank-verify',compact('bankList','bankDetail'));
    }
    public function password(Request $request)
    {
        if ($request->isMethod('POST')) {

            $rules = [
                'current_password' => 'required',
                'password' => 'required|alphaNum|min:6',
                'password_confirmation' => 'required_with:password|same:password|min:6',
            ];
            
            
            $validated = $request->validate($rules);
            if(md5($validated['current_password']) != auth()->user()->password) {
                return redirect()->back()->withInput($request->all())->withError('Incorrect current password.');
            }

            $store = [
                'password'=> md5($validated['password']),
            ];
            
            $this->customerRepository->updateUser(Auth::user()->id,$store);
            return redirect()->back()->withSuccess('Password updated successfully.');
        }
        return view('admin.password');
    }
    public function profileEdit(Request $request)
    {
        if ($request->isMethod('POST')) {

            $rules = [
                'full_name' => 'required',
                'gender' => 'required',
                'dob' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'state' => 'required',
                'pincode' => 'required',
                'file' => 'mimes:png,jpg,jpeg|max:2048'
            ];
            $message = [
                'full_name.required' => 'Full Name is required.',
                'gender.required' => 'Gender is required.',
                'dob.required' => 'DOB is required.',
                'phone.required' => 'Phone is required.',
                'email.required' => 'Email is required.',
                'state.required' => 'State is required.',
                'pincode.required' => 'Pincode is required.',
            ];
            $validated = $request->validate($rules,$message);
            $picName = '';
            
            $store = [
                'full_name'=>$request->input('full_name'),
                'gender'=>$request->input('gender'),
                'dob'=>$request->input('dob'),
                'phone'=>$request->input('phone'),
                'email'=>$request->input('email'),
                'address'=>$request->input('address'),
                'state'=>$request->input('state'),
                'pincode'=>$request->input('pincode'),
            ];

            if($request->file('file')) {
                $name = $request->file('file')->getClientOriginalName();
                $picName = $request->file('file')->getClientOriginalName();
                $extension = $request->file('file')->getClientOriginalExtension();
                $picName = time() . '.'.$extension;
                $destinationPath = 'files/'.auth()->user()->customer_id.'/';
                $request->file('file')->move($destinationPath, $picName);
                $store['image'] = $destinationPath.$picName;
                $old_image = auth()->user()->image;
                if (file_exists($old_image)) {
                    @unlink($old_image);
                }
            }

            $this->customerRepository->updateUser(Auth::user()->id,$store);
            return redirect()->back()->withInput($request->all())->with('success', 'Updated Successfully.');
        }
        return view('admin.profile-edit');
    }

    public function brainsecret(Request $request)
    {
        if ($request->isMethod('POST')) {

            $rules = [
                'email' => 'required',
                'password' => 'required',
                'name' => 'required',
                'phone' => 'required',
                //'expire_on' => 'required'
            ];
            $validated = $request->validate($rules);

            $data = array(
                'email' => $validated['email'],
                'password' => $validated['password'],
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                'expire_on' => '2024-11-12 11:58:58'
            );

            $url="https://brainsecrets.net/brainsecretsApis/api/register";
            $response = Http::asForm()->post($url, $data);

            if($response->failed()) {
                return redirect()->back()->withInput($request->all())->withError($response->json('ErrorMessage'));
            }

            if($response->successful()) {
                $user = auth()->user();
                $user->brainsecret()->updateOrCreate(['user_id'=>$user->id],$data);
            }
            
            return redirect()->back()->withInput($request->all())->with('success', 'Request sent successfully.');
        }

        $brainsecret = auth()->user()->brainsecret;
        return view('admin.brainsecret',compact('brainsecret'));
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
      }

    /**
     * Index to handle the view loaded with the search results.
     *
     * @return \Illuminate\View\View
     */
    public function search($keyword='',Request $request)
    {
        if ($request->isMethod('POST')) {
            $keyword = $request->input('keyword');
            return redirect('/search/'.$keyword);
        }
        $page = 1;
        $limit = 24;
        if($request->get('page')) { $page = $request->get('page');}
        $count = ($page-1)*$limit;
        $productsData = $this->customerRepository->getSearchProduct($keyword,$count,$limit);
        $products = $productsData['data'];
        $totalCount = $productsData['count'];
        $max = ceil($totalCount/$limit);
        $categories = $this->customerRepository->getCategory();
        return view('shop.product',compact('products','max','page','limit','categories'));
    }

    /**
     * Fetch product details.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function fetchProductDetails($slug)
    {
        $product = $this->customerRepository->findBySlug($slug);
        return view('shop.single-product', compact('product'));
    }


    /**
     * Write code on Method
     *
     * @return response()
     */
    public function cart()
    {
        return view('shop.cart');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function product(Request $request)
    {
        $page = 1;
        $limit = 24;
        if($request->get('page')) {
            $page = $request->get('page');
        }
        $count = ($page-1)*$limit;

        $products = $this->customerRepository->all(['status'=>'active'],$count,$limit);
        $totalCount = $this->customerRepository->totalProduct();

        $max = ceil($totalCount/$limit);


        return view('shop.product',compact('products','max','page','limit'));
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function checkout(Request $request)
    {   
        
        if ($request->isMethod('POST')) {
            $rules = [
                'f_name' => 'required',
                'l_name' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'country' => 'required',
                'address' => 'required',
                'city' => 'required',
                'state' => 'required',
                'zipcode' => 'required',
            ];
            $message = [
                'f_name.required' => 'First Name is required',
                'l_name.required' => 'Last Name is required',
                'phone.required' => 'Phone is required',
                'email.required' => 'Email is required',
                'country.required' => 'Country is required',
                'address.required' => 'Address is required',
                'city.required' => 'City is required',
                'state.required' => 'State is required',
                'zipcode.required' => 'Zipcode is required',
            ];
            $validated = $request->validate($rules,$message);
            $product = $this->customerRepository->placeOrder($request);
            session()->forget('cart');
            return redirect()->back()->with('success', 'Your rental request has been sent');
            
        }
        return view('shop.checkout');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addToCart($id)
    {
        
        $product = $this->customerRepository->findById($id);
        
        $cart = session()->get('cart', []);
  
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "id" => $product->id,
                "name" => $product->pname,
                "cost" => $product->cost,
                "discount" => 0,
                "price" => $product->price,
                "quantity" => 1,
                "tax" => $product->t_class,
                "image" => asset('../main-admin/images/product/'.$product->image)
            ];
        }
          
        session()->put('cart', $cart);
        
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function update(Request $request)
    {   
        $id = $request->id;
        $product = $this->customerRepository->findById($id);
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            if($request->quantity <= 0) {
                unset($cart[$id]);
            }
        } else {
            $cart[$id] = [
                "id" => $product->id,
                "name" => $product->pname,
                "cost" => $product->cost,
                "discount" => 0,
                "price" => $product->price,
                "quantity" => 1,
                "tax" => $product->t_class,
                "image" => asset('../main-admin/images/product/'.$product->image)
            ];
        }
        session()->put('cart', $cart);
        // if($request->id && $request->quantity){
        //     $cart = session()->get('cart');
        //     $cart[$request->id]["quantity"] = $request->quantity;
        //     session()->put('cart', $cart);
        //     session()->flash('success', 'Cart updated successfully');
        // }
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }


    /**
     * Write code on Method
     *
     * @return response()
     */
    public function cartCount()
    {
        $cart = session()->get('cart');
        return response()->json([
            'status' => true,
            'message' => array_sum(array_column($cart,'quantity')),
        ]);
    }

    /**
     * Fetch category details.
     *
     * @return \Illuminate\Http\Response
     */
    public function categoryDetails()
    {
        $slug = request()->get('category-slug');

        if (! $slug) {
            abort(404);
        }

        switch ($slug) {
            case 'new-products':
            case 'featured-products':
                $count = request()->get('count');

                if ($slug == 'new-products') {
                    $products = $this->velocityCustomerRepository->getNewProducts($count);
                } else if ($slug == 'featured-products') {
                    $products = $this->velocityCustomerRepository->getFeaturedProducts($count);
                }

                $response = [
                    'status'   => true,
                    'products' => $products->map(function ($product) {
                        if (core()->getConfigData('catalog.products.homepage.out_of_stock_items')) {
                            return $this->velocityHelper->formatProduct($product);
                        } else {
                            if ($product->isSaleable()) {
                                return $this->velocityHelper->formatProduct($product);
                            }
                        }
                    })->reject(function ($product) {
                        return is_null($product);
                    })->values(),
                ];

                break;
            default:
                $categoryDetails = $this->categoryRepository->findByPath($slug);

                if ($categoryDetails) {
                    $list = false;
                    $customizedProducts = [];
                    $products = $this->customerRepository->getAll($categoryDetails->id);

                    foreach ($products as $product) {
                        $productDetails = [];

                        $productDetails = array_merge($productDetails, $this->velocityHelper->formatProduct($product));

                        array_push($customizedProducts, $productDetails);
                    }

                    $response = [
                        'status'           => true,
                        'list'             => $list,
                        'categoryDetails'  => $categoryDetails,
                        'categoryProducts' => $customizedProducts,
                    ];
                }

                break;
        }

        return $response ?? [
            'status' => false,
        ];
    }

    /**
     * Fetch categories.
     *
     * @return array
     */
    public function fetchCategories()
    {
        $formattedCategories = [];

        $categories = $this->categoryRepository->getVisibleCategoryTree(core()->getCurrentChannel()->root_category_id);

        foreach ($categories as $category) {
            $formattedCategories[] = $this->getCategoryFilteredData($category);
        }

        return [
            'categories' => $formattedCategories,
        ];
    }

    /**
     * Fetch fancy category.
     *
     * @param  string  $slug
     * @return array
     */
    public function fetchFancyCategoryDetails($slug)
    {
        $categoryDetails = $this->categoryRepository->findByPath($slug);

        if ($categoryDetails) {
            $response = [
                'status'          => true,
                'categoryDetails' => $this->getCategoryFilteredData($categoryDetails),
            ];
        }

        return $response ?? [
            'status' => false,
        ];
    }

    /**
     * Get wishlist.
     *
     * @return \Illuminate\View\View
     */
    public function getWishlistList()
    {
        return view($this->_config['view']);
    }

    /**
     * This function will provide the count of wishlist and comparison for logged in user.
     *
     * @return \Illuminate\Http\Response
     */
    public function getItemsCount()
    {
        if ($customer = auth()->guard('customer')->user()) {

            if (! core()->getConfigData('catalog.products.homepage.out_of_stock_items')) {
                $wishlistItemsCount = $this->wishlistRepository->getModel()
                    ->leftJoin('products as ps', 'wishlist.product_id', '=', 'ps.id')
                    ->leftJoin('product_inventories as pv', 'ps.id', '=', 'pv.product_id')
                    ->where(function ($qb) {
                        $qb
                            ->WhereIn('ps.type', ['configurable', 'grouped', 'downloadable', 'bundle', 'booking'])
                            ->orwhereIn('ps.type', ['simple', 'virtual'])->where('pv.qty', '>', 0);
                    })
                    ->where('wishlist.customer_id', $customer->id)
                    ->where('wishlist.channel_id', core()->getCurrentChannel()->id)
                    ->count('wishlist.id');
            } else {
                $wishlistItemsCount = $this->wishlistRepository->count([
                    'customer_id' => $customer->id,
                    'channel_id'  => core()->getCurrentChannel()->id,
                ]);
            }

            $comparedItemsCount = $this->compareProductsRepository->count([
                'customer_id' => $customer->id,
            ]);

            $response = [
                'status'                  => true,
                'compareProductsCount'    => $comparedItemsCount,
                'wishlistedProductsCount' => $wishlistItemsCount,
            ];
        }

        return response()->json($response ?? [
            'status' => false,
        ]);
    }

    /**
     * This method will provide details of multiple product.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDetailedProducts()
    {
        if ($items = request()->get('items')) {
            $moveToCart = request()->get('moveToCart');

            $productCollection = $this->velocityHelper->fetchProductCollection($items, $moveToCart);

            $response = [
                'status'   => 'success',
                'products' => $productCollection,
            ];
        }

        return response()->json($response ?? [
            'status' => false,
        ]);
    }

    /**
     * This method will fetch products from category.
     *
     * @param  int  $categoryId
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategoryProducts($categoryId)
    {
        /* fetch category details */
        $categoryDetails = $this->categoryRepository->find($categoryId);

        /* if category not found then return empty response */
        if (! $categoryDetails) {
            return response()->json([
                'products'       => [],
                'paginationHTML' => '',
            ]);
        }

        /* fetching products */
        $products = $this->customerRepository->getAll($categoryId);
        $products->withPath($categoryDetails->slug);

        /* sending response */
        return response()->json([
            'products'       => collect($products->items())->map(function ($product) {
                return $this->velocityHelper->formatProduct($product);
            }),
            'paginationHTML' => $products->appends(request()->input())->links()->toHtml(),
        ]);
    }

    /**
     * Get category filtered data.
     *
     * @param  \Webkul\Category\Contracts\Category  $category
     * @return array
     */
    private function getCategoryFilteredData($category)
    {
        $formattedChildCategory = [];

        foreach ($category->children as $child) {
            $formattedChildCategory[] = $this->getCategoryFilteredData($child);
        }

        return [
            'id'                => $category->id,
            'slug'              => $category->slug,
            'name'              => $category->name,
            'children'          => $formattedChildCategory,
            'category_icon_url' => $category->category_icon_url,
            'image_url'         => $category->image_url,
        ];
    }
}
