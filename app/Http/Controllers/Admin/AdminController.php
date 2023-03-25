<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\AdminRepository;
use App\Repositories\CyrusRepository;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Admin;
use App\Models\Customer;
use DB;

class AdminController extends Controller
{
    public function __construct(AdminRepository $adminRepository,CyrusRepository $cyrusRepository) {
        $this->adminRepository = $adminRepository;
        $this->cyrusRepository = $cyrusRepository;
    }
    public function login(Request $request)
    {
        
        if ($request->isMethod('POST')) {
        $rules = array(
        'username' => 'required|exists:admins,user_name',
        'password' => 'required|min:6');
        $validated = $request->validate($rules);
        $user = Admin::where([ 
              'user_name'         => $request->username,
              'password'     => md5($request->password)
          ])->first(); 

          if ($user)
          {
            Auth::guard('admin')->login($user); 
            return redirect()->intended('/hr80c4037/dashboard')->withSuccess('User Signed in');
          }
          else
          {
            return redirect()->back()->withInput($request->all())->with('error', 'Incorrect password.');
          }
        
      }
      return view('admin-panel/login');
    }

    public function index()
    {
        $users = $this->adminRepository->getAllUserCount();
        $activeUsers = $this->adminRepository->getAllActiveUserCount();
        $inactiveUsers = $this->adminRepository->getAllDeactiveUserCount();
        $pendingRequest = $this->adminRepository->getAllPendingRequestCount();
        return view('admin-panel.dashboard',compact('users','activeUsers','inactiveUsers','pendingRequest'));
    }

    public function userList()
    {
        $users = $this->adminRepository->getAllUser();
        return view('admin-panel.user-list',compact('users'));
    }

    public function purchaseList()
    {
        $purchases = $this->adminRepository->getAllPurchases();
        return view('admin-panel.purchase-list',compact('purchases'));
    }

    public function fundRequestEdit($id,Request $request)
    {
        
        if($request->isMethod('POST')) {
            $rules = array(
                'status' => 'required',
            );
            $validated = $request->validate($rules);

            $this->adminRepository->updateFundRequest($id,$validated['status']);
            return redirect()->back()->withSuccess('Updated successfully.');
        }
        $request = $this->adminRepository->getFundRequestById($id);
        return view('admin-panel.fund-request-edit',compact('request'));
    }

    public function userEdit($id,Request $request)
    {
        
        if($request->isMethod('POST')) {
            $input = $request->only('full_name','dob','phone','email','address','city','state','pincode','gender','pancard','panimage','aadhar','aadharimage','status','password','bank_name','branch','bank_state','account_name','account_type','account_no','ifsc');
            $rules = array(
                'full_name' => 'required',
            );
            $validated = $request->validate($rules);

            $this->adminRepository->updateUser($id,$input);
            return redirect()->back()->withSuccess('Updated successfully.');
        }
        $user = $this->adminRepository->getUserById($id);
        return view('admin-panel.user-edit',compact('user'));
    }

    public function transferHistory()
    {
        $history = $this->adminRepository->getTransferHistory();
        return view('admin-panel.transfer-history',compact('history'));
    }

    public function universalPool($pool=1)
    {
        $pool = $this->adminRepository->getUniversalPool($pool);
        return view('admin-panel.universal-pool',compact('pool'));
    }

    public function fundRequestList()
    {
        $requests = $this->adminRepository->getAllFundRequestList();
        return view('admin-panel.fund-request-list',compact('requests'));
    }
    public function redeemRequestList()
    {
        $requests = $this->adminRepository->getAllRedeemRequestList();
        return view('admin-panel.redeem-request-list', compact('requests'));
    }

    public function bankDetails()
    {
        $requests = $this->adminRepository->getAllbankDetailsList();
        return view('admin-panel.bank-detail-list', compact('requests'));
    }

    public function bankDetailDel($id)
    {
        $requests = $this->adminRepository->deleteBankDetail($id);
        return redirect('hr80c4037/bank-details')->withSuccess('Deleted successfully.');
    }

    public function redeemRequestEdit($id, Request $request)
    {
        $requestData = $this->adminRepository->getRedeemRequestById($id);
        if ($request->isMethod('POST')) {
            $rules = array(
                'status' => 'required',
            );
            $validated = $request->validate($rules);

            $this->adminRepository->updateRedeemRequest($id, $validated['status']);
            if($validated['status'] == 'Rejected') {
                $user = $this->adminRepository->getUserById($requestData->user_id);
                $user->increment('credit',$requestData->redeem);
                $user->decrement('wallet',$requestData->reserve);
            }

            return redirect()->back()->withSuccess('Updated successfully.');
        }
        
        return view('admin-panel.redeem-request-edit', compact('requestData'));
    }

    public function redeemSendMoney($id, Request $request)
    {
        $requestData = $this->adminRepository->getRedeemRequestById($id);

        if(!$requestData) {
            return redirect()->back()->withError('Something went wrong.');
        }

        $bankDetail = $this->adminRepository->getUserCyrusDetailById($requestData->user_id);
        //dd($bankDetail);
        if(!$bankDetail) {
            return redirect()->back()->withError('No bank detail available for this user.');
        }
        
        $postFields = [
            'CustomerMobile' => $bankDetail->mobile,
            'beneficiaryAccount' => $bankDetail->account_no,
            'beneficiaryIFSC' => $bankDetail->ifsc,
            'orderId' => 'CYRUS-'.$requestData->id,
            'amount' => $requestData->after_tds,
            'comments' => $requestData->user_id
        ];
        //dd($postFields);
        $response = $this->cyrusRepository->sendMoney($postFields);
        //dd($response);
        if($response['result']['status'] == 'FAILURE') {

            if($response['result']['statuscode'] =='CY-005') {
                $newRedeem = $this->adminRepository->cloneRedeem($requestData->id);
            }
            //return redirect()->back()->withSuccess('Redeem requested successfully. Amount will be credit in your account within 24 hour.');
            return redirect('hr80c4037/redeem-request')->withInput($request->all())->withError($response['result']['statusMessage']);
        }
        //dd($response);
        $this->adminRepository->updateRedeemRequest($id, 'Approved');
        
        return redirect('hr80c4037/redeem-request')->withSuccess('Sent successfully.');
    }
    
    public function addFund(Request $request)
    {
        
        if($request->isMethod('POST')) {
            $rules = array(
                'amount' => 'required|numeric',
                'username' => 'required|exists:customer,customer_id'
            );
            $message = [
                'username.exists' => 'This Username does not exist.',
            ];
            $validated = $request->validate($rules,$message);
            // if($validated['amount'] > auth()->user()->credit) {
            //     return redirect()->back()->withInput($request->all())->withError('Insufficient fund.');
            // }

            $this->adminRepository->addFund($validated['username'],$validated['amount']);
            return redirect()->back()->withSuccess('Fund added successfully.');
        }

        return view('admin-panel.add-fund');
    }

    public function memberLogin(Request $request)
    {
        
        if($request->isMethod('POST')) {
            $rules = array(
                'username' => 'required|exists:customer,customer_id'
            );
            $message = [
                'username.exists' => 'This Username does not exist.',
            ];
            $validated = $request->validate($rules,$message);

            $user = Customer::where('customer_id',$request->username)->first();
            Auth::login($user); 
            return redirect()->intended('/user');
        }

        return view('admin-panel.member-login');
    }

    public function trusteeClubDistribution(Request $request)
    {
        $users = $this->adminRepository->getTrusteeClubUser();
        if($request->isMethod('POST')) {
            $rules = array(
                'amount' => 'required|numeric|min:1'
            );
            $validated = $request->validate($rules);
            $income = $validated['amount'];
            $distributionAmount = $income/$users->count();
            $distributionAmount = floor($distributionAmount*100)/100;
            if($users) {
                foreach($users as $user) {
                    DB::table('incomes')->insert([
                        'created_at' => date('Y-m-d H:i:s'),
                        'user_id' => $user->id,
                        'amount'  => $distributionAmount,
                        'user_send_by' => $user->id,
                        'type' => 'Trustee Club Pay',
                    ]);
                    Customer::where('id',$user->id)->increment('credit',$distributionAmount);
                }
            }
            return redirect()->back()->withSuccess('Distribute successfully.');
        }
        
        return view('admin-panel.trustee-club-distribution',compact('users'));
    }

    public function closing(Request $request)
    {
        $closing = $this->adminRepository->getClosingPayouts();
        
        if($request->isMethod('POST')) {

            $user_ids = $closing->pluck('user_id');
            $data = [];
            if($closing) {
            foreach($closing as $payout) {
                $data[] = [
                    'user_id' => $payout->id,
                    'amount' => $payout->amount,
                    'tds' => 0,
                    'admin' => 0,
                    'type' => 'Closing',
                    'description' => 'Closing',
                    'net_income' => $payout->amount,
                ];
            }

            if(!empty($data)) {
                $this->adminRepository->addPayout($data);
                $this->adminRepository->availIncome($user_ids->toArray());
            }
            
            }

            return redirect()->back()->withSuccess('Close successfully.');
        }
        
        return view('admin-panel.closing',compact('closing'));
    }

    public function payouts(Request $request)
    {
        $payouts = $this->adminRepository->getPayouts('P');
        if($request->isMethod('POST')) {
            

            return redirect()->back()->withSuccess('Payout successfully.');
        }
        return view('admin-panel.payouts',compact('payouts'));
    }

    public function roiList()
    {
        $roiList = $this->adminRepository->getRoiList();
        return view('admin-panel.roi-list',compact('roiList'));
    }

    public function levelIncome()
    {
        return view('admin.level-income');
    }

    public function roiIncome()
    {
        return view('admin.roi-income');
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

    public function activatePackage(Request $request)
    {
        
        if($request->isMethod('POST')) {
            $input = 
            $rules = array(
                'amount' => 'required|numeric',
            );
            $message = [
                'amount.required' => 'Please fill any package amount.',
            ];
            $validated = $request->validate($rules,$message);
            // if($validated['amount'] > auth()->user()->credit) {
            //     return redirect()->back()->withInput($request->all())->withError('Insufficient fund.');
            // }
            
            $this->customerRepository->updateUserAndParentData();

            $levelPercent = [2,1,0.25,0.25,0.25,0.25,0.25,0.25,0.25,0.25];
            $allTeam = $this->customerRepository->levelIncomeDistribution($validated['amount'],10,$levelPercent);

            return redirect()->back()->withSuccess('Package activated successfully.');
        }

        return view('admin.activate-package');
    }

    public function fundRequest()
    {
        return view('admin.fund-request');
    }

    public function fundHistory()
    {
        return view('admin.fund-history');
    }

    public function orders()
    {
        $categories = $this->customerRepository->getCategory();
        $orders = Auth::user()->orders()->orderBy('id','desc')->get();
        return view('shop.admin.order',compact('orders','categories'));
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

    public function password(Request $request)
    {
        if ($request->isMethod('POST')) {
            $rules = [
                'currentPassword' => 'required',
                'password' => 'required',
                'confirm_password' => 'required|same:password',
            ];
            $message = [
                'currentPassword.required' => 'Current password field is required.',
                'password.required' => 'New password field is required.',
            ];
            $validated = $request->validate($rules,$message);
            if(Auth::user()->pass_word != md5($request->input('currentPassword'))) {
                return redirect()->back()->withInput($request->all())->with('error', 'Incorrect old password.');
            }
            $store = [
                'pass_word'=>md5($request->input('password')),
            ];
            $this->customerRepository->updateUser(Auth::user()->id,$store);
            return redirect()->back()->with('success', 'Updated Successfully.');
        }
        $categories = $this->customerRepository->getCategory();
        return view('shop.admin.password',compact('categories'));
    }

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
                'pancard.required' => 'First Name is required.',
                'aadhar.required' => 'Last Name is required.',
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
                $destinationPath = 'files/kyc';
                $request->file('panimage')->move($destinationPath, $panimage);
                $store['panimage'] = $panimage;
            }

            if($request->file('aadharimage')) {
                $name = $request->file('aadharimage')->getClientOriginalName();
                $aadharimage = $request->file('aadharimage')->getClientOriginalName();
                $extension = $request->file('aadharimage')->getClientOriginalExtension();
                $aadharimage = time() . '.'.$extension;
                $destinationPath = 'files/kyc';
                $request->file('aadharimage')->move($destinationPath, $aadharimage);
                $store['aadharimage'] = $aadharimage;
            }

            if($request->file('b_aadhar_img')) {
                $name = $request->file('b_aadhar_img')->getClientOriginalName();
                $b_aadhar_img = $request->file('b_aadhar_img')->getClientOriginalName();
                $extension = $request->file('b_aadhar_img')->getClientOriginalExtension();
                $b_aadhar_img = time() . '.'.$extension;
                $destinationPath = 'files/kyc';
                $request->file('b_aadhar_img')->move($destinationPath, $b_aadhar_img);
                $store['b_aadhar_img'] = $b_aadhar_img;
            }
            
            $this->customerRepository->updateUser(Auth::user()->id,$store);
            return redirect()->back()->withInput($request->all())->with('success', 'Updated Successfully.');
        }
        $categories = $this->customerRepository->getCategory();
        return view('shop.admin.kyc-edit',compact('categories'));
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
            $message = [
                'bank_name.required' => 'First Name is required.',
                'branch.required' => 'Last Name is required.',
                'account_type.required' => 'Last Name is required.',
                'account_no.required' => 'Last Name is required.',
                'ifsc.required' => 'Last Name is required.',
            ];
            $validated = $request->validate($rules,$message);
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
                $destinationPath = 'files/kyc';
                $request->file('bank_img')->move($destinationPath, $bank_img);
                $store['bank_img'] = $bank_img;
            }
            
            $this->customerRepository->updateUser(Auth::user()->id,$store);
            return redirect()->back()->withInput($request->all())->with('success', 'Updated Successfully.');
        }
        $categories = $this->customerRepository->getCategory();
        return view('shop.admin.bank-edit',compact('categories'));
    }

    public function profileEdit(Request $request)
    {
        if ($request->isMethod('POST')) {

            $rules = [
                'f_name' => 'required',
                'l_name' => 'required',
                'gender' => 'required',
                'dob' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'country' => 'required',
                'state' => 'required',
                'pincode' => 'required',
                'file' => 'mimes:png,jpg,jpeg|max:2048'
            ];
            $message = [
                'f_name.required' => 'First Name is required.',
                'l_name.required' => 'Last Name is required.',
                'gender.required' => 'Gender is required.',
                'dob.required' => 'Email is required.',
                'phone.required' => 'Country is required.',
                'email.required' => 'Address is required.',
                'country.required' => 'City is required.',
                'state.required' => 'State is required.',
                'pincode.required' => 'Pincode is required.',
            ];
            $validated = $request->validate($rules,$message);
            $picName = '';
            if($request->file('file')) {
                $name = $request->file('file')->getClientOriginalName();
                $picName = $request->file('file')->getClientOriginalName();
                $extension = $request->file('file')->getClientOriginalExtension();
                $picName = time() . '.'.$extension;
                $destinationPath = 'files';
                $request->file('file')->move($destinationPath, $picName);
            }
            $store = [
                'f_name'=>$request->input('f_name'),
                'l_name'=>$request->input('l_name'),
                'gender'=>$request->input('gender'),
                'dob'=>$request->input('dob'),
                'phone'=>$request->input('phone'),
                'email'=>$request->input('email'),
                'country'=>$request->input('country'),
                'address'=>$request->input('address'),
                'state'=>$request->input('state'),
                'pincode'=>$request->input('pincode'),
                'image' => $picName,
            ];
            $this->customerRepository->updateUser(Auth::user()->id,$store);
            return redirect()->back()->withInput($request->all())->with('success', 'Updated Successfully.');
        }
        $categories = $this->customerRepository->getCategory();
        return view('shop.admin.profile-edit',compact('categories'));
    }

    public function logout(Request $request) {
        Auth::guard('admin')->logout();
        return redirect('/admin-panel');
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
