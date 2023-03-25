@extends('admin-panel.layouts.master')
@section('content-wrapper')
<div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Users</h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <ol class="breadcrumb pull-right">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">
                                            <i data-feather="home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">User</li>
                                    <li class="breadcrumb-item active">User List</li>
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
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Customer ID</th>
                                        <th>Referral ID</th>
                                        <th>Placement ID</th>
                                        <th>Placement</th>
                                        <th>Status</th>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $key => $user)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$user->full_name}}</td>
                                        <td>{{$user->email}} 
                                                <form style="display: unset;" action="{{url('hr80c4037/member-login')}}" method="POST" target="_blank">
                                                <input name="username" value="{{$user->customer_id}}" type="hidden">
                                                <button style="border: none;" type="submit"><i class="fa fa-sign-in font-success"></i></button>
                                                </form>
                                        </td>
                                        <td>{{$user->phone}}</td>
                                        <td>{{$user->customer_id}}</td>
                                        <td>{{$user->direct_customer_id}}</td>
                                        <td>{{$user->parent_customer_id}}</td>
                                        <td>{{$user->placement}}</td>
                                        <td>{{$user->status}}</td>
                                        <td>{{($user->consume > 0)?'Green':'Red'}}</td>
                                        <td>{{date('Y-m-d',strtotime($user->created_at))}}</td>
                                        <td>
                                            <div>
                                                <a href="{{url('hr80c4037/user/edit/'.$user->id)}}"><i class="fa fa-edit me-2 font-success"></i></a>
                                                <form style="display: unset;" action="{{url('hr80c4037/member-login')}}" method="POST" target="_blank">
                                                <input name="username" value="{{$user->customer_id}}" type="hidden">
                                                <button style="border: none;" type="submit"><i class="fa fa-sign-in font-success"></i></button>
                                                </form>
                                                <!-- <a href="{{url('hr80c4037/fund-request/del/'.$user->id)}}"><i class="fa fa-trash font-danger"></i></a> -->
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