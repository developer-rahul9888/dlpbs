@extends('admin-panel.layouts.master')
@section('content-wrapper')
<div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Fund Request</div>
                                </div>
                            <div class="col-lg-6">
                                <ol class="breadcrumb pull-right">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">
                                            <i data-feather="home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">Fund</li>
                                    <li class="breadcrumb-item active">Request List</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->

                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>Sr no</th>
                                        <th>Name</th>
                                        <th>Customer ID</th>
                                        <th>Amount</th>
                                        <th>Phone</th>
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
                                        <td>INR {{$request->amount}}</td>
                                        <td>{{$request->phone}}</td>
                                        <td>{{$request->status}}</td>
                                        <td>{{date('Y-m-d',strtotime($request->created_at))}}</td>
                                        <td>
                                            <div>
                                                <a href="{{url('hr80c4037/fund-request/edit/'.$request->id)}}"><i class="fa fa-edit me-2 font-success"></i></a>
                                                <!-- <a href="{{url('hr80c4037/fund-request/del/'.$request->id)}}"><i class="fa fa-trash font-danger"></i></a> -->
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