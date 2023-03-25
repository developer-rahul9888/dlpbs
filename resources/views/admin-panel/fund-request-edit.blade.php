@extends('admin-panel.layouts.master')


@section('content-wrapper')

<div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Update Fund Request</h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <ol class="breadcrumb pull-right">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">
                                            <i data-feather="home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">Fund Request</li>
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
                                                            <input class="form-control" name="username" value="{{old('username',$request->customer_id)}}"
                                                                type="text" required="" placeholder="Enter username">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom02"
                                                            class="col-xl-3 col-sm-4 mb-0">Amount :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" name="amount" value="{{old('amount',$request->amount)}}"
                                                                type="number" required="" placeholder="Enter amount">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom02"
                                                            class="col-xl-3 col-sm-4 mb-0">Status :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                                <select class="form-control" name="status">
                                                                    <option {{ (old('status',$request->status)=='Pending')?'selected':'' }} value="Pending">Pending</option>
                                                                    <option {{ (old('status',$request->status)=='Approved')?'selected':'' }} value="Approved">Approved</option>
                                                                    <option {{ (old('status',$request->status)=='Reject')?'selected':'' }} value="Reject">Reject</option>
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