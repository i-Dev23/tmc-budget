<?php

namespace App\Http\Controllers;

use App\Models\global_model;
use Illuminate\Http\Request;
use DB;
use Auth;
use PDF;


class MainController extends Controller
{
    public function index(){
        $getDashboard = global_model::getDashboardNew();
        return view('dashboard', compact('getDashboard'));
    }

    public function reportAllBudget(){
        $reportTransferBudget = global_model::getReportTransferBudget();
        return view('pages/report-trans-budget', compact('reportTransferBudget'));
    }

    public function reportBudget(Request $request, $url=false){
        if(Auth::user()->role == '2'){
            $url = $request->url;
            $divCode = null;
            $getDataDivisi = DB::select("SELECT * from master_divisi where 1=1 and url = '$url' and status = 'Active'");
            switch($url){
                case $url :
                    $divCode = $getDataDivisi[0]->id_divisi;
                break;
            }
            // dd($divCode);
            // get budget
            $dataReport = "";
            $dataReportFilter = "";
            $getBudget = global_model::getBudget($url);
            // $getBudget = global_model::getDataRpBudget($url);
            if ($request->daterange == null) {
                $dateFrom = "";
                $dateEnd = "";
                $dataReport = global_model::getReport($divCode, $dateFrom, $dateEnd);
            }else{
                $dateRange  = explode('-', $request->daterange);
                $dateFrom   = date('Y-m-d', strtotime(str_replace(' ', '', $dateRange[0])));
                $dateEnd    = date('Y-m-d', strtotime(str_replace(' ', '', $dateRange[1])));
                
                $dataReport = global_model::getReport($divCode, $dateFrom, $dateEnd);
            }   

            return view('pages/report-budget', compact('divCode', 'getDataDivisi', 'dataReport', 'url', 'getBudget', 'dateFrom', 'dateEnd'));
        }else if(Auth::user()->role == '1'){
            $url = $request->url;
            $divCode = null;
            $getDataDivisi = DB::select("SELECT * from master_divisi where 1=1 and url = '$url' and status = 'Active'");
            switch($url){
                case $url :
                    $divCode = $getDataDivisi[0]->id_divisi;
                    break;
                }
                
            // dd($divCode);
            // get budget
            $getBudget = global_model::getBudget($url);
            if ($request->daterange == null) {
                $dataReport = null;
                $dateFrom = "";
                $dateEnd = "";
                $dataReport = global_model::getReport($divCode, $dateFrom, $dateEnd);
            }else{
                $dateRange  = explode('-', $request->daterange);
                $dateFrom   = date('Y-m-d', strtotime(str_replace(' ', '', $dateRange[0])));
                $dateEnd    = date('Y-m-d', strtotime(str_replace(' ', '', $dateRange[1])));
                
                $dataReport = global_model::getReport($divCode, $dateFrom, $dateEnd);
            }   
            return view('pages/report-budget', compact('divCode', 'getDataDivisi', 'dataReport', 'url', 'getBudget', 'dateFrom', 'dateEnd'));
        }
    }

    public function reportBudgetBreakdown(Request $request, $url=false){
        if(Auth::user()->role != '3'){
            $url = $request->url;
            $divCode = null;
            $getDataDivisi = DB::select("SELECT * from master_divisi where 1=1 and url = '$url' and status = 'Active'");
            switch($url){
                case $url :
                    $divCode = $getDataDivisi[0]->id_divisi;
                break;
            }
            $getBudget = global_model::getBudgetPerdivisiNew($divCode);
            // dd($getBudget);
            $stsActive = 'Active';
            $dataReport   = global_model::getDetailBudget($divCode,$stsActive);
            return view('pages/report-budget_breakdown', compact('divCode', 'getDataDivisi', 'url', 'getBudget', 'dataReport'));
        }
        return redirect()->route('dashboard');
    }

    public function reportBudgetSubBreakdown($url){
        $getsubBreakdown = global_model::givensubbreakdown($url);
        return view('pages/report-budget_sub_breakdown', compact('getsubBreakdown'));
    }

    public function downloadReqDetail(Request $request){
        $idData = $request->data_report;
        $getData = global_model::getDetailRequestBudget($idData);
        $idDivisi = $getData[0]->id_divisi;
        $idUser = $getData[0]->employee_id;
        $getDivisi = DB::select("select * from master_divisi md where 1=1 and id_divisi = '$idDivisi'");
        $getUser = DB::select("select * from master_user mu where 1=1 and id = '$idUser'");
        $getApprover = DB::select("select * from master_user mu where 1=1 and id_divisi = '$idDivisi' and role = '1'");
        $namingSJ = 'FORMULIR USULAN PROMOSI';
        // return view('pages/downloadpdfRequestindex', compact('getData', 'getDivisi', 'getUser', 'getApprover'));
        $pdf      = PDF::loadView('pages/downloadpdfRequestindex', compact('getData', 'getDivisi', 'getUser', 'getApprover'));
        $pdf->setOptions(['isPhpEnabled' => true, 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf->setPaper('A4', 'potrait');
        
        return $pdf->download($namingSJ . '.pdf');
    }

    public function downloadpdf(Request $request){
        $date_from = $request->date_from;
        $date_to = $request->date_to;
        $url = $request->url;
        //getid divisi
        $get_id = DB::table('master_divisi')->where('url','=', $url)->get();
        $getName = $get_id[0]->nama_divisi;
        $get_date = global_model::downloaddatapdf($get_id[0]->id_divisi, $date_from, $date_to);
        $namingSJ = 'Report Request Budget Divisi '.$getName;
        $pdf      = PDF::loadView('pages/downloadpdfindex', compact('get_date','date_from','date_to','getName'));
        $pdf->setOptions(['isPhpEnabled' => true, 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf->setPaper('A4', 'potrait');

        return $pdf->stream($namingSJ . '.pdf');
    }

    public function downloadpdfbreakdown(Request $request){
        $id_divisi_pdf = $request->id_divisi_pdf;
        $url = $request->url;
        //getid divisi
        $get_id = DB::table('master_divisi')->where('url','=', $url)->get();
        $getName = $get_id[0]->nama_divisi;
        $stsActive = 'Active';
        $get_date   = global_model::getDetailBudget($id_divisi_pdf,$stsActive);
        $namingSJ = 'Report Budget Breakdown Divisi '.$getName;
        $pdf      = PDF::loadView('pages/downloadpdfdetail', compact('get_date','getName'));
        $pdf->setOptions(['isPhpEnabled' => true, 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf->setPaper('A4', 'potrait');
        return $pdf->download($namingSJ . '.pdf');
    }

    public function downloadpdfsubbreakdown(Request $request){
        \Log::info($request->all());
        $getsubBreakdown = global_model::givensubbreakdownpdf($request->hid_sub_breakdown);
        \Log::info($getsubBreakdown);
        $namingSJ = 'Report Budget Sub Breakdown';
        $pdf      = PDF::loadView('pages/downloadpdfsubbreakdown', compact('getsubBreakdown'));
        $pdf->setOptions(['isPhpEnabled' => true, 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf->setPaper('A4', 'potrait');
        return $pdf->download($namingSJ . '.pdf');
    }
    
    public function readallNotif(Request $request){
        if($request->type_notif == "kadiv"){
            $query = DB::table('message')->where('id_divisi','=',$request->id_divisi)->where('read_status', '=', '1')->update(['read_status' => '2']);
        }else if($request->type_notif == "admin"){
            $check = DB::select("SELECT * from message m where read_status = '1' and status_approve = '2'");
            if(count($check) > 0){
                $query = DB::table('message')->where('read_status', '=', '1')->update(['read_status' => '2']);
            }
        }else{
            $id_auth = Auth::user()->id;
            $query = DB::table('message')->where('id_auth','=',$id_auth)->where('read_status', '=', '1')->update(['read_status' => '2']);
        }
    }

    public function settingAccount(){
        return view('form/Account-Setting');
    }

}
