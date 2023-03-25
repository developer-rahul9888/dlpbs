@extends('admin-panel.layouts.master')
@section('content-wrapper')
<div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Bank Details</div>
                                </div>
                            <div class="col-lg-6">
                                <ol class="breadcrumb pull-right">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">
                                            <i data-feather="home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">Bank</li>
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
                                        <th>Account Number</th>
                                        <th>Account Name</th>
                                        <th>IFSC</th>
                                        <th>Mobile</th>
                                        <th>Pan</th>
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
                                        <td>{{$request->account_no}}</td>
                                        <td>{{$request->account_name}}</td>
                                        <td>{{$request->ifsc}}</td>
                                        <td>{{$request->mobile}}</td>
                                        <td>{{$request->pan}}</td>
                                        <td>{{date('Y-m-d',strtotime($request->created_at))}}</td>
                                        <td>
                                            <div>
                                                <a href="{{url('hr80c4037/bank-detail/del/'.$request->id)}}"><i class="fa fa-trash me-2 font-success"></i></a>
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