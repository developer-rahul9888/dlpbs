<!-- Page Sidebar Start-->
@php $user = auth()->user(); @endphp
<div class="page-sidebar">
                <div class="main-header-left d-none d-lg-block">
                    <div class="logo-wrapper">
                        <a href="index.html">
                        <img src="{{asset('assets/images/logo_white.png')}}" style="width: 80px;">
                        </a>
                    </div>
                </div>
                <div class="sidebar custom-scrollbar">
                    <a href="javascript:void(0)" class="sidebar-back d-lg-none d-block"><i class="fa fa-times"
                            aria-hidden="true"></i></a>
                    <div class="sidebar-user">
                                @if(Auth::user()->image)
                                <img src="{{asset(Auth::user()->image)}}" alt="" class="img-60">
                                @else
                                <img src="{{asset('assets/images/avtar.png')}}" alt="" class="img-60">
                                @endif
                        <div>
                            <h6 class="f-14">{{auth()->user()->full_name}}</h6>
                            <p>@if($user->user_level==0)
                                    Deactive
                                @elseif($user->user_level==1)
                                    Basic
                                @elseif($user->user_level==2)
                                    Pro
                                @elseif($user->user_level==3)
                                    Master
                                @elseif($user->user_level==4)
                                    Super
                                @elseif($user->user_level==5)
                                    Super Fast
                                @elseif($user->user_level==6)
                                    Director
                                @endif
                            </p>
                        </div>
                    </div>
                    <ul class="sidebar-menu">
                        <li>
                            <a class="sidebar-header" href="{{url('/user')}}">
                                <i data-feather="home"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li>
                            <a class="sidebar-header" href="javascript:void(0)">
                                <i data-feather="dollar-sign"></i>
                                <span>Earnings</span>
                                <i class="fa fa-angle-right pull-right"></i>
                            </a>

                            <ul class="sidebar-submenu">
                                <li>
                                    <a href="{{url('user/direct-income')}}">
                                        <i class="fa fa-circle"></i>
                                        <span>Direct Income</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{url('user/level-income')}}">
                                        <i class="fa fa-circle"></i>
                                        <span>Level Income</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{url('user/binary-income')}}">
                                        <i class="fa fa-circle"></i>
                                        <span>Binary Income</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{url('user/basic-pool-income')}}">
                                        <i class="fa fa-circle"></i>
                                        <span>Basic Pool Income</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{url('user/pro-pool-income')}}">
                                        <i class="fa fa-circle"></i>
                                        <span>Pro Pool Income</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{url('user/master-pool-income')}}">
                                        <i class="fa fa-circle"></i>
                                        <span>Master Pool Income</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{url('user/super-pool-income')}}">
                                        <i class="fa fa-circle"></i>
                                        <span>Super Pool Income</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{url('user/super-fast-pool-income')}}">
                                        <i class="fa fa-circle"></i>
                                        <span>Super Fast Pool</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{url('user/director-pool-income')}}">
                                        <i class="fa fa-circle"></i>
                                        <span>Director Pool Income</span>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <li>
                            <a class="sidebar-header" href="javascript:void(0)">
                                <i data-feather="users"></i>
                                <span>Team</span>
                                <i class="fa fa-angle-right pull-right"></i>
                            </a>

                            <ul class="sidebar-submenu">
                                <li>
                                    <a href="{{url('user/direct')}}">
                                        <i class="fa fa-circle"></i>
                                        <span>Direct Team</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{url('user/level-team')}}">
                                        <i class="fa fa-circle"></i>
                                        <span>Team Level</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{url('user/team')}}">
                                        <i class="fa fa-circle"></i>
                                        <span>Downline All</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{url('user/treeview')}}">
                                        <i class="fa fa-circle"></i>
                                        <span>Binary Tree</span>
                                    </a>
                                </li>

                                <!-- <li>
                                    <a href="{{url('user/team-binary')}}">
                                        <i class="fa fa-circle"></i>
                                        <span>Binary List View</span>
                                    </a>
                                </li> -->
                            </ul>
                        </li>

                        <li>
                            <a class="sidebar-header" href="javascript:void(0)">
                                <i data-feather="box"></i>
                                <span>Fund</span>
                                <i class="fa fa-angle-right pull-right"></i>
                            </a>

                            <ul class="sidebar-submenu">
                                <li>
                                    <a href="{{url('user/activate-account')}}">
                                        <i class="fa fa-circle"></i>
                                        <span>Activate Account</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{url('user/activation')}}">
                                        <i class="fa fa-circle"></i>
                                        <span>Activation</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{url('user/load-fund')}}">
                                        <i class="fa fa-circle"></i>
                                        <span>Load Fund</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{url('user/transfer-fund')}}">
                                        <i class="fa fa-circle"></i>
                                        <span>Transfer Fund</span>
                                    </a>
                                </li>

                                <!-- <li>
                                    <a href="{{url('user/fund-request')}}">
                                        <i class="fa fa-circle"></i>
                                        <span>Fund Request</span>
                                    </a>
                                </li> -->

                                <li>
                                    <a href="{{url('user/fund-history')}}">
                                        <i class="fa fa-circle"></i>
                                        <span>Transactions</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a class="sidebar-header" href="javascript:void(0)">
                                <i data-feather="user-plus"></i>
                                <span>Account</span>
                                <i class="fa fa-angle-right pull-right"></i>
                            </a>

                            <ul class="sidebar-submenu">
                                <li>
                                    <a href="{{url('user/profile/edit')}}">
                                        <i class="fa fa-circle"></i>
                                        <span>Update Profile</span>
                                    </a>
                                </li>

                                <!-- <li>
                                    <a href="{{url('user/kyc/edit')}}">
                                        <i class="fa fa-circle"></i>
                                        <span>Update KYC</span>
                                    </a>
                                </li> -->

                                <li>
                                    <a href="{{url('user/bank/verify')}}">
                                        <i class="fa fa-circle"></i>
                                        <span>Verify Bank</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{url('user/password')}}">
                                        <i class="fa fa-circle"></i>
                                        <span>Update Password</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <li>
                            <a class="sidebar-header" href="{{url('user/redeem')}}">
                                <i data-feather="dollar-sign"></i>
                                <span>Redeem</span>
                            </a>
                        </li>

                        <li>
                            <a class="sidebar-header" href="{{url('/user/logout')}}">
                                <i data-feather="log-in"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Page Sidebar Ends-->


            <!-- Right sidebar Start-->
            <div class="right-sidebar" id="right_side_bar">
                <div>
                    <div class="container p-0">
                        <div class="modal-header p-l-20 p-r-20">
                            <div class="col-sm-8 p-0">
                                <h6 class="modal-title font-weight-bold">FRIEND LIST</h6>
                            </div>
                            <div class="col-sm-4 text-end p-0">
                                <i class="me-2" data-feather="settings"></i>
                            </div>
                        </div>
                    </div>
                    <div class="friend-list-search mt-0">
                        <input type="text" placeholder="search friend">
                        <i class="fa fa-search"></i>
                    </div>
                    <div class="p-l-30 p-r-30 friend-list-name">
                        <div class="chat-box">
                            <div class="people-list friend-list">
                                <ul class="list">
                                    <li class="clearfix">
                                        <img class="rounded-circle user-image blur-up lazyloaded"
                                            src="{{asset('admin/assets/images/dashboard/user.jpg')}}" alt="">
                                        <div class="status-circle online"></div>
                                        <div class="about">
                                            <div class="name">Vincent Porter</div>
                                            <div class="status">Online</div>
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <img class="rounded-circle user-image blur-up lazyloaded"
                                            src="{{asset('admin/assets/images/dashboard/user1.jpg')}}" alt="">
                                        <div class="status-circle away"></div>
                                        <div class="about">
                                            <div class="name">Ain Chavez</div>
                                            <div class="status">28 minutes ago</div>
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <img class="rounded-circle user-image blur-up lazyloaded"
                                            src="{{asset('admin/assets/images/dashboard/user2.jpg')}}" alt="">
                                        <div class="status-circle online"></div>
                                        <div class="about">
                                            <div class="name">Kori Thomas</div>
                                            <div class="status">Online</div>
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <img class="rounded-circle user-image blur-up lazyloaded"
                                            src="{{asset('admin/assets/images/dashboard/user3.jpg')}}" alt="">
                                        <div class="status-circle online"></div>
                                        <div class="about">
                                            <div class="name">Erica Hughes</div>
                                            <div class="status">Online</div>
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <img class="rounded-circle user-image blur-up lazyloaded"
                                            src="{{asset('admin/assets/images/dashboard/user3.jpg')}}" alt="">
                                        <div class="status-circle offline"></div>
                                        <div class="about">
                                            <div class="name">Ginger Johnston</div>
                                            <div class="status">2 minutes ago</div>
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <img class="rounded-circle user-image blur-up lazyloaded"
                                            src="{{asset('admin/assets/images/dashboard/user5.jpg')}}" alt="">
                                        <div class="status-circle away"></div>
                                        <div class="about">
                                            <div class="name">Prasanth Anand</div>
                                            <div class="status">2 hour ago</div>
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <img class="rounded-circle user-image blur-up lazyloaded"
                                            src="{{asset('admin/assets/images/dashboard/designer.jpg')}}" alt="">
                                        <div class="status-circle online"></div>
                                        <div class="about">
                                            <div class="name">Hileri Jecno</div>
                                            <div class="status">Online</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Right sidebar Ends-->