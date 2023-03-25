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
                                    <h3>Update Profile
                                        <small>Edit your profile</small>
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
                                    <li class="breadcrumb-item">Profile</li>
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
                                            <form class="needs-validation add-product-form" novalidate="" action="" method="POST" enctype='multipart/form-data'>
                                                @csrf
                                                <div class="form">
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">Full Name :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" name="full_name"  value="{{ old('full_name',$user->full_name) }}"
                                                                type="text" required="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">Gender :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <select class="form-control" name="gender">
                                                                <option selected="" disabled="" value="">Select gender</option>
                                                                <option selected="selected" value="Male">Male</option>
                                                                <option value="Female">Female</option>
                                                                <option  value="Other">Other</option>
                                                            </select>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">DOB :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" name="dob"  value="{{ old('dob',$user->dob) }}"
                                                                type="text" required="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">Phone :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" name="phone"  value="{{ old('phone',$user->phone) }}"
                                                                type="text" required="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">Email :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" name="email"  value="{{ old('email',$user->email) }}"
                                                                type="text" required="">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">Address :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" name="address"  value="{{ old('address',$user->address) }}"
                                                                type="text" required="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">State :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" name="state"  value="{{ old('state',$user->state) }}"
                                                                type="text" required="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">Pincode :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" name="pincode"  value="{{ old('pincode',$user->pincode) }}"
                                                                type="text" required="">
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom02"
                                                            class="col-xl-3 col-sm-4 mb-0">Profile Pic :</label>
                                                        <div class="col-xl-6 col-sm-7">
                                                            <input class="form-control" name="file"
                                                                type="file" required="">
                                                        </div>
                                                        <div class="col-md-2">
                                                            @if($user->image)
                                                                <img src="{{asset($user->image)}}" width="100">
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
