@extends('admin-panel.layouts.master')
@section('content-wrapper')
<div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Update User</h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <ol class="breadcrumb pull-right">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">
                                            <i data-feather="home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">User</li>
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
                                        <div class="col-xl-12">
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
                                                    <div class="row">
                                                        <div class="col-sm-4 form-group">
                                                            <label for="validationCustom02">Unique Code :</label>
                                                            <input class="form-control" name="" value="{{$user->customer_id}}"
                                                                type="text" required="" readonly>
                                                        </div>
                                                        <div class="col-sm-4 form-group">
                                                            <label for="validationCustom02">Image :</label>
                                                            <input class="form-control" name="image" value="{{old('image',$user->customer_id)}}"
                                                                type="file" required="" placeholder="Enter image">
                                                        </div>
                                                        <div class="col-sm-4 form-group">
                                                            <img src="{{asset($user->image)}}" width="100px">
                                                        </div>
                                                        <div class="col-sm-4 form-group">
                                                            <label for="validationCustom02">Sponsor Code :</label>
                                                            <input class="form-control" readonly value="{{$user->direct_customer_id}}"
                                                                type="text" >
                                                        </div>
                                                        <div class="col-sm-4 form-group">
                                                            <label for="validationCustom02">Full Name :</label>
                                                            <input class="form-control" name="full_name" value="{{old('full_name',$user->full_name)}}"
                                                                type="text" required="" placeholder="Enter full_name">
                                                        </div>
                                                        <div class="col-sm-4 form-group">
                                                            <label for="validationCustom02">DOJ :</label>
                                                            <input class="form-control" name="dob" value="{{old('dob',$user->dob)}}"
                                                                type="text" required="" placeholder="Enter dob">
                                                        </div>
                                                        <div class="col-sm-4 form-group">
                                                            <label for="validationCustom02">Phone :</label>
                                                            <input class="form-control" name="phone" value="{{old('phone',$user->phone)}}"
                                                                type="text" required="" placeholder="Enter phone">
                                                        </div>
                                                        <div class="col-sm-4 form-group">
                                                            <label for="validationCustom02">Email :</label>
                                                            <input class="form-control" name="email" value="{{old('email',$user->email)}}"
                                                                type="text" required="" placeholder="Enter email">
                                                        </div>
                                                        <div class="col-sm-4 form-group">
                                                            <label for="validationCustom02">Address :</label>
                                                            <input class="form-control" name="address" value="{{old('address',$user->address)}}"
                                                                type="text" required="" placeholder="Enter address">
                                                        </div>
                                                        <div class="col-sm-4 form-group">
                                                            <label for="validationCustom02">City :</label>
                                                            <input class="form-control" name="city" value="{{old('city',$user->city)}}"
                                                                type="text" required="" placeholder="Enter city">
                                                        </div>
                                                        <div class="col-sm-4 form-group">
                                                            <label for="validationCustom02">State :</label>
                                                            <input class="form-control" name="state" value="{{old('state',$user->state)}}"
                                                                type="text" required="" placeholder="Enter state">
                                                        </div>
                                                        <div class="col-sm-4 form-group">
                                                            <label for="validationCustom02">Pincode :</label>
                                                            <input class="form-control" name="pincode" value="{{old('pincode',$user->pincode)}}"
                                                                type="text" required="" placeholder="Enter pincode">
                                                        </div>
                                                        <div class="col-sm-4 form-group">
                                                            <label for="validationCustom02">Gender :</label>
                                                            <input class="form-control" name="gender" value="{{old('gender',$user->gender)}}"
                                                                type="text" required="" placeholder="Enter gender">
                                                        </div>
                                                        <div class="col-sm-4 form-group">
                                                            <label for="validationCustom02">PAN No :</label>
                                                            <input class="form-control" name="pancard" value="{{old('pancard',$user->pancard)}}"
                                                                type="text" required="" placeholder="Enter pancard">
                                                        </div>
                                                        <div class="col-sm-2 form-group">
                                                            <label for="validationCustom02">Upload Pan Image :</label>
                                                            <input class="form-control" name="panimage" value=""
                                                                type="file" required="" placeholder="Enter panimage">
                                                        </div>
                                                        <div class="col-sm-2 form-group">
                                                            @if($user->panimage)
                                                            <img src="{{asset($user->panimage)}}" width="100px">
                                                            @endif
                                                        </div>
                                                        <div class="col-sm-4 form-group">
                                                            <label for="validationCustom02">Aadhar No :</label>
                                                            <input class="form-control" name="aadhar" value="{{old('aadhar',$user->aadhar)}}"
                                                                type="text" required="" placeholder="Enter aadhar">
                                                        </div>
                                                        <div class="col-sm-4 form-group">
                                                            <label for="validationCustom02">Upload Aadhar :</label>
                                                            <input class="form-control" name="aadharimage" type="file" required="">
                                                        </div>
                                                        <div class="col-sm-2 form-group">
                                                            @if($user->aadharimage)
                                                            <img src="{{asset($user->aadharimage)}}" width="100px">
                                                            @endif
                                                        </div>
                                                        <div class="col-sm-4 form-group">
                                                            <label for="validationCustom02">Status :</label>
                                                            <input class="form-control" name="status" value="{{old('status',$user->status)}}"
                                                                type="text" required="" placeholder="Enter status">
                                                        </div>
                                                        <div class="col-sm-4 form-group">
                                                            <label for="validationCustom02">Password :</label>
                                                            <input class="form-control" name="password" value=""
                                                                type="text" required="" placeholder="Enter password">
                                                        </div>
                                                        <div class="col-sm-4 form-group">
                                                            <label for="validationCustom02">Credit :</label>
                                                            <input class="form-control" name="credit" 
                                                                type="text" required="" readonly value="{{old('credit',$user->credit)}}">
                                                        </div>
                                                        <div class="col-sm-4 form-group">
                                                            <label for="validationCustom02">Bank Name :</label>
                                                            <input class="form-control" name="bank_name" value="{{old('bank_name',$user->bank_name)}}"
                                                                type="text" required="" placeholder="Enter bank_name">
                                                        </div>
                                                        <div class="col-sm-4 form-group">
                                                            <label for="validationCustom02">Branch :</label>
                                                            <input class="form-control" name="branch" value="{{old('branch',$user->branch)}}"
                                                                type="text" required="" placeholder="Enter branch">
                                                        </div>

                                                        <div class="col-sm-4 form-group">
                                                            <label for="validationCustom02">State :</label>
                                                            <input class="form-control" name="bank_state" value="{{old('bank_state',$user->bank_state)}}"
                                                                type="text" required="" placeholder="Enter bank_state">
                                                        </div>
                                                        <div class="col-sm-4 form-group">
                                                            <label for="validationCustom02">Account Name :</label>
                                                            <input class="form-control" name="account_name" value="{{old('account_name',$user->account_name)}}"
                                                                type="text" required="" placeholder="Enter account_name">
                                                        </div>
                                                        <div class="col-sm-4 form-group">
                                                            <label for="validationCustom02">Account Type :</label>
                                                            <select class="form-control" name="account_type">
                                                                <option {{ (old('account_type',$user->account_type)=='Saving')?'selected':'' }} value="Saving">Saving</option>
                                                                <option {{ (old('account_type',$user->account_type)=='Current')?'selected':'' }} value="Current">Current</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-4 form-group">
                                                            <label for="validationCustom02">Account No. :</label>
                                                            <input class="form-control" name="account_no" value="{{old('account_no',$user->account_no)}}"
                                                                type="text" required="" placeholder="Enter account_no">
                                                        </div>
                                                        <div class="col-sm-4 form-group">
                                                            <label for="validationCustom02">IFSC Code :</label>
                                                            <input class="form-control" name="ifsc" value="{{old('ifsc',$user->ifsc)}}"
                                                                type="text" required="" placeholder="Enter ifsc">
                                                        </div>
                                                        <div class="col-sm-12 form-group">
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