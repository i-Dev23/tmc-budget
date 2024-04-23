<!-- Page Sidebar Start-->
<header class="main-nav">
    <div class="logo-wrapper"><a href="#"><img class="img-fluid" src="{{asset('assets/images/logo/small-logo-tmc.png')}}" alt=""></a></div>
    <!-- <div class="logo-icon-wrapper"><a href="index.html"><img class="img-fluid" src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a></div> -->
    <nav>
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-right"><span>Back</span><i class="fa fa-angle-right pl-2" aria-hidden="true"></i></div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav" href="{{route('dashboard')}}"><i data-feather="home"></i><span>Dashboard</span></a>
                    </li>
                    <!-- <li class="dropdown"><a class="nav-link menu-title" href="#"><i data-feather="airplay"></i><span>Division</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="#">abc</a></li>
                        </ul>
                    </li> -->
                    @if (Auth::user()->role == '2')
                    @php
                        $dataDivisi = DB::select('SELECT * FROM master_divisi where 1=1 and status = "Active"');
                    @endphp
                    <li class="mega-menu"><a class="nav-link menu-title" href="#"><i data-feather="layers"></i><span>Division</span></a>
                        <div class="mega-menu-container menu-content">
                            <div class="container">
                                <div class="row">
                                    
                                    @foreach($dataDivisi as $val)
                                    <div class="col mega-box">
                                        <div class="link-section">
                                            <div class="submenu-title">
                                                <h5>{{$val->nama_divisi}}</h5>
                                            </div>
                                            <ul class="submenu-content opensubmegamenu">
                                                <li><a href="{{url('report.budget', $val->url)}}">Report Budget</a></li>
                                                <!-- <li><a href="{{url('report.budget', $val->url)}}">Report Request Budget</a></li>
                                                <li><a href="{{url('report.budget.breakdown', $val->url)}}">Breakdown Budget</a></li> -->
                                                <!-- @php
                                                    //cekchild
                                                    $id_divisi = $val->id_divisi;
                                                    $tableChild = DB::table('sub_breakdown')->where('id_divisi', '=', $id_divisi)->get()
                                                @endphp
                                                @if (count($tableChild) > 0)
                                                    <li><a href="{{url('report.budget.sub.breakdown', $val->url)}}">Report Sub Breakdown</a></li>
                                                @endif -->
                                            </ul>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </li>

                    @elseif(Auth::user()->role == '1')
                    @php
                        $idDivisi = Auth::user()->id_divisi;
                        $dataDivisi = DB::select('SELECT * FROM master_divisi where 1=1 and status = "Active" and id_divisi = :idDivisi', ['idDivisi' => $idDivisi]);
                    @endphp
                    @foreach($dataDivisi as $val)
                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav" href="{{route('data-request')}}"><i data-feather="server"></i><span>Data Request</span></a>
                            <a class="nav-link menu-title link-nav" href="{{url('report.budget', $val->url)}}"><i data-feather="server"></i><span>Report Budget</span></a>
                            <a class="nav-link menu-title link-nav" href="{{url('report.budget.breakdown', $val->url)}}"><i data-feather="server"></i><span>Breakdown Budget</span></a>
                        </li>
                    @endforeach

                    @endif

                        @php
                            // dd(Auth::user()->role);
                        @endphp
                    @if(Auth::user()->role == '3')
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav" href="{{route('request')}}"><i data-feather="edit-3"></i><span>Request Budget</span></a>
                        <a class="nav-link menu-title link-nav" href="{{route('data-request')}}"><i data-feather="server"></i><span>Data Request</span></a>
                    </li>
                    @elseif (Auth::user()->role == '2')
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav" href="{{route('data-request')}}"><i data-feather="server"></i><span>Data Request</span></a>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="#"><i data-feather="airplay"></i><span>Master Data</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{route('master', 'user')}}">Master User</a></li>
                            <li><a href="{{route('master', 'division')}}">Master Division</a></li>
                            {{-- <li><a href="{{route('master', 'brand')}}">Report Sub Breakdown</a></li> --}}
                            <li><a href="{{route('master', 'budget')}}">Master Budget</a></li>
                            <li><a href="{{route('report-all-budget')}}">Report Transfer Budget</a></li>
                            {{-- <li><a href="{{route('master', 'breakdown')}}">Master Breakdown</a></li> --}}
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>