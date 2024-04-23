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
                        <li class="breadcrumb-item">Dashboard Report All Transfer</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <span id="greeting" style="display: none;"></span>
    <!-- Container-fluid starts-->

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                <div class="card-body">
                        <div class="table-responsive">
                            <!-- <button class="btn btn-secondary" style="float: right;" onclick="downloadpdf()" ><i class="fa fa-print"></i> Print Report</button> -->
                            <table class="display myTable" id="basic-2">
                                <thead>
                                    <tr style="background-color: #1599d1; color: #fff;">
                                        <th>No</th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Transfer&nbsp;From&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th>Budget&nbsp;Awal</th>
                                        <th>Sisa&nbsp;Budget</th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Transfer&nbsp;To&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th>Total&nbsp;Transfer</th>
                                        <th>Tgl.&nbsp;Transfer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach($reportTransferBudget as $val)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$val->from_divisi . ' > ' . $val->from_sub_divisi  . ' > ' . $val->from_child_sub_divisi}}</td>
                                        <td>{{number_format($val->budget_awal)}}</td>
                                        <td>{{number_format($val->total_sisa_budget)}}</td>
                                        <td>{{$val->to_divisi . ' > ' . $val->to_sub_divisi  . ' > ' . $val->to_child_sub_divisi}}</td>
                                        <td>{{number_format($val->total_transfer)}}</td>
                                        <td>{{$val->tgl_transfer}}</td>
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