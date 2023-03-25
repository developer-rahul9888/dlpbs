@extends('admin-panel.layouts.master')
@section('content-wrapper')
<div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Payouts</h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <ol class="breadcrumb pull-right">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">
                                            <i data-feather="home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">Payouts</li>
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
                            <div class="card-header">
                                <form action="" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary mt-md-0 mt-2">Payout now</button>
                                </form>
                            </div>
                        <div class="card-body">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>Sr no</th>
                                        <th>Name</th>
                                        <th>Customer ID</th>
                                        <th>Amount</th>
                                        <th>Bank Name</th>
                                        <th>Account No.</th>
                                        <th>IFSC</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($payouts as $key => $payout)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$payout->full_name}}</td>
                                        <td>{{$payout->customer_id}}</td>
                                        <td>$ {{$payout->amount}}</td>
                                        <td>{{$payout->bank_name}}</td>
                                        <td>{{$payout->account_no}}</td>
                                        <td>{{$payout->ifsc}}</td>
                                        <td>{{date('Y-m-d',strtotime($payout->created_at))}}</td>
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