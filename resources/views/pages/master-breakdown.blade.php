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
                                        <th class="text-center">Amount</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Create Date</th>
                                        <th class="text-center">Update Date</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach($dataBudget as $val)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$val->nama_divisi}}</td>
                                        <td>{{$val->amount}}</td>
                                        <td class="text-center">
                                            @if ($val->status == 'NonActive')
                                            <p class="status-0">Non Active</p>
                                            @else ($val->status == '1')
                                            <p class="status-2">Active</p>
                                            @endif
                                        </td>
                                        <td>{{$val->created_date}}</td>
                                        <td>{{$val->updated_date}}</td>
                                        <td>
                                            <button class="btn btn-info detail" title="Detail"><i class="fa fa-eye"></i></button>
                                            <button class="btn btn-primary edit" title="Edit Data"><i class="fa fa-pencil"></i></button>
                                            <button class="btn btn-danger delete" title="Delete"><i class="fa fa-trash"></i></button>
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
                                <form method="POST" action="{{route('save.data')}}">
                                    {!! csrf_field() !!}
                                    <div class="modal-body">
                                        <!-- <div class="col-md-6" style="padding: 0;"> -->
                                            <input type="hidden" name="dataMenu" value="user">
                                            <div class="form-group margin-bot-5">
                                                <label class="col-form-label" for="message-text">Divisi :</label>
                                                <select class="form-control" name="divisi">
                                                    <option value="" selected disabled>-- Pilih Divisi --</option>
                                                    @foreach($dataDivisi as $val)
                                                    <option value="{{$val->id_divisi}}">{{$val->nama_divisi}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group margin-bot-5">
                                                <label class="col-form-label" for="Nama-User">Total Budget :</label>
                                                <input class="form-control" name="amount" type="number" placeholder="Masukkan Total Budget" required>
                                            </div>
                                        <!-- </div> -->
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" type="button">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('master_layout/footer')
