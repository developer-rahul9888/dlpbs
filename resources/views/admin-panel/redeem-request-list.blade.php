@extends('admin-panel.layouts.master')
@section('content-wrapper')
<div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Redeem</div>
                                </div>
                            <div class="col-lg-6">
                                <ol class="breadcrumb pull-right">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">
                                            <i data-feather="home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">Redeem</li>
                                    <li class="breadcrumb-item active">List</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->

                <!-- Container-fluid starts-->
                <div class="container-fluid">
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
                    <div class="card">
                        <div class="card-body">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>Sr no</th>
                                        <th>Name</th>
                                        <th>Customer ID</th>
                                        <th>Amount</th>
                                        <th>Payble</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($requests as $key => $request)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$request->full_name}}</td>
                                        <td>{{$request->customer_id}}</td>
                                        <td>INR {{$request->redeem}}</td>
                                        <td>INR {{$request->after_tds}}</td>
                                        <td>{{$request->redeem_status}}</td>
                                        <td>{{date('Y-m-d',strtotime($request->created_at))}}</td>
                                        <td>
                                            <div>
                                                <a href="{{url('hr80c4037/redeem-request/edit/'.$request->id)}}"><i class="fa fa-edit me-2 font-success"></i></a>
                                                @if($request->redeem_status == 'Pending')
                                                <a class="btn btn-primary" href="{{url('hr80c4037/send-money/'.$request->id)}}">Pay</a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->
            </div>


@endsection

@section('styles')
<!-- Datatable css-->
<link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/datatables.css')}}">
@endsection

@section('scripts')
<!-- Datatables js-->
<script src="{{ asset('admin/assets/js/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/datatables/custom-basic.js') }}"></script>
@endsection