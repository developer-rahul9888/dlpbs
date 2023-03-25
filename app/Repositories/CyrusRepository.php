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
use Illuminate\Support\Facades\Http;
use Auth;


/**
 * Class UserRepository
 * @package App\Repositories
 * @version June 30, 2021, 7:13 am UTC
*/

class CyrusRepository extends BaseRepository
{

    public function __construct() {
        $this->MerchantID = 'AP576249';
        $this->MerchantKey = '013d09b70ecf43c';
        $this->payLoad = [
            'MerchantID' => $this->MerchantID,
            'MerchantKey' => $this->MerchantKey,
        ];
    }

    public function getBankList() {

        $this->payLoad = array_merge($this->payLoad,['MethodName' => 'banklist']);
        $response = Http::asForm()->post('https://cyrusrecharge.in/api/CyrusPaytmDMRNewSystem.aspx', $this->payLoad);
        return $this->checkResponse($response);
    }

    public function customerRegistration($data) {

        //$postFields = ['MOBILENO','FNAME','LNAME','DOB','PINCODE','ADDRESS','Pan','Aadhar'];
        $this->payLoad = array_merge($this->payLoad, ['MethodName' => 'customerregistration']);
        $this->payLoad = array_merge($this->payLoad, $data);
        $response = Http::asForm()->post('https://cyrusrecharge.in/api/CyrusPaytmDMRNewSystem.aspx', $this->payLoad);
        return $this->checkResponse($response);
    }

    public function otpVerify($data) {

        //$postFields = ['MOBILENO','OTP'];
        $this->payLoad = array_merge($this->payLoad, ['MethodName' => 'otpverify']);
        $this->payLoad = array_merge($this->payLoad, $data);
        $response = Http::asForm()->post('https://cyrusrecharge.in/api/CyrusPaytmDMRNewSystem.aspx', $this->payLoad);
        return $this->checkResponse($response);
    }

    public function kycDetails($data) {

        //$postFields = ['MOBILENO','Pan','Aadhar'];
        $this->payLoad = array_merge($this->payLoad, ['MethodName' => 'kycdetails']);
        $this->payLoad = array_merge($this->payLoad, $data);
        $response = Http::asForm()->post('https://cyrusrecharge.in/api/CyrusPaytmDMRNewSystem.aspx', $this->payLoad);
        return $this->checkResponse($response);
    }

    public function beneficiaryAccountVerification($data) {
        
        //$postFields = ['CustomerMobileNo''beneficiaryAccount','beneficiaryIFSC','orderId'];
        $this->payLoad = array_merge($this->payLoad, ['MethodName' => 'beneficiaryaccount_verification']);
        $this->payLoad = array_merge($this->payLoad, $data);
        $response = Http::asForm()->post('https://cyrusrecharge.in/api/CyrusPaytmDMRNewSystem.aspx', $this->payLoad);
        return $this->checkResponse($response);
    }

    public function addBeneficiary($data) {
        
        //$postFields = ['MOBILENO','CustomerMobileNo','BankId','AccountNo','IFSC','Name'];
        $this->payLoad = array_merge($this->payLoad, ['MethodName' => 'addbeneficiary']);
        $this->payLoad = array_merge($this->payLoad, $data);
        $response = Http::asForm()->post('https://cyrusrecharge.in/api/CyrusPaytmDMRNewSystem.aspx', $this->payLoad);
        return $this->checkResponse($response);
    }

    public function getBeneficiaryDetails($data) {
        
        //$postFields = ['CustomerMobile','beneficiaryAccount','beneficiaryIFSC','orderId','amount','comments'];
        $this->payLoad = array_merge($this->payLoad, ['MethodName' => 'getbeneficiarydetails']);
        $this->payLoad = array_merge($this->payLoad, $data);
        $response = Http::asForm()->post('https://cyrusrecharge.in/api/CyrusPaytmDMRNewSystem.aspx', $this->payLoad);
        return $this->checkResponse($response);
    }

    public function removeBeneficiaryAccount($data) {
        
        //$postFields = ['BENEFICIARYID'];
        $this->payLoad = array_merge($this->payLoad, ['MethodName' => 'removebeneficiaryaccount']);
        $this->payLoad = array_merge($this->payLoad, $data);
        $response = Http::asForm()->post('https://cyrusrecharge.in/api/CyrusPaytmDMRNewSystem.aspx', $this->payLoad);
        return $this->checkResponse($response);
    }

    public function getCustomerDetails($data) {

        //$postFields = ['MOBILENO'];
        $this->payLoad = array_merge($this->payLoad, ['MethodName' => 'getcustomerdetails']);
        $this->payLoad = array_merge($this->payLoad, $data);
        $response = Http::asForm()->post('https://cyrusrecharge.in/api/CyrusPaytmDMRNewSystem.aspx', $this->payLoad);
        return $this->checkResponse($response);
    }

    public function sendMoney($data) {

        //$postFields = ['CustomerMobile','beneficiaryAccount','beneficiaryIFSC','orderId','amount','comments'];
        $this->payLoad = array_merge($this->payLoad, ['MethodName' => 'sendmoney']);
        $this->payLoad = array_merge($this->payLoad, $data);
        $response = Http::asForm()->post('https://cyrusrecharge.in/api/CyrusPaytmDMRNewSystem.aspx', $this->payLoad);
        return $this->checkResponse($response);
    }

    public function checkStatus($data) {

        //$postFields = ['orderId'];
        $this->payLoad = array_merge($this->payLoad, ['MethodName' => 'checkstatus']);
        $this->payLoad = array_merge($this->payLoad, $data);
        $response = Http::asForm()->post('https://cyrusrecharge.in/api/PayoutAPI.aspx', $this->payLoad);
        return $this->checkResponse($response);
    }

    private function checkResponse($result) {
        if($result->json('statuscode') == 'ERR') {
            return $this->sendError($result->json());
        }
        elseif($result->successful() && ($result->json('statuscode') == 'TXN' || $result->json('statuscode') == '000' || $result->json('code') == '001')) {
            return $this->sendSuccess($result->json());
        } else {
            return $this->sendError($result->json());
        }
    }


    private function sendSuccess($result) {
        return [
            'status' => true,
            'message' => (isset($result['status']))?$result['status']:null,
            'data' => (isset($result['data']))?$result['data']:null,
            'result' => $result
        ];
    }

    private function sendError($result) {
        return [
            'status' => false,
            'message' => (isset($result['status']))?$result['status']:null,
            'data' => (isset($result['data']))?$result['data']:null,
            'result' => $result
        ];
    }
    
}
