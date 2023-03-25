<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\CustomerRepository;
use App\Mail\Register;
use Illuminate\Support\Facades\Mail;
use DB;

class HomeController extends Controller
{
    

    /**
     * Search repository instance.
     *
     * @var \Webkul\Core\Repositories\CustomerRepository
     */
    protected $CustomerRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Core\Repositories\SliderRepository  $sliderRepository
     * @param  \Webkul\Product\Repositories\SearchRepository  $searchRepository
     * @return void
     */
    public function __construct(CustomerRepository $CustomerRepository) {
        $this->customerRepository = $CustomerRepository;
    }

    /**
     * Loads the home page for the storefront.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('home');
    }

    public function response()
    {
        print_r($_POST);
        header("Content-Type:application/json");
        $data_api_resp = json_decode(file_get_contents('php://input'), true);
        return DB::table('responses')->insert([
            'data' => json_encode($data_api_resp)
        ]);
        if (empty($data_api_resp)) {
            # If empty response received from the API
        } else {

            $token = "";     // API token

            # If response received from API, retrive the values
            $accountID = $data_api_resp['api_response']['accountID'];
            $signature = $data_api_resp['api_response']['signature'];
            $pay_id = $data_api_resp['api_response']['pay_id'];
            $txn_id = $data_api_resp['api_response']['txn_id'];
            $pay_amount = $data_api_resp['api_response']['pay_amount'];
            $pay_utr = $data_api_resp['api_response']['pay_utr'];
            $pay_status = $data_api_resp['api_response']['pay_status'];

            # Compute the signature hash
            $signature_compute = md5($accountID . $token . $pay_id . $txn_id . $pay_status . $pay_amount . $pay_utr);

            # Match the signature hash
            if ($signature == $signature_compute) {
                # If signature match, process the transaction
            } else {
                # If signature don't match, ignore the payment
            }
        }
        return DB::table('responses')->insert([
            'data' => json_encode($data_api_resp)
        ]);
    }

    public function howItWork()
    {
        return view('how-it-work');
    }

    public function whyTether()
    {
        return view('why-tether');
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
                
        return view('contact');
    }

    /**
     * Loads the home page for the storefront if something wrong.
     *
     * @return \Exception
     */
    public function notFound()
    {
        abort(404);
    }

    /**
     * Upload image for product search with machine learning.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload()
    {
        return $this->searchRepository->uploadSearchImage(request()->all());
    }
}
