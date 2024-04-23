@include('master_layout/header')

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
<div class="page-body" style="margin-top: 40px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header padd-bottom-0">
                        <h5>Data Master {{$menu}}</h5>
                        <button class="btn btn-primary right capitalize" data-toggle="modal" data-target="#exampleModalgetbootstrap"><i class="fa fa-plus"></i> Add Data {{$menu}}</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display myTable" id="basic-2">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th class="text-center">Divisi</th>
                                        <th class="text-center">Sisa&nbsp;Budget</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center" width="100px">Periode&nbsp;From</th>
                                        <th class="text-center" width="100px">Periode&nbsp;End</th>
                                        <th class="text-center" width="320px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                        // dd($dataBudget);
                                        // periode_from
                                        // periode_end

                                    @endphp
                                    @foreach($dataBudget as $val)
                                    @php
                                        $check_temp = DB::table('temp_budget_all')->where('id_divisi','=',$val->id_divisi)->get();
                                        $budget_temp = 0;
                                        if(count($check_temp) > 0){
                                            $budget_temp = $check_temp[0]->amount;
                                        }
                                    @endphp
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$val->nama_divisi}}</td>
                                        @php
                                            // $data_all = DB::select("SELECT mb.id_divisi, mb.amount, sb2.amountSb amount_sb, bb.amount amount2, drb.nilai_pembiayaan, (mb.amount + case when bb.amount is null then 0 else bb.amount end) + 
                                            //         case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end total,
                                            //         case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end request, 
                                            //         (mb.amount + case when bb.amount is null then 0 else bb.amount end) sisa,
                                            //         (case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end
                                            //         / (mb.amount + case when bb.amount is null then 0 else bb.amount end)) * 100 as persen
                                            //         from master_budget mb left join 
                                            //         (select id_divisi, case when sum(nilai_pembiayaan) is null then 0 else sum(nilai_pembiayaan) end 
                                            //         nilai_pembiayaan from data_request_budget
                                            //         where 1=1 and id_divisi in ('$val->id_divisi') 
                                            //         and status = '2' 
                                            //         GROUP by id_divisi) drb 
                                            //         on mb.id_divisi = drb.id_divisi 
                                            //         left join 
                                            //         (select id_divisi, sum(amount) amountSb from breakdown_budget
                                            //         where id_divisi in ('$val->id_divisi') GROUP by id_divisi) as sb2 on mb.id_divisi = sb2.id_divisi
                                            //         left join
                                            //         (select breakdown_budget.id_divisi, sum(amount)+sb.amountnya amount from breakdown_budget 
                                            //         left join 
                                            //         (select sum(amount) as amountnya, id_divisi  from sub_breakdown where id_divisi in ('$val->id_divisi') group by id_divisi) sb
                                            //         on sb.id_divisi  = breakdown_budget.id_divisi 
                                            //         where breakdown_budget.id_divisi in ('$val->id_divisi') 
                                            //         GROUP by id_divisi) as bb on mb.id_divisi = bb.id_divisi 
                                            //         where 1=1 and mb.id_divisi in ('$val->id_divisi') 
                                            //         and mb.status = 'Active'
                                            // ")
                                            // $data_all = DB::select("
                                            //     select 
                                            //         mb.id_divisi
                                            //         , mb.amount ms_budget
                                            //         , (case when bb.amount is null then 0 else bb.amount end) ms_breakdown
                                            //         , (case when sb.amount is null then 0 else sb.amount end) ms_sub_breakdown
                                            //         , mb.amount + (case when bb.amount is null then 0 else bb.amount end) + 
                                            //             (case when sb.amount is null then 0 else sb.amount end) total
                                            //         , (case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end) request
                                            //         , mb.amount + (case when bb.amount is null then 0 else bb.amount end) + 
                                            //             (case when sb.amount is null then 0 else sb.amount end) - (case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end) sisa
                                            //         , case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end
                                            //             / (mb.amount + case when bb.amount is null then 0 else bb.amount end + 
                                            //             case when sb.amount is null then 0 else sb.amount end) * 100 as persen
                                            //         , mb.status 
                                            //         , mb.periode_end
                                            //         , (case when mb.periode_end >= CURDATE() then 'Active' else 'Expired' end) exp_status
                                            //     from master_budget mb 
                                            //     left join (select id_divisi, sum(amount) amount from breakdown_budget group by id_divisi) bb on mb.id_divisi = bb.id_divisi 
                                            //     left join (select id_divisi, sum(amount) amount from sub_breakdown group by id_divisi) sb on mb.id_divisi = sb.id_divisi
                                            //     left join (select id_divisi, sum(nilai_pembiayaan) nilai_pembiayaan from data_request_budget drb group by id_divisi) drb on mb.id_divisi = drb.id_divisi
                                            //     where 1=1
                                            //     and mb.id_divisi in ('$val->id_divisi')
                                            // ")
                                            $data_all = DB::select("
                                                select 
                                                    mb.id_divisi
                                                    , mb.amount ms_budget
                                                    , (case when bb.amount is null then 0 else bb.amount end) ms_breakdown
                                                    , (case when sb.amount is null then 0 else sb.amount end) ms_sub_breakdown
                                                    , mb.amount + (case when bb.amount is null then 0 else bb.amount end) + 
                                                        (case when sb.amount is null then 0 else sb.amount end) total
                                                    , (case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end) request
                                                    , mb.amount + (case when bb.amount is null then 0 else bb.amount end) + 
                                                        (case when sb.amount is null then 0 else sb.amount end) - (case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end) sisa
                                                    , case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end
                                                        / (mb.amount + case when bb.amount is null then 0 else bb.amount end + 
                                                        case when sb.amount is null then 0 else sb.amount end) * 100 as persen
                                                    , mb.status 
                                                    , mb.periode_end
                                                    , (case when mb.periode_end >= CURDATE() then 'Active' else 'Expired' end) exp_status
                                                from master_budget mb 
                                                left join (select id_divisi, sum(amount) amount from breakdown_budget group by id_divisi) bb on mb.id_divisi = bb.id_divisi 
                                                left join (select id_divisi, sum(amount) amount from sub_breakdown group by id_divisi) sb on mb.id_divisi = sb.id_divisi
                                                -- left join (select id_divisi, sum(nilai_pembiayaan) nilai_pembiayaan from data_request_budget drb where 1=1 and status = '2' group by id_divisi) drb on mb.id_divisi = drb.id_divisi
                                                left join (select drb2.ms_period_end, drb2.ms_period_from, drb2.id_divisi, sum(drb2.nilai_pembiayaan) nilai_pembiayaan from data_request_budget drb2 where 1=1 and drb2.status = '2' and drb2.ms_period_end > CURDATE() group by drb2.id_divisi) drb 
                                                    on mb.id_divisi = drb.id_divisi
                                                where 1=1
                                                and mb.id_divisi in ('$val->id_divisi')
                                            ")
                                        @endphp     
                                        <td style="text-align: right;">{{ number_format($data_all[0]->sisa) }}</td>
                                        <td class="text-center">
                                            @if ($val->datenow == '')
                                            <p class="status-0">Non Active</p>
                                            @else ($val->status == '1')
                                            <p class="status-2">Active</p>
                                            @endif
                                        </td>
                                        <td>{{date('Y-m-d', strtotime($val->periode_from))}}</td>
                                        <td>{{ (date('Y-m-d', strtotime($val->periode_end)) == "1970-01-01") ? '' : date('Y-m-d', strtotime($val->periode_end)) }}</td>
                                        <td >
                                            <button class="btn btn-info detail detail_budget" title="Detail" data-toggle="modal" data-target="#Detail" data-id="{{$val->id_divisi}}"><i class="fa fa-eye"></i></button>
                                            <button class="btn btn-primary edit edit_budget" title="Pembagian Data" data-toggle="modal" data-id="{{$val->id_budget}}|^|{{$val->id_divisi}}|^|{{$val->amount}}|^|{{$val->nama_divisi}}" data-target="#editData" onclick="cekShowin()"><i class="fa fa-users"></i></button>
                                            <button class="btn btn-primary edit edit_budget_divisi" title="Edit Data" data-toggle="modal" data-id="{{$val->id_budget}}|^|{{$val->id_divisi}}|^|{{$val->amount}}|^|{{$val->nama_divisi}}|^|{{$val->periode_from}}|^|{{$val->periode_end}}" data-target="#editDataDivisi"><i class="fa fa-pencil"></i></button>
                                            <button class="btn btn-danger delete delete_budget" data-id="{{$val->id_budget}}" title="Closing" {{ ($val->datenow == '') ? '' : 'disabled' }}>Closing</button>
                                            <button class="btn btn-warning delete bagi_delete_budget" data-toggle="modal" data-id="{{$val->id_divisi}}|^|{{$val->nama_divisi}}" data-target="#editTempBudget" title="Transfer Sisa Budget" {{ ($budget_temp == 0) ? 'disabled' : '' }}><i class="fa fa-exchange"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal fade" id="exampleModalgetbootstrap" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Data <span class="capitalize">{{$menu}}</span></h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">

                                    <div class="form-group margin-bot-5 d-none">
                                        
                                    </div>  
                                    <!-- <div class="col-md-6" style="padding: 0;"> -->
                                        <input type="hidden" name="dataMenu" id="dataMenu" value="budget_post">
                                        <div class="form-group margin-bot-5">
                                            <label class="col-form-label" for="message-text">Divisi :</label>
                                            <select class="form-control" name="divisi" id="divisi">
                                                <option value="" selected disabled>-- Pilih Divisi --</option>
                                                @foreach($dataDivisi as $val)
                                                <option value="{{$val->id_divisi}}">{{$val->nama_divisi}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group margin-bot-5">
                                            <label class="col-form-label" for="Nama-User">Total Budget :</label>
                                            <input class="form-control" name="amount" id="amount" type="text" placeholder="Masukkan Total Budget" required>
                                        </div>
                                        <div class="form-group margin-bot-5">
                                            <label class="col-form-label" for="Nama-User">Periode :</label>
                                            <input class="form-control digits" type="text" id="periode" name="daterange" value="{{date('m/d/Y').' - '.date('m/d/Y') }}">
                                        </div>
                                    <!-- </div> -->
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" type="button" onclick="save_budget()">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="editData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Pembagian <span class="capitalize">{{$menu}}</span> Ke Breakdown</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">
                                    <!-- <div class="col-md-6" style="padding: 0;"> -->
                                        <input type="hidden" name="dataMenu" id="dataMenuEdit" value="budget_update">
                                        <input type="hidden" name="id_budget" id="id_budget">

                                        <div class="form-group margin-bot-5">
                                            <label class="col-form-label" for="message-text">Divisi :</label>
                                            <input type="text" class="form-control" name="divisi_edit_budget" id="divisi_edit_budget" disabled/>
                                        </div>
                                        <div class="form-group margin-bot-5">
                                            <label class="col-form-label" for="message-text">Budget Divisi :</label>
                                            <input type="text" class="form-control" name="amount_edit" id="amount_edit" disabled/>
                                        </div>
                                        <div class="form-group margin-bot-5">
                                            <label class="col-form-label" for="message-text">Breakdown :</label>
                                            <select class="form-control" name="add_budget_master_sub" id="add_budget_master_sub" onchange="reusmana(this.value)" required>
                                            </select>
                                        </div>
                                        <div class="form-group margin-bot-5">
                                            <label class="col-form-label" for="Nama-User">Budget to Breakdown:</label>
                                            <input class="form-control" name="amount_add_sub" id="amount_add_sub" type="text" placeholder="Masukkan Total Budget" required>
                                            <input type="hidden" name="temp_amount" id="temp_amount"/>
                                            <input type="hidden" name="sisa_hasil" id="sisa_hasil"/>
                                            <input type="hidden" name="division_temp" id="division_temp"/>
                                        </div>
                                        <div class="form-group margin-bot-5" id="add_budet_sub_brekdown">
                                        </div>
                                        <div class="form-group margin-bot-5" id="dinamis_budget_brekdown" >
                                        
                                        </div>
                                    <!-- </div> -->
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" type="button" onclick="update_budget()">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="modal fade" id="editDataSub" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit <span class="capitalize">{{$menu}}</span> di Breakdown</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">
                                    <!-- <div class="col-md-6" style="padding: 0;"> -->
                                        <input type="hidden" name="dataMenu" id="dataMenuEditSub" value="budget_sub_update">
                                        <input type="hidden" name="id_budget" id="id_budget_sub">
                                        <input type="hidden" name="id_budget_sub" id="id_budget_divisisub">
                                        <input type="hidden" name="id_budget_divisi" id="id_budget_divisi">

                                        <div class="form-group margin-bot-5">
                                            <label class="col-form-label" for="message-text">Divisi :</label>
                                            <input type="text" class="form-control" name="divisi_edit_budget" id="divisi_edit_budget_sub" disabled/>
                                        </div>
                                        <div class="form-group margin-bot-5">
                                            <label class="col-form-label" for="message-text">Budget Divisi :</label>
                                            <input type="text" class="form-control" name="amount_edit" id="amount_edit_sub" disabled/>
                                        </div>
                                        <div class="form-group margin-bot-5">
                                            <label class="col-form-label" for="message-text">Breakdown :</label>
                                            <input type="text" class="form-control" name="add_budget_master_sub" id="add_budget_master_sub_search" disabled/>
                                        </div>
                                        <div class="form-group margin-bot-5">
                                            <label class="col-form-label" for="Nama-User">Budget to Breakdown:</label>
                                            <input class="form-control" name="amount_add_sub" id="amount_add_sub_new" type="text" placeholder="Masukkan Total Budget" required>
                                        </div>
                                    <!-- </div> -->
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" type="button" onclick="update_budget_sub()">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="editDataSubBreakdown" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit <span class="capitalize">{{$menu}}</span> di Sub Breakdown</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">
                                    <!-- <div class="col-md-6" style="padding: 0;"> -->
                                        <input type="hidden" name="id_budget" id="id_sub_breakdown">
                                        <div class="form-group margin-bot-5 d-none">
                                            <label class="col-form-label" for="message-text">Breakdown :</label>
                                            <input type="text" class="form-control" name="breakdown_sub" id="breakdown_sub" disabled/>
                                        </div>
                                        <div class="form-group margin-bot-5">
                                            <label class="col-form-label" for="message-text">Budget Breakdown :</label>
                                            <input type="text" class="form-control" name="amount_edit_break" id="amount_edit_break" disabled/>
                                        </div>
                                        <div class="form-group margin-bot-5">
                                            <label class="col-form-label" for="message-text">Sub Breakdown :</label>
                                            <input type="text" class="form-control" name="given_name_sub_break" id="given_name_sub_break" disabled/>
                                        </div>
                                        <div class="form-group margin-bot-5">
                                            <label class="col-form-label" for="Nama-User">Budget Sub Breakdown:</label>
                                            <input class="form-control" name="amount_sub_break" id="amount_sub_break" type="text" placeholder="Masukkan Total Budget" required>
                                        </div>
                                    <!-- </div> -->
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" type="button" onclick="update_budget_sub_breakdown()">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="editDataDivisi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Data <span class="capitalize">{{$menu}}</span></h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">
                                    <!-- <div class="col-md-6" style="padding: 0;"> -->
                                        <input type="hidden" name="dataMenu" id="dataMenuEditDivisi" value="budget_update_divisi">
                                        <input type="hidden" name="id_budget_update" id="id_budget_update">
                                        <div class="form-group margin-bot-5">
                                            <label class="col-form-label" for="message-text">Divisi :</label>
                                            <input type="text" class="form-control" name="divisi_edit_budget_divisi" id="divisi_edit_budget_divisi" disabled/>
                                        </div>
                                        <div class="form-group margin-bot-5">
                                            <label class="col-form-label" for="message-text">Main Budget :</label>
                                            <input type="text" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" class="form-control" name="amount_edit_divisi" id="amount_edit_divisi"/>
                                        </div>

                                        <div class="form-group margin-bot-5">
                                            <label class="col-form-label" for="Nama-User">Periode :</label>
                                            <input class="form-control digits" type="text" id="periode_edit" name="daterange" value="{{date('m/d/Y').' - '.date('m/d/Y') }}">
                                        </div>


                                        <input type="hidden" id="divisi_id_update" name="divisi_id_update" />
                                    <!-- </div> -->
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" type="button" onclick="update_budget_divisi()">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal fade" id="editTempBudget" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Data <span class="capitalize">{{$menu}}</span></h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                    <div class="modal-body">
                                            <input type="hidden" name="id_divisi_temp" id="id_divisi_temp">
                                            <div class="form-group margin-bot-5">
                                                <label class="col-form-label" for="message-text">Divisi :</label>
                                                <input type="text" class="form-control" name="budget_divisi_temp" id="budget_divisi_temp" disabled/>
                                            </div>
                                            <div class="form-group margin-bot-5">
                                                <label class="col-form-label" for="message-text">Main Budget :</label>
                                                <input type="text" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" class="form-control" name="amount_temp_divisi" id="amount_temp_divisi"/>
                                            </div>

                                            <div class="form-group margin-bot-5">
                                                <label class="col-form-label" for="message-text">Divisi :</label>
                                                <select class="form-control" name="divisi_temp" id="divisi_temp">
                                                    <option value="" selected disabled>-- Pilih Divisi --</option>
                                                    @foreach($dataDivisi as $val)
                                                    <option value="{{$val->id_divisi}}">{{$val->nama_divisi}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group margin-bot-5">
                                                <label class="col-form-label" for="Nama-User">Total Budget :</label>
                                                <input class="form-control" name="amunt_temp" id="amunt_temp" type="text" placeholder="Masukkan Total Budget" required>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" type="button" onclick="Change_Temp_Dana()">Save</button>
                                    </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Rev_Reus -->
                    <div class="modal fade " id="Detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Detail Data <span class="capitalize">{{$menu}}</span></h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body table-responsive">
                                    <div class="row">
                                        <div class="col-md-6">
                                            Budget Yang Belum Di Bagi : Rp. <span id="budget_cant_shared"></span>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-sm table-condensed table-bordered" align="center" style="width:100%" id="budget_detail">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Division</th>
                                                <th class="text-center">Nama Breakdown</th>
                                                <th class="text-left">Amount Breakdown</th>
                                                <th>Create Date</th>
                                                <th style="width: 130px !important;">Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody id="body_sub_budget">

                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                    <!-- <button type="submit" class="btn btn-primary" type="button">Save</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Rev Reus -->

                    <div class="modal fade" id="trans_dana" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Transfer <span class="capitalize">{{$menu}}</span></h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id_data_trans" id="id_data_trans">
                                    <input type="hidden" name="id_origin_budget" id="idOriginBudget">
                                    <div class="form-group margin-bot-5">
                                        <label class="col-form-label" for="message-text">View Budget :</label>
                                        <input type="text" class="form-control" name="budget_divisi_trans" id="budget_divisi_trans" disabled/>
                                    </div>
                                    
                                    <div class="form-group margin-bot-5" id="subBreakdownTrans"></div>
                                    <p style="margin-bottom: 0; margin-top: 15px; background-color: #2258f0; color: #ffffff; padding: 0 10px;">Transfer ke :</p>
                                    <div style="background-color: #168ca7; color: #ffffff; padding: 0 10px 10px;">
                                        <div class="form-group margin-bot-5">
                                            <label class="col-form-label" for="message-text">Divisi :</label>
                                            <select class="form-control" name="divisi_temp_trans" id="divisi_temp_trans">
                                                <option value="" selected disabled>-- Pilih Divisi --</option>
                                                @foreach($dataDivisi as $val)
                                                <option value="{{$val->id_divisi}}">{{$val->nama_divisi}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group margin-bot-5 cekBreakdown" id="dinamis_budget_breakdown_trans"></div>
                                        <div class="form-group margin-bot-5 cekSubBreakdown" id="dinamis_budget_sub_breakdown_trans"></div>
                                        <div class="form-group margin-bot-5">
                                            <label class="col-form-label" for="Nama-User">Total Transfer Budget :</label>
                                            <input class="form-control" name="amunt_temp_trans" id="amunt_temp_trans" type="text" placeholder="Masukkan Total Transfer Budget">
                                            <input class="form-control" name="amunt_temp_trans_sub" id="amunt_temp_trans_sub" type="text" placeholder="Masukkan Total Transfer Budget.">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" type="button" onclick="save_transfer_budget()">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

@include('master_layout/footer')

<script>
    $(document).ready(function(){
        $('.cekBreakdown').hide();
        $('.cekSubBreakdown').hide();
    })

    $(document).on("change", "#divisi_temp_trans", function(){
        $('#breakdownSubBudget').empty();
        $('.cekSubBreakdown').hide();
        var idData = $(this).val();
        // console.log(idData);

        $.ajax({
            headers : {'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
            type : "POST",
            url : "{{url('cekDataTransferDivisi')}}/" + idData,
            
            success: function(data){
                if(data != null){
                    $('.cekBreakdown').show();
                }else{
                    $('.cekBreakdown').hide();
                }
                $('.cekSubBreakdown').hide();
                $("#dinamis_budget_breakdown_trans").empty();
                $("#dinamis_budget_breakdown_trans").append('<label class="col-form-label" for="message-text">Breakdown Budget :</label><select class="form-control" name="breakdownBudget" id="breakdownBudget"><option selected="" disabled>-- Pilih Breakdown Budget --</option></select>');
                $.each(data, function (key, value) {
                    // $("#breakdownBudget").val(value);
                    $("#breakdownBudget").append('<option value="'+value.idDivisi+'|^|'+value.idSubDivisi+'">'+value.namaSubDivisi+'</option>');
                })
            }
        });
    });

    $(document).on("change", "#breakdownBudget", function(){
        var idSubBreakdown = $(this).val();
        console.log('iki cok',idSubBreakdown);
        $.ajax({
            headers : {'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
            type : "POST",
            url : "{{url('cekSubBreakdownTransfer')}}/" + idSubBreakdown,
            
            success: function(data){
                if(data != null){
                    $('.cekSubBreakdown').show();
                }else{
                    $('.cekSubBreakdown').hide();
                }
                $("#dinamis_budget_sub_breakdown_trans").empty();
                $("#dinamis_budget_sub_breakdown_trans").append('<label class="col-form-label" for="message-text">Sub Breakdown Budget :</label><select class="form-control" name="breakdownSubBudget" id="breakdownSubBudget"><option selected="" disabled>-- Pilih Sub Breakdown Budget --</option></select>');
                $.each(data, function (key, value) {
                    // $("#breakdownBudget").val(value);
                    $("#breakdownSubBudget").append('<option value="'+value.idData+'">'+value.namaSubBreakdown+'</option>');
                })
            }
        });
    });

    // function cekDataSubBreakdown(idDivisi){
    //     console.log('jancok', idDivisi);
    // }

    var html_ask = `<h6>Do you want add budget for sub breakdown ?? <span class="badge badge-success" style="cursor: pointer;" onclick="addeventbuget()" style="margin-top:5px" >Klik Here</span></h6>`
    var arrayPush = []
    function reusmana(id){
        arrayPush = []
        $('#dinamis_budget_brekdown').empty();
        SlickLoader.enable();
            $.ajax({
                url:"{{url('cek_child_sub_breakdown')}}" + "/" + id,
                type:"GET",
                success:function(response){
                    if(response.length != 0){
                        arrayPush.push(response)
                        $('#add_budet_sub_brekdown').empty()
                        $('#add_budet_sub_brekdown').append(html_ask)
                    }else{
                        $('#add_budet_sub_brekdown').empty()
                    }
                },
                error : function(response){$('#dinamis_budget_brekdown').empty();
                    Swal.fire({
                    icon: 'error',
                    text : 'error',
                    title: 'gagal pengecekan',
                    showConfirmButton: false,
                    timer: 1500
                });
                },complete: function (data) {
                SlickLoader.disable(); 
            }
            }); 
    }
    
    function cekShowin(){
        setTimeout(() => {
            if($("#editData").data('bs.modal')?._isShown){
                $('#add_budget_master_sub').prop('disabled',null);
                $('#amount_add_sub').prop('disabled',null);
                $('#dinamis_budget_brekdown').empty();
            }
        }, 1000);
    }
    var no_budget_breakdown = 1;
    var temp_bu = 0;
    var test = 0;
    function addeventbuget(){
        if($('#amount_add_sub').val() != ''){
            var ck_bdget = parseInt($('#amount_add_sub').val().replace(/\D/g, ""));
            // if($('#subbudgetbreakdown1'))
            if($('#subbudgetbreakdown'+test).val() == ""){
                Swal.fire({
                        title: 'Failed!',
                        text: 'Harap Di isi Terlebih Dahulu sub Budget',
                        icon: 'error',
                        confirmButtonText: 'Oke'
                    })
                    return false
            }else{
                $('#subbudgetbreakdown'+test).prop('disabled', 'disabled')
                $('#add_budget_select_sub_ex'+test).prop('disabled', 'disabled')
            }
            if(ck_bdget == ""){
                Swal.fire({
                        title: 'Failed!',
                        text: 'Cek Data Budget',
                        icon: 'error',
                        confirmButtonText: 'Oke'
                    })
                    return false
            }else{
                $('#add_budget_master_sub').prop('disabled','disabled');
                $('#amount_add_sub').prop('disabled','disabled');
                $('#dinamis_budget_brekdown').append(`<select class="form-control" name="add_budget_select_sub_ex[]" id="add_budget_select_sub_ex`+no_budget_breakdown+`" required style="margin-bottom:2px"></select><input class="form-control" name="subbudgetbreakdown[]" type="text" placeholder="Masukkan budget" id="subbudgetbreakdown`+no_budget_breakdown+`" style="margin-bottom:1px" onkeyup="bughetChange(this.id)"><span class="badge badge-danger" style="cursor: pointer; margin-bottom:5px;" onclick="deleteventbudget(`+no_budget_breakdown+`)" id="delete_budget_sub`+no_budget_breakdown+`">Delete</span>`)
                temp_bu = ck_bdget
            }
            for(var i = 0; i<arrayPush[0].length; i++){
                $('#add_budget_select_sub_ex'+no_budget_breakdown).append(`
                    <option>`+arrayPush[0][i].nama_sub_breakdown+`</option>
                `)
            }
            test++
            no_budget_breakdown++
        }else{
            Swal.fire({
                        title: 'Failed!',
                        text: 'Harap Di isi Terlebih Dahulu Budget',
                        icon: 'error',
                        confirmButtonText: 'Oke'
                    })
                    return false
        }
    }

    function bughetChange(id){
        var number_dinam = parseInt($('#'+id).val().replace(/\D/g, ""))
        var sisaNum = temp_bu - number_dinam;

        if(isNaN(sisaNum)){
            $('#amount_add_sub').val(temp_bu.toLocaleString('en-us'))
            $('#'+id).val('')
            return false
        }

        if(sisaNum < 0){
            Swal.fire({
            icon: 'error',
            title: 'error',
            text : 'budget yang ada input melebihi budget yang tersedia',
            showConfirmButton: false,
            timer: 1500
        });

            $('#amount_add_sub').val(temp_bu.toLocaleString('en-us'))
            $('#'+id).val('')
            return false
        }
        $('#amount_add_sub').val(sisaNum.toLocaleString('en-us'))
        $('#'+id).val(number_dinam.toLocaleString('en-us'))
    }

    function deleteventbudget(id){
        var ck_bdget = parseInt($('#amount_add_sub').val().replace(/\D/g, ""));
        temp_bu = ck_bdget
        SlickLoader.enable()
        setTimeout(() => {
            var getReturn = parseInt($('#subbudgetbreakdown'+id).val().replace(/\D/g, ""))
            console.log(getReturn)
            if(isNaN(getReturn)){
                $('#add_budget_select_sub_ex'+id).remove()
                $('#subbudgetbreakdown'+id).remove();
                $('#delete_budget_sub'+id).remove();
                SlickLoader.disable()
                return false;
            }else{
                temp_bu += getReturn
                $('#amount_add_sub').val(temp_bu.toLocaleString('en-us'))
                $('#add_budget_select_sub_ex'+id).remove()
                $('#subbudgetbreakdown'+id).remove();
                $('#delete_budget_sub'+id).remove();
                SlickLoader.disable()
            }
        }, 1000);
    }


    function update_budget_sub_breakdown(){
            var id = $('#id_sub_breakdown').val();
            var amount_breakdown = $('#amount_edit_break').val().replace(/\D/g, "");
            var amount = $('#amount_sub_break').val().replace(/\D/g, "");
            SlickLoader.enable();
            $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "{{ route('update_sub_breakdown') }}",
            data: {
                'id' : id,
                'amount_breakdown':amount_breakdown,
                'amount':amount,
            },
            success: function(data) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Berhasil Update Budget',
                    icon: 'info',
                    confirmButtonText: 'Oke',

                });
                setTimeout(()=>{
                    location.reload();
                },1000)
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Failed!',
                    text: 'Gagal Update Budget',
                    icon: 'error',
                    confirmButtonText: 'Oke'
                })
                // setTimeout(()=>{
                //     location.reload();
                // },1000)
                },complete: function (data) {
                SlickLoader.disable(); 
            }
            })
        }

        $(document).on('click','.transfer_budget_sub_breakdown', function(){
            $('#divisi_temp_trans').val('');
            $('#dinamis_budget_breakdown_trans').empty();
            $('#dinamis_budget_sub_breakdown_trans').empty();
            $('#amunt_temp_trans').val('');
            $('#amunt_temp_trans_sub').val('');
            $("#dinamis_budget_breakdown_trans").empty();

            var hasil = $(this).data('id');
            var explode = hasil.split('|^|');
            var budget = cek_temp_budget_trans(explode[0], explode[1], explode[2])
            $('#id_data_trans').val(hasil)
            $('#amunt_temp_trans').show();
            $('#amunt_temp_trans_sub').hide();
        })
        
        var temp_sisa = 0;
        
        function cek_temp_budget_trans(id_budget, id_divisi, id_sub_divisi){
            SlickLoader.enable();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "get",
                url: "{{ url('cek_budget_trans') }}/" + id_divisi + "/" + id_sub_divisi,
                success: function(data) {
                    id_origin = data.idBudget;
                    temp_sisa = data.amount;
                    $('#idOriginBudget').val(data.idBudget);
                    $('#budget_divisi_trans').val(parseInt(data.amount).toLocaleString("en-us"));
                    cekSubBreakdown(id_budget, id_divisi, id_sub_divisi);
                    $("#subBreakdownTrans").empty();
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: 'Failed!',
                        text: 'Gagal Get Budget',
                        icon: 'error',
                        confirmButtonText: 'Oke'
                    })
                },complete: function (data) {
                    SlickLoader.disable(); 
                }
            })
            
            function cekSubBreakdown(id_budget, id_divisi, id_sub_divisi){
                // SlickLoader.enable();
                $.ajax({
                    headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "get",
                    url: "{{url('getSubBreakdownTrans')}}" + "/" + id_sub_divisi,
                    success: function(data){
                        $("#subBreakdownTrans").append('<label class="col-form-label" for="message-text">Sub Breakdown :</label><select class="form-control" id="transSubBreakdown"><option selected="" disabled>-- Pilih Sub Breakdown --</option></select>');
                        $.each(data, function(key, value){
                            $("#transSubBreakdown").append('<option value="'+value.id_break+'|^|'+value.amount+'|^|'+value.nm_sub_break+'"> '+value.nm_sub_break+' </option>');    
                        })
                    }
                })

                $(document).on('change', '#transSubBreakdown', function(){
                    $('#amunt_temp_trans').val('');
                    var cekData= $(this).val();
                    var explodeData = cekData.split('|^|');
                    var idBudget = explodeData[0];
                    var getBudget = explodeData[1];
                    
                    $('#budget_divisi_trans').val(parseInt(getBudget).toLocaleString("en-us"));
                    $('#amunt_temp_trans').hide();
                    $('#amunt_temp_trans_sub').show();

                    $(document).on('keyup', '#amunt_temp_trans_sub', function(){
                        var inputBudget = parseInt($('#amunt_temp_trans_sub').val().replace(/\D/g,""))

                        $('#amunt_temp_trans_sub').val(inputBudget.toLocaleString('en-us'))
                        var TotSubBudget = getBudget - inputBudget;
                        console.log('sub budget', TotSubBudget)
                        $('#budget_divisi_trans').val(parseInt(TotSubBudget).toLocaleString("en-us"))

                        if(isNaN(inputBudget)){
                            $('#budget_divisi_trans').val(parseInt(getBudget).toLocaleString("en-us"))
                            $('#amunt_temp_trans_sub').val('')
                        }

                        if(TotSubBudget < 0){
                            Swal.fire({
                                icon: 'error',
                                title: 'error',
                                text : 'budget yang ada input melebihi budget yang tersedia',
                                showConfirmButton: false,
                                timer: 1500
                            });

                            $('#budget_divisi_trans').val(parseInt(getBudget).toLocaleString("en-us"))
                            $('#amunt_temp_trans_sub').val('')
                        }
                    })
                })

                $(document).on('keyup', '#amunt_temp_trans', function(){
                    var inputBudget = parseInt($('#amunt_temp_trans').val().replace(/\D/g,""))
                    $('#amunt_temp_trans').val(inputBudget.toLocaleString('en-us'))
                    var TotBudget = temp_sisa - inputBudget;
                    $('#budget_divisi_trans').val(parseInt(TotBudget).toLocaleString("en-us"))

                    if(isNaN(inputBudget)){
                        $('#budget_divisi_trans').val(parseInt(temp_sisa).toLocaleString("en-us"))
                        $('#amunt_temp_trans').val('')
                    }

                    if(TotBudget < 0){
                        Swal.fire({
                            icon: 'error',
                            title: 'error',
                            text : 'budget yang ada input melebihi budget yang tersedia',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        $('#budget_divisi_trans').val(parseInt(temp_sisa).toLocaleString("en-us"))
                        $('#amunt_temp_trans').val('')
                    }
                })
            }
        }
        

        $(document).on('click', '.bagi_delete_budget', function(){
            var hasil = $(this).data('id');
            var explode = hasil.split('|^|');
            var budget = cek_temp_budget(explode[0])
            $('#budget_divisi_temp').val(explode[1])
            $('#id_divisi_temp').val(explode[0])
        })

        function cek_temp_budget(id){
            SlickLoader.enable();
            $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "get",
            url: "{{ url('cek_temp_budget') }}/"+id,
            success: function(data) {
                $('#amount_temp_divisi').val(parseInt(data).toLocaleString('en-us'))
                temp_sisa = data;
                console.log(temp_sisa)
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Failed!',
                    text: 'Gagal Update Budget',
                    icon: 'error',
                    confirmButtonText: 'Oke'
                })
            },complete: function (data) {
                SlickLoader.disable(); 
            }
            })
        }


        $(document).on('keyup focus', '#amunt_temp', function(){
                var number_dinamisY = parseInt($('#amunt_temp').val().replace(/\D/g, ""))
                var sisaNumBer = parseInt(temp_sisa) - number_dinamisY;
                console.log(sisaNumBer)
    
                if(isNaN(number_dinamisY)){
                    $('#amount_temp_divisi').val(parseInt(temp_sisa).toLocaleString('en-us'))
                    // console.log(parseInt(temp_sisa).toLocaleString('en-us'))
                    $('#amunt_temp').val('')
                    // console.log("rets")
                    return false
                }else{
                    if(sisaNumBer >= 0){
                        if(isNaN(sisaNumBer)){
                            $('#amount_temp_divisi').val(parseInt(temp_sisa).toLocaleString('en-us'))
                            $('#amunt_temp').val('')
                            // console.log("Reusmana")
                            return false
                        }
                        $('#amount_temp_divisi').val(sisaNumBer.toLocaleString('en-us'))
                        $('#amunt_temp').val(number_dinamisY.toLocaleString('en-us'))
                        return false
                    }else{
                        // alert("gagal")
                        // console.log("gagal")
                        $('#amount_temp_divisi').val('0')
                        $('#amunt_temp').val(number_dinamisY.toLocaleString('en-us'))
                        return false
                    }
                }
        })

        // $(document).on('keyup focus', '#amount_trans', function(){
        //     var number_dinamisY = parseInt($('#amount_trans').val().replace(/\D/g, ""))
        //     var sisaNumBer = parseInt(temp_sisa) - number_dinamisY;
        //     console.log(sisaNumBer)

        //     if(isNaN(number_dinamisY)){
        //         $('#amount_divisi_trans').val(parseInt(temp_sisa).toLocaleString('en-us'))
        //         // console.log(parseInt(temp_sisa).toLocaleString('en-us'))
        //         $('#amunt_trans').val('')
        //         // console.log("rets")
        //         return false
        //     }else{
        //         if(sisaNumBer >= 0){
        //             if(isNaN(sisaNumBer)){
        //                 $('#amount_divisi_trans').val(parseInt(temp_sisa).toLocaleString('en-us'))
        //                 $('#amunt_trans').val('')
        //                 // console.log("Reusmana")
        //                 return false
        //             }
        //             $('#amount_divisi_trans').val(sisaNumBer.toLocaleString('en-us'))
        //             $('#amunt_trans').val(number_dinamisY.toLocaleString('en-us'))
        //             return false
        //         }else{
        //             // alert("gagal")
        //             // console.log("gagal")
        //             $('#amount_divisi_trans').val('0')
        //             $('#amunt_trans').val(number_dinamisY.toLocaleString('en-us'))

        //             if(sisaNumBer < 0){
        //                 Swal.fire({
        //                     icon: 'error',
        //                     title: 'error',
        //                     text : 'budget yang ada input melebihi budget yang tersedia',
        //                     showConfirmButton: false,
        //                     timer: 1500
        //                 });

        //                 $('#amount_divisi_trans').val(sisaNumBer.toLocaleString('en-us'))
        //                 // $('#'+id).val('')
        //                 $('#amunt_trans').val('')
        //                 return false
        //             }
                    
        //             return false
        //         }
        //     }
        // })
</script>
