@include('master_layout/header')
<style>
    #keren_img{
        width: 10px;
    }
</style>
<!-- Page Sidebar Ends-->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <h3></h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i data-feather="home"></i></a></li>
                        @php
                            $name_divisi = DB::table('master_divisi')->where('url', '=', $url)->get();
                        @endphp
                        <li class="breadcrumb-item">Dashboard / {{$name_divisi[0]->nama_divisi}} Report</li>
                        @php
                            // dd($url);
                        @endphp
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <span id="greeting" style="display: none;"></span>
    <!-- Container-fluid starts-->

    @if ($getBudget)
    <div class="container-fluid">
        <div class="row second-chart-list third-news-update">
            <div class="col-xl-12 chart_data_right box-col-12">
                @if(strtotime($getBudget[0]->periode_end) < strtotime(date("Y-m-d")))
                <h6 class="pulse" style="padding: 2px 10px; border-radius: 10px; size:12px; font-weight: normal; text-align: center;">-- Expired Budget Since {{$getBudget[0]->periode_end}} --</h6>
                @else
                @endif
            </div>
            <div class="col-xl-4 chart_data_right box-col-12">
                <div class="card" style="background-color: #26aae1; color: #ffffff;">
                    <div class="card-body" style="padding: 20px 25px;">
                        <div class="media align-items-center">
                            <div class="media-body right-chart-content">
                                <div class="col-xl-2" style="color: #ffffff; float: left; padding: 0;">
                                    <img id="keren_img" style="width: 50px" src="{{asset('assets/images/coins.png')}}" style="width: 100%;">
                                </div>
                                <div class="col-xl-12" style="float: left;">
                                    <p style="font-size: 20px; margin: 0;"><strong>Total Budget</strong></p>
                                    <h6 style="float:right; background-color: #006608; padding: 2px 10px; border-radius: 25px; size:12px; font-weight: normal;">Rp {{number_format($getBudget[0]->total)}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 chart_data_right box-col-12">
                <div class="card" style="background-color: #26aae1; color: #ffffff;">
                    <div class="card-body" style="padding: 20px 25px;">
                        <div class="media align-items-center">
                            <div class="media-body right-chart-content">
                                <div class="col-xl-2" style="color: #ffffff; float: left; padding: 0;">
                                    <img style="width: 50px" src="{{asset('assets/images/coins.png')}}" style="width: 100%;">
                                </div>
                                <div class="col-xl-12" style="float: left;">
                                    {{-- <p style="color: #ffffff; margin-top: 10px; font-size: 20px; margin-bottom: -10px;">Sisa</p> --}}
                                    <p style="font-size: 20px; margin: 0;"><strong>Request Budget</strong></p>
                                    <h6 style="float:right; background-color: #f7931d; padding: 2px 10px; border-radius: 25px; font-weight: normal;">Rp {{number_format($getBudget[0]->request)}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 chart_data_right box-col-12">
                <div class="card" style="background-color: #26aae1; color: #ffffff;">
                    <div class="card-body" style="padding: 20px 25px;">
                        <div class="media align-items-center">
                            <div class="media-body right-chart-content">
                                <div class="col-xl-2" style="color: #ffffff; float: left; padding: 0;">
                                    <img style="width: 50px" src="{{asset('assets/images/coins.png')}}" style="width: 100%;">
                                </div>
                                <div class="col-xl-12" style="float: left;">
                                    {{-- <p style="color: #ffffff; margin-top: 10px; font-size: 20px; margin-bottom: -10px;">Presentase</p> --}}
                                    <p style="font-size: 20px; margin: 0 auto;"><strong>Sisa Budget</strong></p>
                                    <h6 style="float:right; background-color: #920000; padding: 2px 10px; border-radius: 25px; font-weight: normal;">Rp {{number_format($getBudget[0]->sisa)}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- Container-fluid Ends-->
    
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row date-range-picker">
                    <div class="col-xl-12">
                        <h6>Filter Data Report</h6>
                        <form method="POST" action="{{route('report-budget')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-xl-8">
                                    <input type="hidden" name="url" value="{{$url}}">
                                    <table style="width: 100%;">
                                         <tr>
                                            <td>Range</td>
                                            <td> : </td>
                                            <td><input class="form-control digits" type="text" name="daterange" value="01/01/2023 - 01/30/2023"></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-xl-4">
                                    <button type="submit" class="btn btn-primary goSearch">Go</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="date_from" value="{{$dateFrom}}">
    <input type="hidden" id="date_to" value="{{$dateEnd}}">
    <input type="hidden" id="url_pdf" value="{{$url}}">
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                <div class="card-body">
                        <div class="table-responsive">
                            <button class="btn btn-secondary" style="float: right;" onclick="downloadpdf()" ><i class="fa fa-print"></i> Print Report</button>
                            <table class="display myTable" id="basic-2">
                                <thead>
                                    <tr style="background-color: #1599d1; color: #fff;">
                                        <th>No</th>
                                        <th>Request ID</th>
                                        <th>Employee&nbsp;Request</th>
                                        <th>Division</th>
                                        <th>Request&nbsp;Date</th>
                                        <th>Approve&nbsp;Date</th>
                                        <th>Budget&nbsp;Used</th>
                                        <th>Interest</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no = 1;
                                    @endphp
                                    @foreach($dataReport as $val)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$val->id_request}}</td>
                                        <td>{{$val->username}}</td>
                                        <td>{{$val->nama_divisi}}</td>
                                        <td>{{$val->request_date}}</td>
                                        <td>{{$val->approve_date}}</td>
                                        <td>{{number_format($val->nilai_pembiayaan)}}</td>
                                        <td>{{$val->tujuan_promosi}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@include('master_layout/footer')