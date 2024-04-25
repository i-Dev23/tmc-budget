<?php

namespace App\Http\Controllers;

use App\Models\global_model;
use Illuminate\Http\Request;
use DB;
use Alert;
use App\Mail\SendMailNew;
use App\Mail\MessageInfo;
use Illuminate\Support\Facades\Mail;
use Auth;


class Master extends Controller
{
    public function index($menu){
        if(Auth::user()->role == '2'){
            $stsActive = 'Active';
            $dataUser = global_model::getGlobalDataUser();
            $dataJabatan = global_model::getGlobalData('master_jabatan', $stsActive);
            $dataDivisi = global_model::getGlobalData('master_divisi', $stsActive);
            $dataSubDivisi = global_model::getGlobalData('master_sub_divisi');
            $dataRole = global_model::getDataRole();
            // $dataBudget = global_model::getGlobalData('master_budget');
            $dataBudget = $this->getDataBudget();
            $dataSubDivision = global_model::dataSubDivision();
            
            switch ($menu){
                case 'user':
                    return view('pages/master-user', compact('dataJabatan', 'dataDivisi', 'dataUser', 'menu', 'dataRole','dataSubDivision'));           
                break;
    
                case 'division':
                    return view('pages/master-division', compact('dataJabatan', 'dataDivisi', 'dataSubDivisi', 'dataUser', 'menu'));           
                break;
    
                case 'brand':
                    $getsubBreakdown = global_model::givensubbreakdown();
                    return view('pages/report-budget_sub_breakdown', compact('getsubBreakdown','dataBudget'));
                break;
    
                case 'budget':
                    return view('pages.master-budget', compact('dataJabatan', 'dataDivisi', 'dataUser', 'menu', 'dataBudget'));
                break;
    
                // case 'breakdown':
                //     return view('pages/master-breakdown', compact('dataJabatan', 'dataDivisi', 'dataUser', 'menu', 'dataBudget'));
                // break;
    
            }
        }else{
            return redirect()->route('dashboard');
        }
    }

    public function getDataBudget(){
        // select * from master_budget mb 
        // join master_divisi md on md.id_divisi = mb.id_divisi
        $dataBudget = DB::select("SELECT mb.*, md.*, case when mb.periode_from <= cast(now() as date) and mb.periode_end >= cast(now() as date) then 'tersedia' else '' end datenow
        from master_budget mb join master_divisi md on md.id_divisi = mb.id_divisi");

        return $dataBudget;
    }

    public function saveData(Request $request){
        \Log::info($request->all());
        $menu = $request->dataMenu;
        \Log::info($menu);
        // dd($menu);
        switch($menu){
            case 'user':
                $originPass = explode('@', $request->email);
        
                $username   = $request->username;
                $role       = $request->role;
                $jabatan    = $request->jabatan;
                $divisi     = $request->divisi;
                $email      = $request->email;
                $ori_pass   = 'tmc2023';
                $pass       = bcrypt($ori_pass);

                if($role == '3'){
                    $params = [
                        'username'      => $username,
                        'role'          => $role,
                        'jabatan'       => $jabatan,
                        'divisi'        => $divisi,
                        'email'         => $email,
                        'ori_pass'      => $ori_pass,
                        'pass'          => $pass,
                        'created_at'    => date('Y-m-d'),
                        'updated_at'    => date('Y-m-d'),
                        'id_sub_divisi' => $request->subDivisi,
                    ];
                }else{
                    $params = [
                        'username'      => $username,
                        'role'          => $role,
                        'jabatan'       => $jabatan,
                        'divisi'        => $divisi,
                        'email'         => $email,
                        'ori_pass'      => $ori_pass,
                        'pass'          => $pass,
                        'created_at'    => date('Y-m-d'),
                        'updated_at'    => date('Y-m-d'),
                    ];
                }
            break;

            case 'divisi':
                $division   = $request->division;
                $status     = $request->status;
                $type       = $request->type;

                $params = [
                    'divisi_name'   => $division,
                    'url'           => str_replace(' ','-', $division),
                    'status'        => $status,
                    'type'        => $type,

                ];

            break;

            case 'divisi_update':
                $id         = $request->id;
                $division   = $request->division;
                $status     = $request->status;
                $type_edit  = $request->type_edit;

                $parms_int = [
                    'divisi_name'   => $division,
                    'status'        => $status,
                    'type_edit'     => $type_edit,
                ];
                $params = [
                    'id'        => $id,
                    'parms_int' => $parms_int
                ];

                $get_id = global_model::selectId($division);
                $params_sub_divisi = [];
                $generate_url_test = str_replace(' ','-',$request->breakdown);
                $generate_replace = str_replace("'","",$generate_url_test);
                $generate_url = strtolower($generate_replace);
                if($request->breakdown != ""){
                    $params_sub_divisi = [
                        'nama_sub_divisi' => $request->breakdown,
                        'url'             => $generate_url,
                        'status'          => $status,
                        'id_divisi'       => $get_id[0]->id_divisi,
                    ];
                }
                // dd($params_sub_divisi);

                // $insDataUpdate = global_model::UpdateDataDivisi($params);

            break;

            case 'user_update':
                $id             = $request->id_user;
                $username       = $request->username_edit;
                $id_jabatan     = $request->jabatan_edit;
                $id_divisi      = $request->divisi_edit;
                $role           = $request->role_edit;
                $email          = $request->email_edit;

                if($role == '3'){
                    $data_arr = [
                        'username'     => $username,
                        'id_jabatan'   => $id_jabatan,
                        'id_divisi'    => $id_divisi,
                        'role'         => $role,
                        'email'        => $email,
                        'updated_at'   => now(),
                        'id_sub_divisi'=> $request->sub_divisi,
                    ];
                }else{
                    $data_arr = [
                                    'username'     => $username,
                                    'id_jabatan'   => $id_jabatan,
                                    'id_divisi'    => $id_divisi,
                                    'role'         => $role,
                                    'email'        => $email,
                                    'updated_at'   => now(),
                                    'id_sub_divisi'=> null,
                                ];
                }
                $params = array(
                    "id" => $id,
                    "data" => $data_arr,
                );

                $get_id = global_model::getId($menu);

            break;

            case 'budget_update':
                $id_budget      = $request->id_budget;
                $id_divisi      = $request->division_temp;
                $amount         = $request->sisa_hasil;

                $params_z = [
                    'id_divisi'     => $id_divisi,
                    'amount'        => $amount,
                    'updated_date'  => now(),
                ];

                $params = array(
                    'id'    => $id_budget,
                    'data'  => $params_z,
                );

                //insert to master sub budget
                $getIdBudgetBreakdown = global_model::getId($menu);
                $get_id_break_budget = $getIdBudgetBreakdown[0]->id_breakdown;
                $replca_amount = str_replace(',','',$request->amount_add_sub);
                $params_ins_sub = array(
                    'id_breakdown'     => $get_id_break_budget,
                    'id_budget'        => $id_budget,
                    'id_divisi'        => $id_divisi,
                    'id_sub_divisi'    => $request->add_budget_master_sub,
                    'amount'           => $replca_amount,
                    'created_date'     => now(),
                );

                $arr_sub_name = [];
                $temp_name_budget = [];
                //update to sub breakdown jika ada
                if(!empty($request->arr_sub_breaakdown) && !empty($request->arr_budget)){
                    for($l=0; $l<count($request->arr_sub_breaakdown); $l++){
                        $name_sub = $request->arr_sub_breaakdown[$l];
                        $amount_sub = $request->arr_budget[$l];
                        $strReplace = str_replace(',','',$amount_sub);
                        if($name_sub && $amount_sub){
                            if(isset($arr_sub_name[$name_sub])){
                                $arr_sub_name[$name_sub][] = array(
                                    "amount" => (int)$strReplace,
                                );
                            }else{
                                $arr_sub_name[$name_sub][] = array(
                                    "amount" => (int)$strReplace,
                                );
                            }
                        }
                    }
                }

                $noBreak = 0;
                if(count($arr_sub_name) > 0){
                    foreach($arr_sub_name as $key => $value){
                        $budget_sub_break = 0;
                        $getIdBudgetBreakdown = global_model::getIdSubBreakdown($id_divisi, $request->add_budget_master_sub, $key);
                        if(count($arr_sub_name[$key]) > 0){
                            for($num = 0; $num<count($arr_sub_name[$key]); $num++){
                                $budget_sub_break += $arr_sub_name[$key][$num]["amount"];
                            }
                            $temp_name_budget[] = array(
                                "id" => $getIdBudgetBreakdown[0]->id,
                                "nama_sub_breakdown" => $key,
                                "id_budget" => $id_budget,
                                "amount" => $budget_sub_break,
                                "updated_date" => now(),
                            );
                        }else{
                            $temp_name_budget[] = array(
                                "id" => $getIdBudgetBreakdown[0]->id,
                                "nama_sub_breakdown" => $key,
                                "id_budget" => $id_budget,
                                "amount" => $value[0]['amount'],
                                "updated_date" => now(),
                            );
                        }
                    }
                }

            break;

            case 'budget_post':
                $id_budget      = global_model::getId($menu);
                $id_divisi      = $request->divisi;
                $str_amount     = str_replace(',','',$request->amount);
                $amount         = $str_amount;
                $status_up      = 'insert';
                $dateRange      = explode('-', $request->periode);
                $dateFrom       = date('Y-m-d', strtotime(str_replace(' ', '', $dateRange[0])));
                $dateEnd        = date('Y-m-d', strtotime(str_replace(' ', '', $dateRange[1])));

                // \Log::info("Reusmana");
                //deleteTempJikaUse
                // $givenTempAll = DB::table('temp_budget_all')->where('id','=','1')->get();
                // $amountTempAll = (int)$givenTempAll[0]->amount;

                // if($request->checkBox == 'true'){
                //     $temp_Update = 0;
                //     if($amountTempAll < (int)$amount){
                //         $temp_Update = 0;
                //         \Log::info("sisa nya 0 yaa ".$temp_Update);
                //     }else{
                //         $temp_Update = $amountTempAll - (int)$amount;
                //         \Log::info("sisa nya banyak yaa ".$temp_Update);
                //     }

                //     DB::table('temp_budget_all')->where('id','=','1')->update(['amount' => $temp_Update]);
                // }


                $getNameDivisi = DB::table('master_divisi')->where('id_divisi', '=', $id_divisi)->get();
                $params_ins_temmp = [
                    'id_divisi'     => $id_divisi,
                    'nama_divisi'   => $getNameDivisi[0]->nama_divisi,
                    'amount'        => $amount,
                    'periode_from'	=> $dateFrom,	
                    'periode_end'	=> $dateEnd,
                    'created_date'  => now(),
                ];

                DB::table('log_master_budget')->insert($params_ins_temmp);

                // check amount 
                $check_amount = global_model::check_amount($id_divisi);
                $get_amount_pas = (int)$amount;
                if(count($check_amount) > 0){
                    $status_up = 'update';
                    $get_amount_pas = (int)$check_amount[0]->amount + (int)$amount;
                }
                // dd($get_amount_pas);
                $params = [
                    'status_up'     => $status_up,
                    'id_budget'     => $id_budget[0]->id_budget,
                    'id_divisi'     => $id_divisi,
                    'amount'        => $get_amount_pas,
                    'status'        => 'Active',
                    'dateFrom'      => $dateFrom,
                    'dateEnd'       => $dateEnd,
                    'created_date'  => now(),
                ];
                // dd($params);
            break;

            case 'budget_update_divisi':
                $id_budget      = $request->id;
                $id_divisi      = $request->divisi;
                $amount_e       = $request->amount;
                $amount_replace = str_replace(',','',$amount_e);
                $explode_amount = explode('.',$amount_replace);
                $amount         = $explode_amount[0];
                $dateRangeedit      = explode('-', $request->periode_edit);
                $dateFromEdit       = date('Y-m-d', strtotime(str_replace(' ', '', $dateRangeedit[0])));
                $dateEndEdit        = date('Y-m-d', strtotime(str_replace(' ', '', $dateRangeedit[1])));

                $params_z = [
                    'id_divisi'     => $id_divisi,
                    'amount'        => $amount,
                    'updated_date'  => now(),
                    'periode_from'  => $dateFromEdit,
                    'periode_end'   => $dateEndEdit,
                ];

                $params = array(
                    'id'    => $id_budget,
                    'data'  => $params_z,
                );

            break;

            case 'budget_sub_update':
                $id_budget   = $request->id_budget;
                $id_sub      = $request->id_sub;
                $id_divisi   = $request->id_budget_divisi;
                $amount_e    = $request->amount_edit;
                $amount_tes  = str_replace(',','',$amount_e);
                $amount      = $amount_tes;
                $to_replac   = str_replace(',','',$request->amount_add_sub);
                $amount_sub  = (int)$to_replac;
                $amount_str  = (string)$amount_sub;

                $params_z = [
                    'amount'        => $amount,
                    'updated_date'  => now(),
                ];

                $params = array(
                    'id_budget'    => $id_budget,
                    'data'  => $params_z,
                );

                $params_x = [
                    'amount' => $amount_str,
                    'updated_date' => now(),
                ];

                $params_sub = array(
                    'id_sub_divisi' => $id_sub,
                    'data'          => $params_x,
                );

                $getIdBudgetBreakdown = global_model::getId($menu);
                $get_id_break_budget = $getIdBudgetBreakdown[0]->id_breakdown;
                $params_ins_sub = array(
                    'id_breakdown'     => $get_id_break_budget,
                    'id_budget'        => $id_budget,
                    'id_divisi'        => $id_divisi,
                    'id_sub_divisi'    => $id_sub,
                    'amount'           => $amount_str,
                    'created_date'     => now(),
                );  

            break;
        }

        if($menu == "divisi_update"){
            $updData = global_model::UpdateData($params, $menu);
            if(count($params_sub_divisi) > 0){
                $insDivisisub = global_model::insertData($params_sub_divisi, $menu);   
            }
        } else if($menu == "user_update" || $menu == "budget_update" || $menu == "budget_update_divisi"){
            $updData = global_model::UpdateData($params, $menu);
            if ($menu == "budget_update"){
                $upTdateBudget = global_model::UpdateDataBudget($params_ins_sub);
                if(!empty($request->arr_sub_breaakdown) && !empty($request->arr_budget)){
                    foreach($temp_name_budget as $given){
                        $upTdateBudgetSubBreakdown = global_model::UpdateDataSubBudgetBreakdown($given['id'],$given['id_budget'],$given['amount']);
                    }
                }
            }
        } else if($menu == "budget_sub_update"){
            $upBudgetSub = global_model::UpdateDataBudgetSub($params, $params_sub, $params_ins_sub);
        }else {
            $insData = global_model::insertData($params, $menu);
        }
        return redirect()->back()->with('status', 'Profile updated!');
    }

    public function getDetailDivisi($idDivisi){
        $getData = global_model::getDataDetail($idDivisi);
        
        return $getData;
    }

    public function DeleteDivisi($idDivisi){
        $getData = global_model::DeleteDivisi($idDivisi);
        return $getData;
    }

    public function status_update($idDivisi){
        $getData = global_model::status_update($idDivisi);
        return $getData;
    }

    public function status_update_sub($idDivisi){
        $getData = global_model::status_update_sub($idDivisi);
        return $getData;
    }

    public function cek_child_sub_breakdown($id){
        $getData = global_model::cek_child_sub_breakdown($id);
        return $getData;
    }

    public function DeleteUser($idDivisi){
        $getData = global_model::DeleteUser($idDivisi);
        return $getData;
    }

    public function DeleteBudget($idDivisi){
        $getData = global_model::DeleteBudget($idDivisi);
        return $getData;
    }
    
    public function CheckBudgetTemp($idDivisi){
        $getData = global_model::CheckBudgetTemp($idDivisi);
        return $getData;
    }

    public function CheckBudgetTrans($idDivisi, $idSubDivisi){
        $getData = global_model::CheckBudgetTrans($idDivisi, $idSubDivisi);
        $getDataBudget = [
            'idBudget' => $getData[0]->id_breakdown,
            'amount' => $getData[0]->amount
        ];
        return $getDataBudget;
    }

    public function getSubBreakdownTrans($idSubBreakdown){
        $getData = global_model::getSubBreakdownTrans($idSubBreakdown);
        for($i=0; $i<count($getData); $i++){
            $getSubBreakdown[] = [
                'id_break' => $getData[$i]->id,
                'nm_sub_break' => $getData[$i]->nama_sub_breakdown,
                'amount' => $getData[$i]->amount
            ];
        }
        return $getSubBreakdown;
    }

    public function cekDataTransferDivisi($idDataDivisi){
        $getDataBreakdown = global_model::getDataBreakdown($idDataDivisi);

        for($i=0; $i < count($getDataBreakdown); $i++){
            // $dataSubDivisi[] = $getDataBreakdown[$i]->id_sub_divisi;

            $dataSubDivisi[] = [
                'idDivisi' => $getDataBreakdown[$i]->id_divisi,
                'idSubDivisi' => $getDataBreakdown[$i]->id_sub_divisi,
                'namaSubDivisi' => $getDataBreakdown[$i]->nama_sub_divisi
            ];
        }

        return $dataSubDivisi;
    }

    public function saveTransferBudget(Request $request){
        
        $idDivisiOri = explode('|^|', $request->id_data_trans);
        $idBreakdown = explode('|^|', $request->breakdownBudget);
        $idSubBreakdown = explode('|^|', $request->idSubBreakdown);
        $sumTransfer = 0;

        $idDivisiOrigin     = $idDivisiOri[1];
        $idBudgetOrigin     = $request->idOriginBudget;
        $idSubBreakOrigin   = $idSubBreakdown[0];
        
        $namaDivisiFrm         = $idDivisiOri[3];
        $namaSubDivisiFrm      = $idDivisiOri[4];
        $namaSubChildDivisiFrm = $idSubBreakdown[2];

        // $amountBreakdown   = $idSubBreakdown[1];
        $sisaBudget         = $request->sisaBudget;
        $amountTransbudget  = $request->amount_trans;
        $amountTransSub     = $request->amount_trans_sub;


        // transfer ke
        $idDivisi           = $request->divisi_temp_trans;
        $idBreakDown        = $idBreakdown[1];
        $id_subBreakDown    = $request->breakdownSubBudget;
        $getResultTo        = global_model::DetailTransTo($idDivisi, $idBreakDown, $id_subBreakDown);
        $namaDivisiTo         = $getResultTo[0]->nama_divisi;
        $namaSubDivisiTo      = $getResultTo[0]->nama_sub_divisi;
        $namaSubChildDivisiTo = $getResultTo[0]->nama_sub_breakdown;
        $newTrans = "";
        
        if ($id_subBreakDown == NULL || $id_subBreakDown == "") {
            // $getNameDivisi = DB::select("select md.nama_divisi, msd.nama_sub_divisi from master_divisi md left join master_sub_divisi msd on md.id_divisi = msd.id_divisi where 1=1 and md.id_divisi = '$idDivisi' and msd.id_sub_divisi = '$idBreakDown'");
            $getDataBreakdown = DB::select("select * from breakdown_budget bb where 1=1 and id_divisi = '$idDivisi' and id_sub_divisi = '$idBreakDown'");
            if ($getDataBreakdown == NULL || $getDataBreakdown == ""){
                
                $newTrans = "new";
                $budgetTransfer = $amountTransbudget == NULL || $amountTransbudget == "" ? $amountTransSub : $amountTransbudget;
                $sumTransfer = $amountTransbudget == NULL || $amountTransbudget == "" ? $amountTransSub : $amountTransbudget;
                
            }else{
                $budgetTransfer = $amountTransbudget == NULL || $amountTransbudget == "" ? $amountTransSub : $amountTransbudget;
                $sumTransfer = $amountTransbudget == NULL || $amountTransbudget == "" ? $getDataBreakdown[0]->amount + $amountTransSub : $getDataBreakdown[0]->amount + $amountTransbudget;
            
            }

        }else{
            $getDataSubBreakdown = DB::select("select * from sub_breakdown where 1=1 and id = '$id_subBreakDown'");
            if($amountTransbudget == NULL || $amountTransbudget == ""){
                $budgetTransfer = $amountTransSub;
                $sumTransfer = $getDataSubBreakdown[0]->amount + $amountTransSub;
            }else{
                $budgetTransfer = $amountTransbudget;
                $sumTransfer = $getDataSubBreakdown[0]->amount + $amountTransbudget;
            }
        }
        $params = [
            'idDivisiOrigin'     => $idDivisiOrigin,
            'id_BudgetOrigin'    => $idBudgetOrigin,
            'id_subBreakOrigin'  => $idSubBreakOrigin,
            'namaDivisiFrm'         => $namaDivisiFrm,
            'namaSubDivisiFrm'      => $namaSubDivisiFrm,
            'namaSubChildDivisiFrm' => $namaSubChildDivisiFrm,
            'budgetAwal'         =>  $sisaBudget + $budgetTransfer,
            'sisa_budget'        => $sisaBudget,
            'tot_transfer'       => $sumTransfer,
            'new_trans'          => $newTrans,
            //transfer ke
            'namaDivisiTo'         => $namaDivisiTo,
            'namaSubDivisiTo'      => $namaSubDivisiTo,
            'namaSubChildDivisiTo' => $namaSubChildDivisiTo,
            'idBudget'           => $idDivisi,
            'idDivisi'           => $idDivisi,
            'idBreakdown'        => $idBreakDown,
            'idSubBreakdown'     => $id_subBreakDown
        ];
        
        if ($id_subBreakDown == NULL || $id_subBreakDown == "") {
            $insUptTransfer = global_model::insUptTransferBreakdown($params);
        }else{
            $insUptTransfer = global_model::insUptTransferSubBreakdown($params);
        }

        if($insUptTransfer > 0){
            $insLogTransfer = global_model::insLogTrans($params);
        }

        return $insLogTransfer;
        
    }

    public function cekSubBreakdownTransfer($idDataSubDivisi){
        $params = explode('|^|', $idDataSubDivisi);
        $idDivisi = $params[0];
        $idSubDivisi = $params[1];
        $getDataSubBreakdown = global_model::getDataSubBreakdown($idDivisi, $idSubDivisi);
        // dd($getDataSubBreakdown);

        for($i=0; $i < count($getDataSubBreakdown); $i++){
            // $dataSubDivisi[] = $getDataBreakdown[$i]->id_sub_divisi;

            $dataSubBreakdown[] = [
                'idData' => $getDataSubBreakdown[$i]->id,
                'idDivisi' => $getDataSubBreakdown[$i]->id_divisi,
                'idSubDivisi' => $getDataSubBreakdown[$i]->id_sub_divisi,
                'namaSubBreakdown' => $getDataSubBreakdown[$i]->nama_sub_breakdown
            ];
        }

        return $dataSubBreakdown;
    }

    public function DeleteBudgetSub($idDivisi){
        $getData = global_model::DeleteBudgetSub($idDivisi);
        return $getData;
    }

    public function getForEdit(){
        $stsActive = 'Active';
        $dataUser = global_model::getGlobalDataUser();
        $dataJabatan = global_model::getGlobalData('master_jabatan', $stsActive);
        $dataDivisi = global_model::getGlobalData('master_divisi', $stsActive);
        $dataRole = global_model::getDataRole();
        $dataSubDivision = global_model::dataSubDivision();
        $result = array(
            'data_user' => $dataUser,
            'data_jabatan' => $dataJabatan,
            'data_divisi' => $dataDivisi,
            'data_role' => $dataRole,
            'data_sub' => $dataSubDivision,
        );
        return $result;
    }

    public function getForEditWithParams($params){
        return array(
          'data_sub' =>  global_model::dataSubDivisionWithParams($params),
        ); 
            
    }

    public function getforeditSubdivisi($id){
        $stsActive = 'Active';
        $dataUser = global_model::getforeditSubdivisi($id,$stsActive);
        return $dataUser;
    }

    public function getDetailBudget($id){
        $stsActive = 'Active';
        $dataUser = global_model::getDetailBudget($id,$stsActive);
        // dd($dataUser);
        return $dataUser;
    }

    public function getDetailBudgetNew($idDivisi){
        $query = DB::select("SELECT 
                (select sum(sb.amount) from sub_breakdown sb left join master_budget mb on mb.id_divisi = sb.id_divisi where 1=1 and sb.id_divisi = '$idDivisi') cok, 
                mb.id_budget,
                mb.amount budget_all,
                md.nama_divisi,
                msd.nama_sub_divisi

            from master_budget mb
            left join master_divisi md on md.id_divisi = mb.id_divisi 
            left join master_sub_divisi msd on msd.id_divisi = md.id_divisi
            where 1=1 
            and mb.id_divisi = '$idDivisi'
            group by mb.id_budget 
        ");
        return $query;
    }

    public function getDetailRequestBudget($id){
        $dataUser = global_model::getDetailRequestBudget($id);
        return $dataUser;   
    }

    public function getSubDivisi($id){
        return global_model::getSubDivisi($id);
    }

    public function Rename(Request $request){
        $id = $request->id;
        $name = $request->name;
        $arr_child = $request->child;
        try{
            $inst = global_model::Rename($id, $name);
            $get_sub_divisi = global_model::getSubDivisiBreakdown($id);
            $arr_insert = [];
            // /insert sub breakdown
            if(!empty($arr_child)){
                foreach($arr_child as $value){
                    if($value != ""){
                        $arr_insert[] = array(
                            'id_divisi' => $get_sub_divisi[0]->id_divisi,
                            'id_sub_divisi' => $get_sub_divisi[0]->id_sub_divisi,
                            'nama_sub_breakdown' => $value,
                            'amount' => 0,
                            'status' => 'Active',
                            'created_date' => now(),
                        );
                    }
                }
            }
            if(count($arr_insert) > 0){
                global_model::insertSubBreakdown($arr_insert);
            }
        }catch(\Exception $e){
            return false;
        }
    }

    public function ListDetailSubBreakdown(Request $request){
        $id_sub_divisi = $request->division;
        $get_sub_divisi = global_model::getSubDivisiBreakdownList($id_sub_divisi);
        return $get_sub_divisi;
    }

    public function ListDetailSubBreakdownBudget(Request $request){
        $id_sub_divisi = $request->division;
        $get_sub_divisi = global_model::getSubDivisiBreakdownListBudget($id_sub_divisi);
        return $get_sub_divisi;
    }

    public function updateSubBreakdown(Request $request){
        try{
            $id = $request->id;
            //getidbreakdownbudget
            $get_sub_divisi = global_model::getIDBreakdownListBudget($id);
            $id_breakdown = $get_sub_divisi[0]->id_sub_divisi;
    
            //updatebreakdown
            $arr_pr_breakdown = array(
                "amount" => $request->amount_breakdown,
            );
            global_model::UpdateBudgetBreakdown($id_breakdown, $arr_pr_breakdown);
            //updatesubbreakdown
            $arr_sub_breakdown = array(
                "amount" => $request->amount,
            );
            global_model::UpdateBudgetSubBreakdown($id, $arr_sub_breakdown);
            return true;
        }catch(\Exception $e){
            \Log::info($e->getMessage());
            abort(404);
            return false;
        }
    }

    public function Approve(Request $request){
        $jenis = $request->jenis;
        $id = $request->id;
        $getidreq = DB::table('data_request_budget')->where('id','=',$id)->get();
        $id_request = $getidreq[0]->id_request;

        if($jenis == 'kadiv'){
            $hasilApprove = global_model::ApproveKadiv($id);
            if($hasilApprove){
                $auth_id_req = $request->id;
                $sub_divisi_disp = $request->sub_divisi_disp;
                $budget_req = $request->budget_req;
                $getNameDiv = DB::table('master_divisi')->where('id_divisi','=',Auth::user()->id_divisi)->get();
                $message = "Request Budget Masuk dengan ID : ".$id_request.", Telah Di Approve Kadiv Pada Tanggal ".date('d-m-Y').", Divisi : ".$getNameDiv[0]->nama_divisi.", Senilai Rp ".number_format($budget_req);

                //insert ke message
                $arr_message = array(
                    'message' => $message,
                    'read_status' => 1,
                    'status_approve' => 2,
                );
                // inst message
               DB::table('message')->where('id_request','=',$auth_id_req)->update($arr_message);
               $getDas = DB::table('master_user')->where('role','=','2')->get();
                foreach($getDas as $val){
                    $getNameDivEmail = DB::table('master_divisi')->where('id_divisi','=',Auth::user()->id_divisi)->get();
                    $getNameDivForSubject = "Informasi Approve Budget ".$getNameDiv[0]->nama_divisi;
                    $details = [
                        'title' => $getNameDivEmail[0]->nama_divisi,
                        'request_id' => $id_request,
                        'body' => $message,
                    ];
                    Mail::to($val->email)->send(new MessageInfo($details, $getNameDivForSubject));
                    // Mail::to('reusmanasujani@gmail.com')->send(new MessageInfo($details, $getNameDivForSubject));
                }
                return true; 
            }else{
                \Log::info("masuk ke sini");
                abort(404);
                return false;
            }
        }else if ($jenis == 'admin'){
                //pengurangan budget
                $check_budget = global_model::CheckBudgetRequest($id);
                if($check_budget[0]->biaya < 0){
                    abort(404);
                    return false;
                }
                $approve = global_model::ApproveAdmin($id);
                // update Budget breakdown
                $ck = DB::table("data_request_budget")->where("id", "=", $id)->get();
                if($ck[0]->child == null){
                    global_model::UpdateBudgetRequestBreakdown((int)$check_budget[0]->id_breakdown, $check_budget[0]->biaya);
                }else{
                    global_model::UpdateBudgetRequestSubBreakdown((int)$ck[0]->child, (int)$check_budget[0]->biaya);
                }
                $auth_id_req = $request->id;
                $sub_divisi_disp = $request->sub_divisi_disp;
                $auth_request = $request->auth_request;
                $budget_req = $request->budget_req;
                $getNameDivSub = DB::table('master_user')->where('id','=',$auth_request)->get();
                $getNameDiv = DB::table('master_divisi')->where('id_divisi','=',$getNameDivSub[0]->id_divisi)->get();
                $message = "Request Budget dengan ID : ".$id_request.", Telah Di Approve Kadiv Dan Admin Pada Tanggal ".date('d-m-Y').", Divisi : ".$getNameDiv[0]->nama_divisi.", Senilai Rp ".number_format($budget_req);

                //insert ke message
                $arr_message = array(
                    'message' => $message,
                    'read_status' => 1,
                    'status_approve' => 3,
                );
                // inst message
                DB::table('message')->where('id_request','=',$auth_id_req)->update($arr_message);
                $getDas = global_model::getDashboard();
                foreach($getDas as $val){
                    if((int)$val->persen > 80){
                        $getDas = DB::table('master_user')->where('role','=','2')->get();
                        $getNameDivEmail = DB::table('master_divisi')->where('id_divisi','=',$val->id_divisi)->get();
                        $getNameDivForSubject = "Pemberitahuan Budget Divisi ".$getNameDivEmail[0]->nama_divisi;
                        $details = [
                            'title' => $getNameDivEmail[0]->nama_divisi,
                            'body' => 'Sisa Budget Rp '.number_format($val->sisa). ' dari total budget Rp '.number_format($val->total).', telah di request budget sebanyak Rp '.number_format($val->request),
                        ];
                        Mail::to($getDas[0]->email)->send(new SendMailNew($details, $getNameDivForSubject));
                        // Mail::to('reusmanasujani@gmail.com')->send(new SendMailNew($details));
                    }
                }

                $getDasemail = $getNameDivSub;
                foreach($getDasemail as $value){
                    $getNameDivEmail = DB::table('master_divisi')->where('id_divisi','=',$value->id_divisi)->get();
                    $getNameDivForSubject = "Informasi Approve Budget ".$getNameDiv[0]->nama_divisi;
                    $details = [
                        'title' => $getNameDivEmail[0]->nama_divisi,
                        'request_id' => $id_request,
                        'body' => $message,
                    ];
                    Mail::to($value->email)->send(new MessageInfo($details, $getNameDivForSubject));
                    // Mail::to('reusmanasujani@gmail.com')->send(new MessageInfo($details, $getNameDivForSubject));
                }
                return true; 
        }
    }

    public function Reject(Request $request){
        $jenis = $request->jenis;
        $id = $request->id;
        $id_auth = $request->auth_request;
        //getidrequest
        $getidreq = DB::table('data_request_budget')->where('id','=',$id)->get();
        $id_request = $getidreq[0]->id_request;
        $status = '3';
        $hasilReject = global_model::RejectRequest($id, $status);

        if($jenis == 'kadiv'){
            if($hasilReject){
                $auth_id_req = $request->id;
                $sub_divisi_disp = $request->sub_divisi_disp;
                $budget_req = $request->budget_req;
                $getNameDiv = DB::table('master_divisi')->where('id_divisi','=',Auth::user()->id_divisi)->get();
                $message = "Request Budget dengan ID : ".$id_request." Telah Di Reject Kadiv Pada Tanggal ".date('d-m-Y').", Divisi : ".$getNameDiv[0]->nama_divisi.", Senilai Rp ".number_format($budget_req);

                //insert ke message
                $arr_message = array(
                    'message' => $message,
                    'read_status' => 1,
                    'status_approve' => 3,
                );
                // inst message
                DB::table('message')->where('id_request','=',$auth_id_req)->update($arr_message);
                $getDas = DB::table('master_user')->where('id','=',$id_auth)->get();
                foreach($getDas as $val){
                    $getNameDivEmail = DB::table('master_divisi')->where('id_divisi','=',$val->id_divisi)->get();
                    $getNameDivForSubject = "Informasi Reject Budget ".$getNameDiv[0]->nama_divisi;
                    $details = [
                        'title' => $getNameDivEmail[0]->nama_divisi,
                        'request_id' => $id_request,
                        'body' => $message,
                    ];
                    Mail::to($val->email)->send(new MessageInfo($details, $getNameDivForSubject));
                    // Mail::to('reusmanasujani@gmail.com')->send(new MessageInfo($details, $getNameDivForSubject));
                }
                return true; 
            }
            abort(404);
            return false;
        }else if ($jenis == 'admin'){
            if($hasilReject){
                // update Budget breakdown
                $auth_id_req = $request->id;
                $sub_divisi_disp = $request->sub_divisi_disp;
                $budget_req = $request->budget_req;
                $getNameDivSub = DB::table('master_user')->where('id_sub_divisi','=',$sub_divisi_disp)->get();
                $getNameDiv = DB::table('master_divisi')->where('id_divisi','=',$getNameDivSub[0]->id_divisi)->get();
                $message = "Request Budget dengan ID : ".$id_request." Telah Di Reject Admin Pada Tanggal ".date('d-m-Y').", Divisi : ".$getNameDiv[0]->nama_divisi.", Senilai Rp ".number_format($budget_req);

                //insert ke message
                $arr_message = array(
                    'message' => $message,
                    'read_status' => 1,
                    'status_approve' => 3,
                );
                // inst message
                DB::table('message')->where('id_request','=',$auth_id_req)->update($arr_message);
                $getDas = DB::table('master_user')->where('id','=',$id_auth)->get();
                foreach($getDas as $val){
                    $getNameDivEmail = DB::table('master_divisi')->where('id_divisi','=',$val->id_divisi)->get();
                    $getNameDivForSubject = "Informasi Reject Budget ".$getNameDiv[0]->nama_divisi;
                    $details = [
                        'title' => $getNameDivEmail[0]->nama_divisi,
                        'request_id' => $id_request,
                        'body' => $message,
                    ];
                    Mail::to($val->email)->send(new MessageInfo($details, $getNameDivForSubject));
                    // Mail::to('reusmanasujani@gmail.com')->send(new MessageInfo($details, $getNameDivForSubject));
                }
                return true; 
            }
            abort(404);
            return false;
        }
    }

    public function GetPdfBreakdown(){
        $this->getDetailBudget;
    }

    public function DeleteBudgetSubBreakdown($id){
        //update budget to 0
        //get sub divisi or breakdown
        $getIdDivisi = DB::table('sub_breakdown')->where('id','=',$id)->get();

        $id_sub_divisi = $getIdDivisi[0]->id_sub_divisi;

        $getBudgetSub = DB::table('breakdown_budget')->where('id_sub_divisi', '=', $id_sub_divisi)->get();
        //rollback budget
        $roolback_budget = (int)$getIdDivisi[0]->amount + (int)$getBudgetSub[0]->amount;
        $updateBudgetSubBreakdowns = DB::table('sub_breakdown')->where('id','=',$id)->update(['amount' => 0]);

        $updateBudgetSubBreakdowns = DB::table('breakdown_budget')->where('id_sub_divisi','=',$id_sub_divisi)->update(['amount' => $roolback_budget]);
        return true;
    }

    public function UpdateAndGivenTemp(Request $request){
        \Log::info($request->all());
        $id_divisi = $request->id_divisi;
        $temp_amount = $request->temp_amount;
        $upd_divisi = $request->upd_divisi;
        $given_amount = $request->given_amount;

        try{
            //updateTemp 
            global_model::UpdateTempBudget($temp_amount, $id_divisi);
            
            //getidBudget
            $id_budget_check = global_model::getId('budget_post');
            $id_budget = 1;
            if(count($id_budget_check) > 0){
                $id_budget = $id_budget_check[0]->id_budget;
            }
    
            //cekMasterBudget 
            $checkMasterBudget = global_model::CekMasterBudgetForTemp($upd_divisi);
            if(count($checkMasterBudget) > 0 ){
                $amountTotal = (int)$given_amount + (int)$checkMasterBudget[0]->amount;
                global_model::UpdateMasterBudget($upd_divisi, $amountTotal);
            }else{
                $arrInsertMasterBudget = array(
                    'id_budget' => $id_budget,
                    'id_divisi' => $upd_divisi,
                    'amount' => $given_amount,
                    'status' => 'Active',
                    'periode_from' => now(),
                    'periode_end' => now(),
                    'created_date' => now(),
                );
                global_model::InsetMasterBudget($arrInsertMasterBudget);
            }
            return true;
        }catch(\Exception $e){
            \Log::info($e->getMessage());
            abort(404);
            return false;
        }
    }

    
}
