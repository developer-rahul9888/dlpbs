@extends('admin.layouts.master')
@section('content-wrapper')

@php $timer = $club = false;

$user = auth()->user();

if($user->consume > 0 && date('Y-m-d H:i:s') <= date('Y-m-d H:i:s',strtotime('+7 days',strtotime($user->package_used)))) {
    $fdate = date('Y-m-d H:i:s');
    $tdate = date('Y-m-d H:i:s',strtotime('+7 days',strtotime($user->package_used)));
    $seconds = strtotime($tdate);
    
    if($user->consume > 0 && date('Y-m-d H:i:s') <= $tdate ) {
        $club = 'Pending';
        $timer = true;
    }
}

if($user->club > 0) {
        $club = 'Eligible';
        $timer = false;
}

if($user->user_level==0) {
    $pool = 'Deactive';
}  
elseif($user->user_level==1) {
    $pool = 'Basic';
} 
elseif($user->user_level==2) {
    $pool = 'Pro';
}
elseif($user->user_level==3) {
    $pool = 'Master';
}  
elseif($user->user_level==4) {
    $pool = 'Super';
}
elseif($user->user_level==5) {
    $pool = 'Super Fast';
} 
elseif($user->user_level==6) {
    $pool = 'Director';
} else {
    $pool = 'Deactive';
}

    


@endphp


@section('styles')
<style>

.share-link > .copy-link {
    width: 80px;
    cursor: pointer;
    border: 1px solid #e6e6e6;
    padding: 3px;
    height: 37px;
    border-radius: 5px;
    background-color: white;
}
.card .card-body .status {
    position: absolute;
    top: 0;
    right: 0;
    padding: 8px;
    background-color: #13c9ca;
    border-radius: 0 0 5px 15px;
    color: white;
}


.media-body {
    color: white  !important;
}
.media-body h3 {
    background-color:none;
}

/* countdown number */

.countdownHolder{
	width:100%;
	margin:0 auto;
	font: 30px/1.5 'Open Sans Condensed',sans-serif;
	text-align:center;
	letter-spacing:-3px;
}

.position{
	display: inline-block;
	height: 1.6em;
	overflow: hidden;
	position: relative;
	width: 1.05em;
}

.digit{
	position:absolute;
	display:block;
	width:1em;
	background-color:#444;
	border-radius:0.2em;
	text-align:center;
	color:#fff;
	letter-spacing:-1px;
}

.digit.static{
	box-shadow:1px 1px 1px rgba(4, 4, 4, 0.35);
	
	background-image: linear-gradient(bottom, #3A3A3A 50%, #444444 50%);
	background-image: -o-linear-gradient(bottom, #3A3A3A 50%, #444444 50%);
	background-image: -moz-linear-gradient(bottom, #3A3A3A 50%, #444444 50%);
	background-image: -webkit-linear-gradient(bottom, #3A3A3A 50%, #444444 50%);
	background-image: -ms-linear-gradient(bottom, #3A3A3A 50%, #444444 50%);
	
	background-image: -webkit-gradient(
		linear,
		left bottom,
		left top,
		color-stop(0.5, #3A3A3A),
		color-stop(0.5, #444444)
	);
}

/**
 * You can use these classes to hide parts
 * of the countdown that you don't need.
 */

.countDays{ }
.countDiv0{}
.countHours{}
.countDiv1{}
.countMinutes{}
.countDiv2{ display:none !important; }
.countSeconds{ display:none !important; }


.countDiv{
	display:inline-block;
	width:16px;
	height:1.6em;
	position:relative;
}

.countDiv:before,
.countDiv:after{
	position:absolute;
	width:5px;
	height:5px;
	background-color:#444;
	border-radius:50%;
	left:50%;
	margin-left:-3px;
	top:0.5em;
	box-shadow:1px 1px 1px rgba(4, 4, 4, 0.5);
	content:'';
}

.countDiv:after{
	top:0.9em;
}

/*----------------------------
	Main Section
-----------------------------*/

#note{
	color: #666666;
	font-size: 12px;
	margin: 0 auto;
	padding: 4px;
	text-align: center;
	text-shadow: 1px 1px 0 rgba(255, 255, 255, 0.3);
	width: 400px;
}
</style>
@endsection
            <div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="page-header-left">
                                    <h3>Dashboard
                                        <small>Welcome , {{auth()->user()->full_name}}</small>
                                    </h3>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body form-group share-link">
                                        <span class="tooltiptext" id="myTooltip" >Copy to clipboard</span>
                                        <lable>Referral link</lable>
                                        <input type="text" class="form-control" id="share-link" value="{{url('register/'.auth()->user()->customer_id)}}">
                                        <i class="copy-link" data-feather="copy" onclick="myFunction()" onmouseout="outFunc()"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                @if($timer) 
                                    <div id="countdown"></div>
                                    <p id="note"></p>
                                @else
                                <ol class="breadcrumb pull-right">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">
                                            <i data-feather="home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->

                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xxl-4 col-md-6 xl-50">
                            <a href="{{url('user/income')}}">
                                <div class="card o-hidden widget-cards">
                                    <div class="card-body" style="background:linear-gradient(90deg, #34568b 0%, #1b2029 100%)">
                                        <div class="media static-top-widget align-items-center">
                                            <div class="icons-widgets">
                                                <div class="align-self-center text-center">
                                                    <i data-feather="credit-card" class="font-warning"></i>
                                                </div>
                                            </div>
                                            <div class="media-body media-doller">
                                                <h4 class="m-0">Earnings</h4>
                                                <h3 class="mb-0">INR <span class="counter">{{auth()->user()->incomes->sum('amount')}}</span>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xxl-4 col-md-6 xl-50">
                            <a href="{{url('user/activation')}}">
                                <div class="card o-hidden widget-cards">
                                    <div class="card-body" style="background:linear-gradient(90deg, #FF6F61 0%, #1b2029 100%)">
                                        <div class="media static-top-widget align-items-center">
                                            <div class="icons-widgets">
                                                <div class="align-self-center text-center"><i data-feather="users"
                                                        class="font-danger"></i></div>
                                            </div>
                                            <div class="media-body media-doller"><h4 class="m-0">Activation Wallet</h4>
                                                <h3 class="mb-0">INR <span class="counter">{{auth()->user()->wallet}}</span></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xxl-4 col-md-6 xl-50">
                            <a href="{{url('user/load-fund')}}">
                                <div class="card o-hidden widget-cards">
                                    <div class="card-body" style="background:linear-gradient(90deg, #6B5B95 0%, #1b2029 100%)">
                                        <div class="media static-top-widget align-items-center">
                                            <div class="icons-widgets">
                                                <div class="align-self-center text-center"><i data-feather="users"
                                                        class="font-danger"></i></div>
                                            </div>
                                            <div class="media-body media-doller">
                                                <h3 class="mb-0">Load Wallet</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xxl-4 col-md-6 xl-50">
                            <a href="{{url('user/direct-income')}}">
                                <div class="card o-hidden widget-cards">
                                    <div class="card-body" style="background:linear-gradient(90deg, #88B04B 0%, #1b2029 100%)">
                                        <div class="media static-top-widget align-items-center">
                                            <div class="icons-widgets">
                                                <div class="align-self-center text-center">
                                                    <i data-feather="user" class="font-secondary"></i>
                                                </div>
                                            </div>
                                            <div class="media-body media-doller">
                                                <h4 class="m-0">Direct Income</h4>
                                                <h3 class="mb-0">INR <span>{{auth()->user()->directIncome->sum('amount')}}</span></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xxl-4 col-md-6 xl-50">
                            <a href="{{url('user/level-income')}}">
                                <div class="card o-hidden widget-cards">
                                    <div class="card-body" style="background:linear-gradient(90deg, #F7CAC9 0%, #1b2029 100%)">
                                        <div class="media static-top-widget align-items-center">
                                            <div class="icons-widgets">
                                                <div class="align-self-center text-center">
                                                    <i data-feather="users" class="font-secondary"></i>
                                                </div>
                                            </div>
                                            <div class="media-body media-doller">
                                                <h4 class="m-0">Level Income</h4>
                                                <h3 class="mb-0">INR <span>{{auth()->user()->levelIncome->sum('amount')}}</span></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        

                        <div class="col-xxl-4 col-md-6 xl-50">
                            <a href="{{url('user/basic-pool-income')}}">
                                <div class="card o-hidden widget-cards">
                                    <div class="card-body" style="background:linear-gradient(90deg, #92A8D1 0%, #1b2029 100%)">
                                        <div class="media static-top-widget align-items-center">
                                            <div class="icons-widgets">
                                                <div class="align-self-center text-center">
                                                    <i data-feather="box" class="font-secondary"></i>
                                                </div>
                                            </div>
                                            <div class="media-body media-doller">
                                                <h4 class="m-0">Basic Pool Income</h4>
                                                <h3 class="mb-0">INR <span>{{auth()->user()->basicPoolIncome->sum('amount')}}</span></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xxl-4 col-md-6 xl-50">
                            <a href="{{url('user/pro-pool-income')}}">
                                <div class="card o-hidden widget-cards">
                                    <div class="card-body" style="background:linear-gradient(90deg, #B565A7 0%, #1b2029 100%)">
                                        <div class="media static-top-widget align-items-center">
                                            <div class="icons-widgets">
                                                <div class="align-self-center text-center">
                                                    <i data-feather="box" class="font-secondary"></i>
                                                </div>
                                            </div>
                                            <div class="media-body media-doller">
                                                <h4 class="m-0">Pro Pool Income</h4>
                                                <h3 class="mb-0">INR <span>{{auth()->user()->proPoolIncome->sum('amount')}}</span></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xxl-4 col-md-6 xl-50">
                            <a href="{{url('user/pro-binary-income')}}">
                                <div class="card o-hidden widget-cards">
                                    <div class="card-body" style="background:linear-gradient(90deg, #009B77 0%, #1b2029 100%)">
                                        <div class="media static-top-widget align-items-center">
                                            <div class="icons-widgets">
                                                <div class="align-self-center text-center">
                                                    <i data-feather="git-merge" class="font-secondary"></i>
                                                    <!-- <i class="fa fa-google-wallet" aria-hidden="true"></i> -->
                                                    <!-- <img src="{{asset('assets/images/dollar-symbol.png')}}" width="40px"> -->
                                                </div>
                                            </div>
                                            <div class="media-body media-doller">
                                                <h4 class="m-0">Pro Binary Income</h4>
                                                <h3 class="mb-0">INR <span>{{auth()->user()->proBinaryIncome->sum('amount')}}</span></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xxl-4 col-md-6 xl-50">
                            <a href="{{url('user/master-pool-income')}}">
                                <div class="card o-hidden widget-cards">
                                    <div class="card-body" style="background:linear-gradient(90deg, #DD4124 0%, #1b2029 100%)">
                                        <div class="media static-top-widget align-items-center">
                                            <div class="icons-widgets">
                                                <div class="align-self-center text-center">
                                                    <i data-feather="box" class="font-secondary"></i>
                                                </div>
                                            </div>
                                            <div class="media-body media-doller">
                                                <h4 class="m-0">Master Pool Income</h4>
                                                <h3 class="mb-0">INR <span>{{auth()->user()->masterPoolIncome->sum('amount')}}</span></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xxl-4 col-md-6 xl-50">
                            <a href="{{url('user/master-binary-income')}}">
                                <div class="card o-hidden widget-cards">
                                    <div class="card-body" style="background:linear-gradient(90deg, #D65076 0%, #1b2029 100%)">
                                        <div class="media static-top-widget align-items-center">
                                            <div class="icons-widgets">
                                                <div class="align-self-center text-center">
                                                    <i data-feather="git-merge" class="font-secondary"></i>
                                                </div>
                                            </div>
                                            <div class="media-body media-doller">
                                                <h4 class="m-0">Master Binary Income</h4>
                                                <h3 class="mb-0">INR <span>{{auth()->user()->masterBinaryIncome->sum('amount')}}</span></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xxl-4 col-md-6 xl-50">
                            <a href="{{url('user/super-pool-income')}}">
                                <div class="card o-hidden widget-cards">
                                    <div class="card-body" style="background:linear-gradient(90deg, #45B8AC 0%, #1b2029 100%)">
                                        <div class="media static-top-widget align-items-center">
                                            <div class="icons-widgets">
                                                <div class="align-self-center text-center">
                                                    <i data-feather="box" class="font-secondary"></i>
                                                </div>
                                            </div>
                                            <div class="media-body media-doller">
                                                <h4 class="m-0">Super Pool Income</h4>
                                                <h3 class="mb-0">INR <span>{{auth()->user()->superPoolIncome->sum('amount')}}</span></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xxl-4 col-md-6 xl-50">
                            <a href="{{url('user/super-binary-income')}}">
                                <div class="card o-hidden widget-cards">
                                    <div class="card-body" style="background:linear-gradient(90deg, #5B5EA6 0%, #1b2029 100%)">
                                        <div class="media static-top-widget align-items-center">
                                            <div class="icons-widgets">
                                                <div class="align-self-center text-center">
                                                    <i data-feather="git-merge" class="font-secondary"></i>
                                                </div>
                                            </div>
                                            <div class="media-body media-doller">
                                                <h4 class="m-0">Super Binary Income</h4>
                                                <h3 class="mb-0">INR <span>{{auth()->user()->superBinaryIncome->sum('amount')}}</span></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xxl-4 col-md-6 xl-50">
                            <a href="{{url('user/super-fast-pool-income')}}">
                                <div class="card o-hidden widget-cards">
                                    <div class="card-body" style="background:linear-gradient(90deg, #9B2335 0%, #1b2029 100%)">
                                        <div class="media static-top-widget align-items-center">
                                            <div class="icons-widgets">
                                                <div class="align-self-center text-center">
                                                    <i data-feather="box" class="font-secondary"></i>
                                                </div>
                                            </div>
                                            <div class="media-body media-doller">
                                                <h4 class="m-0">Super Fast Pool Income</h4>
                                                <h3 class="mb-0">INR <span>{{auth()->user()->superFastPoolIncome->sum('amount')}}</span></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xxl-4 col-md-6 xl-50">
                            <a href="{{url('user/super-fast-binary-income')}}">
                                <div class="card o-hidden widget-cards">
                                    <div class="card-body" style="background:linear-gradient(90deg, #E15D44 0%, #1b2029 100%)">
                                        <div class="media static-top-widget align-items-center">
                                            <div class="icons-widgets">
                                                <div class="align-self-center text-center">
                                                    <i data-feather="git-merge" class="font-secondary"></i>
                                                </div>
                                            </div>
                                            <div class="media-body media-doller">
                                                <h4 class="m-0">Super Fast Binary Income</h4>
                                                <h3 class="mb-0">INR <span>{{auth()->user()->superFastBinaryIncome->sum('amount')}}</span></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>


                        <div class="col-xxl-4 col-md-6 xl-50">
                            <a href="{{url('user/director-pool-income')}}">
                                <div class="card o-hidden widget-cards">
                                    <div class="card-body" style="background:linear-gradient(90deg, #7FCDCD 0%, #1b2029 100%)">
                                        <div class="media static-top-widget align-items-center">
                                            <div class="icons-widgets">
                                                <div class="align-self-center text-center">
                                                    <i data-feather="box" class="font-secondary"></i>
                                                </div>
                                            </div>
                                            <div class="media-body media-doller">
                                                <h4 class="m-0">Director Pool Income</h4>
                                                <h3 class="mb-0">INR <span>{{auth()->user()->directorPoolIncome->sum('amount')}}</span></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xxl-4 col-md-6 xl-50">
                            <a href="{{url('user/director-binary-income')}}">
                                <div class="card o-hidden widget-cards">
                                    <div class="card-body" style="background:linear-gradient(90deg, #BC243C 0%, #1b2029 100%)">
                                        <div class="media static-top-widget align-items-center">
                                            <div class="icons-widgets">
                                                <div class="align-self-center text-center">
                                                    <i data-feather="git-merge" class="font-secondary"></i>
                                                </div>
                                            </div>
                                            <div class="media-body media-doller">
                                                <h4 class="m-0">Director Binary Income</h4>
                                                <h3 class="mb-0">INR <span>{{auth()->user()->directorBinaryIncome->sum('amount')}}</span></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xxl-4 col-md-6 xl-50">
                            <a href="{{url('user/salary-income')}}">
                                <div class="card o-hidden widget-cards">
                                    <div class="card-body" style="background:linear-gradient(90deg, #C3447A 0%, #1b2029 100%)">
                                        <div class="media static-top-widget align-items-center">
                                            <div class="icons-widgets">
                                                <div class="align-self-center text-center">
                                                    <i data-feather="box" class="font-secondary"></i>
                                                </div>
                                            </div>
                                            <div class="media-body media-doller">
                                                <h4 class="m-0">Salary Income</h4>
                                                <h3 class="mb-0">INR <span>{{auth()->user()->salaryIncome->sum('amount')}}</span></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xxl-4 col-md-6 xl-50">
                            <a href="{{url('user/weekly-fix-income')}}">
                                <div class="card o-hidden widget-cards">
                                    <div class="card-body" style="background:linear-gradient(90deg, #C3447A 0%, #1b2029 100%)">
                                        <div class="media static-top-widget align-items-center">
                                            <div class="icons-widgets">
                                                <div class="align-self-center text-center">
                                                    <i data-feather="box" class="font-secondary"></i>
                                                </div>
                                            </div>
                                            <div class="media-body media-doller">
                                                <h4 class="m-0">Weekly Fix Income</h4>
                                                <h3 class="mb-0">INR <span>{{auth()->user()->weeklyFixIncome->sum('amount')}}</span></h3>
                                            </div>
                                        </div>
                                        @php $roi = auth()->user()->roi;  @endphp
                                        @if($roi)
                                        <div class="status">Pay Date : {{$roi->pay_date}}</div>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xxl-4 col-md-6 xl-50">
                            <a href="{{url('user/redeem')}}">
                                <div class="card o-hidden widget-cards">
                                    <div class="card-body" style="background:linear-gradient(90deg, #98B4D4 0%, #1b2029 100%)">
                                        <div class="media static-top-widget align-items-center">
                                            <div class="icons-widgets">
                                                <div class="align-self-center text-center"><i data-feather="credit-card"
                                                        class="font-danger"></i></div>
                                            </div>
                                            <div class="media-body media-doller"><h4 class="m-0">Withdrawal Wallet</h4>
                                                <h3 class="mb-0">INR <span class="counter">{{auth()->user()->credit}}</span></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>




                        <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="profile-details text-center">
                                    @if(Auth::user()->image)
                                    <img src="{{asset(Auth::user()->image)}}" alt="" class="img-fluid img-90 rounded-circle blur-up lazyloaded">
                                    @else
                                    <img src="{{asset('assets/images/avtar.png')}}" alt="" class="img-fluid img-90 rounded-circle blur-up lazyloaded">
                                    @endif
                                        
                                        <h5 class="f-w-600 mb-0">{{auth()->user()->full_name}}</h5>
                                        <span>{{auth()->user()->customer_id}}</span>
                                        <!-- <div class="social">
                                            <div class="form-group btn-showcase">
                                                <button class="btn social-btn btn-fb d-inline-block"> <i class="fa fa-facebook"></i></button>
                                                <button class="btn social-btn btn-twitter d-inline-block"><i class="fa fa-google"></i></button>
                                                <button class="btn social-btn btn-google d-inline-block me-0"><i class="fa fa-twitter"></i></button>
                                            </div>
                                        </div> -->
                                    </div>
                                    <hr>
                                    <div class="project-status">
                                        <h5 class="f-w-600">Employee Status</h5>
                                        <div class="media">
                                            <div class="media-body">
                                                <h6>Customer ID<span class="pull-right">{{auth()->user()->customer_id}}</span></h6>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="media-body">
                                                <h6>Status <span class="pull-right">{{(auth()->user()->consume > 0)?'Green':'Red'}}</span></h6>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="media-body">
                                                <h6>Package<span class="pull-right">INR {{(auth()->user()->package > 0)?auth()->user()->package:'---'}}</span></h6>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="media-body">
                                                <h6>Pool<span class="pull-right">{{$pool}} Pool</span></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(auth()->user()->consume > 0)
                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="profile-details text-center">
                                        <img src="https://brainsecrets.net/wp-content/uploads/2019/12/logo.png" alt="" class="img-fluid blur-up lazyloaded">
                                        <h5 class="f-w-600 mb-0">Brainsecrets</h5>
                                    </div>
                                    <hr>
                                    <div class="row justify-content-center">
                                        <a  href="{{url('user/brainsecret')}}" class="btn btn-primary" fdprocessedid="k7ue6e">Create Account</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>



                    </div>
                </div>
                <!-- Container-fluid Ends-->
            </div>




            
	
@endsection


@section('scripts')

<script>
    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).val()).select();
        document.execCommand("copy");
        $temp.remove();
    }

    function myFunction() {
  /* Get the text field */
  var copyText = document.getElementById("share-link");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

   /* Copy the text inside the text field */
  //navigator.clipboard.writeText(copyText.value);

  document.execCommand("copy");

 var tooltip = document.getElementById("myTooltip");
  tooltip.innerHTML = "Copied";
  document.getElementById("myTooltip").style.top = '-50px';
  document.getElementById("myTooltip").style.opacity = '0';
  setTimeout(function() {
    document.getElementById("myTooltip").style.top = '-15px';
    document.getElementById("myTooltip").style.opacity = '1';
  }, 1000)
}

function outFunc() {
  var tooltip = document.getElementById("myTooltip");
  tooltip.innerHTML = "Copy to clipboard";
  
}


</script>


@if($timer)

<script>
        
(function($){
	
	// Number of seconds in every time division
	var days	= 24*60*60,
		hours	= 60*60,
		minutes	= 60;
	
	// Creating the plugin
	$.fn.countdown = function(prop){
		
		var options = $.extend({
			callback	: function(){},
			timestamp	: 0
		},prop);
		
		var left, d, h, m, s, positions;

		// Initialize the plugin
		init(this, options);
		
		positions = this.find('.position');
		
		(function tick(){
			
			// Time left
			left = Math.floor((options.timestamp - (new Date())) / 1000);
			
			if(left < 0){
				left = 0;
			}
			
			// Number of days left
			d = Math.floor(left / days);
			updateDuo(0, 1, d);
			left -= d*days;
			
			// Number of hours left
			h = Math.floor(left / hours);
			updateDuo(2, 3, h);
			left -= h*hours;
			
			// Number of minutes left
			m = Math.floor(left / minutes);
			updateDuo(4, 5, m);
			left -= m*minutes;
			
			// Number of seconds left
			s = left;
			updateDuo(6, 7, s);
			
			// Calling an optional user supplied callback
			options.callback(d, h, m, s);
			
			// Scheduling another call of this function in 1s
			setTimeout(tick, 1000);
		})();
		
		// This function updates two digit positions at once
		function updateDuo(minor,major,value){
			switchDigit(positions.eq(minor),Math.floor(value/10)%10);
			switchDigit(positions.eq(major),value%10);
		}
		
		return this;
	};


	function init(elem, options){
		elem.addClass('countdownHolder');

		// Creating the markup inside the container
		$.each(['Days','Hours','Minutes','Seconds'],function(i){
			$('<span class="count'+this+'">').html(
				'<span class="position">\
					<span class="digit static">0</span>\
				</span>\
				<span class="position">\
					<span class="digit static">0</span>\
				</span>'
			).appendTo(elem);
			
			if(this!="Seconds"){
				elem.append('<span class="countDiv countDiv'+i+'"></span>');
			}
		});

	}

	// Creates an animated transition between the two numbers
	function switchDigit(position,number){
		
		var digit = position.find('.digit')
		
		if(digit.is(':animated')){
			return false;
		}
		
		if(position.data('digit') == number){
			// We are already showing this number
			return false;
		}
		
		position.data('digit', number);
		
		var replacement = $('<span>',{
			'class':'digit',
			css:{
				top:'-2.1em',
				opacity:0
			},
			html:number
		});
		
		// The .static class is added when the animation
		// completes. This makes it run smoother.
		
		digit
			.before(replacement)
			.removeClass('static')
			.animate({top:'2.5em',opacity:0},'fast',function(){
				digit.remove();
			})

		replacement
			.delay(100)
			.animate({top:0,opacity:1},'fast',function(){
				replacement.addClass('static');
			});
	}
})(jQuery);

// other one
$(function(){
	
    var seconds = {{$seconds}};
	var note = $('#note'),
		ts = new Date(2012, 0, 1),
		newYear = true;
	
	if((new Date()) > ts){
		// The new year is here! Count towards something else.
		// Notice the *1000 at the end - time must be in milliseconds
		ts = seconds*1000;
		newYear = false;
	}
		
	$('#countdown').countdown({
		timestamp	: ts,
		callback	: function(days, hours, minutes, seconds){
			
			var message = "";
			
			message += days + " day" + ( days==1 ? '':'s' ) + ", ";
			message += hours + " hour" + ( hours==1 ? '':'s' ) + ", ";
			message += minutes + " minute" + ( minutes==1 ? '':'s' ) + " and ";
			message += seconds + " second" + ( seconds==1 ? '':'s' ) + " <br />";
			
			if(newYear){
				message += "left until the new year!";
			}
			else {
				message += "left to achieve royalty from now!";
			}
			
			note.html(message);
		}
	});
	
});
</script>

@endif

@endsection