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
                        <h5>Data Master User</h5>
                        <button class="btn btn-primary right" data-toggle="modal" data-target="#exampleModalgetbootstrap"><i class="fa fa-plus"></i> Add Data User</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display myTable" id="basic-2">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Role</th>
                                        <th>Divisi</th>
                                        <th>Email</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($dataUser)
                                        @php
                                            $no = 1;
                                            // dd($dataUser);
                                        @endphp
                                        @foreach($dataUser as $val)
                                        @php
                                            $note = DB::table('master_role')->where('id','=', $val->role)->get();
                                        @endphp
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{$val->username}}</td>
                                            <td>{{$note[0]->name_role}}</td>
                                            <td>{{$val->nama_divisi}}</td>
                                            <td>{{$val->email}}</td>
                                            <td class="text-center">
                                                {{-- <button class="btn btn-info detail"><i class="fa fa-eye"></i></button> --}}
                                                <button class="btn btn-primary edit edit_user" data-id="{{$val->id}}|^|{{$val->username}}|^|{{$val->nama_jabatan}}|^|{{$val->nama_divisi}}|^|{{$val->email}}|^|{{$val->role}}|^|{{$val->id_sub_divisi}}"  data-toggle="modal" data-target="#editData" title="Edit Data"><i class="fa fa-pencil"></i></button>
                                                <button class="btn btn-danger delete delete_user" data-id="{{$val->id}}" title="Delete User"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal fade" id="exampleModalgetbootstrap" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Data User</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                    <div class="modal-body">
                                            <input type="hidden" name="dataMenu" id="dataMenu" value="user">
                                            <div class="form-group margin-bot-5">
                                                <label class="col-form-label" for="Nama-User">Nama User :</label>
                                                <input class="form-control" name="username" id="username" type="text" placeholder="Masukkan Nama User" required>
                                            </div>
                                            <div class="form-group margin-bot-5 d-none">
                                                <label class="col-form-label" for="message-text d-none">Jabatan :</label>
                                                <select class="form-control" name="jabatan" id="jabatan">
                                                    <option value="" selected disabled>-- Pilih Jabatan --</option>
                                                    @foreach($dataJabatan as $val)
                                                    <option value="{{$val->id_jabatan}}">{{$val->nama_jabatan}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
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
                                                <label class="col-form-label" for="message-text">Role :</label>
                                                <select class="form-control" name="role" id="role" >
                                                    <option value="" selected disabled>-- Pilih Role --</option>
                                                    @foreach($dataRole as $value)
                                                        <option value="{{$value->id}}">{{$value->name_role}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div>
                                                <div class="form-group margin-bot-5 d-none" id="dinamic_sub">
                                                    <label class="col-form-label" for="message-text">Breakdown :</label>
                                                    <select class="form-control" name="sub_divisi" id="sub_divisi">
                                                        <option value="" selected disabled>-- Pilih Breakdown --</option>
                                                        {{-- @foreach($dataSubDivision as $value)
                                                            <option value="{{$value->id_sub_divisi}}">{{$value->nama_sub_divisi}}</option>
                                                        @endforeach --}}
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group margin-bot-5">
                                                <label class="col-form-label" for="message-text">Email :</label>
                                                <input class="form-control" name="email" type="email" id="email" placeholder="Masukkan Alamat Email" required>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" type="button" onclick="save_data_user()">Save</button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                        <input type="hidden" name="dataMenuEdit" id="dataMenuEdit" value="user_update">
                        <input type="hidden" name="id_user" id="id_user">
                        <div class="form-group margin-bot-5">
                            <label class="col-form-label" for="Nama-User">Nama User :</label>
                            <input class="form-control" name="username_edit" id="username_edit" type="text" placeholder="Masukkan Nama User" required>
                        </div>
                        <div class="form-group margin-bot-5 d-none">
                            <label class="col-form-label" for="message-text">Jabatan :</label>
                            <select class="form-control" name="jabatan_edit" id="jabatan_edit">
                            </select>
                        </div>
                        <div class="form-group margin-bot-5">
                            <label class="col-form-label" for="message-text">Divisi :</label>
                            <select class="form-control" name="divisi_edit" id="divisi_edit">
                            </select>
                        </div>
                        <div id="dinamic_user">
                            {{-- <div class="form-group margin-bot-5">
                                <label class="col-form-label" for="message-text">Role :</label>
                                <select class="form-control" name="role_edit" id="role_edit">
                                </select>
                            </div> --}}
                        </div>
                        <div class="form-group margin-bot-5 d-none" id="dinamic_sub_edit">
                            <label class="col-form-label" for="message-text">Breakdown :</label>
                            <select class="form-control" name="sub_divisi_edit" id="sub_divisi_edit">
                                <option value="" selected disabled>-- Pilih Breakdown --</option>
                                {{-- @foreach($dataSubDivision as $value)
                                    <option value="{{$value->id_sub_divisi}}">{{$value->nama_sub_divisi}}</option>
                                @endforeach --}}
                            </select>
                        </div>
                        <div class="form-group margin-bot-5">
                            <label class="col-form-label" for="message-text">Email :</label>
                            <input class="form-control" name="email_edit" id="email_edit" type="email" placeholder="Masukkan Alamat Email" required>
                        </div>
                    <!-- </div> -->
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" type="button" onclick="edit_user()">Save</button>
                </div>
            {{-- </form> --}}
        </div>
    </div>
</div>

@include('master_layout/footer')
