<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\CustomerRepository;
use App\Repositories\CyrusRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use DB;

class AuthController extends Controller
{

    public function __construct(CustomerRepository $CustomerRepository,CyrusRepository $cyrusRepository) {
    $this->customerRepository = $CustomerRepository;
    $this->cyrusRepository = $cyrusRepository;
}

    

    public function login(Request $request)
    {

      // $response = $this->cyrusRepository->check([
      //   'MerchantID' => 'AP576249',
      //   'MerchantKey' => '013d09b70ecf43c',
      //   'MethodName' => 'paytransfer',
      //   'orderId' => 147852,
      //   'vpa' => 'goldroger9888@okaxis',
      //   'Name' => 'Rahul',
      //   'amount' => 10,
      //   'MobileNo' => '7888953469',
      //   'TransferType' => 'UPI',
      // ]);
      // dd($response);
      // $response = $this->cyrusRepository->getBankList();
      
        if ($request->isMethod('POST')) {
          $rules = array(
          'username' => 'required',
          'password' => 'required|alphaNum|min:6');
          $validated = $request->validate($rules);
          $username = $request->username;
          $user = Customer::where(function ($query) use($username) {
            $query->where('email',$username);
            $query->orWhere('customer_id',$username);
          })
          ->where('password',md5($request->password))
          ->first();

          if ($user)
          {
            Auth::login($user); 
            return redirect()->intended('/user')->withSuccess('User Signed in');
          }
          else
          {
            return redirect()->back()->withInput($request->all())->with('error', 'Incorrect credential.');
          }
        
      }
      return view('login');
    }

    

    public function member_login(Request $request)
    {
        if ($request->isMethod('POST')) {
        $rules = array(
          'email' => 'required|email|exists:customer,email'
          );
        $validated = $request->validate($rules);
        $user = Customer::where(['customer_id'=> $request->customer_id])->first(); 

        if ($user)
          {
            Auth::login($user); 
            return redirect()->intended('/user')->withSuccess('User Signed in');
          }
          else
          {
            return redirect()->back()->with('error', 'Incorrect email or password.');
          }
        } 
        $categories = $this->customerRepository->getCategory();
      return view('shop.login',compact('categories'));
    }


    public function register(Request $request)
    {    
      
        if ($request->isMethod('POST')) {
         
            $rules = array(
                'full_name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'placement' => 'required',
                'password' => 'required|alphaNum|min:6',
                'password_confirmation' => 'required_with:password|same:password|min:6',
            );
            $message = [
                'full_name.required' => 'First Name is required',
                'email.required' => 'Email is required',
                'phone.required' => 'Phone is required',
                'password.required' => 'password is required',
                'city.required' => 'City is required',
                'pincode.required' => 'pincode is required',
            ];
            $validated = $request->validate($rules,$message);
            
            if($request->referral_id) {
                $sponsorData = Customer::where('customer_id',$request->referral_id)->where('consume','>',0)->first();
                if(!$sponsorData) {
                    return redirect()->back()->withInput($request->all())->withError('Referral ID does not exist.');
                }
                $direct_customer_id = $sponsorData->customer_id;
            } else {
              $direct_customer_id = 'DBS8888';
            }
            

            $sessionData = [
              'full_name' => $request->full_name,
              'email' => $request->email,
              'phone' => $request->phone,
              'password' => $request->password,
              'direct_customer_id' => $direct_customer_id,
            ];
            
            //$request->session()->put('signupData',$sessionData);
            //$msg = 'Please pay amount to complete registration process.';
            
            //return redirect()->intended('payment')->withSuccess($msg);


            $parentCustomerId = $this->binaryPlacement($direct_customer_id,$request->placement);
            if(!$parentCustomerId) {
                return redirect()->back()->withInput($request->all())->withError('Try again later.');
            }

            $user = new Customer;
            $user->full_name = $request->full_name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = $request->password;
            $user->direct_customer_id = $direct_customer_id;
            $user->parent_customer_id = $parentCustomerId;
            $user->placement = $request->placement;
            $user->status = 'Active';
            $user->save();

            $insert_id = $user->id;
            $f_name = $request->f_name;
            $phone = $request->phone;
            $customer_n = 'DBS'.substr($phone,-4).''.$insert_id;
            $customer_id = strtoupper($customer_n);
            $user->customer_id = $customer_id;
            $user->save();

            if ($user)
              {

                $to = $request->email;
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: INRlinkpro.com <info@INRlinkpro.com>' . "\r\n";
                $subject = 'Thank you for joining INRlinkpro.';
                $message = '
                Respected  <b style="color:orange">'.$user->full_name.'</b><br>
        I would like to welcome you to the INRlinkpro. personally.  It is a tremendous honor for us to be working with you. We are looking forward to do more business deals with you. Your registration details is as below.<br><br>
        ID-NO:- <b style="color:orange">'.$customer_id.'</b><br>
        Password:- <b style="color:orange">'.$request->password.'</b><br>
        <br>
        Thank you for joining the INRlinkpro..<br>
        Looking forward to a continuous and a fruitful business partnership with you.
        <br>
        Regards,
        <br>
        INRlinkpro';


                //mail($to,$subject,$message,$headers);
                $msg = 'Registered successfully. Your Username is '.$customer_id;
                return redirect()->intended('/login')->withSuccess($msg);
              }
              else
              {
                return redirect()->back()->withInput($request->all())->withError('Something went wrong.');
              }
            
          }
          $referralCode = '';
          if(request()->segment(2)) {
              $referralCode = Customer::where('customer_id',request()->segment(2))->value('customer_id');
          }
      return view('register',compact('referralCode'));
    }

    public function binaryPlacement($customerId,$placement) {
        $user = DB::table('customer')->where('parent_customer_id',$customerId)->where('placement',$placement)->first();
        if(!$user) {
          return $customerId;
        }
        return $this->binaryPlacement($user->customer_id,$placement);
    }


    public function forgotPassword(Request $request)
    {
          
          if ($request->isMethod('POST')) {
          $rules = array(
          'username' => 'required');
          $validated = $request->validate($rules);
          $username = $request->username;
          $user = Customer::where(function ($query) use($username) {
            $query->where('email',$username);
            $query->orWhere('customer_id',$username);
          })->first();

          if ($user)
          {
            $passwordplain = "";
            $passwordplain  = rand(99999,999999);
            $newpass = md5($passwordplain);
            $to = $user->email;
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: fxearner.com <info@fxearner.com>' . "\r\n";
            $subject = 'Forgot password at fxearner';

            $message='Dear '.$user->full_name.','. "\r\n";
            $message.='<br><br>Thanks for contacting regarding to forgot password,<br> Your temp password is <b>'.$passwordplain.'</b>'."\r\n";
            $message.='<br>Please update your password.';
            $message.='<br><br>Thanks & Regards';
            $message.='<br>fxearner ';
            $mail= mail($to,$subject,$message,$headers);
            
            $user->password = $newpass;
            $user->save();

            return redirect()->intended('/forgot-password')->withSuccess('Your temporary password sent to your registered email address.');
          }
          else
          {
            return redirect()->back()->withInput($request->all())->with('error', 'Incorrect credential.');
          }
        
      }
      return view('forgot-password');
    }

    public function payment(Request $request)
    {
        $userData = $request->session()->get('signupData');
      //echo '<pre>'; print_r($userData); die;
        //$user = Customer::where('token',$token)->where('status','Pending')->first();
        // if(!$userData) {
        //     return redirect()->to('register');
        // }

        if ($request->session()->missing('signupData')) {
          return redirect()->to('register');
        }

        $live_rate = file_get_contents('https://min-api.cryptocompare.com/data/price?fsym=INR&tsyms=ETH,TRX,INR,INR');
        $json_decode = json_decode($live_rate,true);
		    $rate = $json_decode['TRX']*40;
        if (request()->isMethod('POST')) {

            $input = $request->all();
            $rules = array(
              'trx_id' => 'required');
            $validated = $request->validate($rules);

            $txid = DB::table('summary')->where('txid',$validated['trx_id'])->first();
            if($txid) {
              return redirect()->to('register');
            }

            try {
              $detail = $this->tron->getTransaction($validated['trx_id']);
            } catch (\IEXBase\TronAPI\Exception\TronException $e) {
              DB::table('summary_failed')->insert([
                'response' => $e->getMessage(),
                'data' => json_encode($userData),
                'txid' => $validated['trx_id']
              ]);
              return redirect()->back()->withError('Paymend Failed.');
            }
            
            

            $user = new Customer;
            $user->full_name = $userData['full_name'];
            $user->email = $userData['email'];
            $user->phone = $userData['phone'];
            $user->password = $userData['password'];
            $user->direct_customer_id = $userData['direct_customer_id'];
            $user->status = 'Active';
            $user->consume = 1;
            $user->user_level = 1;
            $user->package = 40;
            $user->save();

            $insert_id = $user->id;
            $phone = $userData['phone'];
            $customer_n = 'INR'.substr($phone,-4).''.$insert_id;
            $customer_id = strtoupper($customer_n);
            $user->customer_id = $customer_id;
            $user->save();

            DB::table('summary')->insert([
              'user_id' => $user->id,
              'txid' => $validated['trx_id'],
              'status' => 'Process'
            ]);
            if ($user)
              {
                auth()->login($user); 
                $request->session()->forget('signupData');
                // Direct Income
                $income = $this->customerRepository->addDirectIncome();

                $this->customerRepository->uniLevelAutoPoolIncome();
                
                Customer::where('id',$income->user_id)->increment('direct');

                $this->customerRepository->levelIncomeDistribution();

                

                $to = $user->email;
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: INRlinkpro.com <info@INRlinkpro.com>' . "\r\n";
                $subject = 'Thank you for joining INRlinkpro.';
                $message = '
                Respected  <b style="color:orange">'.$user->full_name.'</b><br>
        I would like to welcome you to the INRlinkpro. personally.  It is a tremendous honor for us to be working with you. We are looking forward to do more business deals with you. Your registration details is as below.<br><br>
        ID-NO:- <b style="color:orange">'.$user->customer_id.'</b><br>
        <br>
        Thank you for joining the INRlinkpro..<br>
        Looking forward to a continuous and a fruitful business partnership with you.
        <br>
        Regards,
        <br>
        INRlinkpro';

                
                //mail($to,$subject,$message,$headers);

                return redirect()->intended('/user')->withSuccess('User Signed in');
              }
              else
              {
                return redirect()->back()->withInput($request->all())->withError('Something went wrong.');
              }
        }

        return view('payment',compact('rate'));
    }

    public function username($userId) {
      $user = Customer::where('customer_id',$userId)->first();
      if($user) {
        return $user->full_name;
      } else {
        echo 'No record found';
      }
    }
}
