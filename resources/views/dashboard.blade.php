
@include('master_layout/header')

<!-- Page Sidebar Ends-->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Dashboard</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a></li>
                        @php
                            $id_divisi = Auth::user()->id_divisi;
                            $nama_divisi = DB::select("SELECT * from master_divisi md where id_divisi = '$id_divisi'");
                            $role_name = DB::select("SELECT * from master_role mr where id = '".Auth::user()->role."'");
                        @endphp
                        @if ($id_divisi)
                            <li class="breadcrumb-item">Dashboard / {{$nama_divisi[0]->nama_divisi}}
                        @endif
                        @if (Auth::user()->role == "3")
                            / {{ $role_name[0]->name_role }}
                        @endif
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row second-chart-list third-news-update">
            @if (count($getDashboard) > 0)
            @php
                $i = 0;
                $no = 1;
            @endphp
            <input type="hidden" value="{{count($getDashboard)}}" id="count_hasil">
            @foreach ($getDashboard as $item)
            <input type="hidden" value="{{$item->persen}}" id="persen{{$i}}">
            @php
            if(Auth::user()->role == '2'){
                        if($item->id_divisi){
                            $get_name = DB::select("SELECT * from master_divisi md where id_divisi = '$item->id_divisi'");
                        }
                    }else{
                        $get_name = DB::select("SELECT * from master_divisi md where id_divisi = '".Auth::user()->id_divisi."'");
                    }
                @endphp
                @if (count($getDashboard) == $no && (count($getDashboard))  % 2 == 1)
                <div class="col-xl-3 xl-100 chart_data_right box-col-6">
                    <div class="card" style="background-color: #26aae1; color: #ffffff; padding:2px">
                            <div class="card-body">
                                <h3>{{$get_name[0]->nama_divisi}}</h3><br>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <span style="color: #ffffff;">Total Budget</span><h6 style="background-color:rgb(0, 79, 85); margin-right:2px; padding:2px;border-radius:5px">Rp {{number_format($item->total)}}</h6>
                                            <span style="color: #ffffff;">Budget Digunakan</span><h6 style="background-color:rgb(0, 79, 85); margin-right:2px; padding:2px;border-radius:5px">Rp {{number_format($item->request)}}</h6>
                                            <span style="color: #ffffff;">Sisa Budget</span><h6 style="background-color:rgb(0, 79, 85); margin-right:2px; padding:2px;border-radius:5px">Rp {{number_format($item->sisa)}}</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="media-body right-chart-content" style="position: relative; height:50vh;">
                                                <canvas id="myChart{{$i}}" class="chart_class" style="width:100px; height:50px"></canvas></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                <div class="col-xl-3 xl-50 chart_data_right box-col-6">
                    <div class="card" style="background-color: #26aae1; color: #ffffff; padding:2px">
                        <div class="card-body">
                            <h3>{{$get_name[0]->nama_divisi}}</h3><br>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <span style="color: #ffffff;">Total Budget</span><h6 style="background-color:rgb(0, 79, 85); margin-right:2px; padding:2px;border-radius:5px">Rp {{number_format($item->total)}}</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <span style="color: #ffffff;">Budget Digunakan</span><h6 style="background-color:rgb(0, 79, 85); margin-right:2px; padding:2px;border-radius:5px">Rp {{number_format($item->request)}}</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <span style="color: #ffffff;">Sisa Budget</span><h6 style="background-color:rgb(0, 79, 85); margin-right:2px; padding:2px;border-radius:5px">Rp {{number_format($item->sisa)}}</h6>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="chart-container" style="position: relative; height:50vh;">
                                            <canvas id="myChart{{$i}}" class="chart_class"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @php
                    $i++;
                    $no++;
                @endphp
                <br>
            @endforeach
                
            @endif
            
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>

@include('master_layout/footer')