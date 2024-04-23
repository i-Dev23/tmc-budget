@include('master_layout/header')
<style>
    @media screen and (min-width: 1200px) {
        img {
            width: 50%;
        }
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
                            // $name_divisi = DB::table('master_divisi')->where('url', '=', $url)->get();   
                        @endphp
                        <li class="breadcrumb-item">Dashboard / Report Sub Breakdown</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <span id="greeting" style="display: none;"></span>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row second-chart-list third-news-update">
            {{-- @foreach ($getBudget as $item) --}}
                {{-- <div class="col-xl-4 chart_data_right box-col-6" >
                    <div class="card" style="background-color: #26aae1; color: #ffffff; min-height: 200px">
                        <div class="card-body" style="padding: 20px 25px;">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <img style="width: 50px" src="{{asset('assets/images/coins.png')}}" style="width: 50%;">
                                    </div>
                                    <div class="col-md-12">
                                        <p style="font-size: 20px; margin: 0px;"><strong>Total Budget</strong><br></p>
                                            <span style="font-size: 19px; margin-top:0px " >{{$item->nama_sub_divisi}}</span>
                                    
                                    </div>
                                    <div class="col-md-12">
                                        <div style="float:right; background-color: #003f05; border-radius: 5px;">
                                            <h6 style=" size:15px; font-weight: bold; margin:0px; padding:2px 10px">Rp {{number_format($item->amount)}}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            {{-- @endforeach --}}
        </div>
    </div>
    @if($getsubBreakdown != null)
    {{-- <input type="hidden" id="url_pdf" value="{{$url}}">
    <input type="hidden" id="id_divisi_pdf" value="{{$getsubBreakdown[0]->id_divisi}}"> --}}

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                <div class="card-body">
                        <div class="table-responsive">
                            <button class="btn btn-secondary" style="float: right;" onclick="downloadpdfsubbreakdown('{{$getsubBreakdown[0]->id_divisi}}')" ><i class="fa fa-print"></i> Print Report</button>
                            <br>
                            <table class="display myTable" id="basic-2">
                                <thead>
                                    <tr style="background-color: #1599d1; color: #fff;">
                                        <th>No</th>
                                        <th>Nama Division</th>
                                        <th>Nama Breakdown</th>
                                        <!-- <th>Amount</th> -->
                                        <th>Nama Sub Breakdown</th>
                                        <th class="text-right">Amount Sub Breakdown</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                        // dd($getsubBreakdown[0]->id_divisi);
                                    @endphp
                                    <input type="hidden" id="hid_sub_breakdown" name="hid_sub_breakdown" value="{{$getsubBreakdown[0]->id_divisi}}">
                                    @foreach($getsubBreakdown as $val)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$val->nama_divisi}}</td>
                                        <td>{{$val->nama_sub_divisi}}</td>
                                        <!-- <td>Rp {{($val->amount == null) ? 0 : number_format($val->amount)}}</td> -->
                                        <td>{{$val->nama_sub_breakdown}}</td>
                                        <td class="text-right">Rp {{($val->amount_sub == null) ? 0 : number_format($val->amount_sub)}}</td>
                                        {{-- <td>{{ date('d-M-Y', strtotime($val->created_date)) }}</td> --}}
                                        {{-- <td class="text-right">Rp {{($val->budget == null) ? 0 : number_format($val->budget)}}</td> --}}
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

    @endif

</div>


@include('master_layout/footer')
<script>
    $(document).ready(function(){
        // alert("Reusmana");
    })
</script>