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
                                    <h3>Verify Bank Detail
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

                                            @elseif($bankDetail)
                                                <div class="alert alert-danger">Contact admin for edit this bank detatils.</div>
                                            @endif

                                            @if(session('error'))
                                                <div class="alert alert-danger">{{session('error')}}</div>
                                            @endif
                                            <form class="needs-validation add-product-form" novalidate="" action="" method="POST">
                                                @csrf
                                                <div class="form">
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">First Name :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" name="first_name" @if($bankDetail) readonly @endif value="{{ old('first_name',($bankDetail)?$bankDetail->first_name:'') }}"
                                                                type="text" required="">
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">Last Name :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" name="last_name" @if($bankDetail) readonly @endif  value="{{ old('last_name',($bankDetail)?$bankDetail->last_name:'') }}"
                                                                type="text" required="">
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">DOB :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" name="dob" @if($bankDetail) readonly @endif  value="{{ old('dob',($bankDetail)?$bankDetail->dob:'') }}"
                                                                type="date" required="">
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">Pincode :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" name="pincode"  @if($bankDetail) readonly @endif value="{{ old('pincode',($bankDetail)?$bankDetail->pincode:'') }}"
                                                                type="number" required="">
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">Address :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" name="address" @if($bankDetail) readonly @endif  value="{{ old('address',($bankDetail)?$bankDetail->address:'') }}"
                                                                type="text" required="">
                                                        </div>
                                                    </div>


                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">Bank :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <select class="form-control" name="bank" @if($bankDetail) readonly @endif>
                                                                <option selected="" disabled="" value="">Select bank</option>
                                                                @foreach($bankList['data'] as $bank)
                                                                <option
                                                                @if(old('bank') == $bank['id']) selected="selected"
                                                                @elseif ($bankDetail && $bankDetail->bank == $bank['id']) selected="selected"
                                                                @endif value="{{$bank['id']}}">{{$bank['bankname']}}</option>
                                                                @endforeach
                                                            </select>
                                                            
                                                        </div>
                                                    </div>
                                                    

                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">Account Type :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <select class="form-control" name="account_type" @if($bankDetail) readonly @endif>
                                                                <option selected="" disabled="" value="">Select account_type</option>
                                                                <option selected="selected" value="Saving">Saving</option>
                                                                <option value="Current">Current</option>
                                                            </select>
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">Account No. :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" name="account_no" @if($bankDetail) readonly @endif value="{{ old('account_no',($bankDetail)?$bankDetail->account_no:'') }}"
                                                                type="number" required="">
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">Account name :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" name="account_name" @if($bankDetail) readonly @endif  value="{{ old('account_name',($bankDetail)?$bankDetail->account_name:'') }}"
                                                                type="text" required="">
                                                        </div>
                                                    </div>

                                                    
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">IFSC Code :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" name="ifsc" @if($bankDetail) readonly @endif  value="{{ old('ifsc',($bankDetail)?$bankDetail->ifsc:'') }}"
                                                                type="text" required="">
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">Mobile :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" name="mobile" @if($bankDetail) readonly @endif  value="{{ old('mobile',($bankDetail)?$bankDetail->mobile:'') }}"
                                                                type="number" required="">
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">Pan :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" name="pan" @if($bankDetail) readonly @endif  value="{{ old('pan',($bankDetail)?$bankDetail->pan:'') }}"
                                                                type="text" required="">
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">Aadhar :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" name="aadhar" @if($bankDetail) readonly @endif  value="{{ old('aadhar',($bankDetail)?$bankDetail->aadhar:'') }}"
                                                                type="number" required="">
                                                        </div>
                                                    </div>

                                                    @if(request()->segment(4) == 'otp')
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">OTP :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" name="otp" @if($bankDetail) readonly @endif value="{{ old('otp') }}"
                                                                type="number" required="">
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>

                                                @if(!$bankDetail)
                                                <div class="form">
                                                    <div class="form-group row">
                                                        <div class="offset-xl-3 offset-sm-4 mt-4">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                            <button type="button" class="btn btn-light">Discard</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
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
