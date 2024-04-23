@include('master_layout/header')

<script>
    swal("Good job!", "You clicked the button!", "success");
</script>

<!-- Page Sidebar Ends-->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <h3></h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Request Budget {{$get_divisi_name[0]->nama_divisi}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <span id="greeting" style="display: none;"></span>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row date-range-picker">
            <div class="col-sm-12">
                <div class="card">
                    @php 
                    $check_child = DB::select("select * from sub_breakdown where 1=1 and id_sub_divisi = '".Auth::user()->id_sub_divisi."'");
                    @endphp
                    
                    @if (!empty($check_child))
                    <div class="card-header visible">
                        <h5 style="margin-bottom: 5px">Formulir Usulan Promosi 1</h5>
                        <select name="select_budget2" id="select_budget2" class="form-control">
                            <option value="" selected="" disabled="" >Silahkan Pilih Sub Breakdown</option>
                            @foreach ($check_child as $item)
                                <option value="{{$item->id}}">{{$item->nama_sub_breakdown}}</option>
                            @endforeach
                        </select>
                        <div id="dinamic_view2">
                                <h1>Saldo 0</h1>
                        </div>
                    </div>
                    @php
                        $jabatan_m = DB::select("SELECT * from master_jabatan mj where id_jabatan = '".Auth::user()->id_jabatan."'");
                    @endphp
                    @else
                        <div class="card-header">
                            <h5>Formulir Usulan Promosi 2</h5>@php
                                $get_saldo = DB::select("SELECT bb.amount from master_user mu join master_sub_divisi msd on mu.id_sub_divisi = msd.id_sub_divisi 
                                left join breakdown_budget bb on msd.id_sub_divisi = bb.id_sub_divisi 
                                where mu.id = '".Auth::user()->id."'");
    
                                $jabatan_m = DB::select("SELECT * from master_jabatan mj where id_jabatan = '".Auth::user()->id_jabatan."'");
                            @endphp
                            @if ($get_saldo[0]->amount == 0)
                                <h1>Saldo 0</h1>
                            @else
                                <h1>Saldo <span id="saldo_page">{{ number_format($get_saldo[0]->amount) }}</span></h1>
                            @endif
                            <input type="hidden" id="saldo_page_hidden" value="{{ ($get_saldo[0]->amount) }}">
                        </div>
                        
                    @endif
                    <div class="card-body">
                        {{-- <form class="needs-validation" novalidate="" method="post" action="{{route('save.request.budget')}}" enctype="multipart/form-data">
                            {!! csrf_field() !!} --}}
                            <form id="request_budget_send" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6 padd-0 mb-3">
                                    <div class="col-md-12 mb-3">
                                        <input type="hidden" name="id_sb_breakdown2" id="id_sb_breakdown2" value="">
                                        <label for="validationCustom01">Nama Pengusul <span class="required">*</span></label>
                                        <input class="form-control input-air-primary" type="text" placeholder="{{Auth::user()->username}}" name="username" id="username" required="" disabled value="{{Auth::user()->username}}">
                                    </div>
                                
                                    @if (count($jabatan_m) > 0)
                                        <div class="col-md-12 mb-3">
                                            <label for="validationCustom01">Jabatan <span class="required">*</span></label>
                                            <input class="form-control input-air-primary" type="text"  name="jabatan" required="" disabled value="{{$jabatan_m[0]->nama_jabatan}}">
                                        </div>
                                    @endif
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom01">Untuk Pembiayaan <span class="required">*</span></label>
                                        <input class="form-control input-air-primary" type="text" placeholder="..." name="untuk_biaya" id="untuk_biaya" required="">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom01">Nilai Pembiayaan <span class="required">*</span></label>
                                        <input class="form-control input-air-primary" id="nilai_biaya" value="0" type="text" placeholder="..." name="nilai_biaya" required="">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom01">Keterangan <span class="required">*</span></label>
                                        <textarea class="form-control input-air-primary" type="text" placeholder="..." name="keterangan" required="" id="keterangan"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6 padd-0 mb-3">
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom01">Periode <span class="required">*</span></label>
                                        <td><input class="form-control digits input-air-primary" type="text" name="daterange" value="{{date('m/d/Y').' - '.date('m/d/Y') }}"></td>
                                        <!-- <input class="form-control" type="text" placeholder="..." name="periode" required=""> -->
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom01">Berkas Pendukung <span class="required">*</span></label>
                                        <p class="required">
                                            Input File .PDF sebagai pendukung pengajuan budget<br>
                                            File yang di input tidak boleh melebihi 2Mb (Max. 2Mb)
                                        </p>
                                        <input class="" type="file" name="berkas" accept=".pdf">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button class="btn btn-primary right" type="submit" > Submit </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('master_layout/footer')