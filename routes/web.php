<?php

use App\Enum\AccountType;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\LedgerController;
use App\Http\Controllers\RevenueController;

Route::get('/', function () {
    if (session('is_admin_logged_in')) return redirect('/journals');
    return view('admin.auth.authLogin');
})->name('admin-login');

Route::post('/admins/login', [AuthController::class, 'login']);
Route::get('/admins/logout', [AuthController::class, 'logout']);

Route::middleware(['admin'])->group(function () {

    Route::resource('/categories', CategoryController::class);
    Route::resource('/revenues', RevenueController::class);
    Route::resource('/expenses', ExpenseController::class);
    Route::resource('/journals', JournalController::class);
    Route::resource('/ledgers', LedgerController::class);
    // Route::resource('/users', UserController::class);
});

Route::get('/accountType', function () {
    $acc = AccountType::ACCOUNT_TYPE;
    $assetsAccountName = $acc['Assets']['accountName'];
    return view('accountType', compact('acc'));
});
