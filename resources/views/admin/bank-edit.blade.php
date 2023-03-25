@extends('admin.layouts.master')


@section('content-wrapper')

@php $user = Auth::user();  @endphp
            <div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Update Bank Detail
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
                                    <li class="breadcrumb-item">Bank</li>
                                    <li class="breadcrumb-item active">Edit</li>
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
                                        <div class="col-xl-9">
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
                                            <form class="needs-validation add-product-form" novalidate="" action="" method="POST" enctype='multipart/form-data'>
                                                @csrf
                                                <div class="form">
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">Bank Name :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" name="bank_name"  value="{{ old('bank_name',$user->bank_name) }}"
                                                                type="text" required="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">Account Type :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <select class="form-control" name="account_type">
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
                                                            <input class="form-control" name="branch"  value="{{ old('branch',$user->branch) }}"
                                                                type="text" required="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">Account No. :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" name="account_no"  value="{{ old('account_no',$user->account_no) }}"
                                                                type="text" required="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">IFSC Code :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" name="ifsc"  value="{{ old('ifsc',$user->ifsc) }}"
                                                                type="text" required="">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">Passbook image or<br> cancel cheque :</label>
                                                        <div class="col-xl-6 col-sm-7">
                                                            <input class="form-control" name="bank_img"
                                                                type="file" required="">
                                                        </div>
                                                        <div class="col-md-2">
                                                            @if($user->bank_img)
                                                                <img src="{{asset($user->bank_img)}}" width="100">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="form">
                                                    <div class="form-group row">
                                                        <div class="offset-xl-3 offset-sm-4 mt-4">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
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
