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
                                    <h3>Update Kyc
                                        <small>Edit your kyc</small>
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
                                    <li class="breadcrumb-item">KYC</li>
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
                                                            class="col-xl-4 col-sm-4 mb-0">PAN No :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" name="pancard"  value="{{ old('pancard',$user->pancard) }}" placeholder="PAN No" 
                                                                type="text" required="">
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom02"
                                                            class="col-xl-4 col-sm-4 mb-0">Upload Pan Image :</label>
                                                        <div class="col-xl-6 col-sm-7">
                                                            <input class="form-control" name="panimage"
                                                                type="file" required="">
                                                        </div>
                                                        <div class="col-md-2">
                                                            @if($user->panimage)
                                                                <img src="{{asset($user->panimage)}}" width="100">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-4 col-sm-4 mb-0">Aadhar / Driving licence /<br> Voter Card No. :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" name="aadhar"  value="{{ old('aadhar',$user->aadhar) }}" placeholder="Aadhar / Driving licence / Voter Card No." 
                                                                type="text" required="">
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom02"
                                                            class="col-xl-4 col-sm-4 mb-0">Aadhar / Driving licence /<br> Voter Card Front Image :</label>
                                                        <div class="col-xl-6 col-sm-7">
                                                            <input class="form-control" name="aadharimage"
                                                                type="file" required="">
                                                        </div>
                                                        <div class="col-md-2">
                                                            @if($user->aadharimage)
                                                                <img src="{{asset($user->aadharimage)}}" width="100">
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom02"
                                                            class="col-xl-4 col-sm-4 mb-0">Passbook image or <br> cancel cheque :</label>
                                                        <div class="col-xl-6 col-sm-7">
                                                            <input class="form-control" name="b_aadhar_img"
                                                                type="file" required="">
                                                        </div>
                                                        <div class="col-md-2">
                                                            @if($user->b_aadhar_img)
                                                                <img src="{{asset($user->b_aadhar_img)}}" width="100">
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
