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
        font-size: 8;
        font-family: sans-serif;
        color: #232323;
        border-collapse: collapse;
        border: 1px solid #aaaaaa;
        width: 100%;
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
        <table style="width: 100%; border: none">
            <tr style="border-collapse: collapse; border: none;">
                <td style="text-align: left; padding-top: 15px; width:80%">
                    <img style="vertical-align:middle" src="{{asset('assets/images/logo/small-logo-tmc.png')}}" alt="" height="100px" width="250px">
                </td>
                <td style="text-align: right; width:20%"></td>
            </tr>
        </table>
        <hr>
        <div class="row">
            <div class="col-sm-4 text-center">
              <p style="margin-top: 0px; font-size: 110%; text-align:center"><b>REPORT DATA REQUEST BUDGET DIVISI {{ strtoupper($getName) }}</b></p>
            </div> 
          </div>
          <div class="row">
            <div class="col-sm-4 text-center">
                <table style="border: none;width: 60%;">
                <tr style="border: none;">
                    @if(date('d-M-Y', strtotime($date_from)) == '01-Jan-1970')
                      <td width="49%" style="padding:5px; border-bottom:none;font-weight: bold; font-size:12px">All Data Report</td>
                    @else
                      <td width="49%" style="padding:5px; border-bottom:none;font-weight: bold; font-size:12px">Mulai Dari Tanggal : <br/>{{ date('d-M-Y', strtotime($date_from)) }} s/d Tanggal {{ date('d-M-Y', strtotime($date_to)) }}</td>
                    @endif
                </tr>
                </table>
            </div>
          </div>
    </header>
    <main>
    <table>
      <thead>
        <tr style="border: 1px black solid;">
            <th style="border: 1px black solid;">NO</th>
            <th style="border: 1px black solid;">REQUEST ID</th>
            {{-- <th style="border: 1px black solid;">NAMA JABATAN</th> --}}
            <th style="border: 1px black solid;">SUB DIVISI</th>
            <th style="border: 1px black solid;">REQUESTER</th>
            <th style="border: 1px black solid;">REQUEST DATE</th>
            <th style="border: 1px black solid;">APPROVE DATE</th>
            <th style="border: 1px black solid;">COST USAGE</th>
            <th style="border: 1px black solid;">BIAYA</th>
        </tr>
        </thead>
        <tbody>
          @php
              $no = 1;
              $total = 0;
          @endphp
          @foreach ($get_date as $val)
              <tr style="border: 1px black solid;">
                  <td align="center" style="border: 1px black solid;" >{{ $no++ }}</td>
                  <td align="center" style="border: 1px black solid;" width="80px">{{ $val->id_request }}</td>
                  <td align="center" style="border: 1px black solid;" width="100px">{{ $val->nama_sub_divisi }}</td>
                  <td align="center" style="border: 1px black solid;" width="100px">{{ $val->username }}</td>
                  <td align="center" style="border: 1px black solid;" width="100px">{{ date('d-M-Y', strtotime($val->request_date)) }}</td>
                  <td align="center" style="border: 1px black solid;" width="100px">{{ date('d-M-Y', strtotime($val->approve_date)) }}</td>
                  <td align="center" style="border: 1px black solid;" >
                    @if($val->tujuan_promosi == NULL)
                      {{ $val->pembiayaan }}
                    @else
                      {{ $val->tujuan_promosi }}
                    @endif
                  </td>
                  <td align="right" style="border: 1px black solid;" width="100px">{{number_format($val->nilai_pembiayaan)}}</td>
              </tr>
              @php
                  $total += $val->nilai_pembiayaan;
              @endphp
          @endforeach
          <tr style="border: 1px black solid;">
            <td  align="center" style="border: 1px black solid; font-weight:bold" colspan="7" >Total Biaya Request</td>
            <td  align="right" style="border: 1px black solid; font-weight:bold" >Rp {{number_format($total)}}</td>
          </tr>
        </tbody>
    </table>
    <br>

  </main>
</body>
</html>
