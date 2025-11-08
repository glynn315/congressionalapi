<?php

use App\Http\Controllers\AccountManagementController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\BudgetFundingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FundingsController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\MasterListController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\SolicitationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/dashboard', [DashboardController::class, 'getDashboard']);

Route::prefix('accounts')->group(function () {
    Route::post('/login', [AccountManagementController::class, 'login']);
    Route::post('/logout', [AccountManagementController::class, 'logout']);
    Route::get('/me', [AccountManagementController::class, 'me'])->middleware('auth:api');
    Route::get('/displayAccount', [AccountManagementController::class, 'displayAccounts']);
    Route::post('/storeAccounts', [AccountManagementController::class, 'storeAccount']);
});

Route::get('/request/display', [RequestController::class, 'displayRequest']);
Route::get('/request/displayRecent', [RequestController::class, 'displayRecentRequests']);
Route::post('/request/store', [RequestController::class, 'storeRequest']);

Route::get('/area/dropdown', [AreaController::class, 'dropdownArea']);
Route::post('/area/store', [AreaController::class, 'storeArea']);

Route::get('/personel/displayList', [MasterListController::class, 'displayPersonel']);
Route::get('/personel/displayList/{id}', [MasterListController::class, 'displayPersonelbyID']);
Route::post('/personel/store', [MasterListController::class, 'storePersonel']);

Route::get('/invitation/displayInvitation', [InvitationController::class, 'displayInvitations']);
Route::post('/invitation/storeInvitation', [InvitationController::class, 'storeRequest']);

Route::get('/solicitation/displaySolicitation', [SolicitationController::class, 'displaySolicitations']);
Route::post('/solicitation/storeSolicitation', [SolicitationController::class, 'storeRequest']);

Route::get('/fundings/displayFundings', [FundingsController::class, 'displayFundings']);
Route::get('/fundings/displayPettyCashFunding', [FundingsController::class, 'displayFundingPettyCash']);
Route::post('/fundings/storeFundings', [FundingsController::class, 'storeFundings']);

Route::get('/budget/displayBudgets', [BudgetFundingController::class, 'displayBudgets']);
Route::post('/budget/storeBudgets', [BudgetFundingController::class, 'storeBudgets']);
Route::get('/budget/countBudget', [BudgetFundingController::class, 'countBudgetsPerFunding']);


