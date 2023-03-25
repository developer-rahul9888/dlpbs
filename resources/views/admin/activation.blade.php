@extends('admin.layouts.master')
@section('content-wrapper')


            <div class="page-body">

                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xxl-4 col-md-6 xl-50">
                            <a href="{{url('user/activate-account')}}">
                                <div class="card o-hidden widget-cards">
                                    <div class="warning-box card-body">
                                        <div class="media static-top-widget align-items-center">
                                            <div class="icons-widgets">
                                                <div class="align-self-center text-center">
                                                    <i data-feather="navigation" class="font-warning"></i>
                                                </div>
                                            </div>
                                            <div class="media-body media-doller">
                                                <h3 class="mb-0">Activate Account
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xxl-4 col-md-6 xl-50">
                            <a href="{{url('user/activate-pool')}}">
                                <div class="card o-hidden widget-cards">
                                    <div class="secondary-box card-body">
                                        <div class="media static-top-widget align-items-center">
                                            <div class="icons-widgets">
                                                <div class="align-self-center text-center">
                                                    <i data-feather="box" class="font-secondary"></i>
                                                </div>
                                            </div>
                                            <div class="media-body media-doller">
                                                <h3 class="mb-0">Upgrade Pool</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        

                        
                        <div class="col-xxl-4 col-md-6 xl-50">
                            <a href="{{url('user/activate-user')}}">
                                <div class="card o-hidden widget-cards">
                                    <div class="danger-box card-body">
                                        <div class="media static-top-widget align-items-center">
                                            <div class="icons-widgets">
                                                <div class="align-self-center text-center"><i data-feather="users"
                                                        class="font-danger"></i></div>
                                            </div>
                                            <div class="media-body media-doller"><h3 class="m-0">Activate User</h3>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->
            </div>
@endsection