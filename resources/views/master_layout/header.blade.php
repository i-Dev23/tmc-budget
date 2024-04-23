<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="TekawebMedia">
    <!-- <link rel="icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon"> -->
    <!-- <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon"> -->
    <title>Budget Monitoring | PT. Tritunggal Multi Cemerlang</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/fontawesome.css')}}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/icofont.css')}}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/themify.css')}}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/flag-icon.css')}}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/feather-icon.css')}}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/chartist.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/date-picker.css')}}">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/slick-loader@1.1.20/slick-loader.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.css')}}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <link id="color" rel="stylesheet" href="{{asset('assets/css/color-1.css')}}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/responsive.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/daterange-picker.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">

    <style type="text/css">
        .left{
            float: left !important;
        }

        .right{
            float: right !important;
        }

        .padd-bottom-0{
            padding-bottom: 0 !important;
        }

        .margin-bot-5{
            margin-bottom: 5px !important;
        }
        .myTable th{
            /* text-align: center !important; */
        }

        .parent-active{
            background-image: linear-gradient(90deg, #0065cd 0%, #1599d1 100%); 
            color: #ffffff !important;
        }

        .parent-active i{
            color: #ffffff !important;
        }

        .padd-0{
            padding: 0 !important;
        }

        .required{
            color: #f00;
        }

        .my-btn{
            font-size: 15px;
            padding: 5px 10px;
            color: #ffffff !important;
            border-radius: .25rem;
        }

        .my-stsbtn{
            font-size: 15px;
            padding: 0;
            color: #ffffff !important;
            border-radius: .25rem;
            text-align: center !important;
        }

        .text-center{
            text-align: center !important;
        }
        
        .status-0{
            background-color: #f00;
            text-align: center;
            color: #ffffff;
            border-radius: 25px;
            width: 125px;
            margin: 0 auto;
        }
        
        .status-1{
            background-color: #ff7f12;
            text-align: center;
            color: #ffffff;
            border-radius: 25px;
            width: 125px;
            margin: 0 auto;
        }

        .status-2{
            background-color: #1c7000;
            text-align: center;
            color: #ffffff;
            border-radius: 25px;
            width: 125px;
            margin: 0 auto;
        }

        .status-3{
            background-color: #968700;
            text-align: center;
            color: #ffffff;
            border-radius: 25px;
            width: 125px;
            margin: 0 auto;
        }

        .capitalize{
            text-transform: capitalize;
        }

        .dysply{
            display: flex;
            flex-wrap: nowrap;  
        }

        .pulse {
            width: 100%;
            /* height: 100%; */
            animation: pulse 1.1s infinite;
            
        }

        @keyframes pulse {
            0% {
                color: #ffffff;
                background-color: #f00;
            }
            50%{
                opacity: 0;
            }
            100% {
                color: #ffffff;
                background-color: #f00;
            }
        }

        /* @media screen and (max-width: 1000px){
            width: 100%;
        } */
    </style>
</head>


<body>
    @include('sweetalert::alert')
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
    
    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="loader-index"><span></span></div>
        <svg>
            <defs></defs>
            <filter id="goo">
                <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
                <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo">    </fecolormatrix>
            </filter>
        </svg>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <div class="page-main-header">
            <div class="main-header-right row m-0">
                <div class="main-header-left">
                    <div class="logo-wrapper"><a href="index.html"><img class="img-fluid" src="{{asset('assets/images/logo/small-logo-tmc.png')}}" alt=""></a></div>
                </div>
                <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="grid" id="sidebar-toggle"></i></div>
                <!-- <div class="left-menu-header col">
                    <ul>
                        <li>
                            <form class="form-inline search-form">
                                <div class="search-bg"><i class="fa fa-search"></i></div>
                                <input class="form-control-plaintext" placeholder="Search here.....">
                            </form><span class="d-sm-none mobile-search search-bg"><i class="fa fa-search"></i></span>
                        </li>
                    </ul>
                </div> -->
    
                <div class="nav-right col pull-right right-menu">
                    <ul class="nav-menus">
                        @if (Auth::user()->role == '1')
                        {{-- kadiv --}}
                            @php
                                $idDiv = Auth::user()->id_divisi;
                                $getCount = DB::select("SELECT count(*) total from message m where id_divisi  = '$idDiv' and read_status = '1' and status_approve = '1'");
                                $getNotif = DB::select("SELECT * from message m where id_divisi  = '$idDiv' and read_status = '1' and status_approve = '1'");
                            @endphp
                            <li class="onhover-dropdown" >
                                <div class="notification-box"><i data-feather="bell"></i><span class="badge badge-pill badge-secondary">{{$getCount[0]->total}}</span></div>
                                <ul class="notification-dropdown onhover-show-div" >
                                    <li>
                                        <p class="f-w-600 font-roboto" id="read_all_notif">Read all <i class="fa fa-arrow-right" style="color: #65a8dc;"></i></p>
                                        <input type="hidden" id="type_approve_notif" value="kadiv">
                                    </li>
                                    
                                    @if (count($getNotif) > 0)
                                    <input type="hidden" id="id_divisi_notif" value="{{$getNotif[0]->id_divisi}}">
                                    <div class="scroll-d" style="overflow-y: scroll;height:80vh; width:100%;">
                                        @foreach ($getNotif as $notif)
                                            <li>
                                                <p class="mb-0" ><i class="fa fa-circle-o mr-3 font-primary"> </i>
                                                    
                                                    {{$notif->message}} 
                                                    {{-- <span class="pull-right">10 min.</span> --}}
                                                </p>
                                            </li>
                                        @endforeach
                                    </div>
                                    @endif
                                    {{-- <li>
                                        <p class="mb-0"><i class="fa fa-circle-o mr-3 font-success"></i>Order Complete<span class="pull-right">1 hr</span></p>
                                    </li>
                                    <li>
                                        <p class="mb-0"><i class="fa fa-circle-o mr-3 font-info"></i>Tickets Generated<span class="pull-right">3 hr</span></p>
                                    </li>
                                    <li>
                                        <p class="mb-0"><i class="fa fa-circle-o mr-3 font-warning"></i>Delivery Complete<span class="pull-right">6 hr</span></p>
                                    </li> --}}
                                </ul> 
                            </li>
                        @elseif (Auth::user()->role == '2')
                            @php
                            $idDiv = Auth::user()->id_divisi;
                            $getCount = DB::select("SELECT count(*) total from message m where read_status = '1' and status_approve = '2'");
                            $getNotif = DB::select("SELECT * from message m where read_status = '1' and status_approve = '2'");
                            @endphp
                            <li class="onhover-dropdown">
                                <div class="notification-box"><i data-feather="bell"></i><span class="badge badge-pill badge-secondary">{{$getCount[0]->total}}</span></div>
                                <ul class="notification-dropdown onhover-show-div">
                                    <li>
                                        <p class="f-w-600 font-roboto" id="read_all_notif">Read all <i class="fa fa-arrow-right" style="color: #65a8dc;"></i></p>
                                        <input type="hidden" id="type_approve_notif" value="admin">
                                    </li>
                                    @if (count($getNotif) > 0)
                                    <input type="hidden" id="id_divisi_notif" value="{{$getNotif[0]->id_divisi}}">
                                    <div class="scroll-d" style="overflow-y: scroll;height:80vh; width:100%;">
                                        @foreach ($getNotif as $notif)
                                            <li>
                                                <p class="mb-0"><i class="fa fa-circle-o mr-3 font-primary"> </i>{{$notif->message}} 
                                                    {{-- <span class="pull-right">10 min.</span> --}}
                                                </p>
                                            </li>
                                        @endforeach
                                    </div>
                                    @endif
                                </ul> 
                            </li>
                        @else
                            @php
                            $idDiv = Auth::user()->id;
                            $getCount = DB::select("SELECT count(*) total from message m where id_auth = '$idDiv' and read_status = '1' and status_approve = '3'");
                            $getNotif = DB::select("SELECT * from message m where id_auth = '$idDiv' and read_status = '1' and status_approve = '3'");
                            @endphp
                            <li class="onhover-dropdown">
                                <div class="notification-box"><i data-feather="bell"></i><span class="badge badge-pill badge-secondary">{{$getCount[0]->total}}</span></div>
                                <ul class="notification-dropdown onhover-show-div">
                                    <li>
                                        <p class="f-w-600 font-roboto" id="read_all_notif">Read all <i class="fa fa-arrow-right" style="color: #65a8dc;"></i></p>
                                        <input type="hidden" id="type_approve_notif" value="user">
                                    </li>
                                    @if (count($getNotif) > 0)
                                    <input type="hidden" id="id_divisi_notif" value="{{$getNotif[0]->id_divisi}}">
                                    <div class="scroll-d" style="overflow-y: scroll;height:80vh; width:100%;">
                                        @foreach ($getNotif as $notif)
                                            <li>
                                                <p class="mb-0"><i class="fa fa-circle-o mr-3 font-primary"> </i>{{$notif->message}} 
                                                    {{-- <span class="pull-right">10 min.</span> --}}
                                                </p>
                                            </li>
                                        @endforeach
                                    </div>
                                    @endif
                                </ul> 
                            </li>
                        @endif
                        {{-- <li class="onhover-dropdown"><i data-feather="message-square"></i>
                             <ul class="chat-dropdown onhover-show-div p-t-15 p-b-15">
                                <li>
                                    <div class="media"><img class="img-fluid rounded-circle mr-3" src="{{asset('assets/images/user/1.jpg')}}" alt="">
                                        <div class="status-circle away"></div>
                                        <div class="media-body"><span>Erica Hughes</span>
                                            <p class="f-12 light-font">Lorem Ipsum is simply dummy...</p>
                                        </div>
                                        <p class="f-12 font-warning">58 mins ago</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="media"><img class="img-fluid rounded-circle mr-3" src="{{asset('assets/images/user/2.jpg')}}" alt="">
                                        <div class="status-circle online"></div>
                                        <div class="media-body"><span>Kori Thomas</span>
                                            <p class="f-12 light-font">Lorem Ipsum is simply dummy...</p>
                                        </div>
                                        <p class="f-12 font-success">1 hr ago</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="media"><img class="img-fluid rounded-circle mr-3" src="{{asset('assets/images/user/4.jpg')}}" alt="">
                                        <div class="status-circle offline"></div>
                                        <div class="media-body"><span>Ain Chavez</span>
                                            <p class="f-12 light-font">Lorem Ipsum is simply dummy...</p>
                                        </div>
                                        <p class="f-12 font-danger">32 mins ago</p>
                                    </div>
                                </li>
                                <li class="text-center"> <a href="#">View All     </a></li>
                            </ul> 
                        </li> --}}
                        <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
                        <li class="onhover-dropdown p-0">
                            <div class="media profile-media"><img class="b-r-10" src="{{asset('assets/images/dashboard/profile.jpg')}}" alt="">
                                <div class="media-body"><span>{{Auth::user()->username}}</span>
                                    @php
                                        $get_role = DB::select("select mr.name_role from master_user mu inner join master_role mr on mu.role  = mr.id where mu.role = '".Auth::user()->role."' limit 1")
                                    @endphp
                                    <p class="mb-0 font-roboto">{{$get_role[0]->name_role}} <i class="middle fa fa-angle-down"></i></p>
                                    {{-- <p class="mb-0 font-roboto">{{Auth::user()->role}} <i class="middle fa fa-angle-down"></i></p> --}}
                                </div>
                            </div>
                            <form id="log_out" action="{{route('logout')}}" method="POST">
                                {{@csrf_field()}}
                                <ul class="profile-dropdown onhover-show-div">
                                    <li><i data-feather="user"></i><a href="{{route('setting-account')}}"><span>Account Settings </span></a></li>
                                    {{-- <li><i data-feather="mail"></i><span>Inbox</span></li> --}}
                                    <li><i data-feather="log-in"></i>
                                        <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('log_out').submit();">
                                            <span>Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="d-lg-none mobile-toggle pull-right"><i data-feather="more-horizontal"></i></div>
            </div>
        </div>
        <!-- Page Header Ends                              -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper sidebar-icon">

        @include('master_layout/sidebar')
        