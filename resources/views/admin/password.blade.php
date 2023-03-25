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
                                    <h3>Update Password
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
                                    <li class="breadcrumb-item">Password</li>
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
                                                            class="col-xl-3 col-sm-4 mb-0">Current Password :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" name="current_password"  value="{{ old('current_password') }}"
                                                                type="password" required="">
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">New Password :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" name="password"  value="{{ old('password') }}"
                                                                type="password" required="">
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">Confirm New Password :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" name="password_confirmation"  value="{{ old('password_confirmation') }}"
                                                                type="password" required="">
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
