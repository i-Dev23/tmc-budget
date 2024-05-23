<?php

namespace App\Http\Controllers;

use App\Models\global_model;
use Illuminate\Http\Request;
use DB;
// use RealRashid\SweetAlert\Facades\Alert;
// use Alert;
use Illuminate\Support\Facades\Auth;
use App\Mail\SendMailNew;
use App\Mail\MessageInfo;
use Illuminate\Support\Facades\Mail;
use Exception;
class RequestController extends Controller
{
    public function __construct(){
        $this->path = ('./file_upload/');
    }

    public function index(){
        $auth = Auth::user()->id_divisi;
        $get_divisi_name = DB::table('master_divisi')->where('id_divisi', '=', $auth)->get();
        // dd($get_divisi_name[0]->type);
        // dd($get_divisi_name);
        if($get_divisi_name[0]->type == 'type1'){
            return view('form/request-budget', compact('get_divisi_name'));
        }else{
            return view('form/request-budget_dua', compact('get_divisi_name'));
        }
    }

    public function checkSubBreakdown($id){
        $checkSub = DB::table('sub_breakdown')->where('id', '=', $id)->get();
        if(empty($checkSub)){
            $checkBreakDownBudget = DB::select('select * from breakdown_budget bb where 1=1 and id_breakdown = "'.$id.'"');
            return $checkBreakDownBudget;
        }else{
            return $checkSub;
        }
    }

    public function request_budget(Request $request){

        $dateNow = date('Y-m-d');
        $cek = DB::select("SELECT * from master_budget mb where periode_from <= '$dateNow' and periode_end >= '$dateNow'");
        if(count($cek) <= 0){
            return array(
                'status'    => 500,
                'message'   => 'Request Budget Kadaluarsa' 
            );  
        }

        try{
            $produk                 = $request->produk;
            $child                  = "";
            if(!empty($request->id_sb_breakdown)){
                $child              = $request->id_sb_breakdown;
            }
            $produk_item            = $request->produk_item;
            $sasaran                = $request->sasaran;
            $wilayah                = $request->wilayah;
            $tujuan_prmosi          = $request->tujuan_prmosi;
            $rata_omzet             = $request->rata_omzet;
            $rinci_target           = $request->rinci_target;
            $periode                = $request->daterange;
            $jenis_promosi          = $request->jenis_promosi;
            $mekanisme_promosi      = $request->mekanisme_promosi;
            $rinci_biaya_promosi    = $request->rinci_biaya_promosi;
            $biaya_utuh             = str_replace(',','',$request->biaya_utuh);
            $keterangan             = $request->keterangan;
            $periodeData            = explode('-', $periode);
            $periodFrom             = str_replace(' ', '', str_replace('/', '-', trim($periodeData[0])));
            $periodFromEx           = explode('-', $periodFrom);
            $periodFrom             = $periodFromEx[1].'-'.$periodFromEx[0].'-'.$periodFromEx[2];
            $periodEnd              = str_replace(' ', '', str_replace('/', '-', trim($periodeData[1])));
            $periodEndEx            = explode('-',$periodEnd);
            $periodEnd              = $periodEndEx[1].'-'.$periodEndEx[0].'-'.$periodEndEx[2];
            //generate request
            $auth_given = Auth::user()->id_divisi;
            $search_name = DB::table('master_divisi')->where('id_divisi','=',$auth_given)->get();
            $spesifik_name = $search_name[0]->nama_divisi;
            $sub_str = substr($spesifik_name, 0 ,2);
            
            $get_id_new = DB::select("SELECT case when max(id) is null then 1 else max(id) + 1 end id from data_request_budget");
            $id_request = strtoupper($sub_str).date('d').date('m').$get_id_new[0]->id.date('y');
            
            if($request->berkas){
                $file_pendukung         = $request->berkas;
                $file_ori               = $file_pendukung->getClientOriginalName();
                $string                 = uniqid(rand());
                $randomString           = substr($string, 0, 8);
                $file_rename            = $randomString."-".str_replace(' ', '-', $file_ori);
                $file_size              = $file_pendukung->getSize();
                
                
                // throw new Exception("Error Processing Request", 1);
                if($file_size > 2048000){
                    // swal("Error", "File yang anda masukkan melebihi 2Mb", "error");
                    return array(
                        'status' => 500,
                        'message' => 'file berkas lebih dari 2MB',
                    );
                }else{ 
                
                    $params = [
                        'id'                    => $get_id_new[0]->id,
                        'id_divisi'             => Auth::user()->id_divisi,
                        'id_jabatan'            => Auth::user()->id_jabatan,
                        'employee_id'           => Auth::user()->id,
                        'filename'              => $file_rename,
                        'path'                  => $this->path.'document/'.$file_rename,
                        'request_date'          => date('Y-m-d'),
                        'produk'                => $produk,
                        'produk_item'           => $produk_item,
                        'sasaran_outlet'        => $sasaran,
                        'wilayah'               => $wilayah,
                        'tujuan_promosi'        => $tujuan_prmosi,
                        'rincian_rata_omzet'    => $rata_omzet,
                        'rincian_target'        => $rinci_target,
                        'rincian_biaya'         => $rinci_biaya_promosi,
                        'biaya_utuh'            => $biaya_utuh,
                        'periode_from'          => date('Y-m-d', strtotime($periodFrom)),
                        'periode_end'           => date('Y-m-d', strtotime($periodEnd)),
                        'ms_period_from'        => $cek[0]->periode_from,
                        'ms_period_end'         => $cek[0]->periode_end,
                        'jenis_promosi'         => $jenis_promosi,
                        'mekanis_promo'         => $mekanisme_promosi,
                        'keterangan'            => $keterangan,
                        'status_approve'        => '0',
                        'id_request'            => $id_request,
                        'child'                 => $child,
                    ];

                    $insertData = global_model::insertDataRequest($params);
                    $saveFile = $file_pendukung->move($this->path . 'document/' , $file_rename);
                }
            }else{
                    // $get_id_new = DB::select("SELECT case when max(id) is null then 1 else max(id) + 1 end id from data_request_budget");
                    $params = [
                        'id'                    => $get_id_new[0]->id,
                        'id_divisi'             => Auth::user()->id_divisi,
                        'id_jabatan'            => Auth::user()->id_jabatan,
                        'employee_id'           => Auth::user()->id,
                        'filename'              => '',
                        'path'                  => '',
                        'request_date'          => date('Y-m-d'),
                        'produk'                => $produk,
                        'produk_item'           => $produk_item,
                        'sasaran_outlet'        => $sasaran,
                        'wilayah'               => $wilayah,
                        'tujuan_promosi'        => $tujuan_prmosi,
                        'rincian_rata_omzet'    => $rata_omzet,
                        'rincian_target'        => $rinci_target,
                        'rincian_biaya'         => $rinci_biaya_promosi,
                        'biaya_utuh'            => $biaya_utuh,
                        'periode_from'          => date('Y-m-d', strtotime($periodFrom)),
                        'periode_end'           => date('Y-m-d', strtotime($periodEnd)),
                        'ms_period_from'        => $cek[0]->periode_from,
                        'ms_period_end'         => $cek[0]->periode_end,
                        'jenis_promosi'         => $jenis_promosi,
                        'mekanis_promo'         => $mekanisme_promosi,
                        'keterangan'            => $keterangan,
                        'status_approve'        => '0',
                        'id_request'            => $id_request,
                        'child'                 => $child,
                    ];
                    
                    $insertData = global_model::insertDataRequest($params);
            }
    
            //message
            $getNameDiv = DB::table('master_divisi')->where('id_divisi','=',Auth::user()->id_divisi)->get();
            $getNameDivSub = DB::table('master_sub_divisi')->where('id_sub_divisi','=',Auth::user()->id_sub_divisi)->get();
            $message = "Request Budget dengan id : ".$id_request." Masuk Pada Tanggal ".date('d-m-Y').", Divisi  : ".$getNameDiv[0]->nama_divisi.", Breakdown : ".$getNameDivSub[0]->nama_sub_divisi.", Senilai Rp ".number_format($biaya_utuh);
    
            //insert ke message
            $arr_message = array(
                'id_divisi' => Auth::user()->id_divisi,
                'id_auth' => Auth::user()->id,
                'message' => $message,
                'read_status' => 1,
                'status_approve' => 1,
                'id_request' => $get_id_new[0]->id,
            );
            // inst message
            DB::table('message')->insert($arr_message);
            //send mail
            $getDas = DB::table('master_user')->where('id_divisi', '=', Auth::user()->id_divisi)->where('role', '=', 1)->get();
            foreach($getDas as $val){
                $getNameDivForSubject = "Informasi Request Budget ".$getNameDiv[0]->nama_divisi;
                $details = [
                    'title' => $getNameDiv[0]->nama_divisi,
                    'request_id' => $id_request,
                    'body' => $message,
                ];
                // dd(Mail::to('test'));
                // Mail::to('ardiyanputra95@gmail.com')->send(new MessageInfo($details, $getNameDivForSubject));
                Mail::to($val->email)->send(new MessageInfo($details, $getNameDivForSubject));
            }
            //endsendmail
    
            return array(
                'status' => 200,
                'message' => 'Berhasil Proses Budget Baru',
            );
        }catch(\Exception $e){
            \Log::info($e->getMessage());
            abort(404);
            return false;
        }
    }

    public function dataRequest(){
        $role = Auth::user()->role;
        $employeeID = Auth::user()->id;
        $idDivisi = Auth::user()->id_divisi;
        $dataRequest = global_model::getRequest($role, $employeeID, $idDivisi);
        return view('pages/data-request-budget', compact('dataRequest'));
    }

    public function request_new_ya(Request $request){

        //cek periode
        $dateNow = date('Y-m-d');
        $cek = DB::select("SELECT * from master_budget mb where periode_from <= '$dateNow' and periode_end >= '$dateNow'");
        if(count($cek) <= 0){
            return array(
                'status'    => 500,
                'message'   => 'Request Budget Kadaluarsa' 
            );  
        }

        try{
            //replace
            $replace_num = str_replace(',','',$request->nilai_biaya);
            $nama_pengusul          = Auth::user()->username;
            $jabatan                = '';
            if(!empty($request->jabatan)){
                $jabatan            = $request->jabatan;
            }
            $id_sb_breakdown2       = "";
            if(!empty($request->id_sb_breakdown2)){
                $id_sb_breakdown2       = $request->id_sb_breakdown2;
            }
            $untuk_pembayaran       = $request->untuk_biaya;
            $nilai_pembayaran       = (int)$replace_num;
            $keterangan             = $request->keterangan;
            $periode_ex             = explode(' - ',$request->daterange);
            $periode_awal           = trim($periode_ex[0]);
            $periode_akhir          = trim($periode_ex[1]);
            $periodFromEx           = explode('/', $periode_awal);
            $periode_awal           = $periodFromEx[1].'-'.$periodFromEx[0].'-'.$periodFromEx[2];
            $periodEndEx            = explode('/',$periode_akhir);
            $periode_akhir          = $periodEndEx[1].'-'.$periodEndEx[0].'-'.$periodEndEx[2];

            //generate request
            $auth_given = Auth::user()->id_divisi;
            $search_name = DB::table('master_divisi')->where('id_divisi','=',$auth_given)->get();
            $spesifik_name = $search_name[0]->nama_divisi;
            $sub_str = substr($spesifik_name, 0 ,2);

            $get_id_new = DB::select("SELECT case when max(id) is null then 1 else max(id) + 1 end id from data_request_budget");
            $id_request = strtoupper($sub_str).date('d').date('m').$get_id_new[0]->id.date('y');

            if($request->berkas){
                $file_pendukung         = $request->berkas;
                $file_ori               = $file_pendukung->getClientOriginalName();
                $string                 = uniqid(rand());
                $randomString           = substr($string, 0, 8);
                $file_rename            = $randomString."-".str_replace(' ', '-', $file_ori);
                $file_size              = $file_pendukung->getSize();
                
                if($file_size <= 2048000){
                    $arr_param = array(
                        'id'                    => $get_id_new[0]->id,
                        'id_divisi'             => Auth::user()->id_divisi,
                        'id_jabatan'            => Auth::user()->id_jabatan,
                        'employee_id'           => Auth::user()->id,
                        'filename'              => $file_rename,
                        'path'                  => $this->path.'document/'.$file_rename,
                        'request_date'          => date('Y-m-d'),
                        'periode_from'          => date('Y-m-d', strtotime($periode_awal)),
                        'periode_end'           => date('Y-m-d', strtotime($periode_akhir)),
                        'pembiayaan'            => $untuk_pembayaran,
                        'nilai_pembiayaan'      => $nilai_pembayaran,
                        'keterangan'            => $keterangan,
                        'status'                => '0',
                        'id_request'            => $id_request, 
                        'child'                 => $id_sb_breakdown2,
                    );
                    $insertBerkas = global_model::insertBerkas($arr_param);
                    if($insertBerkas){
                        $saveFile = $file_pendukung->move($this->path . 'document/' , $file_rename);
                    }else{
                        return array(
                            'status'    => 500,
                            'message'   => $insertBerkas, 
                        );
                    }
                    //message
                    $getNameDiv = DB::table('master_divisi')->where('id_divisi','=',Auth::user()->id_divisi)->get();
                    $getNameDivSub = DB::table('master_sub_divisi')->where('id_sub_divisi','=',Auth::user()->id_sub_divisi)->get();
                    $message = "Request Budget dengan id : ".$id_request." Masuk Pada Tanggal ".date('d-m-Y').", Divisi  : ".$getNameDiv[0]->nama_divisi.", Breakdown : ".$getNameDivSub[0]->nama_sub_divisi.", Senilai Rp ".number_format($nilai_pembayaran);

                    //insert ke message
                    $arr_message = array(
                        'id_divisi' => Auth::user()->id_divisi,
                        'id_auth' => Auth::user()->id,
                        'message' => $message,
                        'read_status' => 1,
                        'status_approve' => 1,
                        'id_request' => $get_id_new[0]->id,
                    );
                    // inst message
                    DB::table('message')->insert($arr_message);
                    
                    //send mail
                    $getDas = DB::table('master_user')->where('id_divisi', '=', Auth::user()->id_divisi)->where('role', '=', 1)->get();
                    foreach($getDas as $val){
                        $getNameDivForSubject = "Informasi Request Budget ".$getNameDiv[0]->nama_divisi;
                        $details = [
                            'title' => $getNameDiv[0]->nama_divisi,
                            'request_id' => $id_request,
                            'body' => $message,
                        ];
                        // Mail::to('reusmanasujani@gmail.com')->send(new MessageInfo($details, $getNameDivForSubject));
                        Mail::to($val->email)->send(new MessageInfo($details, $getNameDivForSubject));
                    }
                    //endsendmail

                    return array(
                        'status'    => 200,
                        'message'   => 'Success Request Budget Baru' 
                    );
                }else{
                    return array(
                        'status'    => 500,
                        'message'   => 'Ukuran File Lebih 2Mb' 
                    );
                }
            }
        }catch(\Exception $e){
            return array(
                'status'    => 500,
                'message'   => 'Gagal Request Budget Baru' 
            );   
        }
    }
}