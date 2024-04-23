<?php

namespace App\Http\Controllers;

use App\Models\global_model;
use Illuminate\Http\Request;
use DB;
use Alert;
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
                    return view('dashboard');
                break;
    
                case 'budget':
                    return view('pages/master-budget', compact('dataJabatan', 'dataDivisi', 'dataUser', 'menu', 'dataBudget'));
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
        $dataBudget = DB::select("
            select * from master_budget mb 
            join master_divisi md on md.id_divisi = mb.id_divisi
        ");

        return $dataBudget;
    }

    public function saveData(Request $request){
        $menu = $request->dataMenu;

        switch($menu){
            case 'user':
                $originPass = explode('@', $request->email);
        
                $username   = $request->username;
                $role       = $request->role;
                $jabatan    = $request->jabatan;
                $divisi     = $request->divisi;
                $email      = $request->email;
                $ori_pass   = 'tmc12345';
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

                $params = [
                    'divisi_name'   => $division,
                    'url'           => str_replace(' ','-', $division),
                    'status'        => $status
                ];

            break;

            case 'divisi_update':
                $id         = $request->id;
                $division   = $request->division;
                $status     = $request->status;

                $parms_int = [
                    'divisi_name'   => $division,
                    'status'        => $status
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
                $params_ins_sub = array(
                    'id_breakdown'     => $get_id_break_budget,
                    'id_budget'        => $id_budget,
                    'id_divisi'        => $id_divisi,
                    'id_sub_divisi'    => $request->add_budget_master_sub,
                    'amount'           => $request->amount_add_sub,
                    'created_date'     => now(),
                ); 

            break;

            case 'budget_post':
                $id_budget      = global_model::getId($menu);
                $id_divisi      = $request->divisi;
                $amount         = $request->amount;
                $status_up      = 'insert';
                // check amount 
                $check_amount = global_model::check_amount($id_divisi);
                if(count($check_amount) > 0){
                    $status_up = 'update';
                }
                $get_amount_pas = (int)$check_amount[0]->amount + (int)$amount;
                // dd($get_amount_pas);
                $params = [
                    'status_up'     => $status_up,
                    'id_budget'     => $id_budget[0]->id_budget,
                    'id_divisi'     => $id_divisi,
                    'amount'        => $get_amount_pas,
                    'status'        => 'Active',
                    'created_date'  => now(),
                ];

            break;

            case 'budget_update_divisi':
                $id_budget      = $request->id;
                $id_divisi      = $request->divisi;
                $amount_e       = $request->amount;
                $amount_replace = str_replace(',','',$amount_e);
                $explode_amount = explode('.',$amount_replace);
                $amount         = $explode_amount[0];

                $params_z = [
                    'id_divisi'     => $id_divisi,
                    'amount'        => $amount,
                    'updated_date'  => now(),
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
                $amount_sub  = (int)$request->amount_add_sub;
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

    public function DeleteUser($idDivisi){
        $getData = global_model::DeleteUser($idDivisi);
        return $getData;
    }

    public function DeleteBudget($idDivisi){
        $getData = global_model::DeleteBudget($idDivisi);
        return $getData;
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

    public function getforeditSubdivisi($id){
        $stsActive = 'Active';
        $dataUser = global_model::getforeditSubdivisi($id,$stsActive);
        return $dataUser;
    }

    public function getDetailBudget($id){
        $stsActive = 'Active';
        $dataUser = global_model::getDetailBudget($id,$stsActive);
        return $dataUser;
    }

    public function getDetailRequestBudget($id){
        $dataUser = global_model::getDetailRequestBudget($id);
        return $dataUser;   
    }

    public function getSubDivisi($id){
        return global_model::getSubDivisi($id);
    }

    public function Approve(Request $request){
        $jenis = $request->jenis;
        $id = $request->id;

        if($jenis == 'kadiv'){
            return global_model::ApproveKadiv($id);
        }else if ($jenis == 'admin'){
            $approve = global_model::ApproveAdmin($id);
            if($approve){
                //pengurangan budget
                $check_budget = global_model::CheckBudgetRequest($id);
                if($check_budget[0]->biaya < 0){
                    return array(
                        'status' => 500,
                        'message' => 'Gagal Approve, Budget Kurang'
                    );
                }
                //update Budget breakdown
                return global_model::UpdateBudgetRequestBreakdown((int)$check_budget[0]->id_breakdown, $check_budget[0]->biaya);
            }
        }
    }

    
}
