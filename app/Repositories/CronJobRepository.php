<?php

namespace App\Repositories;


use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Webstore;
use App\Models\Income;
use App\Models\Summary;
use App\Models\Pin;
use App\Models\Roi;
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

class CronJobRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'pname',
        'status',
        'comm_dis',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Roi::class;
    }

    public function getPendingRoiDate() {
        return DB::table('roi')->where('pay_date','<=',date('Y-m-d'))->where('status','Active')->where('tmonth','>',0)->orderBy('pay_date','ASC')->value('pay_date');
    }

    public function getSelfRoiByDate($payDate) {
        return Roi::where('pay_date',$payDate)->orderBy('id','ASC')->where('status','Active')->where('tmonth','>',0)->get();
    }

    public function updateSelfRoi($payDate,$userId,$status) {
        return Roi::where('pay_date',$payDate)->where('user_id',$userId)->where('status','Active')->where('tmonth','>',0)
        ->when($status, function ($q) use($payDate) {
            return $q->decrement('tmonth',1,['pay_date'=> date('Y-m-d',strtotime('+1 week',strtotime($payDate)))]);
        }, function ($q) use($payDate) {
            return $q->update(['pay_date'=> date('Y-m-d',strtotime('+1 week',strtotime($payDate)))]);
        });
    }


    
    
}
