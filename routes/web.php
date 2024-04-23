<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('clear-compiled');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    return "Cache is cleared";
});

Route::get('login', 'UserController@index')->name('login');

Route::post('proses.login', 'UserController@ProsesLogin')->name('proses.login');

Route::group(['middleware' => ['auth']], function(){
    Route::get('dashboard', 'MainController@index')->name('dashboard');
    
    Route::get('report.budget/{url}', 'MainController@reportBudget')->name('report-budget');

    Route::post('report.budget', 'MainController@reportBudget')->name('report-budget');
    
    Route::get('report.budget.breakdown/{url}', 'MainController@reportBudgetBreakdown')->name('report-budget-breakdown');

    Route::post('report.budget.breakdown', 'MainController@reportBudgetBreakdown')->name('report-budget-breakdown');

    Route::get('report.budget.sub.breakdown/{url}', 'MainController@reportBudgetSubBreakdown')->name('report.budget.sub.breakdown');

    Route::get('master/{menu}', 'Master@index')->name('master');

    Route::post('save.data', 'Master@saveData')->name('save.data');

    Route::get('request', 'RequestController@index')->name('request');
    
    Route::post('save.request.budget', 'RequestController@request_budget')->name('save.request.budget');

    Route::post('update.temp.and.given', 'Master@UpdateAndGivenTemp')->name('update.temp.and.given');
    
    Route::get('data-request', 'RequestController@dataRequest')->name('data-request');

    Route::post('request_new_ya', 'RequestController@request_new_ya')->name('request_new_ya');

    Route::post('logout', 'UserController@logout')->name('logout');

    Route::get('getDetailDivisi/{idDivisi}', 'Master@getDetailDivisi');

    Route::get('DeleteDivisi/{idDivisi}', 'Master@DeleteDivisi');

    Route::get('status_update/{idUser}', 'Master@status_update');

    Route::get('status_update_sub/{idUser}', 'Master@status_update_sub');

    Route::get('cek_child_sub_breakdown/{idUser}', 'Master@cek_child_sub_breakdown');

    Route::get('DeleteUser/{idUser}', 'Master@DeleteUser');
    
    Route::get('cek_temp_budget/{idUser}', 'Master@CheckBudgetTemp');

    Route::post('cekDataTransferDivisi/{idData}', 'Master@cekDataTransferDivisi');

    Route::post('save.transfer.budget', 'Master@saveTransferBudget')->name('save.transfer.budget');

    Route::post('cekSubBreakdownTransfer/{idData}', 'Master@cekSubBreakdownTransfer');

    Route::get('cek_budget_trans/{id_divisi}/{id_sub_divisi}', 'Master@CheckBudgetTrans');
    
    Route::get('getSubBreakdownTrans/{idData}', 'Master@getSubBreakdownTrans');

    Route::get('delete_budget/{idbudget}', 'Master@DeleteBudget');

    Route::get('delete_budget_sub/{idbudget}', 'Master@DeleteBudgetSub');

    Route::get('delete_budget_sub_breakdown/{id}', 'Master@DeleteBudgetSubBreakdown');

    Route::get('getforedit', 'Master@getForEdit');

    Route::get('getforedit-sub/{id}', 'Master@getForEditWithParams')->name('getforedit-sub');

    Route::get('getforedit_subdivisi/{id}', 'Master@getforeditSubdivisi');

    Route::get('get_detail_budget/{id}', 'Master@getDetailBudget');

    Route::get('get_detail_budget_new/{id}', 'Master@getDetailBudgetNew');

    Route::get('get_detail_request_budget/{id}', 'Master@getDetailRequestBudget');

    Route::get('getsubdivisi/{id}', 'Master@getSubDivisi');
    
    Route::post('approve', 'Master@Approve')->name('approve');

    Route::post('reject', 'Master@Reject')->name('reject');

    Route::get('download','MainController@downloadpdf')->name('download');

    Route::get('downloadReqDtl', 'MainController@downloadReqDetail')->name('downloadReqDtl');

    Route::get('downloadbreakdown', 'MainController@downloadpdfbreakdown')->name('downloadbreakdown');

    Route::get('downloadsubbreakdown', 'MainController@downloadpdfsubbreakdown')->name('downloadsubbreakdown');

    Route::post('readall_notif', 'MainController@readallNotif')->name('readall_notif');

    Route::post('rename_division', 'Master@Rename')->name('rename_division');

    Route::post('list-detail-sub_brekdown', 'Master@ListDetailSubBreakdown')->name('list-detail-sub_brekdown');

    Route::post('list-detail-sub_brekdown_budget', 'Master@ListDetailSubBreakdownBudget')->name('list-detail-sub_brekdown_budget');

    Route::post('update_sub_breakdown', 'Master@updateSubBreakdown')->name('update_sub_breakdown');

    Route::get('check_sub_breakdown/{id}', 'RequestController@checkSubBreakdown')->name('check_sub_breakdown');

    Route::get('report-all-budget', 'MainController@reportAllBudget')->name('report-all-budget');

    Route::get('setting-account', 'MainController@settingAccount')->name('setting-account');

    Route::get('send-mail', function () {
   
        $details = [
            'title' => 'Mail Test',
            'body' => 'This is for testing email using smtp'
        ];

        $getNameDivForSubject = 'Test Mail';
        // dd($details);
       
        \Mail::to('ardiyanputra95@gmail.com')->send(new \App\Mail\SendMailNew($details, $getNameDivForSubject));
       
        dd("Email is Sent.");
    });

    // Route::get('getDataReport', 'MainController@getDataReport')->name('getDataReport');
    // Route::post('getDataReport', 'MainController@getDataReport')->name('getDataReport');
});