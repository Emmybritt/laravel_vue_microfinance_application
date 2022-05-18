<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\BranchesController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransactionsController;
use App\Models\Role;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\DisbursementController;
use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/user', function (Request $request) {
        $role = Role::find($request->user()->role_id);
    // return ;
        return response([
        'user' => $request->user(),
        'permission' => $role->permission,
        ]);
    });

    Route::put('/permission/{id}', [RolesController::class, 'UpdatePermission']);

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::resource('/account', AccountController::class);
    Route::resource('/role', RolesController::class);
    Route::delete('/delete', [RolesController::class, 'deleteAllPost']);
    Route::get('/role-counts', [RolesController::class, 'roleCount']);
    Route::get('/staff-counts', [AuthController::class, 'countStaffs']);
    Route::resource('branch', BranchesController::class);
    Route::delete('/deleteAllBranches', [BranchesController::class, 'DeleteAllBranches']);
    Route::get('branch-counts', [BranchesController::class, 'BranchCounts']);
    Route::get('/staffs', [AuthController::class, 'index']);
    Route::delete('/deleteStaff/{user}', [AuthController::class, 'deleteStaff']);
    Route::get('/accounts-counts',[ AccountController::class , 'getAccountsCount']);
    Route::get('/allAccounts',[ AccountController::class , 'AllAccounts']);
    Route::get('/get-account-detail/{account_number}', [AccountController::class , 'GetAccountDetail']);
    Route::resource('/transaction', TransactionsController::class);
    Route::resource('/expenses', ExpensesController::class);
    // Route::post('/trans/{account}/transaction', [TransactionsController::class, 'storeTransaction']);
    Route::get('/recent-expenses', [ExpensesController::class, 'checkRecentExpenses']);
    Route::get('/calculate-expenses', [ExpensesController::class, 'calculateTotalExpenses']);
    Route::get('/search-expenses/{query}', [ExpensesController::class, 'searchExpenses']);
    Route::get('/search-accounts/{details}', [AccountController::class , 'searchAccounts']);
    Route::get('/accounts-transactions/{id}', [AccountController::class, 'AcountTransactions']);
    Route::get('/total-debit-and-credit/{id}', [TransactionsController::class , 'totalCreditAndDebit']);
    Route::resource('/income', IncomeController::class);
    Route::resource('/loan', LoanController::class);
    Route::resource('/disbursement', DisbursementController::class);
    Route::get('/recent-income', [IncomeController::class, 'recentIncome']);
    Route::get('/loan_users_count', [LoanController::class, 'fetchTotalLoanUser']);
    Route::post('/pay_loan', [LoanController::class, 'payLoan']);
    Route::get('/get_loan_balance', [LoanController::class, 'returnAllPayment']);
    Route::get('/AlltotalLoansCounts', [LoanController::class,'allLoansCount']);
    
    Route::get('/getAllLoanUsers', [LoanController::class, 'getAllLoanUser']);
    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::post('/postLoanUsersPayment', [LoanController::class, 'postLoanUsersPayment']);
    Route::get('/singleRole/{id}', [RolesController::class, 'singleRole']);
    Route::post('/newPermission/{id}', [RolesController::class, 'newRolePermission']);
    Route::get('/GetRolesPermission/{id}', [RolesController::class, 'TotalSingleRolePermission']);
});

Route::get('/aboutus', [AboutUsController::class, 'index']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/register', [AuthController::class, 'register']);
