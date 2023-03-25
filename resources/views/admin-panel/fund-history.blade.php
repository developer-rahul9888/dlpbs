@extends('admin.layouts.master')


@section('content-wrapper')

<div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Fund Request History
                                        <small>Request history</small>
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
                        <div class="card-body vendor-table">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>Sr no</th>
                                        <th>Amount</th>
                                        <th>Send By</th>
                                        <th>Pay level</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex vendor-list">
                                                <img src="assets/images/team/2.jpg" alt=""
                                                    class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                                <span>Petey Cruiser</span>
                                            </div>
                                        </td>
                                        <td>1670</td>
                                        <td>Warephase</td>
                                        <td>8/10/18</td>
                                        <td>
                                            <div>
                                                <i class="fa fa-edit me-2 font-success"></i>
                                                <i class="fa fa-trash font-danger"></i>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex vendor-list">
                                                <img src="assets/images/dashboard/user5.jpg" alt=""
                                                    class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                                <span>Rowan torres</span>
                                            </div>
                                        </td>
                                        <td>790</td>
                                        <td>Sunnamplex</td>
                                        <td>5/6/18</td>
                                        <td>
                                            <div>
                                                <i class="fa fa-edit me-2 font-success"></i>
                                                <i class="fa fa-trash font-danger"></i>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex vendor-list">
                                                <img src="assets/images/dashboard/boy-2.png" alt=""
                                                    class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                                <span>Gray Brody</span>
                                            </div>
                                        </td>
                                        <td>579</td>
                                        <td>Conecom</td>
                                        <td>25/2/18</td>
                                        <td>
                                            <div>
                                                <i class="fa fa-edit me-2 font-success"></i>
                                                <i class="fa fa-trash font-danger"></i>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex vendor-list">
                                                <img src="assets/images/dashboard/user.jpg" alt=""
                                                    class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                                <span>Lane Skylar</span>
                                            </div>
                                        </td>
                                        <td>8972</td>
                                        <td>Golddex</td>
                                        <td>30/3/18</td>
                                        <td>
                                            <div>
                                                <i class="fa fa-edit me-2 font-success"></i>
                                                <i class="fa fa-trash font-danger"></i>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex vendor-list">
                                                <img src="assets/images/dashboard/designer.jpg" alt=""
                                                    class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                                <span>Colton Clay</span>
                                            </div>
                                        </td>
                                        <td>9710</td>
                                        <td>Green-Plus</td>
                                        <td>6/5/18</td>
                                        <td>
                                            <div>
                                                <i class="fa fa-edit me-2 font-success"></i>
                                                <i class="fa fa-trash font-danger"></i>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex vendor-list">
                                                <img src="assets/images/dashboard/user2.jpg" alt=""
                                                    class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                                <span>Woters maxine</span>
                                            </div>
                                        </td>
                                        <td>680</td>
                                        <td>Kan-code</td>
                                        <td>15/4/18</td>
                                        <td>
                                            <div>
                                                <i class="fa fa-edit me-2 font-success"></i>
                                                <i class="fa fa-trash font-danger"></i>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex vendor-list">
                                                <img src="assets/images/dashboard/user1.jpg" alt=""
                                                    class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                                <span>Lane Skylar</span>
                                            </div>
                                        </td>
                                        <td>8678</td>
                                        <td>Plexzap</td>
                                        <td>4/8/18</td>
                                        <td>
                                            <div>
                                                <i class="fa fa-edit me-2 font-success"></i>
                                                <i class="fa fa-trash font-danger"></i>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex vendor-list">
                                                <img src="assets/images/dashboard/user3.jpg" alt=""
                                                    class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                                <span>Perez Alonzo</span>
                                            </div>
                                        </td>
                                        <td>3476</td>
                                        <td>Betatech</td>
                                        <td>17/9/18</td>
                                        <td>
                                            <div>
                                                <i class="fa fa-edit me-2 font-success"></i>
                                                <i class="fa fa-trash font-danger"></i>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex vendor-list">
                                                <img src="assets/images/team/3.jpg" alt=""
                                                    class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                                <span>Anna Mull</span>
                                            </div>
                                        </td>
                                        <td>1670</td>
                                        <td>Zotware</td>
                                        <td>8/10/18</td>
                                        <td>
                                            <div>
                                                <i class="fa fa-edit me-2 font-success"></i>
                                                <i class="fa fa-trash font-danger"></i>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex vendor-list">
                                                <img src="assets/images/team/1.jpg" alt=""
                                                    class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                                <span>Paige Turner</span>
                                            </div>
                                        </td>
                                        <td>4680</td>
                                        <td>Finhigh</td>
                                        <td>11/7/18</td>
                                        <td>
                                            <div>
                                                <i class="fa fa-edit me-2 font-success"></i>
                                                <i class="fa fa-trash font-danger"></i>
                                            </div>
                                        </td>
                                    </tr>

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