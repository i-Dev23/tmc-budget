@include('master_layout/header')

<!-- Page Sidebar Ends-->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <h3></h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <span id="greeting" style="display: none;"></span>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            @if (Auth::user()->role == '2')
                                <input type="hidden" name= "test_admin" value="admin" id="test_admin">
                            @else
                                <input type="hidden" name= "test_admin" value="" id="test_admin">
                            @endif
                            <table class="display myTable" id="basic-2">
                                <thead>
                                    <tr style="background-color: #1599d1; color: #fff;">
                                        <th>No</th>
                                        <th>Id Request</th>
                                        <th>Employee&nbsp;Request</th>
                                        <th>Division</th>
                                        <th>Request&nbsp;Date</th>
                                        <th class="text-center">Status</th>
                                        <th>Interest</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                        // dd(Auth::user()->role == '2');
                                        // dd($dataRequest);
                                    @endphp
                                    
                                    @foreach($dataRequest as $val)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <th>{{$val->id_request}}</th>
                                        <td>{{$val->username}}</td>
                                        {{-- <td>{{$val->nama_jabatan}}</td> --}}
                                        <td>{{$val->nama_divisi}}</td>
                                        <td>{{$val->request_date}}</td>
                                        <td>
                                            @if ($val->status == '0')
                                            <p class="status-0">New Request</p>
                                            @elseif ($val->status == '1')
                                            <p class="status-1">Aprrove Kadiv</p>
                                            @elseif ($val->status == '2')
                                            <p class="status-2">Approved Admin</p>
                                            @else
                                            <p class="status-3">Reject</p>
                                            @endif
                                        </td>
                                        <td>{{$val->tujuan_promosi}}</td>
                                        <td class="text-center">
                                            @if ($val->type == "type1")
                                                <button class="btn btn-info detail detail-request_budget" title="Detail" data-toggle="modal" data-target="#DetailRequestBudget" data-id="{{$val->id}}"><i class="fa fa-eye"></i></button>
                                            @else
                                                <button class="btn btn-info detail detail-request_budget" title="Detail" data-toggle="modal" data-target="#DetailRequestBudget2" data-id="{{$val->id}}"><i class="fa fa-eye"></i></button>
                                            @endif
                                        </td>
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

<div class="modal fade" id="DetailRequestBudget" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Request Budget <span class="capitalize"></span></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body table-responsive">
                <h5 class="text-center" style="margin-bottom: 35px;">FORMULIR USULAN PROMOSI</h5>
                <table class="table table-sm table-condensed table-bordered" align="center" id="dtlFormUsulan" style="width:60%"></table>
            </div>
            <div class="modal-footer">
                
                <input type="hidden" id="id_request_budget_approve">
                <input type="hidden" id="auth_request">
                <input type="hidden" id="sub_divisi_disp">
                <input type="hidden" id="budget_req">
                @if (Auth::user()->role == 1)
                <button type="submit" class="btn btn-primary" style="color:black" type="button" id="approve_kadiv_button" onclick="approve_kadiv()">Approve</button>
                <button type="submit" class="btn btn-warning" style="color:black" type="button" id="reject_button_kadiv" onclick="reject('kadiv')">Reject</button>
                @elseif (Auth::user()->role == 2)
                <button type="submit" class="btn btn-primary" style="color:black" type="button" id="approve_admin_button" onclick="approve_admin()">Approve</button>
                <button type="submit" class="btn btn-warning" style="color:black" type="button" id="reject_button_admin" onclick="reject('admin')">Reject</button>
                @endif
                <!-- <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Close</button> -->
                <button class="btn btn-secondary" type="button" id="downloadpdfReqDtl" data-dismiss="modal"><i class="fa fa-print"></i> Print</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="DetailRequestBudget2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Request Budget <span class="capitalize"></span></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
                <div class="modal-body table-responsive">
                    <table class="table table-striped table-sm table-condensed table-bordered" align="center" style="width:100%" id="request_budget">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Divisi</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Sub Divisi</th>
                                {{-- <th class="text-center">Jabatan</th>                     --}}
                                <th class="text-center">Untuk Pembiayaan</th>
                                <th class="text-center">Request Pembiayaan</th>
                                <th class="text-center">Keterangan</th>
                                <th class="text-center">Request Date</th>
                                <th class="text-center">Approve Date</th>
                                <th class="text-center">Reject Date</th>
                                <th class="text-center">Berkas File</th>
                            </tr>
                        </thead>
                        <tbody id="body_request_budget">

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_request_budget_approve">
                    <input type="hidden" id="auth_request">
                    <input type="hidden" id="sub_divisi_disp">
                    <input type="hidden" id="budget_req">
                    @if (Auth::user()->role == 1)
                    <button type="submit" class="btn btn-primary" style="color:black" type="button" id="approve_kadiv_button" onclick="approve_kadiv()">Approve</button>
                    <button type="submit" class="btn btn-warning" style="color:black" type="button" id="reject_button_kadiv" onclick="reject('kadiv')">Reject</button>
                    @elseif (Auth::user()->role == 2)
                    <button type="submit" class="btn btn-primary" style="color:black" type="button" id="approve_admin_button" onclick="approve_admin()">Approve</button>
                    <button type="submit" class="btn btn-warning" style="color:black" type="button" id="reject_button_admin" onclick="reject('admin')">Reject</button>
                    @endif
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                </div>
            {{-- </form> --}}
        </div>
    </div>
</div>


@include('master_layout/footer')