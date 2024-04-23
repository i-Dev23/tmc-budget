@include('master_layout/header')

<style>
    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #customers td, #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #customers tr:nth-child(even){
        background-color: #f2f2f2;
    }

    #customers tr:hover {
        background-color: #ddd;
    }

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #1599d1;
        color: white;
    }

    #customers tbody {
        cursor: pointer;
    }
</style>

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
                        <h5 class="capitalize">Data Master {{$menu}}</h5>
                        <button class="btn btn-primary right" data-toggle="modal" data-target="#exampleModalgetbootstrap"><i class="fa fa-plus"></i> Add Data <span class="capitalize">{{$menu}}</span></button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display myTable" id="basic-2">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Divisi</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach($dataDivisi as $val)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$val->nama_divisi}}</td>
                                        <td class="text-center">
                                            @if ($val->status == 'NonActive')
                                            <p class="status-0">Non Active</p>
                                            @else
                                            <p class="status-2">Active</p>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-info detail detail_master_division" title="Detail" data-toggle="modal" data-target="#Detail" data-id="{{$val->id_divisi}}"><i class="fa fa-eye"></i></button>
                                            <button class="btn btn-primary edit edit_master_division" data-id="{{$val->nama_divisi}}|^|{{$val->status}}|^|{{$val->id_divisi}}|^|{{$val->type}}"  data-toggle="modal" data-target="#editData" title="Edit Data"><i class="fa fa-pencil"></i></button>
                                            <button class="btn btn-danger delete delete_master_division d-none" data-id="{{$val->id_divisi}}" title="Delete Data"><i class="fa fa-trash"></i></button>
                                        </td>
                                        <input type="hidden" value="{{ $val->nama_divisi }}" id="master_division">
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
                                {{-- <form method="POST" action="{{route('save.data')}}"> --}}
                                    {{-- {!! csrf_field() !!} --}}
                                    <div class="modal-body">
                                        <!-- <div class="col-md-6" style="padding: 0;"> -->
                                            <input type="hidden" name="dataMenu" id="dataMenu" value="divisi">
                                            <div class="form-group margin-bot-5">
                                                <label class="col-form-label" for="Nama-User">Nama Divisi :</label>
                                                <input class="form-control" name="division" id="division" type="text"  required>
                                            </div>
                                            <div class="form-group margin-bot-5">
                                                <label class="col-form-label" for="message-text">Status :</label>
                                                <select class="form-control" name="status" id="status" required>
                                                    <option value="" selected disabled>-- Pilih --</option>
                                                    <option value="Active">Active</option>
                                                    <option value="NonActive">Non Active</option>
                                                </select>
                                            </div>
                                            <div class="form-group margin-bot-5">
                                                <label class="col-form-label" for="message-text">Type Form :</label>
                                                <select class="form-control" name="type" id="type" required>
                                                    <option value="" selected disabled>-- Pilih --</option>
                                                    <option value="type1">type1</option>
                                                    <option value="type2">type2</option>
                                                </select>
                                            </div>
                                        <!-- </div> -->
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" type="button" onclick="save_division()">Save</button>
                                    </div>
                                {{-- </form> --}}
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal fade" id="editData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Data <span class="capitalize">{{$menu}}</span></h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                {{-- <form method="POST" action="{{route('save.data')}}">
                                    {!! csrf_field() !!} --}}
                                    <div class="modal-body">
                                        <!-- <div class="col-md-6" style="padding: 0;"> -->
                                            <input type="hidden" name="dataMenu" id="dataMenuEdit" value="divisi_update">
                                            <input type="hidden" name="idDivisi" id="idDivisiEdit">
                                            <div class="form-group margin-bot-5">
                                                <label class="col-form-label" for="Nama-User">Nama Divisi :</label>
                                                <input class="form-control" name="division" type="text" placeholder="Masukkan Nama Divisi" id="divisi_ril">
                                            </div>
                                            <div class="form-group margin-bot-5">
                                                <label class="col-form-label" for="Nama-User">Add Breakdown :</label>
                                                <input class="form-control" name="breakdown" id="breakdown_edit" type="text" placeholder="Masukkan Data Breakdown">
                                            </div>
                                            <div class="form-group margin-bot-5">
                                                <label class="col-form-label" for="message-text">Status :</label>
                                                <select class="form-control" name="status" id="select_division">
                                                    <option value="" selected disabled>-- Pilih --</option>
                                                    <option value="Active">Active</option>
                                                    <option value="NonActive">Non Active</option>
                                                </select>
                                            </div>
                                            <div class="form-group margin-bot-5">
                                                <label class="col-form-label" for="message-text">Type Form :</label>
                                                <select class="form-control" name="type_edit" id="type_edit" required>
                                                    <option value="" selected disabled>-- Pilih --</option>
                                                    <option value="type1">type1</option>
                                                    <option value="type2">type2</option>
                                                </select>
                                            </div>
                                        <!-- </div> -->
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" type="button" onclick="edit_division()">Save</button>
                                    </div>
                                {{-- </form> --}}
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="renameData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Data Sub <span class="capitalize">{{$menu}}</span></h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="idDivisiSub" id="idDivisiSubEdit">
                                        <div class="form-group margin-bot-5">
                                            <label class="col-form-label" for="Nama-User">Nama Breakdown :</label>
                                            <input class="form-control" name="subrenamedivision" type="text" placeholder="Masukkan Nama Divisi" id="subrenamedivision">
                                        </div>

                                        <div class="form-group margin-bot-5">
                                            <h6>Do you want add sub breakdown ?? <span class="badge badge-success" style="cursor: pointer;" onclick="addevent()" >Klik Here</span></h6>
                                        </div>
                                        <div class="form-group margin-bot-5" id="dinamis_division_brekdown" >
                                            
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" type="button" onclick="rename_division()">Save</button>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="Detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Detail Data <span class="capitalize">{{$menu}}</span></h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                {{-- <form method="POST" action="{{route('save.data')}}"> --}}
                                    {!! csrf_field() !!}
                                    <div class="modal-body table-responsive">
                                        <table class="table table-striped table-sm table-condensed table-bordered" align="center" style="width:100%" id="customers">
                                            <thead>
                                                <tr>
                                                    <th>Breakdown</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center" width="100px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="body_sub">

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                    </div>
                                {{-- </form> --}}
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
    var no_dinamis_breakdown = 1;
    function addevent(){
        $('#dinamis_division_brekdown').append(`<input class="form-control" name="subrenamebreakdown[]" type="text" placeholder="Masukkan Nama Sub Breakdown" id="subrenamebreakdown`+no_dinamis_breakdown+`" style="margin-bottom:1px"><span class="badge badge-danger" style="cursor: pointer; margin-bottom:5px;" onclick="deletevent(`+no_dinamis_breakdown+`)" id="delete_break_sub`+no_dinamis_breakdown+`">Delete</span>`)
        no_dinamis_breakdown++;
    }

    function deletevent(id){
        $('#subrenamebreakdown'+id).remove();
        $('#delete_break_sub'+id).remove();
        // alert(this.value);
    }
</script>