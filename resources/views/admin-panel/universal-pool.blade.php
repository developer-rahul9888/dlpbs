@extends('admin-panel.layouts.master')
@section('content-wrapper')
<div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>
                                    @if(request()->segment(3)==1)
                                        Basic
                                    @elseif(request()->segment(3)==2)
                                        Pro
                                    @elseif(request()->segment(3)==3)
                                        Master
                                    @elseif(request()->segment(3)==4)
                                        Super
                                    @elseif(request()->segment(3)==5)
                                        Super Fast
                                    @elseif(request()->segment(3)==6)
                                        Director
                                    @endif
                                    Pool</h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <ol class="breadcrumb pull-right">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">
                                            <i data-feather="home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">Universal</li>
                                    <li class="breadcrumb-item active">Pool</li>
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
                                        <th>Pool ID</th>
                                        <th>Name</th>
                                        <th>Customer ID</th>
                                        <th>Rebirth</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pool as $key => $value)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{($value->pool_id > 0)?$value->pool_id:$value->id}}</td>
                                        <td>{{$value->full_name}}</td>
                                        <td>{{$value->customer_id}}</td>
                                        <td>{{($value->pool_id > 0)?'Rebirth':'New'}}</td>
                                        <td>{{date('Y-m-d',strtotime($value->created_at))}}</td>
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