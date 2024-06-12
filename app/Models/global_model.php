<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Auth;

class global_model extends Model
{

	public static function getId($page){
		if ($page == "user_update"){
			$get_id = DB::select("SELECT case when max(id) is null then 1 else max(id) + 1 end id from master_user md");
		}else if($page == "budget_post"){
			$get_id = DB::select("SELECT case when max(id_budget) is null then 1 else max(id_budget) + 1 end id_budget from master_budget");
		}elseif($page == "budget_update" || $page == "budget_sub_update"){
			$get_id = DB::select("SELECT case when max(id_breakdown) is null then 1 else max(id_breakdown) + 1 end id_breakdown from breakdown_budget");
		}

		return $get_id;;
	}

	public static function getReport($divisi, $dateFrom=false, $dateEnd=false){
		// dd($divisi, $dateFrom, $dateEnd);
		if($dateFrom!="" && $dateEnd!=""){
			
			$sql = "SELECT 
					md.nama_divisi
					,mu.username 
					,mj.nama_jabatan 
					,drb.id_request
					,drb.produk 
					,drb.produk_item
					,drb.filename
					,drb.sasaran_outlet 
					,drb.wilayah 
					,drb.tujuan_promosi 
					,drb.rincian_rata_omzet 
					,drb.rincian_target 
					,drb.rincian_biaya 
					,drb.jenis_promosi 
					,drb.mekanis_promo 
					,drb.pembiayaan 
					,drb.nilai_pembiayaan 
					,drb.keterangan 
					,drb.request_date
					,drb.approve_date
				from data_request_budget drb
				left join master_user mu on drb.employee_id = mu.id 
				left join master_divisi md on drb.id_divisi = md.id_divisi 
				left join master_jabatan mj on drb.id_jabatan = mj.id_jabatan 
				where 1=1
				and drb.status = '2'
				and drb.id_divisi = '$divisi'
				and drb.approve_date between '$dateFrom' and '$dateEnd'";
				// and case when '$dateFrom' = '0' then 1=1
				// else drb.approve_date between '$dateFrom' and '$dateEnd' end";
				// \Log::info($sql);
				$query = DB::select($sql);
			}else{
				
				$sql = "SELECT 
					md.nama_divisi
					,mu.username 
					,mj.nama_jabatan 
					,drb.id_request
					,drb.produk 
					,drb.produk_item
					,drb.filename
					,drb.sasaran_outlet 
					,drb.wilayah 
					,drb.tujuan_promosi 
					,drb.rincian_rata_omzet 
					,drb.rincian_target 
					,drb.rincian_biaya 
					,drb.jenis_promosi 
					,drb.mekanis_promo 
					,drb.pembiayaan 
					,drb.nilai_pembiayaan 
					,drb.keterangan 
					,drb.request_date
					,drb.approve_date
				from data_request_budget drb
				left join master_user mu on drb.employee_id = mu.id 
				left join master_divisi md on drb.id_divisi = md.id_divisi 
				left join master_jabatan mj on drb.id_jabatan = mj.id_jabatan 
				where 1=1
				and drb.status = '2'
				and drb.id_divisi = '$divisi'";
				// and drb.approve_date between '$dateFrom' and '$dateEnd'";
				// and case when '$dateFrom' = '0' then 1=1
				// else drb.approve_date between '$dateFrom' and '$dateEnd' end";
				// \Log::info($sql);
				$query = DB::select($sql);
			}

			return $query;
		}
		
		public static function getRequest($role, $employeeID=false, $idDivisi=false){
			
			if($role == '2'){
				
				// $query = DB::select("
			// 	select 
			// 		md.nama_divisi
			// 		,mu.username
			// 		,mj.nama_jabatan 
			// 		,drb.produk 
			// 		,drb.produk_item
			// 		,drb.filename
			// 		,drb.sasaran_outlet 
			// 		,drb.wilayah 
			// 		,drb.tujuan_promosi 
			// 		,drb.rincian_rata_omzet 
			// 		,drb.rincian_target 
			// 		,drb.rincian_biaya 
			// 		,drb.jenis_promosi 
			// 		,drb.mekanis_promo 
			// 		,drb.pembiayaan 
			// 		,drb.nilai_pembiayaan 
			// 		,drb.keterangan 
			// 		,drb.request_date
			// 		,drb.approve_date
			// 		,drb.status
			// 	from data_request_budget drb
			// 	left join master_user mu on drb.employee_id = mu.id
			// 	left join master_divisi md on drb.id_divisi = md.id_divisi 
			// 	left join master_jabatan mj on drb.id_jabatan = mj.id_jabatan
			// 	where 1=1
			// 	and drb.status in ('1','2') and drb.request_date is not null
			// ");

			$query = DB::select("SELECT DISTINCT drb.id, md.nama_divisi
					,mu.username
					,mj.nama_jabatan 
					,drb.produk 
					,drb.produk_item
					,drb.filename
					,drb.sasaran_outlet 
					,drb.wilayah 
					,drb.tujuan_promosi 
					,drb.rincian_rata_omzet 
					,drb.rincian_target 
					,drb.rincian_biaya 
					,drb.jenis_promosi 
					,drb.mekanis_promo 
					,drb.pembiayaan 
					,drb.nilai_pembiayaan 
					,drb.keterangan 
					,drb.request_date
					,drb.approve_date
					,drb.status, msd.nama_sub_divisi
					,drb.id_request 
					,md.type
				from data_request_budget drb
				left join master_user mu on drb.employee_id = mu.id
				left join master_divisi md on drb.id_divisi = md.id_divisi
				left join master_sub_divisi msd on mu.id_sub_divisi  = msd.id_sub_divisi  
				left join master_jabatan mj on drb.id_jabatan = mj.id_jabatan
				where 1=1
				and drb.status in ('1','2','3') and drb.request_date is not null and mu.id_sub_divisi is not null
			");

		}elseif($role == '1'){
			// $query = DB::select("
			// 	select 
			// 		md.nama_divisi
			// 		,mu.username
			// 		,mj.nama_jabatan 
			// 		,drb.produk 
			// 		,drb.produk_item
			// 		,drb.filename
			// 		,drb.sasaran_outlet 
			// 		,drb.wilayah 
			// 		,drb.tujuan_promosi 
			// 		,drb.rincian_rata_omzet 
			// 		,drb.rincian_target 
			// 		,drb.rincian_biaya 
			// 		,drb.jenis_promosi 
			// 		,drb.mekanis_promo 
			// 		,drb.pembiayaan 
			// 		,drb.nilai_pembiayaan 
			// 		,drb.keterangan 
			// 		,drb.request_date
			// 		,drb.approve_date
			// 		,drb.status
			// 	from data_request_budget drb
			// 	left join master_user mu on drb.employee_id = mu.id
			// 	left join master_divisi md on drb.id_divisi = md.id_divisi 
			// 	left join master_jabatan mj on drb.id_jabatan = mj.id_jabatan
			// 	where 1=1
			// 	and drb.status in ('0','1','2')
			// 	and drb.id_divisi = '$idDivisi'
			// ");

			$query = DB::select("select DISTINCT drb.id, md.nama_divisi
								,mu.username
								,mj.nama_jabatan 
								,drb.produk 
								,drb.produk_item
								,drb.filename
								,drb.sasaran_outlet 
								,drb.wilayah 
								,drb.tujuan_promosi 
								,drb.rincian_rata_omzet 
								,drb.rincian_target 
								,drb.rincian_biaya 
								,drb.jenis_promosi 
								,drb.mekanis_promo 
								,drb.pembiayaan 
								,drb.nilai_pembiayaan 
								,drb.keterangan 
								,drb.request_date
								,drb.approve_date
								,drb.status, msd.nama_sub_divisi 
								,drb.id_request 
								,md.type
							from data_request_budget drb
							left join master_user mu on drb.employee_id = mu.id
							left join master_divisi md on drb.id_divisi = md.id_divisi
							left join master_sub_divisi msd on mu.id_sub_divisi  = msd.id_sub_divisi  
							left join master_jabatan mj on drb.id_jabatan = mj.id_jabatan
							where 1=1
							and drb.status in ('0','1','2','3') and drb.request_date is not null and mu.id_sub_divisi is not null
							and drb.id_divisi = '$idDivisi'");
		}else{
			
			// $query = DB::select("
			// 	select 
			// 		md.nama_divisi
			// 		,mu.username
			// 		,mj.nama_jabatan 
			// 		,drb.produk 
			// 		,drb.produk_item
			// 		,drb.filename
			// 		,drb.sasaran_outlet 
			// 		,drb.wilayah 
			// 		,drb.tujuan_promosi 
			// 		,drb.rincian_rata_omzet 
			// 		,drb.rincian_target 
			// 		,drb.rincian_biaya 
			// 		,drb.jenis_promosi 
			// 		,drb.mekanis_promo 
			// 		,drb.pembiayaan 
			// 		,drb.nilai_pembiayaan 
			// 		,drb.keterangan 
			// 		,drb.request_date
			// 		,drb.approve_date
			// 		,drb.status
			// 	from data_request_budget drb
			// 	left join master_user mu on drb.employee_id = mu.id
			// 	left join master_divisi md on drb.id_divisi = md.id_divisi 
			// 	left join master_jabatan mj on drb.id_jabatan = mj.id_jabatan
			// 	where 1=1
			// 	and employee_id = '$employeeID'
			// ");

			$query = DB::select("select DISTINCT drb.id, md.nama_divisi
						,mu.username
						,mj.nama_jabatan 
						,drb.produk 
						,drb.produk_item
						,drb.filename
						,drb.sasaran_outlet 
						,drb.wilayah 
						,drb.tujuan_promosi 
						,drb.rincian_rata_omzet 
						,drb.rincian_target 
						,drb.rincian_biaya 
						,drb.jenis_promosi 
						,drb.mekanis_promo 
						,drb.pembiayaan 
						,drb.nilai_pembiayaan 
						,drb.keterangan 
						,drb.request_date
						,drb.approve_date
						,drb.status, msd.nama_sub_divisi 
						,drb.id_request 
						,md.type
					from data_request_budget drb
					left join master_user mu on drb.employee_id = mu.id
					left join master_divisi md on drb.id_divisi = md.id_divisi
					left join master_sub_divisi msd on mu.id_sub_divisi  = msd.id_sub_divisi  
					left join master_jabatan mj on drb.id_jabatan = mj.id_jabatan
					where 1=1
					and drb.request_date is not null and mu.id_sub_divisi is not null
					and drb.employee_id  = '$employeeID'");
		}

		return $query;
	}


	public static function getGlobalData($table, $where=false){
		if($table == "master_divisi"){
			$query = DB::select("SELECT * FROM $table where status = :where", ['where' => $where]);
		}else if($table == "master_jabatan"){
			$query = DB::select("SELECT * FROM $table where id_jabatan != '1' and status = :where", ['where' => $where]);
		}else{
			if($where != null){
				$query = DB::select("SELECT * FROM $table where 1=1 and status = :where", ['where' => $where]);
				// $query = DB::select("SELECT * FROM $table where 1=1 ", );
			}else{
				$query = DB::select("SELECT * FROM $table");
			}
		}
		return $query;

	}

	public static function getDataDetail($idDivisi){
		$query = DB::select("SELECT * from master_sub_divisi msd where id_divisi = '$idDivisi'");
		return $query;
	}

	public static function getGlobalDataUser(){
		
		$query = DB::select("SELECT 
				mu.id
				,mu.username
				,mu.role
				,md.nama_divisi 
				,mj.nama_jabatan 
				,mu.email
				,mu.id_sub_divisi
			from master_user mu 
			left join master_divisi md on md.id_divisi = mu.id_divisi 
			left join master_jabatan mj on mj.id_jabatan = mu.id_jabatan 
			where 1=1
			-- and mu.id = '3'
			and md.status = 'Active'
		");
		return $query;

	}

	public static function getDataRole(){
		return DB::table('master_role')->where('id', '!=', '2') ->get();
	}

	public static function selectId($division){
		$query = DB::table('master_divisi')->select('id_divisi')->where('nama_divisi','=',$division)->get();
		return $query;

	}

	public static function UpdateData($params, $menu){
		// dd($params, $menu);
		if($menu == "user_update"){
			$query = DB::table('master_user')->where('id','=',$params['id'])->update($params['data']);
		}else if($menu == "divisi_update"){
			$query = DB::table('master_divisi')->where('id_divisi','=',$params['id'])->update(['status' => $params['parms_int']['status'], 'type' => $params['parms_int']['type_edit']]);
		}else if($menu == "budget_update" || $menu == "budget_update_divisi"){
			$query = DB::table('master_budget')->where('id_budget','=',$params['id'])->update($params['data']);
		}
		return $query;
	}

	public static function UpdateDataBudget($params){
		//ceck data
		// dd($$params);
		$checkDataBudget = DB::table('breakdown_budget')->where('id_sub_divisi','=',$params['id_sub_divisi'])->get();
		if(count($checkDataBudget) <= 0){
			$query = DB::table('breakdown_budget')->insert($params);
		}else{
			$get_budget = DB::select("SELECT case when exists (select amount from breakdown_budget
										where id_sub_divisi = '".$params['id_sub_divisi']."') then (select amount from breakdown_budget
										where id_sub_divisi = '".$params['id_sub_divisi']."') else 0  end amount");
			$get_amount = (int)$get_budget[0]->amount + (int)$params['amount'];
			$query = DB::table('breakdown_budget')->where('id_sub_divisi','=',$params['id_sub_divisi'])->update(['amount'=>$get_amount, 'updated_date' => now()]);
		}
		return $query;
	}	

	public static function UpdateDataBudgetSub($params, $params_sub, $params_ins_sub){
		try{
			DB::table('master_budget')->where('id_budget', '=', $params['id_budget'])->update($params['data']);
			//cekfor update or inst
			$get_check = DB::table('breakdown_budget')->where('id_sub_divisi', '=', $params_sub['id_sub_divisi'])->get();
			if(count($get_check) > 0){
				DB::table('breakdown_budget')->where('id_sub_divisi', '=', $params_sub['id_sub_divisi'])->update($params_sub['data']);
			}else{
				$query = DB::table('breakdown_budget')->insert($params_ins_sub);
			}
			return array('message' => 200);
		}catch(\Exception $e){
			throw new Exception("gagal Insert");
			return array('message' => 500);
		}
	}

	public static function insertData($params, $menu){
		// dd($params, $menu);
		if($menu == 'user'){
			$get_id = DB::select("SELECT case when max(id) is null then 1 else max(id) + 1 end id from master_user md");
			if ($params['role'] == '3'){
				$query = DB::insert("INSERT INTO master_user (id, role, id_divisi, id_jabatan, username, password, ori_password, email, created_at, id_sub_divisi) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
					[
						$get_id[0]->id,
						$params['role'],
						$params['divisi'],
						$params['jabatan'],
						$params['username'],
						$params['pass'],
						$params['ori_pass'],
						$params['email'],
						$params['created_at'],
						$params['id_sub_divisi']
					]
				);
			}else{
				$query = DB::insert("INSERT INTO master_user (id, role, id_divisi, id_jabatan, username, password, ori_password, email, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
					[
						$get_id[0]->id,
						$params['role'],
						$params['divisi'],
						$params['jabatan'],
						$params['username'],
						$params['pass'],
						$params['ori_pass'],
						$params['email'],
						$params['created_at'],
						$params['updated_at']
		
					]
				);
			}
		}elseif($menu == 'divisi'){
			$get_id = DB::select("select case when max(id_divisi) is null then 1 else max(id_divisi) + 1 end id from master_divisi md");
			$query = DB::insert("INSERT INTO master_divisi (id_divisi, nama_divisi, url, status, type) VALUES (?, ?, ?, ?, ?)",
				[
					$get_id[0]->id,
					$params['divisi_name'],
					$params['url'],
					$params['status'],
					$params['type'],
				]
			);
		}elseif($menu == 'divisi_update') {
			$get_id = DB::select("SELECT max(id_sub_divisi) + 1 id_sub_divisi  from master_sub_divisi msd");
			if ($get_id){
				$number = $get_id[0]->id_sub_divisi;
			}else{
				$number = 1;
			}
			$query = DB::insert("INSERT INTO master_sub_divisi (id_sub_divisi, nama_sub_divisi, url, id_divisi, status) VALUES (?, ?, ?, ?, ?)",
				[
					$number,
					$params['nama_sub_divisi'],
					$params['url'],
					$params['id_divisi'],
					$params['status'],
				]
			);
		}else if($menu == "budget_post"){
			if($params['status_up'] == 'insert'){
				$params_ins = [
					'id_budget'     => $params['id_budget'],
					'id_divisi'     => $params['id_divisi'],
					'amount'        => $params['amount'],
					'status'        => 'Active',
					'periode_from'	=> $params['dateFrom'],	
					'periode_end'	=> $params['dateEnd'],
					'created_date'  => now(),
				];
				$query = DB::table('master_budget')->insert($params_ins);
			}else{
				$params_updt = [
					'id_divisi'     => $params['id_divisi'],
					'amount'        => $params['amount'],
					'periode_from'	=> $params['dateFrom'],	
					'periode_end'	=> $params['dateEnd'],
					'updated_date'  => now(),
				];
				$query = DB::table('master_budget')->where('id_divisi', '=', $params['id_divisi'])->update($params_updt);
			}
		}

		return $query;
	}

	public static function insertDataRequest($params){

		$query = DB::insert("INSERT INTO data_request_budget (
			id,
			id_divisi,
			id_jabatan,
			employee_id,
			filename,
			path,
			request_date,
			produk,
			produk_item,
			sasaran_outlet,
			wilayah,
			tujuan_promosi,
			rincian_rata_omzet,
			rincian_target,
			rincian_biaya,
			periode_from,
			periode_end,
			ms_period_from,
			ms_period_end,
			jenis_promosi,
			mekanis_promo,
			nilai_pembiayaan,
			keterangan,
			status,
			id_request,
			child
		) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", 
			[
				$params['id'],
				$params['id_divisi'],
				$params['id_jabatan'],
				$params['employee_id'],
				$params['filename'],
				$params['path'],
				$params['request_date'],
				$params['produk'],
				$params['produk_item'],
				$params['sasaran_outlet'],
				$params['wilayah'],
				$params['tujuan_promosi'],
				$params['rincian_rata_omzet'],
				$params['rincian_target'],
				$params['rincian_biaya'],
				$params['periode_from'],
				$params['periode_end'],
				$params['ms_period_from'],
				$params['ms_period_end'],
				$params['jenis_promosi'],
				$params['mekanis_promo'],
				$params['biaya_utuh'],
				$params['keterangan'],
				$params['status_approve'],
				$params['id_request'],
				$params['child']
			]
		);

		return $query;
	}

	public static function DeleteDivisi($params){
		try{
			$delete = DB::table('master_divisi')->where('id_divisi', '=', $params)->delete();
			return $result = [
				'status' => 'success',
				'message' => 'Berhasil Hapus'
			];
		}catch(\Exception $e){
			return $result = [
				'status' => 'gagal',
				'message' => 'Gagal Hapus'
			];
		}
	}

	public static function DeleteUser($params){
		try{
			$delete = DB::table('master_user')->where('id', '=', $params)->delete();
			return $result = [
				'status' => 'success',
				'message' => 'Berhasil Hapus User'
			];
		}catch(\Exception $e){
			return $result = [
				'status' => 'gagal',
				'message' => 'Gagal Hapus User'
			];
		}
	}

	public static function DeleteBudget($params){
		try{
			$getDivisiId = DB::table('master_budget')->where('id_budget', '=', $params)->get();
			$id_divisi_ = $getDivisiId[0]->id_divisi;
			$getBreakdown = DB::table('breakdown_budget')->where('id_divisi', '=', $id_divisi_)->get();
			$getSubBreakdown = DB::table('sub_breakdown')->where('id_divisi', '=', $id_divisi_)->get();

			$amountSub = 0;
			if(count($getSubBreakdown) > 0){
				foreach($getSubBreakdown as $val){
					$amountSub += (int)$val->amount;
				}
			}

			$amountBreak = 0;
			if(count($getBreakdown) > 0){
				foreach($getBreakdown as $val){
					$amountBreak += (int)$val->amount;
				}
			}

			$data_roleback = 0;
			if(count($getBreakdown) > 0){
				$data_roleback = (int)$getDivisiId[0]->amount + (int)$amountBreak + $amountSub;
			}else{
				$data_roleback = (int)$getDivisiId[0]->amount;
			}
			//update temp all
			$select_amount = DB::table('temp_budget_all')->where('id_divisi', '=', $id_divisi_)->get();
			\Log::info($select_amount);
			$temp_money = 0;
			if(count($select_amount) > 0){
				$temp_money = (int)$select_amount[0]->amount;
			}else{
				$temp_money = 0;
			}
			$total_all = $temp_money + $data_roleback;
			if(count($select_amount) == 0){
				//insert
				$params_ins_temp = array(
					'id_divisi' 	=> $id_divisi_,
					'amount'	 	=> $total_all,
				);
				DB::table('temp_budget_all')->insert($params_ins_temp);
			}else{
				//update
				DB::table('temp_budget_all')->where('id_divisi', '=', $id_divisi_)->update(['amount' => $total_all]);
			}
			
			// $delete = DB::table('master_budget')->where('id_budget', '=', $params)->update(['amount' => 0]);
			// if($delete){
				DB::table('master_budget')->where('id_budget', '=', $params)->update(['amount' => 0]);
				DB::table('breakdown_budget')->where('id_divisi', '=', $id_divisi_)->update(['amount' => 0]);
				DB::table('sub_breakdown')->where('id_divisi', '=', $id_divisi_)->update(['amount' => 0]);
			// }
			return $result = [
				'status' => 'success',
				'message' => 'Dana berhasil ditarik'
			];
		}catch(\Exception $e){
			\Log::info($e);
			return $result = [
				'status' => 'error',
				'message' => 'Dana gagal ditarik!'
			];
		}
	}

	public static function DeleteBudgetSub($params){
		try{
			//getBudget dulu
			$getBudgetSub = DB::table('breakdown_budget')->where('id_sub_divisi', '=', $params)->get();

			if(count($getBudgetSub) > 0){
				//getbudgetMasterbudget
				$getMasterBudget = DB::table('master_budget')->where('id_divisi', '=', $getBudgetSub[0]->id_divisi)->get();
	
				$getChild = DB::table('sub_breakdown')->select('amount')->where('id_sub_divisi', '=', $params)->get();
				// $getChild = DB::select("SELECT case when sum(amount) is null then 0 else sum(amount) end amount from sub_breakdown where id_sub_divisi = '$params'");
				$numberChild = 0;
				foreach($getChild as $val){
					$numberChild += (int)$val->amount;
				}
					
				//rollback budget
				$roolback_budget = 0;
				if(count($getBudgetSub) > 0){
					$roolback_budget = (int)$getMasterBudget[0]->amount + (int)$getBudgetSub[0]->amount + $numberChild;
					//  + (int)$getChild[0]['amount'];
				}
				
				\Log::info($roolback_budget);
				if($roolback_budget >= 1){
					$delete = DB::table('breakdown_budget')->where('id_sub_divisi', '=', $params)->delete();
					$updaBreakdown = DB::table('sub_breakdown')->where('id_sub_divisi', '=', $params)->update(['amount' => 0]);
					if($delete){
						$update_master_budget = DB::table('master_budget')->where('id_budget', '=', $getMasterBudget[0]->id_budget)->update(['amount' => $roolback_budget, 'updated_date' => now()]);
					}
				}
			}
			return $result = [
				'status' => 'success',
				'message' => 'Berhasil Hapus Budget'
			];
		}catch(\Exception $e){
			\Log::info($e);
			\Log::info($e->getMessage());
			abort(404);
			return $result = [
				'status' => 'gagal',
				'message' => 'Gagal Hapus Budget'
			];
			// \Log::info($e->getMessage());
			// // throw new Exception("Value must be 1 or below");
			// abort(404);
			// return false;
		}
	}

	public static function status_update($params){
		$get_status = DB::table('master_sub_divisi')->where('id_sub_divisi', '=', $params)->get();
		$status = "";
		if($get_status[0]->status == 'Active'){
			$status = "NonActive";
		}else{
			$status = "Active";
		}
		try{
			$delete = DB::table('master_sub_divisi')->where('id_sub_divisi', '=', $params)->update([
				'status' => $status,
			]);
			return $result = [
				'status' => 'success',
				'message' => 'Berhasil Update Status'
			];
		}catch(\Exception $e){
			return $result = [
				'status' => 'gagal',
				'message' => 'Gagal Update Status'
			];
		}
	}

	public static function status_update_sub($params){
		$get_status = DB::table('sub_breakdown')->where('id', '=', $params)->get();
		$status = "";
		if($get_status[0]->status == 'Active'){
			$status = "NonActive";
		}else{
			$status = "Active";
		}
		try{
			$delete = DB::table('sub_breakdown')->where('id', '=', $params)->update([
				'status' => $status,
			]);
			return $result = [
				'status' => 'success',
				'message' => 'Berhasil Update Status'
			];
		}catch(\Exception $e){
			return $result = [
				'status' => 'gagal',
				'message' => 'Gagal Update Status'
			];
		}
	}

	public static function cek_child_sub_breakdown($id){
		return DB::table('sub_breakdown')->where('id_sub_divisi', '=', $id)->where('status','=','Active')->get();
	}

	public static function getIdSubBreakdown($id_divisi, $get_id_break_budget, $name){
		return DB::table('sub_breakdown')->where('id_divisi', '=', $id_divisi)->where('id_sub_divisi', '=', $get_id_break_budget)->where('nama_sub_breakdown', '=', $name)->get();
	}

	public static function UpdateDataSubBudgetBreakdown($id, $id_budget, $amount){
		$cek_amount = DB::table("sub_breakdown")->where('id', '=', $id)->get();
		if($cek_amount[0]->amount <= 0 || $cek_amount[0]->amount == ""){
			return DB::update("UPDATE sub_breakdown set id_budget = '$id_budget', amount = '$amount', updated_date = '".now()."' where id = '$id'");
		}else{
			$tambah = (int)$cek_amount[0]->amount + $amount;
			return DB::update("UPDATE sub_breakdown set id_budget = '$id_budget', amount = '$tambah', updated_date = '".now()."' where id = '$id'");
		}
	}

	public static function UpdateDataDivisi($params){
		// dd($params);
		return DB::update("UPDATE master_divisi set nama_divisi = '$id_budget', amount = '$amount', updated_date = '".now()."' where id = '$id'");
	}

	public static function getBudget($url){
		// $select = DB::select("select * from master_budget mb
		// inner join master_divisi md on md.id_divisi = mb.id_divisi 
		// where md.url = '$url'");

		if(Auth::user()->role == '1'){
			$id_divisi = Auth::user()->id_divisi;	
			// $query = DB::select("SELECT mb.periode_end, mb.amount, bb.amount amount2, drb.nilai_pembiayaan, (mb.amount + case when bb.amount is null then 0 else bb.amount end) + 
			// 					case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end total,
			// 					case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end request, 
			// 					(mb.amount + case when bb.amount is null then 0 else bb.amount end) sisa,
			// 					(case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end
			// 					/ (mb.amount + case when bb.amount is null then 0 else bb.amount end)) * 100 as persen
			// 					from master_budget mb left join 
			// 					(select id_divisi, case when sum(nilai_pembiayaan) is null then 0 else sum(nilai_pembiayaan) end 
			// 					nilai_pembiayaan, ms_period_from, ms_period_end from data_request_budget
			// 					where id_divisi in ('$id_divisi') and status = '2' GROUP by id_divisi) drb 
			// 					on mb.id_divisi = drb.id_divisi 
			// 					left join 
			// 					-- (select id_divisi, sum(amount) amount from breakdown_budget
			// 					-- where id_divisi in ('$id_divisi') GROUP by id_divisi) 
			// 					(select breakdown_budget.id_divisi, sum(amount)+sb.amountnya amount from breakdown_budget 
			// 					left join (select sum(amount) as amountnya, id_divisi  from sub_breakdown) sb
			// 					on sb.id_divisi  = breakdown_budget.id_divisi 
			// 					where breakdown_budget.id_divisi in ('$id_divisi') GROUP by id_divisi)
			// 					as bb on mb.id_divisi = bb.id_divisi 
			// 					where mb.id_divisi in ('$id_divisi') and mb.status = 'Active'
			// 					-- and mb.periode_end > CURDATE()
			// 					and mb.periode_from = drb.ms_period_from
			// 					and mb.periode_end = drb.ms_period_end
			// ");
			$query = DB::select("SELECT 
					mb.id_divisi
					, mb.amount ms_budget
					, (case when bb.amount is null then 0 else bb.amount end) ms_breakdown
					, (case when sb.amount is null then 0 else sb.amount end) ms_sub_breakdown
					, mb.amount + (case when bb.amount is null then 0 else bb.amount end) + 
						(case when sb.amount is null then 0 else sb.amount end) total
					, (case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end) request
					, mb.amount + (case when bb.amount is null then 0 else bb.amount end) + 
						(case when sb.amount is null then 0 else sb.amount end) - (case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end) sisa
					, case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end
						/ (mb.amount + case when bb.amount is null then 0 else bb.amount end + 
						case when sb.amount is null then 0 else sb.amount end) * 100 as persen
					, mb.status 
					, mb.periode_end
					, (case when mb.periode_end >= CURDATE() then 'Active' else 'Expired' end) exp_status
				from master_budget mb 
				left join (select id_divisi, sum(amount) amount from breakdown_budget group by id_divisi) bb on mb.id_divisi = bb.id_divisi 
				left join (select id_divisi, sum(amount) amount from sub_breakdown group by id_divisi) sb on mb.id_divisi = sb.id_divisi
				left join (select drb2.ms_period_end, drb2.ms_period_from, drb2.id_divisi, sum(drb2.nilai_pembiayaan) nilai_pembiayaan from data_request_budget drb2 where 1=1 and drb2.status = '2' and drb2.ms_period_end > CURDATE() group by drb2.id_divisi) drb
				on mb.id_divisi = drb.id_divisi
				where 1=1
				and mb.id_divisi in ($id_divisi)

			");
		}else{
			$get_id_divisi = DB::table('master_divisi')->where('url', '=', $url)->get();
			$id = $get_id_divisi[0]->id_divisi;
			// $query = DB::select("SELECT mb.periode_end, mb.id_divisi, mb.amount, bb.amount amount2, drb.nilai_pembiayaan, (mb.amount + case when bb.amount is null then 0 else bb.amount end) + 
			// 					case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end total,
			// 					case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end request, 
			// 					(mb.amount + case when bb.amount is null then 0 else bb.amount end) sisa,
			// 					(case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end
			// 					/ (mb.amount + case when bb.amount is null then 0 else bb.amount end)) * 100 as persen
			// 					from master_budget mb left join 
			// 					(select id_divisi, case when sum(nilai_pembiayaan) is null then 0 else sum(nilai_pembiayaan) end 
			// 					nilai_pembiayaan, ms_period_from, ms_period_end from data_request_budget
			// 					where id_divisi in ('$id') and status = '2' GROUP by id_divisi) drb 
			// 					on mb.id_divisi = drb.id_divisi 
			// 					left join 
			// 					-- (select id_divisi, sum(amount) amount from breakdown_budget
			// 					-- where id_divisi in ('$id') GROUP by id_divisi) 
			// 					(select breakdown_budget.id_divisi, sum(amount)+sb.amountnya amount from breakdown_budget 
			// 					left join (select sum(amount) as amountnya, id_divisi  from sub_breakdown) sb
			// 					on sb.id_divisi  = breakdown_budget.id_divisi 
			// 					where breakdown_budget.id_divisi in ('$id') GROUP by id_divisi)
			// 					as bb on mb.id_divisi = bb.id_divisi 
			// 					where mb.id_divisi in ('$id') and mb.status = 'Active'
			// 					-- and mb.periode_end > CURDATE()
			// 					and mb.periode_from = drb.ms_period_from
			// 					and mb.periode_end = drb.ms_period_end
			// ");

			$query = DB::select("SELECT 
					mb.id_divisi
					, mb.amount ms_budget
					, (case when bb.amount is null then 0 else bb.amount end) ms_breakdown
					, (case when sb.amount is null then 0 else sb.amount end) ms_sub_breakdown
					, mb.amount + (case when bb.amount is null then 0 else bb.amount end) + 
						(case when sb.amount is null then 0 else sb.amount end) + 
						(case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end) total
					, (case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end) request
					, mb.amount + (case when bb.amount is null then 0 else bb.amount end) + 
						(case when sb.amount is null then 0 else sb.amount end) + 
						(case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end) - (case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end) sisa
					, case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end
						/ (mb.amount + case when bb.amount is null then 0 else bb.amount end + 
						case when sb.amount is null then 0 else sb.amount end) * 100 as persen
					, mb.status 
					, mb.periode_from
					, mb.periode_end
					, drb.ms_period_from
					, drb.ms_period_end
					, (case when mb.periode_end >= CURDATE() then 'Active' else 'Expired' end) exp_status
				from master_budget mb 
				left join (select id_divisi, sum(amount) amount from breakdown_budget group by id_divisi) bb on mb.id_divisi = bb.id_divisi 
				left join (select id_divisi, sum(amount) amount from sub_breakdown group by id_divisi) sb on mb.id_divisi = sb.id_divisi
				left join (select drb2.ms_period_end, drb2.ms_period_from, drb2.id_divisi, sum(drb2.nilai_pembiayaan) nilai_pembiayaan from data_request_budget drb2 where 1=1 and drb2.status = '2' and drb2.ms_period_end >= CURDATE() group by drb2.id_divisi) drb 
					on mb.id_divisi = drb.id_divisi
					and drb.ms_period_from <= CURDATE()	
				where 1=1
				and mb.id_divisi in ('$id')
			");
		}
		return $query;
	}

	public static function getDataRpBudget($url){
		if(Auth::user()->role == '1'){
			$id_divisi = Auth::user()->id_divisi;	
			$query = DB::select("SELECT 
					lmb.nama_divisi
					, lmb.amount total
					, (case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end) request
					, (case when lmb.amount is null then 0 else lmb.amount end) - (case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end) sisa
					, lmb.amount - (case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end) total_budget
					, lmb.periode_end
					, mb.status 
					from log_master_budget lmb 
				left join data_request_budget drb on lmb.id_divisi = drb.id_divisi
				left join master_budget mb on mb.id_divisi = lmb.id_divisi 
				where 1=1 
				and mb.status = 'Active'
				and lmb.id_divisi in ('$id')
			");
		}else{
			$get_id_divisi = DB::table('master_divisi')->where('url', '=', $url)->get();
			$id = $get_id_divisi[0]->id_divisi;
			$query = DB::select("SELECT 
					lmb.nama_divisi
					, lmb.amount total
					, (case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end) request
					, (case when lmb.amount is null then 0 else lmb.amount end) - (case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end) sisa
					, lmb.amount - (case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end) total_budget
					, lmb.periode_end
					, mb.status 
					from log_master_budget lmb 
				left join data_request_budget drb on lmb.id_divisi = drb.id_divisi
				left join master_budget mb on mb.id_divisi = lmb.id_divisi 
				where 1=1 
				and mb.status = 'Active'
				and lmb.id_divisi in ('$id')
			");
		}
		return $query;
	}

	public static function getforeditSubdivisi($id, $stsActive){
		$data_exp = explode('|^|', $id);
		$id_divisi = $data_exp[1];
		return DB::table('master_sub_divisi')->where('status', '=', $stsActive)->where('id_divisi','=', $id_divisi)->get();
	}

	public static function check_amount($divisi){
		return DB::select("SELECT case when amount is null or amount = '' then 0 else amount end amount from master_budget where id_divisi = '$divisi'");
	}

	// 	public static function getDetailBudget($id, $stsActive){
	// 		// return DB::select("SELECT id_budget, md.id_divisi, msd.id_sub_divisi,  md.nama_divisi,  mb.amount, date(mb.created_date) created_date, msd.nama_sub_divisi, msd.budget from master_budget mb left join master_sub_divisi msd 
	// 		// on mb.id_divisi = msd.id_divisi left join master_divisi md on mb.id_divisi = md.id_divisi where mb.id_divisi = '$id' and msd.status = '$stsActive'");
	// 		// return DB::select("SELECT mb.id_budget, md.id_divisi, msd.id_sub_divisi,  md.nama_divisi,  mb.amount, date(bb.created_date) created_date, 
	// 		// msd.nama_sub_divisi, bb.amount  budget, bb.id_breakdown from master_budget mb left join master_sub_divisi msd 
	// 		// on mb.id_divisi = msd.id_divisi 
	// 		// left join breakdown_budget bb on msd.id_sub_divisi = bb.id_sub_divisi 
	// 		// left join master_divisi md on mb.id_divisi = md.id_divisi where mb.id_divisi = '$id' 
	// 		// and msd.status = '$stsActive'");

	// 		return DB::select("SELECT mb.id_budget, md.id_divisi, msd.id_sub_divisi,  md.nama_divisi,  mb.amount, date(bb.created_date) created_date, 
	// 		msd.nama_sub_divisi, bb.amount  budget,  bb.id_breakdown, case when h.id_sub_divisi is not null
	// 		then 1 else 0 end ada, (h.amount + case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end) budget_all, 
	// 		case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end  budgetRequest from master_budget mb left join master_sub_divisi msd 
	// 		on mb.id_divisi = msd.id_divisi 
	// 		left join breakdown_budget bb on msd.id_sub_divisi = bb.id_sub_divisi 
	// 		left join (select DISTINCT id_sub_divisi, sum(amount) amount from sub_breakdown  where id_divisi = '$id' group by id_sub_divisi) h
	// 		on h.id_sub_divisi = msd.id_sub_divisi
	// 		left join master_divisi md on mb.id_divisi = md.id_divisi
	// 		left join (select data_request_budget.id_divisi, case when sum(nilai_pembiayaan) is null then 0 else sum(nilai_pembiayaan) end 
	// 								nilai_pembiayaan, mu.id_sub_divisi 
	// 								from data_request_budget
	// 								left join master_user mu on mu.id = data_request_budget.employee_id 
	// 								where 1=1 and data_request_budget.id_divisi in ('$id') 
	// -- 								and mu.id_sub_divisi = '2'
	// 								and status = '2' 
	// 								GROUP by data_request_budget.id_divisi, mu.id_sub_divisi ) drb 
	// 								on bb.id_sub_divisi = drb.id_sub_divisi 
	// 		where mb.id_divisi = '$id' 
	// 		and msd.status = '$stsActive'");
	// 		// return DB::select("SELECT mb.id_budget, md.id_divisi, msd.id_sub_divisi,  md.nama_divisi,  mb.amount, date(bb.created_date) created_date, 
	// 		// msd.nama_sub_divisi, bb.amount  budget, bb.id_breakdown, case when h.id_sub_divisi is not null
	// 		// then 1 else 0 end ada from master_budget mb left join master_sub_divisi msd 
	// 		// on mb.id_divisi = msd.id_divisi 
	// 		// left join breakdown_budget bb on msd.id_sub_divisi = bb.id_sub_divisi 
	// 		// left join (select DISTINCT id_sub_divisi from sub_breakdown) h
	// 		// on h.id_sub_divisi = msd.id_sub_divisi
	// 		// left join master_divisi md on mb.id_divisi = md.id_divisi where mb.id_divisi = '$id' 
	// 		// and msd.status = '$stsActive'");
	// 	}

	//Revisi Reus//

	// public static function cekDataBreakdownTrans(){

	// }

	public static function DetailTransTo($idDivisi=false, $idBreakDown=false, $id_subBreakDown=false){
		if ($idDivisi != NULL && $idBreakDown == NULL && $id_subBreakDown == NULL){
			$query = DB::select("select * from master_divisi md where 1=1 and id_divisi = '$idDivisi'");
		}elseif ($idDivisi != NULL && $idBreakDown != NULL && $id_subBreakDown == NULL){
			$query = DB::select("
				select 
					md.nama_divisi,
					msd.nama_sub_divisi
				from master_divisi md 
				left join master_sub_divisi msd on md.id_divisi = msd.id_divisi 
				where 1=1
				and md.id_divisi = '$idDivisi'
				and msd.id_sub_divisi = '$idBreakDown'
			");
		}elseif ($idDivisi != NULL && $idBreakDown != NULL && $id_subBreakDown != NULL){
			$query = DB::select("
				select 
					md.nama_divisi,
					msd.nama_sub_divisi,
					sb.nama_sub_breakdown
				from master_divisi md 
				left join master_sub_divisi msd on md.id_divisi = msd.id_divisi 
				left join sub_breakdown sb on msd.id_sub_divisi = sb.id_sub_divisi
				where 1=1
				and md.id_divisi = '$idDivisi'
				and msd.id_sub_divisi = '$idBreakDown'
				and sb.id = '$id_subBreakDown'
			");

		}
		
		return $query;
	}

	public static function getDetailBudget($id, $stsActive){
		// return DB::select("SELECT id_budget, md.id_divisi, msd.id_sub_divisi,  md.nama_divisi,  mb.amount, date(mb.created_date) created_date, msd.nama_sub_divisi, msd.budget from master_budget mb left join master_sub_divisi msd 
		// on mb.id_divisi = msd.id_divisi left join master_divisi md on mb.id_divisi = md.id_divisi where mb.id_divisi = '$id' and msd.status = '$stsActive'");
		// return DB::select("SELECT mb.id_budget, md.id_divisi, msd.id_sub_divisi,  md.nama_divisi,  mb.amount, date(bb.created_date) created_date, 
		// msd.nama_sub_divisi, bb.amount  budget, bb.id_breakdown from master_budget mb left join master_sub_divisi msd 
		// on mb.id_divisi = msd.id_divisi 
		// left join breakdown_budget bb on msd.id_sub_divisi = bb.id_sub_divisi 
		// left join master_divisi md on mb.id_divisi = md.id_divisi where mb.id_divisi = '$id' 
		// and msd.status = '$stsActive'");

		// return DB::select("SELECT mb.id_budget, md.id_divisi, msd.id_sub_divisi,  md.nama_divisi,  mb.amount, date(bb.created_date) created_date, 
		// 	msd.nama_sub_divisi, bb.amount  budget,  bb.id_breakdown, case when h.id_sub_divisi is not null
		// 	then 1 else 0 end ada, (h.amount) budget_all
		// 	-- then 1 else 0 end ada, (h.amount + case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end) budget_all, 
		// 	-- case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end  budgetRequest 
		// 	from master_budget mb left join master_sub_divisi msd 
		// 	on mb.id_divisi = msd.id_divisi 
		// 	left join breakdown_budget bb on msd.id_sub_divisi = bb.id_sub_divisi 
		// 	left join (select DISTINCT id_sub_divisi, sum(amount) amount from sub_breakdown  where id_divisi = '$id' group by id_sub_divisi) h
		// 	on h.id_sub_divisi = msd.id_sub_divisi
		// 	left join master_divisi md on mb.id_divisi = md.id_divisi
		// 	-- 		left join (select data_request_budget.id_divisi, case when sum(nilai_pembiayaan) is null then 0 else sum(nilai_pembiayaan) end 
		// 	-- 		nilai_pembiayaan, mu.id_sub_divisi 
		// 	-- 		from data_request_budget
		// 	-- 		left join master_user mu on mu.id = data_request_budget.employee_id 
		// 	-- 		where 1=1 and data_request_budget.id_divisi in ('$id') 
		// 	-- -- 		and mu.id_sub_divisi = '2'
		// 	-- 		and status = '2' 
		// 	-- 		GROUP by data_request_budget.id_divisi, mu.id_sub_divisi ) drb 
		// 	-- 		on bb.id_sub_divisi = drb.id_sub_divisi 
		// 	where mb.id_divisi = '$id' 
		// 	and msd.status = '$stsActive'
		// ");

		// return DB::select("SELECT mb.id_budget, md.id_divisi, msd.id_sub_divisi,  md.nama_divisi,  mb.amount, date(bb.created_date) created_date, 
		// msd.nama_sub_divisi, bb.amount  budget, bb.id_breakdown, case when h.id_sub_divisi is not null
		// then 1 else 0 end ada from master_budget mb left join master_sub_divisi msd 
		// on mb.id_divisi = msd.id_divisi 
		// left join breakdown_budget bb on msd.id_sub_divisi = bb.id_sub_divisi 
		// left join (select DISTINCT id_sub_divisi from sub_breakdown) h
		// on h.id_sub_divisi = msd.id_sub_divisi
		// left join master_divisi md on mb.id_divisi = md.id_divisi where mb.id_divisi = '$id' 
		// and msd.status = '$stsActive'");

		return DB::select("SELECT mb.id_budget, md.id_divisi, msd.id_sub_divisi,  md.nama_divisi,  mb.amount, date(bb.created_date) created_date, msd.nama_sub_divisi, bb.amount budget,  bb.id_breakdown, 
			case when h.id_sub_divisi is not null then 1 else 0 end ada, (case when h.amount is null then 0 else h.amount end + bb.amount) budget_all
			from master_budget mb left join master_sub_divisi msd 
				on mb.id_divisi = msd.id_divisi 
				left join breakdown_budget bb on msd.id_sub_divisi = bb.id_sub_divisi 
				left join (select DISTINCT id_sub_divisi, sum(amount) amount from sub_breakdown  where id_divisi = '$id' group by id_sub_divisi) h
				on h.id_sub_divisi = msd.id_sub_divisi
				left join master_divisi md on mb.id_divisi = md.id_divisi
			where mb.id_divisi = '$id' 
			and msd.status = '$stsActive'
		");
	}
	//End Revisi Reus//

	public static function getDetailRequestBudget($id){
		return DB::select("SELECT drb.id, md.id_divisi, msd.id_sub_divisi, mu.id as id_user, md.nama_divisi, mj.nama_jabatan, msd.nama_sub_divisi, mu.username, request_date, filename, approve_date, 
						produk, produk_item, sasaran_outlet, wilayah, tujuan_promosi, rincian_rata_omzet, rincian_target, rincian_biaya, jenis_promosi, mekanis_promo
						,pembiayaan, nilai_pembiayaan, keterangan, drb.status, drb.reject_date, md.type, drb.filename, drb.periode_from, drb.periode_end, drb.employee_id
						from data_request_budget drb
						left join master_jabatan mj on drb.id_jabatan = mj.id_jabatan 
						left join master_divisi md on md.id_divisi = drb.id_divisi 
						left join master_user mu on drb.employee_id = mu.id 
						left join master_sub_divisi msd on mu.id_sub_divisi = msd.id_sub_divisi 
						where drb.id = '$id'");
	}

	public static function downloaddatapdf($id, $date_from, $date_to){
		if($date_from==null || $date_to==null){
			$query =  DB::select("SELECT drb.id, drb.id_request, md.id_divisi, md.nama_divisi, mj.nama_jabatan, msd.nama_sub_divisi, mu.username, request_date, filename, approve_date, 
					produk, produk_item
					,sasaran_outlet, wilayah, tujuan_promosi, rincian_rata_omzet, rincian_target, rincian_biaya, jenis_promosi, mekanis_promo
					,pembiayaan, nilai_pembiayaan, keterangan, drb.status
				from data_request_budget drb
				left join master_jabatan mj on drb.id_jabatan = mj.id_jabatan 
				left join master_divisi md on md.id_divisi = drb.id_divisi 
				left join master_user mu on drb.employee_id = mu.id 
				left join master_sub_divisi msd on mu.id_sub_divisi = msd.id_sub_divisi 
				where drb.id_divisi = '$id' and drb.status = '2'
			");
		}else{
			$query =  DB::select("SELECT drb.id, drb.id_request, md.id_divisi, md.nama_divisi, mj.nama_jabatan, msd.nama_sub_divisi, mu.username, request_date, filename, approve_date, 
					produk, produk_item
					,sasaran_outlet, wilayah, tujuan_promosi, rincian_rata_omzet, rincian_target, rincian_biaya, jenis_promosi, mekanis_promo
					,pembiayaan, nilai_pembiayaan, keterangan, drb.status
				from data_request_budget drb
				left join master_jabatan mj on drb.id_jabatan = mj.id_jabatan 
				left join master_divisi md on md.id_divisi = drb.id_divisi 
				left join master_user mu on drb.employee_id = mu.id 
				left join master_sub_divisi msd on mu.id_sub_divisi = msd.id_sub_divisi 
				where drb.approve_date between '$date_from' and '$date_to' and drb.id_divisi = '$id' and drb.status = '2'
			");
		}

		return $query;
	}

	public static function getBudgetPerdivisi($id){
		return DB::select("SELECT msd.nama_sub_divisi, case when bb.amount is null then 0 else bb.amount end amount from master_sub_divisi msd 
							left join breakdown_budget bb 
							on msd.id_divisi = bb.id_divisi and msd.id_sub_divisi = bb.id_sub_divisi 
							where msd.id_divisi ='$id' and msd.status = 'Active'");
	}

	public static function getBudgetPerdivisiNew($id){
		return DB::select("SELECT mb.id_budget, md.id_divisi, msd.id_sub_divisi,  md.nama_divisi,  mb.amount, date(bb.created_date) created_date, msd.nama_sub_divisi, bb.amount budget,  bb.id_breakdown, 
		case when h.id_sub_divisi is not null then 1 else 0 end ada, (case when h.amount is null then 0 else h.amount end + bb.amount) budget_all
		from master_budget mb left join master_sub_divisi msd 
			on mb.id_divisi = msd.id_divisi 
			left join breakdown_budget bb on msd.id_sub_divisi = bb.id_sub_divisi 
			left join (select DISTINCT id_sub_divisi, sum(amount) amount from sub_breakdown where id_divisi = '$id' group by id_sub_divisi) h
			on h.id_sub_divisi = msd.id_sub_divisi
			left join master_divisi md on mb.id_divisi = md.id_divisi
		where mb.id_divisi = '$id' 
		and msd.status = 'Active'");
	}

	public static function dataSubDivision(){
		return DB::table('master_sub_divisi')->get();
	}

	public static function dataSubDivisionWithParams($params){
		$getIdDiv = DB::table('master_divisi')->where('nama_divisi','=',$params)->get();
		$id_div = $getIdDiv[0]->id_divisi;
		return DB::table('master_sub_divisi')->where('id_divisi','=',$id_div)->get();
	}

	public static function Rename($id, $name){
		return DB::table('master_sub_divisi')->where('id_sub_divisi', '=', $id)->update(['nama_sub_divisi' => $name]);
	}

	public static function getSubDivisi($id){
		return DB::table('master_sub_divisi')->where('id_divisi','=', $id)->get();
	}

	public static function getSubDivisiBreakdown($id){
		return DB::table('master_sub_divisi')->where('id_sub_divisi','=', $id)->get();
	}

	public static function getSubDivisiBreakdownList($id){
		return DB::table('sub_breakdown')->where('id_sub_divisi','=', $id)->get();
	}

	public static function CheckBudgetTrans($idDivisi, $idSubDivisi){
		$query = DB::select("select * from breakdown_budget bb where 1=1 
			and id_divisi = '$idDivisi' 
			and id_sub_divisi = '$idSubDivisi'
		");

		return $query;
	}

	public static function getSubDivisiBreakdownListBudget($id){
		$sql = "SELECT sb.*, bb.amount amount_sub from sub_breakdown sb left join breakdown_budget bb 
				on sb.id_sub_divisi = bb.id_sub_divisi where sb.id_sub_divisi = '$id' and sb.status = 'Active'";
		return DB::select($sql);
	}

	public static function getSubBreakdownTrans($idSubBreakdown){
		$query = DB::select("
			select sb.*, bb.amount amount_sub
			from sub_breakdown sb 
			left join breakdown_budget bb 
			on sb.id_sub_divisi = bb.id_sub_divisi where sb.id_sub_divisi = '$idSubBreakdown' 
			and sb.status = 'Active'
			and sb.amount != '0'
		");

		return $query;
	}

	public static function getIDBreakdownListBudget($id){
		return DB::table('sub_breakdown')->where('id','=', $id)->get();
	}

	public static function UpdateBudgetBreakdown($id, $arr){
		return DB::table('breakdown_budget')->where('id_sub_divisi', '=' ,$id)->update($arr);
	}

	public static function UpdateBudgetSubBreakdown($id, $arr){
		return DB::table('sub_breakdown')->where('id', '=' ,$id)->update($arr);
	}

	public static function insertSubBreakdown($params_arr){
		return DB::table('sub_breakdown')->insert($params_arr);
	}

	public static function givensubbreakdown($url){
		return DB::select("SELECT md.id_divisi, md.nama_divisi, msd.nama_sub_divisi, bb.amount, sb.nama_sub_breakdown, 
		case when sb.amount is null then 0 else sb.amount end amount_sub 
		from breakdown_budget bb left join sub_breakdown sb 
		on bb.id_sub_divisi = sb.id_sub_divisi 
		left join master_sub_divisi msd on msd.id_sub_divisi = bb.id_sub_divisi 
		left join master_divisi md on msd.id_divisi = md.id_divisi 
		where sb.id_sub_divisi is not null
		and md.status = 'Active' and msd.status = 'Active' and sb.status = 'Active' and md.url = '$url'");
	}

	public static function givensubbreakdownpdf($url){
		return DB::select("SELECT md.id_divisi, md.nama_divisi, msd.nama_sub_divisi, bb.amount, sb.nama_sub_breakdown, 
		case when sb.amount is null then 0 else sb.amount end amount_sub 
		from breakdown_budget bb left join sub_breakdown sb 
		on bb.id_sub_divisi = sb.id_sub_divisi 
		left join master_sub_divisi msd on msd.id_sub_divisi = bb.id_sub_divisi 
		left join master_divisi md on msd.id_divisi = md.id_divisi 
		where sb.id_sub_divisi is not null
		and md.status = 'Active' and msd.status = 'Active' and sb.status = 'Active' and md.id_divisi = '$url'");
	}

	public static function insertBerkas($arr_params){
		try{
			return DB::table('data_request_budget')->insert($arr_params);
		}catch(\Exception $e){
			return false;
			abort(404);
		}
	}

	public static function getDashboardNew(){
		if(Auth::user()->role == '1'){
			$id_divisi = Auth::user()->id_divisi;	
			$query = DB::select("SELECT 
					mb.id_divisi
					, mb.amount ms_budget
					, (case when bb.amount is null then 0 else bb.amount end) ms_breakdown
					, (case when sb.amount is null then 0 else sb.amount end) ms_sub_breakdown
					, mb.amount + (case when bb.amount is null then 0 else bb.amount end) + 
						(case when sb.amount is null then 0 else sb.amount end) total
					, (case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end) request
					, mb.amount + (case when bb.amount is null then 0 else bb.amount end) + 
						(case when sb.amount is null then 0 else sb.amount end) - (case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end) sisa
					, case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end
						/ (mb.amount + case when bb.amount is null then 0 else bb.amount end + 
						case when sb.amount is null then 0 else sb.amount end) * 100 as persen
					, mb.status 
					, mb.periode_end
					, (case when mb.periode_end >= CURDATE() then 'Active' else 'Expired' end) exp_status
				from master_budget mb 
				left join (select id_divisi, sum(amount) amount from breakdown_budget group by id_divisi) bb on mb.id_divisi = bb.id_divisi 
				left join (select id_divisi, sum(amount) amount from sub_breakdown group by id_divisi) sb on mb.id_divisi = sb.id_divisi
				-- left join (select id_divisi, sum(nilai_pembiayaan) nilai_pembiayaan from data_request_budget drb where 1=1 and status = '2' group by id_divisi) drb on mb.id_divisi = drb.id_divisi
				left join (select drb2.ms_period_end, drb2.ms_period_from, drb2.id_divisi, sum(drb2.nilai_pembiayaan) nilai_pembiayaan from data_request_budget drb2 where 1=1 and drb2.status = '2' and drb2.ms_period_end > CURDATE() group by drb2.id_divisi) drb 
					on mb.id_divisi = drb.id_divisi
				where mb.id_divisi in ('$id_divisi') and mb.status = 'Active'

			");
		}else if(Auth::user()->role == '3'){
			$id_divisi = Auth::user()->id_divisi;
			$id = Auth::user()->id;
			$query = DB::select("SELECT 
					mb.id_divisi
					, mb.amount ms_budget
					, (case when bb.amount is null then 0 else bb.amount end) ms_breakdown
					, (case when sb.amount is null then 0 else sb.amount end) ms_sub_breakdown
					, mb.amount + (case when bb.amount is null then 0 else bb.amount end) + 
						(case when sb.amount is null then 0 else sb.amount end) total
					, (case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end) request
					, mb.amount + (case when bb.amount is null then 0 else bb.amount end) + 
						(case when sb.amount is null then 0 else sb.amount end) - (case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end) sisa
					, case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end
						/ (mb.amount + case when bb.amount is null then 0 else bb.amount end + 
						case when sb.amount is null then 0 else sb.amount end) * 100 as persen
					, mb.status 
					, mb.periode_end
					, (case when mb.periode_end >= CURDATE() then 'Active' else 'Expired' end) exp_status
				from master_budget mb 
				left join (select id_divisi, sum(amount) amount from breakdown_budget group by id_divisi) bb on mb.id_divisi = bb.id_divisi 
				left join (select id_divisi, sum(amount) amount from sub_breakdown group by id_divisi) sb on mb.id_divisi = sb.id_divisi
				-- left join (select id_divisi, sum(nilai_pembiayaan) nilai_pembiayaan from data_request_budget drb where 1=1 and status = '2' group by id_divisi) drb on mb.id_divisi = drb.id_divisi
				left join (select drb2.ms_period_end, drb2.ms_period_from, drb2.id_divisi, sum(drb2.nilai_pembiayaan) nilai_pembiayaan from data_request_budget drb2 where 1=1 and drb2.status = '2' and drb2.ms_period_end > CURDATE() group by drb2.id_divisi) drb 
					on mb.id_divisi = drb.id_divisi
				where 1=1
				and mb.id_divisi = '$id_divisi'
			");
		}else{
			// $query = DB::select("select 
			// 		mb.id_divisi
			// 		, mb.amount ms_budget
			// 		, (case when bb.amount is null then 0 else bb.amount end) ms_breakdown
			// 		, (case when sb.amount is null then 0 else sb.amount end) ms_sub_breakdown
			// 		, mb.amount + (case when bb.amount is null then 0 else bb.amount end) + 
			// 			(case when sb.amount is null then 0 else sb.amount end) total
			// 		, (case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end) request
			// 		, mb.amount + (case when bb.amount is null then 0 else bb.amount end) + 
			// 			(case when sb.amount is null then 0 else sb.amount end) - (case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end) sisa
			// 		, case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end
			// 			/ (mb.amount + case when bb.amount is null then 0 else bb.amount end + 
			// 			case when sb.amount is null then 0 else sb.amount end) * 100 as persen
			// 		, mb.status 
			// 		, mb.periode_from
			// 		, mb.periode_end
			// 		, drb.ms_period_from
			// 		, drb.ms_period_end
			// 		, (case when mb.periode_end >= CURDATE() then 'Active' else 'Expired' end) exp_status
			// 	from master_budget mb 
			// 	left join (select id_divisi, sum(amount) amount from breakdown_budget group by id_divisi) bb on mb.id_divisi = bb.id_divisi 
			// 	left join (select id_divisi, sum(amount) amount from sub_breakdown group by id_divisi) sb on mb.id_divisi = sb.id_divisi
			// 	left join (select drb2.ms_period_end, drb2.ms_period_from, drb2.id_divisi, sum(drb2.nilai_pembiayaan) nilai_pembiayaan from data_request_budget drb2 where 1=1 and drb2.status = '2' and drb2.ms_period_end > CURDATE() group by drb2.id_divisi) drb 
			// 		on mb.id_divisi = drb.id_divisi
			// 		and drb.ms_period_from < CURDATE()
		
			// ");

			$query = DB::select("SELECT 
					mb.id_divisi
					, mb.amount ms_budget
					, (case when bb.amount is null then 0 else bb.amount end) ms_breakdown
					, (case when sb.amount is null then 0 else sb.amount end) ms_sub_breakdown
					, mb.amount + (case when bb.amount is null then 0 else bb.amount end) + 
						(case when sb.amount is null then 0 else sb.amount end) + 
						(case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end) total
					, (case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end) request
					, mb.amount + (case when bb.amount is null then 0 else bb.amount end) + 
						(case when sb.amount is null then 0 else sb.amount end) + 
						(case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end) - (case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end) sisa
					, case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end
						/ (mb.amount + case when bb.amount is null then 0 else bb.amount end + 
						case when sb.amount is null then 0 else sb.amount end) * 100 as persen
					, mb.status 
					, mb.periode_from
					, mb.periode_end
					, drb.ms_period_from
					, drb.ms_period_end
					, (case when mb.periode_end >= CURDATE() then 'Active' else 'Expired' end) exp_status
				from master_budget mb 
				left join (select id_divisi, sum(amount) amount from breakdown_budget group by id_divisi) bb on mb.id_divisi = bb.id_divisi 
				left join (select id_divisi, sum(amount) amount from sub_breakdown group by id_divisi) sb on mb.id_divisi = sb.id_divisi
				left join (select drb2.ms_period_end, drb2.ms_period_from, drb2.id_divisi, sum(drb2.nilai_pembiayaan) nilai_pembiayaan from data_request_budget drb2 where 1=1 and drb2.status = '2' and drb2.ms_period_end >= CURDATE() group by drb2.id_divisi) drb 
					on mb.id_divisi = drb.id_divisi
					and drb.ms_period_from <= CURDATE()	
			");
		}
		return $query;
	}

	public static function getDashboard(){
		if(Auth::user()->role == '1'){
			$id_divisi = Auth::user()->id_divisi;	
			$query = DB::select("SELECT mb.amount, bb.amount amount2, drb.nilai_pembiayaan, (mb.amount + case when bb.amount is null then 0 else bb.amount end) + 
								case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end total,
								case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end request, 
								(mb.amount + case when bb.amount is null then 0 else bb.amount end) sisa,
								(case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end
								/ (mb.amount + case when bb.amount is null then 0 else bb.amount end)) * 100 as persen
								from master_budget mb left join 
								(select id_divisi, case when sum(nilai_pembiayaan) is null then 0 else sum(nilai_pembiayaan) end 
								nilai_pembiayaan from data_request_budget
								where id_divisi in ('$id_divisi') and status = '2' GROUP by id_divisi) drb 
								on mb.id_divisi = drb.id_divisi 
								left join 
								-- (select id_divisi, sum(amount) amount from breakdown_budget
								-- where id_divisi in ('$id_divisi') GROUP by id_divisi) 
								(select breakdown_budget.id_divisi, sum(amount)+sb.amountnya amount from breakdown_budget 
								left join (select sum(amount) as amountnya, id_divisi  from sub_breakdown group by id_divisi) sb
								on sb.id_divisi  = breakdown_budget.id_divisi 
								where breakdown_budget.id_divisi in ('$id_divisi') GROUP by id_divisi)
								as bb on mb.id_divisi = bb.id_divisi 
								where mb.id_divisi in ('$id_divisi') and mb.status = 'Active'
								and mb.periode_end >= CURDATE()
								");
		}else if(Auth::user()->role == '3'){
			$id = Auth::user()->id;
			$query = DB::select("SELECT (case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end + case when bb.amount is null then 0 else bb.amount end) total   
								,case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end request,
								case when bb.amount is null then 0 else bb.amount end sisa,
								(case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end / (case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end + case when bb.amount is null then 0 else bb.amount end))
								* 100  as persen
								from master_user mu left join 
								-- (select id_sub_divisi, amount from breakdown_budget bb)
								(select breakdown_budget.id_sub_divisi, sum(amount)+sb.amountnya amount from breakdown_budget 
								left join (select sum(amount) as amountnya, id_sub_divisi  from sub_breakdown group by id_divisi) sb
								on sb.id_sub_divisi  = breakdown_budget.id_sub_divisi GROUP by id_sub_divisi) bb
								on bb.id_sub_divisi = mu.id_sub_divisi left join 
								(select employee_id, sum(nilai_pembiayaan) nilai_pembiayaan from data_request_budget 
								where employee_id = '$id' and status = '2' ) drb
								on drb.employee_id = mu.id where mu.id = '$id'
								-- and mb.periode_end >= CURDATE()
								");
		}else{
			// $query = DB::select("SELECT mb.id_divisi, mb.amount, bb.amount amount2, sb.amountnya, drb.nilai_pembiayaan, (mb.amount + (case when sb.amountnya is null then 0 else sb.amountnya end) + (case when bb.amount is null then 0 else bb.amount end) + 
			// 	case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end) total,
			// 	case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end request, 
			// 	(mb.amount + case when sb.amountnya is null then 0 else sb.amountnya end + case when bb.amount is null then 0 else bb.amount end) sisa,
			// 	(case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end
			// 	/ (mb.amount + case when sb.amountnya is null then 0 else sb.amountnya end + case when bb.amount is null then 0 else bb.amount end)) * 100 as persen
			// 	from master_budget mb left join 
			// 	(select id_divisi, case when sum(nilai_pembiayaan) is null then 0 else sum(nilai_pembiayaan) end 
			// 	nilai_pembiayaan from data_request_budget
			// 	where 1=1
			// 	and status = '2' 
			// 	GROUP by id_divisi) drb 
			// 	on mb.id_divisi = drb.id_divisi 
			// 	left join 
			// 	(select sum(amount) as amount, id_divisi from breakdown_budget bb group by id_divisi) bb
			// 	on mb.id_divisi = bb.id_divisi 
			// 	left join
			// 	(select sum(amount) as amountnya, id_divisi from sub_breakdown group by id_divisi) sb
			// 	on mb.id_divisi = sb.id_divisi 
			// 	where 1=1
			// 	and mb.status = 'Active'
			// 	and mb.periode_end >= CURDATE()
			// ");

			$query = DB::select("SELECT mb.id_divisi, mb.amount, bb.amount amount2, sb.amountnya bu, drb.nilai_pembiayaan, (mb.amount + (case when sb.amountnya is null then 0 else sb.amountnya end) + (case when bb.amount is null then 0 else bb.amount end) + 
				case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end) + (case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end) total,
				case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end request, 
				(mb.amount + (case when sb.amountnya is null then 0 else sb.amountnya end) + (case when bb.amount is null then 0 else bb.amount end) + 
				case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end) sisa,
				-- (mb.amount + case when sb.amountnya is null then 0 else sb.amountnya end + case when bb.amount is null then 0 else bb.amount end) sisa,
				(case when drb.nilai_pembiayaan is null then 0 else drb.nilai_pembiayaan end
				/ (mb.amount + case when sb.amountnya is null then 0 else sb.amountnya end + case when bb.amount is null then 0 else bb.amount end)) * 100 as persen
				from master_budget mb left join 
				(select id_divisi, case when sum(nilai_pembiayaan) is null then 0 else sum(nilai_pembiayaan) end 
				nilai_pembiayaan from data_request_budget
				where 1=1
				and status = '2' 
				GROUP by id_divisi) drb 
				on mb.id_divisi = drb.id_divisi 
				left join 
				(select sum(amount) as amount, id_divisi from breakdown_budget bb group by id_divisi) bb
				on mb.id_divisi = bb.id_divisi 
				left join
				(select sum(amount) as amountnya, id_divisi from sub_breakdown group by id_divisi) sb
				on mb.id_divisi = sb.id_divisi 
				where 1=1
				and mb.status = 'Active'
				and mb.periode_end >= CURDATE()
			");
		}
		return $query;
	}

	public static function ApproveKadiv($id){
		$date_now = date('Y-m-d');
		try{
			return DB::table('data_request_budget')->where('id','=',$id)->update(['approve_date' => $date_now, 'update_date' => $date_now, 'status' => '1']);
		}catch(\Exception $e){
			\Log::info($e->getMessage());
			abort(404);
			return false;
		}
	}

	public static function ApproveAdmin($id){
		$date_now = date('Y-m-d');
		try{
			return DB::table('data_request_budget')->where('id','=',$id)->update(['approve_date' => $date_now, 'update_date' => $date_now, 'status' => '2']);
		}catch(\Exception $e){
			\Log::info($e->getMessage());
			abort(404);
			return false;
		}
	}

	public static function RejectRequest($id, $status){
		$date_now = date('Y-m-d');
		try{
			return DB::table('data_request_budget')->where('id','=',$id)->update(['reject_date' => $date_now, 'update_date' => $date_now, 'status' => '3']);
		}catch(\Exception $e){
			\Log::info($e->getMessage());
			abort(404);
			return false;
		}
	}

	public static function CheckBudgetRequest($id){
		//cekhavechildorno
		$ck = DB::table("data_request_budget")->where("id", "=", $id)->get();
		if($ck[0]->child == null){
			return DB::select("SELECT (case when bb.amount is null then 0 else bb.amount end - case when drb.nilai_pembiayaan is null
								then 0 else drb.nilai_pembiayaan end) as biaya, bb.id_breakdown from master_user mu inner join breakdown_budget bb on mu.id_sub_divisi = bb.id_sub_divisi 
								inner join data_request_budget drb on mu.id = drb.employee_id where drb.id = '$id'");
		}else{
			$sql = "SELECT (case when bb.amount is null then 0 else bb.amount end - case when drb.nilai_pembiayaan is null
					then 0 else drb.nilai_pembiayaan end) as biaya from master_user mu 
					inner join 
					(select amount, id_sub_divisi  from sub_breakdown where id ='".$ck[0]->child."') bb 
					on mu.id_sub_divisi = bb.id_sub_divisi 
					inner join data_request_budget drb on mu.id = drb.employee_id where drb.id = '$id'";
			return DB::select($sql);
		}

	}

	public static function UpdateBudgetRequestBreakdown($id, $amount){
		try{
			return DB::table('breakdown_budget')->where('id_breakdown', '=', $id)->update(['amount' => $amount]);
		}catch(\Exception $e){
			return $e->getMessage();
		}
	}
	
	public static function UpdateBudgetRequestSubBreakdown($id, $amount){
		try{
			return DB::table('sub_breakdown')->where('id', '=', $id)->update(['amount' => $amount]);
		}catch(\Exception $e){
			return $e->getMessage();
		}
	}

	public static function CheckBudgetTemp($id){
		try{
			$budget = 0;
			$dataBudget = DB::table('temp_budget_all')->where('id_divisi', '=', $id)->get();
			if(count($dataBudget) > 0){
				$budget = $dataBudget[0]->amount;
			}
			return $budget;
		}catch(\Exception $e){
			return $e->getMessage();
		}
	}

	public static function getDataBreakdown($idDataDivisi){
		$getData = DB::select("select * from master_sub_divisi msd where 1=1 and id_divisi = '$idDataDivisi'");
		return $getData;
	}

	public static function getDataSubBreakdown($idDivisi, $idSubDivisi){
		$getData = DB::select("select * from sub_breakdown sb join master_sub_divisi msd
			on msd.id_sub_divisi = sb.id_sub_divisi
			where 1=1 
			and sb.id_divisi = '$idDivisi'
			and sb.id_sub_divisi = '$idSubDivisi'
		");
		return $getData;
	}

	// public static function insertDataBreakTrans($params){
	// 	$query = DB::select("INSERT INTO breakdown_budget (id_budget, id_divisi, id_sub_divisi, amount, created_date, updated_date) VALUES (?, ?, ?, ?, ?, ?)",
	// 		[
	// 			$params['idBudget'],
	// 			$params['idDivisi'],
	// 			$params['idBreakDown'],
	// 			$params['sumTransfer'],
	// 			now(),
	// 			now()
	// 		]
	// 	);
			
	// 	return $query;
	// }

	public static function insUptTransferBreakdown($params){
		try{
			if($params['new_trans'] != "" || $params['new_trans'] == "new"){
				
				$queryTransfer = DB::select("INSERT INTO breakdown_budget (id_budget, id_divisi, id_sub_divisi, amount, created_date, updated_date) VALUES (?, ?, ?, ?, ?, ?)",
					[
						$params['idBudget'],
						$params['idDivisi'],
						$params['idBreakdown'],
						$params['tot_transfer'],
						now(),
						now()
					]
				);

			}else{
				
				$queryTransfer = DB::table('breakdown_budget')
				->where('id_divisi', '=', $params['idDivisi'])
				->where('id_sub_divisi', '=', $params['idBreakdown'])
				->update(['amount' => $params['tot_transfer']]);
				
			}
			
			if($queryTransfer > 0){
				if($params['id_subBreakOrigin'] == NULL || $params['id_subBreakOrigin'] == ""){
					return DB::table('breakdown_budget')->where('id_breakdown', '=', $params['id_BudgetOrigin'])->update(['amount' => $params['sisa_budget']]);
				}else{
					return DB::table('sub_breakdown')->where('id', '=', $params['id_subBreakOrigin'])->update(['amount' => $params['sisa_budget']]);
				}
			}
			return $queryTransfer;
		}catch(\Exception $e){
			return $e->getMessage();
		}
	}
	public static function insUptTransferSubBreakdown($params){
		try{
			$queryTransferSub =  DB::table('sub_breakdown')->where('id', '=', $params['idSubBreakdown'])->update(['amount' => $params['tot_transfer']]);
			if($queryTransferSub > 0){
				if($params['id_subBreakOrigin'] == NULL || $params['id_subBreakOrigin'] == ""){
					return DB::table('breakdown_budget')->where('id_breakdown', '=', $params['id_BudgetOrigin'])->update(['amount' => $params['sisa_budget']]);
				}else{
					return DB::table('sub_breakdown')->where('id', '=', $params['id_subBreakOrigin'])->update(['amount' => $params['sisa_budget']]);
				}
			}
			return $queryTransferSub;
		}catch(\Exception $e){
			return $e->getMessage();
		}
	}

	public static function insLogTrans($params){
		
		$query = DB::select('INSERT INTO log_budget_transfer (id_divisi_frm, id_budget_frm, id_sub_budget_frm, from_divisi, from_sub_divisi, from_child_sub_divisi, budget_awal, total_sisa_budget, id_divisi_to, id_budget_to, id_sub_budget_to, to_divisi, to_sub_divisi, to_child_sub_divisi, amount, periode_from, periode_end, create_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
			[
				$params['idDivisiOrigin'],
				$params['id_BudgetOrigin'],
				$params['id_subBreakOrigin'],
				$params['namaDivisiFrm'],
				$params['namaSubDivisiFrm'],
				$params['namaSubChildDivisiFrm'],
				$params['budgetAwal'],
				$params['sisa_budget'],
				$params['idDivisi'],
				$params['idBreakdown'],
				$params['idSubBreakdown'],
				$params['namaDivisiTo'],
				$params['namaSubDivisiTo'],
				$params['namaSubChildDivisiTo'],
				$params['tot_transfer'],
				null,
				null,
				now()
			]
		);

		return $query;
	}

	public static function CheckBudgetTempTrans($id){
		try{
			$budget = 0;
			$dataBudget = DB::table('sub_breakdown')->where('id', '=', $id)->get();
			if(count($dataBudget) > 0){
				$budget = ['idBudget' => $dataBudget[0]->id, 'amount' => $dataBudget[0]->amount];
			}
			return $budget;
		}catch(\Exception $e){
			return $e->getMessage();
		}
	}

	public static function UpdateTempBudget($amount, $id_divisi){
		try{
			return DB::table('temp_budget_all')->where('id_divisi', '=', $id_divisi)->update(['amount' => $amount]);
		}catch(\Exception $e){
			\Log::info($e);
			abort(404);
			return false;
		}
	}

	public static function CekMasterBudgetForTemp($id_divisi){
		try{
			return DB::table('master_budget')->where('id_divisi', '=', $id_divisi)->get();
		}catch(\Exception $e){
			return $e->getMessage();
		}
	}
	
	public static function UpdateMasterBudget($id_divisi, $amount){
		try{
			return DB::table('master_budget')->where('id_divisi', '=', $id_divisi)->update(['amount' => $amount, 'updated_date' => now()]);
		}catch(\Exception $e){
			return $e->getMessage();
		}
	}

	public static function InsetMasterBudget($arrData){
		try{
			return DB::table('master_budget')->insert($arrData);
		}catch(\Exception $e){
			return $e->getMessage();
		}
	}

	public static function getReportTransferBudget(){
		$query = DB::select("
            select
                from_divisi,
                from_sub_divisi,
                from_child_sub_divisi,
                budget_awal,
				total_sisa_budget,
                to_divisi,
                to_sub_divisi,
                to_child_sub_divisi,
                amount total_transfer,
                create_date tgl_transfer
            from log_budget_transfer
        ");

		return $query;
	}
}