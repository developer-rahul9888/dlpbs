<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\CustomerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use DB;

class CyrusController extends Controller
{

    public function __construct(CustomerRepository $CustomerRepository) {
    $this->customerRepository = $CustomerRepository;
}

    

    public function login(Request $request)
    {
      $response = Http::asForm()->post('https://cyrusrecharge.in/api/CyrusPaytmDMRNewSystem.aspx', [
        'MerchantID' => 'AP576249',
        'MerchantKey' => '013d09b70ecf43c',
        'MethodName' => 'banklist',
        ]);
        dd($response->json());
    }
}
