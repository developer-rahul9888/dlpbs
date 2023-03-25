@extends('admin.layouts.master')


@section('content-wrapper')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>{{str_replace('-',' ',request()->segment(2))}}
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
                        <li class="breadcrumb-item active">Income List</li>
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
                <div class="main-container">
                    <div class=" gutter">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="panel panel-light">
                                <div class="panel-heading">

                                    <div class="panel-body">
                                        <div class="demo-btn-group center-text">

                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                            <tbody>
                                                <tr>
                                                    <td class="dtlboxbg tdmargin" valign="top" height="400"
                                                        align="center">
                                                        <table class="content" width="100%" cellspacing="0"
                                                            cellpadding="0" border="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td valign="top" align="center">
                                                                        <table width="100%" cellspacing="0"
                                                                            cellpadding="0" border="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="left"></td>
                                                                                    <td align="center">
                                                                                        Tree View For DISTRIBUTOR ID -
                                                                                        {{$user->customer_id}}<br>
                                                                                        <p><strong></strong></p>
                                                                                    </td>
                                                                                    <td>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td valign="top" align="center">&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <table width="100%" cellspacing="0"
                                                                            cellpadding="0" border="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td colspan="8" width="100%"
                                                                                        align="center">
                                                                                        <div class="table">
                                                                                            <div class="row alt">
                                                                                                <div class="ops">
                                                                                                    <ul>
                                                                                                        <li
                                                                                                            align="center">
                                                                                                            @if($user->user_level > 1)
                                                                                                            <img src="{{asset('assets/images/green.png')}}"
                                                                                                                width="65" border="0">
                                                                                                            @else
                                                                                                            <img src="{{asset('assets/images/red.png')}}"
                                                                                                                width="65" border="0">
                                                                                                            @endif
                                                                                                        </li>

                                                                                                        <table
                                                                                                            style="bottom: 30px;">
                                                                                                            <tbody>
                                                                                                                <tr>
                                                                                                                    <td colspan="4" align="center">
                                                                                                                        <a
                                                                                                                            href="{{url('user/treeview/'.$user->customer_id)}}"><strong>{{$user->full_name}}
                                                                                                                                <br> {{$user->customer_id}}</strong></a>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </ul>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!-- <button type="button"
                                                                                            class="btn btn-info btn-sm bbh-btn"
                                                                                            data-id="XL51069537"
                                                                                            data-toggle="modal"
                                                                                            data-target="#myModal">View</button> -->
                                                                                        </font>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="8" align="center"><img
                                                                                            class="width-img70"
                                                                                            src="{{asset('assets/images/l1.png')}}"
                                                                                            width="590" height="85">
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="4" width="50%"
                                                                                        align="center" valign="top">
                                                                                        @if($user_1)
                                                                                        @if($user_1->user_level > 1)
                                                                                        <img src="{{asset('assets/images/green.png')}}"
                                                                                            width="65" border="0">
                                                                                        @else
                                                                                        <img src="{{asset('assets/images/red.png')}}"
                                                                                            width="65" border="0">
                                                                                        @endif
                                                                                            <table style="bottom: 30px;">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td colspan="4"
                                                                                                            align="center">
                                                                                                            <a href="{{url('user/treeview/'.$user_1->customer_id)}}"><strong>{{$user_1->full_name}} 
                                                                                                            <br> {{$user_1->customer_id}}</strong></a>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        @else 
                                                                                        <img src="{{asset('assets/images/red.png')}}"
                                                                                            width="65" border="0">
                                                                                        @endif
                                                                                    </td>
                                                                                    <td colspan="4" width="50%"
                                                                                        align="center" valign="top">
                                                                                        @if($user_2)
                                                                                        @if($user_2->user_level > 1)
                                                                                        <img src="{{asset('assets/images/green.png')}}"
                                                                                            width="65" border="0">
                                                                                        @else
                                                                                        <img src="{{asset('assets/images/red.png')}}"
                                                                                            width="65" border="0">
                                                                                        @endif
                                                                                            <table style="bottom: 30px;">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td colspan="4"
                                                                                                            align="center">
                                                                                                            <a href="{{url('user/treeview/'.$user_2->customer_id)}}"><strong>{{$user_2->full_name}} 
                                                                                                            <br> {{$user_2->customer_id}}</strong></a>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        @else 
                                                                                        <img src="{{asset('assets/images/red.png')}}"
                                                                                            width="65" border="0">
                                                                                        @endif
                                                                                    </td>

                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="4" width="50%"
                                                                                        align="center"><img
                                                                                            class="img-width"
                                                                                            src="{{asset('assets/images/l2.png')}}"
                                                                                            width="297" height="60">
                                                                                    </td>
                                                                                    <td colspan="4" width="50%"
                                                                                        align="center"><img
                                                                                            class="img-width"
                                                                                            src="{{asset('assets/images/l2.png')}}"
                                                                                            width="297" height="60">
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="2" width="25%"
                                                                                        align="center" valign="top">
                                                                                        @if($user_3)
                                                                                        @if($user_3->user_level > 1) 
                                                                                        <img src="{{asset('assets/images/green.png')}}"
                                                                                            width="65" border="0">
                                                                                        @else
                                                                                        <img src="{{asset('assets/images/red.png')}}"
                                                                                            width="65" border="0">
                                                                                        @endif
                                                                                            <table style="bottom: 30px;">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td colspan="4"
                                                                                                            align="center">
                                                                                                            <a href="{{url('user/treeview/'.$user_3->customer_id)}}"><strong>{{$user_3->full_name}} 
                                                                                                            <br> {{$user_3->customer_id}}</strong></a>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        @else 
                                                                                        <img src="{{asset('assets/images/red.png')}}"
                                                                                            width="65" border="0">
                                                                                        @endif
                                                                                    </td>

                                                                                    <td colspan="2" width="25%"
                                                                                        align="center" valign="top">
                                                                                        @if($user_4)
                                                                                        @if($user_4->user_level > 1) 
                                                                                        <img src="{{asset('assets/images/green.png')}}"
                                                                                            width="65" border="0">
                                                                                        @else
                                                                                        <img src="{{asset('assets/images/red.png')}}"
                                                                                            width="65" border="0">
                                                                                        @endif
                                                                                            <table style="bottom: 30px;">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td colspan="4"
                                                                                                            align="center">
                                                                                                            <a href="{{url('user/treeview/'.$user_4->customer_id)}}"><strong>{{$user_4->full_name}} 
                                                                                                            <br> {{$user_4->customer_id}}</strong></a>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        @else 
                                                                                        <img src="{{asset('assets/images/red.png')}}"
                                                                                            width="65" border="0">
                                                                                        @endif
                                                                                    </td>

                                                                                    <td colspan="2" width="25%"
                                                                                        align="center" valign="top">
                                                                                        @if($user_5)
                                                                                        @if($user_5->user_level > 1) 
                                                                                        <img src="{{asset('assets/images/green.png')}}"
                                                                                            width="65" border="0">
                                                                                        @else
                                                                                        <img src="{{asset('assets/images/red.png')}}"
                                                                                            width="65" border="0">
                                                                                        @endif
                                                                                            <table style="bottom: 30px;">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td colspan="4"
                                                                                                            align="center">
                                                                                                            <a href="{{url('user/treeview/'.$user_5->customer_id)}}"><strong>{{$user_5->full_name}} 
                                                                                                            <br> {{$user_5->customer_id}}</strong></a>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        @else 
                                                                                        <img src="{{asset('assets/images/red.png')}}"
                                                                                            width="65" border="0">
                                                                                        @endif
                                                                                    </td>

                                                                                    <td colspan="2" width="25%"
                                                                                        align="center" valign="top">
                                                                                        @if($user_6)
                                                                                        @if($user_6->user_level > 1) 
                                                                                        <img src="{{asset('assets/images/green.png')}}"
                                                                                            width="65" border="0">
                                                                                        @else
                                                                                        <img src="{{asset('assets/images/red.png')}}"
                                                                                            width="65" border="0">
                                                                                        @endif
                                                                                            <table style="bottom: 30px;">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td colspan="4"
                                                                                                            align="center">
                                                                                                            <a href="{{url('user/treeview/'.$user_6->customer_id)}}"><strong>{{$user_6->full_name}} 
                                                                                                            <br> {{$user_6->customer_id}}</strong></a>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        @else 
                                                                                        <img src="{{asset('assets/images/red.png')}}"
                                                                                            width="65" border="0">
                                                                                        @endif
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="2" width="25%"
                                                                                        align="center"><img
                                                                                            src="{{asset('assets/images/l2.png')}}"
                                                                                            width="145" height="35">
                                                                                    </td>
                                                                                    <td colspan="2" width="25%"
                                                                                        align="center"><img
                                                                                            src="{{asset('assets/images/l2.png')}}"
                                                                                            width="145" height="35">
                                                                                    </td>
                                                                                    <td colspan="2" width="25%"
                                                                                        align="center"><img
                                                                                            src="{{asset('assets/images/l2.png')}}"
                                                                                            width="145" height="35">
                                                                                    </td>
                                                                                    <td colspan="2" width="25%"
                                                                                        align="center"><img
                                                                                            src="{{asset('assets/images/l2.png')}}"
                                                                                            width="145" height="35">
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td width="12.5%" align="center"
                                                                                        valign="top">
                                                                                        @if($user_7)
                                                                                        @if($user_7->user_level > 1) 
                                                                                        <img src="{{asset('assets/images/green.png')}}"
                                                                                            width="65" border="0">
                                                                                        @else
                                                                                        <img src="{{asset('assets/images/red.png')}}"
                                                                                            width="65" border="0">
                                                                                        @endif
                                                                                            <table style="bottom: 30px;">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td colspan="4"
                                                                                                            align="center">
                                                                                                            <a href="{{url('user/treeview/'.$user_7->customer_id)}}"><strong>{{$user_7->full_name}} 
                                                                                                            <br> {{$user_7->customer_id}}</strong></a>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        @else 
                                                                                        <img src="{{asset('assets/images/red.png')}}"
                                                                                            width="65" border="0">
                                                                                        @endif
                                                                                    </td>

                                                                                    <td width="12.5%" align="center"
                                                                                        valign="top">
                                                                                        @if($user_8)
                                                                                        @if($user_8->user_level > 1) 
                                                                                        <img src="{{asset('assets/images/green.png')}}"
                                                                                            width="65" border="0">
                                                                                        @else
                                                                                        <img src="{{asset('assets/images/red.png')}}"
                                                                                            width="65" border="0">
                                                                                        @endif
                                                                                            <table style="bottom: 30px;">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td colspan="4"
                                                                                                            align="center">
                                                                                                            <a href="{{url('user/treeview/'.$user_8->customer_id)}}"><strong>{{$user_8->full_name}} 
                                                                                                            <br> {{$user_8->customer_id}}</strong></a>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        @else 
                                                                                        <img src="{{asset('assets/images/red.png')}}"
                                                                                            width="65" border="0">
                                                                                        @endif
                                                                                    </td>

                                                                                    <td width="12.5%" align="center"
                                                                                        valign="top">
                                                                                        @if($user_9)
                                                                                        @if($user_9->user_level > 1) 
                                                                                        <img src="{{asset('assets/images/green.png')}}"
                                                                                            width="65" border="0">
                                                                                        @else
                                                                                        <img src="{{asset('assets/images/red.png')}}"
                                                                                            width="65" border="0">
                                                                                        @endif
                                                                                            <table style="bottom: 30px;">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td colspan="4"
                                                                                                            align="center">
                                                                                                            <a href="{{url('user/treeview/'.$user_9->customer_id)}}"><strong>{{$user_9->full_name}} 
                                                                                                            <br> {{$user_9->customer_id}}</strong></a>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        @else 
                                                                                        <img src="{{asset('assets/images/red.png')}}"
                                                                                            width="65" border="0">
                                                                                        @endif
                                                                                    </td>

                                                                                    <td width="12.5%" align="center"
                                                                                        valign="top">
                                                                                        @if($user_10)
                                                                                        @if($user_10->user_level > 1) 
                                                                                        <img src="{{asset('assets/images/green.png')}}"
                                                                                            width="65" border="0">
                                                                                        @else
                                                                                        <img src="{{asset('assets/images/red.png')}}"
                                                                                            width="65" border="0">
                                                                                        @endif
                                                                                            <table style="bottom: 30px;">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td colspan="4"
                                                                                                            align="center">
                                                                                                            <a href="{{url('user/treeview/'.$user_10->customer_id)}}"><strong>{{$user_10->full_name}} 
                                                                                                            <br> {{$user_10->customer_id}}</strong></a>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        @else 
                                                                                        <img src="{{asset('assets/images/red.png')}}"
                                                                                            width="65" border="0">
                                                                                        @endif
                                                                                    </td>

                                                                                    <td width="12.5%" align="center"
                                                                                        valign="top">
                                                                                        @if($user_11)
                                                                                        @if($user_11->user_level > 1) 
                                                                                        <img src="{{asset('assets/images/green.png')}}"
                                                                                            width="65" border="0">
                                                                                        @else
                                                                                        <img src="{{asset('assets/images/red.png')}}"
                                                                                            width="65" border="0">
                                                                                        @endif
                                                                                            <table style="bottom: 30px;">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td colspan="4"
                                                                                                            align="center">
                                                                                                            <a href="{{url('user/treeview/'.$user_11->customer_id)}}"><strong>{{$user_11->full_name}} 
                                                                                                            <br> {{$user_11->customer_id}}</strong></a>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        @else 
                                                                                        <img src="{{asset('assets/images/red.png')}}"
                                                                                            width="65" border="0">
                                                                                        @endif
                                                                                    </td>

                                                                                    <td width="12.5%" align="center"
                                                                                        valign="top">
                                                                                        @if($user_12)
                                                                                        @if($user_12->user_level > 1) 
                                                                                        <img src="{{asset('assets/images/green.png')}}"
                                                                                            width="65" border="0">
                                                                                        @else
                                                                                        <img src="{{asset('assets/images/red.png')}}"
                                                                                            width="65" border="0">
                                                                                        @endif
                                                                                            <table style="bottom: 30px;">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td colspan="4"
                                                                                                            align="center">
                                                                                                            <a href="{{url('user/treeview/'.$user_12->customer_id)}}"><strong>{{$user_12->full_name}} 
                                                                                                            <br> {{$user_12->customer_id}}</strong></a>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        @else 
                                                                                        <img src="{{asset('assets/images/red.png')}}"
                                                                                            width="65" border="0">
                                                                                        @endif
                                                                                    </td>

                                                                                    <td width="12.5%" align="center"
                                                                                        valign="top">
                                                                                        @if($user_13)
                                                                                        @if($user_13->user_level > 1) 
                                                                                        <img src="{{asset('assets/images/green.png')}}"
                                                                                            width="65" border="0">
                                                                                        @else
                                                                                        <img src="{{asset('assets/images/red.png')}}"
                                                                                            width="65" border="0">
                                                                                        @endif
                                                                                            <table style="bottom: 30px;">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td colspan="4"
                                                                                                            align="center">
                                                                                                            <a href="{{url('user/treeview/'.$user_13->customer_id)}}"><strong>{{$user_13->full_name}} 
                                                                                                            <br> {{$user_13->customer_id}}</strong></a>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        @else 
                                                                                        <img src="{{asset('assets/images/red.png')}}"
                                                                                            width="65" border="0">
                                                                                        @endif
                                                                                    </td>

                                                                                    <td width="12.5%" align="center"
                                                                                        valign="top">
                                                                                        @if($user_14)
                                                                                        @if($user_14->user_level > 1) 
                                                                                        <img src="{{asset('assets/images/green.png')}}"
                                                                                            width="65" border="0">
                                                                                        @else
                                                                                        <img src="{{asset('assets/images/red.png')}}"
                                                                                            width="65" border="0">
                                                                                        @endif
                                                                                            <table style="bottom: 30px;">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td colspan="4"
                                                                                                            align="center">
                                                                                                            <a href="{{url('user/treeview/'.$user_14->customer_id)}}"><strong>{{$user_14->full_name}} 
                                                                                                            <br> {{$user_14->customer_id}}</strong></a>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        @else 
                                                                                        <img src="{{asset('assets/images/red.png')}}"
                                                                                            width="65" border="0">
                                                                                        @endif
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->
</div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="position: relative;z-index: 99999;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="bbh-ajax-info"></div>

            </div>
        </div>
    </div>
</div>

@endsection