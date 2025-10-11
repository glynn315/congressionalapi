<?php

use App\Http\Controllers\BudgetFundingController;
use App\Http\Controllers\FundingsController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\SolicitationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/request/display', [RequestController::class, 'displayRequest']);
Route::post('/request/store', [RequestController::class, 'storeRequest']);

Route::get('/invitation/displayInvitation', [InvitationController::class, 'displayInvitations']);
Route::post('/invitation/storeInvitation', [InvitationController::class, 'storeRequest']);

Route::get('/solicitation/displaySolicitation', [SolicitationController::class, 'displaySolicitations']);
Route::post('/solicitation/storeSolicitation', [SolicitationController::class, 'storeRequest']);

Route::get('/fundings/displayFundings', [FundingsController::class, 'displayFundings']);
Route::post('/fundings/storeFundings', [FundingsController::class, 'storeFundings']);

Route::get('/budget/displayBudgets', [BudgetFundingController::class, 'displayBudgets']);
Route::post('/budget/storeBudgets', [BudgetFundingController::class, 'storeBudgets']);
Route::get('/budget/countBudget', [BudgetFundingController::class, 'countBudgetsPerFunding']);
