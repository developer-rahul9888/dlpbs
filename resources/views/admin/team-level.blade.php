@extends('admin.layouts.master')


@section('content-wrapper')

<div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                        <div class="col-lg-12">
                        <div class="col-lg-4 pull-right">
                                <div class="form-group mb-3 row">
                                                        <label for="validationCustom01" class="col-xl-3 col-sm-4 mb-0">Level :</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <select class="form-control" name="level" id="level" fdprocessedid="pike2g">
                                                                <option  @if(request()->segment(3) == '') selected="" @endif value="">All</option>
                                                                <option @if(request()->segment(3) == 1) selected="" @endif value="1">Level 1</option>
                                                                <option @if(request()->segment(3) == 2) selected="" @endif value="2">Level 2</option>
                                                                <option @if(request()->segment(3) == 3) selected="" @endif value="3">Level 3</option>
                                                                <option @if(request()->segment(3) == 4) selected="" @endif value="4">Level 4</option>
                                                                <option @if(request()->segment(3) == 5) selected="" @endif value="5">Level 5</option>
                                                                <option @if(request()->segment(3) == 6) selected="" @endif value="6">Level 6</option>
                                                                <option @if(request()->segment(3) == 7) selected="" @endif value="7">Level 7</option>
                                                                <option @if(request()->segment(3) == 8) selected="" @endif value="8">Level 8</option>
                                                                <option @if(request()->segment(3) == 9) selected="" @endif value="9">Level 9</option>
                                                                <option @if(request()->segment(3) == 10) selected="" @endif value="10">Level 10</option>
                                                            </select>
                                                            
                                                        </div>
                                                    </div>
                            </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>All Team
                                        <small>From {{request()->segment(3)}} level</small>
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
                                    <li class="breadcrumb-item">Team</li>
                                    <li class="breadcrumb-item active">All List</li>
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
                                        <th>Referral ID</th>
                                        <th>Placement</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($levelTeam as $key => $user)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$user->full_name}}</td>
                                        <td>{{$user->customer_id}}</td>
                                        <td>{{$user->direct_customer_id}}</td>
                                        <td>{{$user->placement}}</td>
                                        <td>{{($user->consume > 0)?'Green':'Red'}}</td>
                                        <td>{{date('Y-m-d',strtotime($user->created_at))}}</td>
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


<script>

    $('#level').change (function () {
        var level = $(this).val();
        window.location.href = "{{url('user/level-team')}}/" + level;
    });

</script>
@endsection