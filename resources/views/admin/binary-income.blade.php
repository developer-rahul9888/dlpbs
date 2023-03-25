@extends('admin.layouts.master')





@section('content-wrapper')

@php 

$poolId = 2;

$url = request()->segment(2);

if($url == 'pro-pool-income') {
    $poolId = 2;
} 
elseif($url == 'master-binary-income') {
    $poolId = 3;
}
elseif($url == 'super-binary-income') {
    $poolId = 4;
}
elseif($url == 'super-fast-binary-income') {
    $poolId = 5;
}
elseif($url == 'director-binary-income') {
    $poolId = 6;
}




@endphp

<div class="page-body">

                <!-- Container-fluid starts-->

                <div class="container-fluid">

                    <div class="page-header">

                        <div class="row">

                            <div class="col-lg-6">

                                <div class="page-header-left">

                                    <h3>{{str_replace('-',' ',request()->segment(2))}}

                                        <small>From 10 level</small>

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

                                    <li class="breadcrumb-item">Income</li>

                                    <li class="breadcrumb-item active">Binary Income List</li>

                                </ol>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Container-fluid Ends-->



                <!-- Container-fluid starts-->

                <div class="container-fluid">

                    <div class="card">
                        <div class="card-header">
                            <a href="{{url('user/pool/'.$url)}}" class="btn btn-primary mt-md-0 mt-2">Tree View</a>
                        </div>
                        <div class="card-body">

                            <table class="display" id="basic-1">

                                <thead>

                                    <tr>

                                        <th>Sr no</th>

                                        <th>Amount</th>

                                        <th>Type</th>

                                        <th>Date</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach($incomes as $key => $income)

                                    <tr>

                                        <td>{{$key+1}}</td>

                                        <td>INR {{$income->amount}}</td>

                                        <td>{{$income->type}}</td>

                                        <td>{{date('Y-m-d',strtotime($income->created_at))}}</td>

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