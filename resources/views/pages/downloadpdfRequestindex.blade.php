<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        /** 
        Set the margins of the page to 0, so the footer and the header
        can be of the full height and width !
        **/
        @page {
            margin: 0cm 0cm;
        }

        .pagenum:before {
            content: counter(page);
        }

        /** Define now the real margins of every page in the PDF **/
        body {
            margin-top: 6cm;
            margin-left: 25px;
            margin-right: 25px;
            margin-bottom: 1cm;
            font-family: sans-serif;
        }

        h3 {
            font-family: sans-serif;
        }

        /** Define the header rules **/
        header {
            position: fixed;
            top: 0cm;
            left: 25px;
            right: 25px;
            height: 0.5cm;
            
            /** Extra personal styles **/
            text-align: center;
        }

        /** Define the footer rules **/
        footer {
            position: fixed; 
            bottom: 0cm; 
            left: 0cm; 
            right: 0cm;
            height: 2cm;
            
            /** Extra personal styles **/
            background-color: #03a9f4;
            color: white;
            text-align: center;
            line-height: 1.5cm;
        }

        table {
            font-size: 11;
            font-family: sans-serif;
            color: #232323;
            border-collapse: collapse;
            border: 1px solid #AAAAAA;
            width: 100%;
        }

        .table {
            margin-bottom: 0px;
            color: #212529;
        }

        th, td {
            border: 1px solid #dee2e6;
            vertical-align: top;
            text-align: center !important;
            display: table-cell;
            padding: 1rem 2rem;
            font-size: 90%;
        }

        .col-md-4{
            width: 33.333333%;
            font-family: sans-serif;
            float:left;
        }

        h6 {
            text-align:center;
        }

        P {
            font-size: 12px;
        }
    </style>
</head>
<body>
    <script type="text/php">
        if (isset($pdf)) {
            $pdf->page_script('
            $font = $fontMetrics->get_font(\'DejaVu Sans, Arial, Helvetica, sans-serif\', \'normal\');
            $pageText = $PAGE_NUM . \' / \' . $PAGE_COUNT;
            $y = 800;
            $x = 290;
            $size = 9;
            $pdf->text($x, $y, $pageText, $font, $size);
            ');
        }
    </script>

    <header>
        <table style="width: 100%; border: none;">
            <tr style="border-collapse: collapse; border: none;">
                <td style="text-align: left; padding-top: 15px; width:80%">
                    <img style="vertical-align:middle" src="{{asset('assets/images/logo/small-logo-tmc.png')}}" alt="" height="100px" width="250px">
                </td>
                <td style="text-align: right; width:20%"><h1 style="margin-top: 35px;">{{$getDivisi[0]->nama_divisi}}</h1></td>
            </tr>
        </table>
        <hr>
    </header>
    <main style="margin-top:-60px; margin-bottom: 15px; text-align: center;">
        <h3>FORMULIR USULAN PROMOSI</h3>
        <table class="table table-sm table-condensed table-bordered" align="center">
            <tr><th class="text-center">Produk</th><td class="text-center">{{$getData[0]->produk}}</td></tr>
            <tr><th class="text-center">Item Produk</th><td class="text-center">{{$getData[0]->produk_item}}</td></tr>
            <tr><th class="text-center">Sasaran / Outlet</th><td class="text-center">{{$getData[0]->sasaran_outlet}}</td></tr>
            <tr><th class="text-center">Wilayah</th><td class="text-center">{{$getData[0]->wilayah}}</td></tr>
            <tr><th class="text-center">Tujuan Promosi</th><td class="text-center">{{$getData[0]->tujuan_promosi}}</td></tr>
            <tr><th class="text-center">Perincian Biaya Omzet</th><td class="text-center">{{$getData[0]->rincian_rata_omzet}}</td></tr>
            <tr><th class="text-center">Perincian Target</th><td class="text-center">{{$getData[0]->rincian_target}}</td></tr>
            <tr><th class="text-center">Periode</th><td class="text-center">{{$getData[0]->periode_from}} s/d {{$getData[0]->periode_end}}</td></tr>
            <tr><th class="text-center">Jenis Promosi</th><td class="text-center">{{$getData[0]->jenis_promosi}}</td></tr>
            <tr><th class="text-center">Mekanisme Promosi / Cara Pelaksanaan</th><td class="text-center">{{$getData[0]->mekanis_promo}}</td></tr>
            <tr><th class="text-center">Perincian Biaya Promosi</th><td class="text-center">{{$getData[0]->rincian_biaya}}</td></tr>
            <tr><th class="text-center">Keterangan</th><td class="text-center">{{$getData[0]->keterangan}}</td></tr>
            <tr><th class="text-center">Total Request Budget</th><td class="text-center"><b>Rp {{number_format($getData[0]->nilai_pembiayaan)}}</b></td></tr>
        </table>
        <br>
        <div class="col-md-4">
            <h6 class="text-center">Dibuat Oleh,</h6>
            @if($getData[0]->status == '0' || $getData[0]->status == '1' || $getData[0]->status == '2')
            <img src="{{asset('assets/images/check.png')}}" style="width: 45px;">
            <br>
            <p>( {{$getUser[0]->username}} )</p>
            @else
            <br><br>
            <p style="margin-top: 21px;">( .......... )</p>
            @endif
        </div>
        <div class="col-md-4">
            <h6 class="text-center">Diketahui Oleh,</h6>
            @if($getData[0]->status == '1' || $getData[0]->status == '2')
            <img src="{{asset('assets/images/check.png')}}" style="width: 45px;">
            <br>
            <p>( {{$getApprover[0]->username}} )</p>
            @else
            <br><br>
            <p style="margin-top: 21px;">( .......... )</p>
            @endif
        </div>
        <div class="col-md-4">
            <h6 class="text-center">Disetujui Oleh,</h6>
            @if($getData[0]->status == '2')
            <img src="{{asset('assets/images/check.png')}}" style="width: 45px;">
            <br>
            <p>( Admin )</p>
            @else
            <br><br>
            <p style="margin-top: 21px;">( .......... )</p>
            @endif
        </div>
    </main>
</body>
</html>
