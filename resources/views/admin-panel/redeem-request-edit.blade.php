@extends('admin-panel.layouts.master')


@section('content-wrapper')

<div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Update Redeem Request</h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <ol class="breadcrumb pull-right">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">
                                            <i data-feather="home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">Redeem Request</li>
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
                                            @csrf
                                                <div class="form">
                                                    
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom02"
                                                            class="col-xl-3 col-sm-4 mb-0">Username :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" readonly name="username" value="{{old('username',$requestData->customer_id)}}"
                                                                type="text" required="" placeholder="Enter username">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom02"
                                                            class="col-xl-3 col-sm-4 mb-0">Redeem Amount :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" readonly name="amount" value="{{old('amount',$requestData->redeem)}}"
                                                                type="number" required="" placeholder="Enter amount">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom02"
                                                            class="col-xl-3 col-sm-4 mb-0">Payble Amount:</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" readonly name="after_tds" value="{{old('after_tds',$requestData->after_tds)}}"
                                                                type="number" required="" placeholder="Enter amount">
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">Bank Name :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" readonly name="bank_name"  value="{{ old('bank_name',$requestData->bank_name) }}"
                                                                type="text" required="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">Account Type :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <select class="form-control" readonly name="account_type">
                                                                <option selected="" disabled="" value="">Select account_type</option>
                                                                <option selected="selected" value="Saving">Saving</option>
                                                                <option value="Current">Current</option>
                                                            </select>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">Branch :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" readonly name="branch"  value="{{ old('branch',$requestData->branch) }}"
                                                                type="text" required="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">Account No. :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" readonly name="account_no"  value="{{ old('account_no',$requestData->account_no) }}"
                                                                type="text" required="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">IFSC Code :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" readonly name="ifsc"  value="{{ old('ifsc',$requestData->ifsc) }}"
                                                                type="text" required="">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">Passbook image or<br> cancel cheque :</label>
                                                        <div class="col-md-2">
                                                            @if($requestData->bank_img)
                                                                <img src="{{asset($requestData->bank_img)}}" width="100">
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom02"
                                                            class="col-xl-3 col-sm-4 mb-0">Status :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                                <select class="form-control" name="status">
                                                                    <option {{ (old('status',$requestData->redeem_status)=='Pending')?'selected':'' }} value="Pending">Pending</option>
                                                                    <option {{ (old('status',$requestData->redeem_status)=='Approved')?'selected':'' }} value="Approved">Approved</option>
                                                                    <option {{ (old('status',$requestData->redeem_status)=='Rejected')?'selected':'' }} value="Rejected">Rejected</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="offset-xl-3 offset-sm-4 mt-4">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
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