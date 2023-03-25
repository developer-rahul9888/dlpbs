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
                                    <h3>Brainsecret
                                        <small>Create Account</small>
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
                                    <li class="breadcrumb-item">Account</li>
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
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">Name :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" name="name" @if($brainsecret) readonly @endif value="{{ old('name',($brainsecret)?$brainsecret->name:'') }}"
                                                                type="text" required="">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">Phone :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" name="phone" @if($brainsecret) readonly @endif value="{{ old('phone',($brainsecret)?$brainsecret->phone:'') }}"
                                                                type="text" required="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">Email :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" name="email" @if($brainsecret) readonly @endif value="{{ old('email',($brainsecret)?$brainsecret->email:'') }}"
                                                                type="text" required="">
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3 row">
                                                        <label for="validationCustom01"
                                                            class="col-xl-3 col-sm-4 mb-0">Password :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input class="form-control" name="password" @if($brainsecret) readonly @endif value="{{ old('password',($brainsecret)?$brainsecret->password:'') }}"
                                                                type="text" required="">
                                                        </div>
                                                    </div>
                                                    
                                                </div>

                                                @if(!$brainsecret)
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
