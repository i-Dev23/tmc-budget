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
                        <select name="select_budget" id="select_budget" class="form-control">
                            <option value="" selected="" disabled="" >Silahkan Pilih Sub Breakdown</option>
                            @foreach ($check_child as $item)
                                <option value="{{$item->id}}">{{$item->nama_sub_breakdown}}</option>
                            @endforeach
                        </select>
                        <div id="dinamic_view">
                                <h1>Saldo 0</h1>
                        </div>
                    </div>
                    @else
                    <div class="card-header">
                        <h5>Formulir Usulan Promosi 2
                        @php
                            $get_saldo = DB::select("SELECT bb.amount from master_user mu join master_sub_divisi msd on mu.id_sub_divisi = msd.id_sub_divisi 
                            left join breakdown_budget bb on msd.id_sub_divisi = bb.id_sub_divisi 
                            where mu.id = '".Auth::user()->id."'");

                            $jabatan_m = DB::select("SELECT * from master_jabatan mj where id_jabatan = '".Auth::user()->id_jabatan."'");
                            // $jabatan_name = DB::select()
                        @endphp
                        @if ($get_saldo[0]->amount == 0)
                            <h1>Saldo 0</h1>
                        @else
                            <h1>Saldo <span id="saldo_page_page">{{ number_format($get_saldo[0]->amount) }}</span></h1>
                        @endif
                        <input type="hidden" id="saldo_page_page_hidden" value="{{ ($get_saldo[0]->amount) }}"></h5>
                    </div>
                    @endif
                    <div class="card-body">
                        <form id="request_budget_send_pertama" method="post" enctype="multipart/form-data">
                        {{-- <form class="needs-validation" novalidate="" method="post" action="{{route('save.request.budget')}}" enctype="multipart/form-data">
                            {!! csrf_field() !!} --}}
                            <div class="row">
                                <div class="col-md-6 padd-0 mb-3">
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom01">Produk <span class="required">*</span></label>
                                        <input type="hidden" name="id_sb_breakdown" id="id_sb_breakdown" value="">
                                        <input class="form-control input-air-primary" type="text" placeholder="..." name="produk" required="">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom01">Produk Item <span class="required">*</span></label>
                                        <input class="form-control input-air-primary" type="text" placeholder="..." name="produk_item" required="">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom01">Sasaran / outlet <span class="required">*</span></label>
                                        <input class="form-control input-air-primary" type="text" placeholder="..." name="sasaran" required="">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom01">Wilayah <span class="required">*</span></label>
                                        <input class="form-control input-air-primary" type="text" placeholder="..." name="wilayah" required="">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom01">Tujuan promosi <span class="required">*</span></label>
                                        <input class="form-control input-air-primary" type="text" placeholder="..."name="tujuan_prmosi" required="">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom01">Perincian rata-rata Omzet <span class="required">*</span></label>
                                        <input class="form-control input-air-primary" type="text" placeholder="..." name="rata_omzet" required="">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom01">Perincian target promosi <span class="required">*</span></label>
                                        <input class="form-control input-air-primary" type="text" placeholder="..."name="rinci_target" required="">
                                    </div>
                                </div>

                                <div class="col-md-6 padd-0 mb-3">
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom01">Periode <span class="required">*</span></label>
                                        <td><input class="form-control digits input-air-primary" type="text" name="daterange" value="{{date('m/d/Y').' - '.date('m/d/Y') }}"></td>
                                        <!-- <input class="form-control" type="text" placeholder="..." name="periode" required=""> -->
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom01">Jenis promosi <span class="required">*</span></label>
                                        <input class="form-control input-air-primary" type="text" placeholder="..." name="jenis_promosi" required="">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom01">Mekanisme promosi / cara pelaksanaan <span class="required">*</span></label>
                                        <input class="form-control input-air-primary" type="text" placeholder="..." name="mekanisme_promosi" required="">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom01">Perincian biaya promosi <span class="required">*</span></label>
                                        <input class="form-control input-air-primary" type="text" placeholder="..." name="rinci_biaya_promosi" required="">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom01">Biaya yang di butuhkan <span class="required">*</span></label>
                                        <input class="form-control input-air-primary" type="text" placeholder="..." name="biaya_utuh" id="biaya_utuh" required="">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom01">Keterangan <span class="required">*</span></label>
                                        <textarea class="form-control input-air-primary" type="text" placeholder="..." name="keterangan" required=""></textarea>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom01">Berkas Pendukung <span class="required">*</span></label>
                                        <p class="required">
                                            Input File .PDF sebagai pendukung pengajuan budget<br>
                                            File yang di input tidak boleh melebihi 2Mb (Max. 2Mb)
                                        </p>
                                        <input class="" type="file" name="berkas" required="" accept=".pdf">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button class="btn btn-primary right" type="submit"> Submit </button>
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

<script>
    
</script>