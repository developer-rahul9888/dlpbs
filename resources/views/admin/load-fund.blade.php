@extends('admin.layouts.master')


@section('content-wrapper')
<div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                <h3>Load Fund
                                        <small>Load fund by UPI</small>
                                    </h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <ol class="breadcrumb pull-right">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">
                                            <i data-feather="home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">Load</li>
                                    <li class="breadcrumb-item active">Fund</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->

                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row product-adding">
                                        <div class="col-xl-7">
                                            @if (count($errors) > 0)
                                                    <div class = "alert alert-danger">
                                                    {{ $errors->first() }}
                                                    </div>
                                            @endif

                                            @if(session('success'))
                                                <div class="alert alert-success">{{session('success')}}</div>
                                            @endif

                                            @if(session('error'))
                                                <div class="alert alert-danger">{{session('error')}}</div>
                                            @endif
                                            <form class="needs-validation add-product-form" novalidate="" action="" method="POST">
                                                
                                                <div class="form">
                                                    <input type="hidden" name="token" value="d0934a-81e19c-3d30cc-324419-46d180" type="text">
                                                    <input type="hidden" name="secret" value="t1mmLxIASR" type="text">
                                                    <input type="hidden" name="orderId" value="{{time()}}" type="number">
                                                    <input type="hidden" name="txnNote" value="Test" type="text">
                                                    <input type="hidden" name="cust_Mobile" value="7888953469" type="text">
                                                    <input type="hidden" name="cust_Email" value="developer.rahul9888@gmail.com" type="text">
                                                    <input type="hidden" name="callback_url" value="https://dlpbs.com/response" type="text">
                                                    <!-- <a href="upi://pay?pa=BHARATPE09912524269@yesbankltd&pn=Brain Secrets&tr=1675609386&am=10&cu=INR&tn=Test">Pay Now !</a> -->
                                                    
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom02"
                                                            class="col-xl-3 col-sm-4 mb-0">Amount</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" name="txnAmount" id="redeem" min="299" value="{{old('txnAmount')}}"
                                                                type="number" required="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form">
                                                    <div class="form-group row">
                                                        <div class="offset-xl-3 offset-sm-4 mt-4">
                                                            <button type="submit" class="btn btn-primary" >Submit</button>
                                                            <button type="button" class="btn btn-light">Discard</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->
            </div>

@endsection