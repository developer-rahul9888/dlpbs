<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\CronJobRepository;
use App\Mail\Register;
use Illuminate\Support\Facades\Mail;
use DB;

class CronJobController extends Controller
{
    

    /**
     * Search repository instance.
     *
     * @var \Webkul\Core\Repositories\CronJobRepository
     */
    protected $cronJobRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Core\Repositories\SliderRepository  $sliderRepository
     * @param  \Webkul\Product\Repositories\SearchRepository  $searchRepository
     * @return void
     */
    public function __construct(CronJobRepository $cronJobRepository) {
    $this->cronJobRepository = $cronJobRepository;
    }

    /**
     * Loads the home page for the storefront.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $payDate = $this->cronJobRepository->getPendingRoiDate();
        $day = date('l',strtotime($payDate));
        $status = true;
        //if($day=='Sunday') { $status = false; } else { $status = true; }

        if($payDate) {
            $roiData = $this->cronJobRepository->getSelfRoiByDate($payDate);
            $response = $roiData->map(function($data) use($payDate,$status) {
                if($status) {
                    if($data->tmonth == 4) { $amount = 150; }
                    elseif($data->tmonth == 3) { $amount = 300; }
                    elseif($data->tmonth == 2) { $amount = 600; }
                    elseif($data->tmonth == 1) { $amount = 1200; }
                    else { $amount = 0; }
                    if($amount > 0) {
                        DB::table('incomes')->insert([
                            'user_id' => $data->user_id,
                            'amount'  => $amount,
                            'type' => 'Weekly Fix Income',
                            'pay_level' => 0,
                            'created_at' => $payDate
                        ]);
                        DB::table('customer')->where('id',$data->user_id)->increment('credit',$amount);
                    } 
                    
                }
                $this->cronJobRepository->updateSelfRoi($payDate,$data->user_id,$status);
                return $data;
            });
        }
        
        //echo '<pre>'; print_r($response->toArray());
    }
}
