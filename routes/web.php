<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VictimController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Auth\AdminLoginController;


Route::get('/', function () {
    return view('home.home');
});


// Authentication Routes
Route::middleware('guest')->group(function () {
    // Login Routes
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

    // Register Routes
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
});



Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Campaign Routes
    Route::prefix('campaigns')->group(function () {
        Route::get('/', [CampaignController::class, 'index'])->name('campaigns');
        Route::get('/create', [CampaignController::class, 'create'])->name('campaign.create');
        Route::get('/create-bulk', [CampaignController::class, 'createBulk'])->name('campaign.create.bulk');
        Route::post('/store', [CampaignController::class, 'store'])->name('campaign.store');
        Route::post('/store-bulk', [CampaignController::class, 'storeBulk'])->name('campaign.store.bulk');
        Route::get('/{campaign}', [CampaignController::class, 'show'])->name('campaign.show');
    });

    // Transaction Routes
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions');

    // Plan Routes
    Route::prefix('plans')->group(function () {
        Route::get('/', [PlanController::class, 'index'])->name('plans');
        Route::post('/subscribe/{plan}', [PlanController::class, 'subscribe'])->name('plans.subscribe');
        Route::get('/success', [PlanController::class, 'success'])->name('plans.success');
        Route::get('/cancel', [PlanController::class, 'cancel'])->name('plans.cancel');
    });

    // Victim Routes
    Route::prefix('victims')->group(function () {
        Route::get('/', [VictimController::class, 'index'])->name('victims');
        Route::post('/import', [VictimController::class, 'import'])->name('victims.import');
        Route::get('/export', [VictimController::class, 'export'])->name('victims.export');
        Route::delete('/{victim}', [VictimController::class, 'destroy'])->name('victims.destroy');
    });

    // Password Routes
    Route::prefix('password')->group(function () {
        Route::get('/change', [PasswordController::class, 'showChangeForm'])->name('password.change');
        Route::post('/change', [PasswordController::class, 'change'])->name('password.update');
    });

    // Activity Log
    Route::get('/activities', function () {
        return view('activities.index', [
            'activities' => auth()->user()->activities()->latest()->paginate(15)
        ]);
    })->name('activities');
});


















































// Admin Routes
Route::prefix('admin')->group(function () {

    // Protecting admin routes using the 'admin' middleware
    Route::middleware(['admin'])->group(function () {
        // Admin logout route

        Route::get('/profile', [App\Http\Controllers\Admin\AdminController::class, 'editProfile'])->name('admin.profile');
        Route::post('/profile/update', [App\Http\Controllers\Admin\AdminController::class, 'updateProfile'])->name('admin.profile.update');
        Route::post('/profile/password', [App\Http\Controllers\Admin\AdminController::class, 'updatePassword'])->name('admin.profile.password.update');

        Route::get('/change/user/password/page/{id}', [App\Http\Controllers\Admin\AdminController::class, 'showResetPasswordForm'])->name('admin.change.user.password.page');
        Route::post('/user-password-reset', [App\Http\Controllers\Admin\AdminController::class, 'resetPassword'])->name('admin.user.password_reset');

        Route::get('{user}/verification', [App\Http\Controllers\Admin\AdminController::class, 'userVerification'])->name('user.verification');
        Route::get('{user}/suspension', [App\Http\Controllers\Admin\AdminController::class, 'userSuspension'])->name('user.suspension');


        Route::get('/home', [App\Http\Controllers\Admin\AdminController::class, 'sendEmailPage'])->name('admin.home');
        Route::get('/payment-settings', [App\Http\Controllers\Admin\AdminController::class, 'paymentSettings'])->name('payment.settings');
        Route::get('/manage-users', [App\Http\Controllers\Admin\AdminController::class, 'manageUsersPage'])->name('manage.users.page');
        Route::get('/manage-transactions', [App\Http\Controllers\Admin\AdminController::class, 'manageTransactionsPage'])->name('manage.transactions.page');
        Route::get('/transactions/delete/{id}', [App\Http\Controllers\Admin\AdminController::class, 'deleteTransaction'])->name('delete.transaction');
        Route::get('/transactions/approve/{id}', [App\Http\Controllers\Admin\AdminController::class, 'approveTransaction'])->name('approve.transaction');
        Route::get('/manage-investment-plan', [App\Http\Controllers\Admin\AdminController::class, 'manageInvestmentPlan'])->name('manage.investment.plan');
        Route::get('/view-deposit/{id}/', [App\Http\Controllers\Admin\AdminController::class, 'viewDeposit']);
        Route::get('/manage-kyc', [App\Http\Controllers\Admin\AdminController::class, 'manageKycPage'])->name('manage.kyc.page');
        Route::get('/accept-kyc/{id}/', [App\Http\Controllers\Admin\AdminController::class, 'acceptKyc'])->name('admin.accept.kyc');
        Route::get('/reject-kyc/{id}/', [App\Http\Controllers\Admin\AdminController::class, 'rejectKyc'])->name('admin.reject.kyc');
        Route::get('/reset-password/{user}', [App\Http\Controllers\Admin\AdminController::class, 'resetUserPassword'])->name('reset.password');
        Route::get('/clear-account/{id}', [App\Http\Controllers\Admin\AdminController::class, 'clearAccount'])->name('clear.account');

        Route::get('/{user}/impersonate',  [App\Http\Controllers\Admin\AdminController::class, 'impersonate'])->name('users.impersonate');
        Route::get('/leave-impersonate',  [App\Http\Controllers\Admin\AdminController::class, 'leaveImpersonate'])->name('users.leave-impersonate');

        Route::post('/edit-user/{user}', [App\Http\Controllers\Admin\AdminController::class, 'editUser'])->name('edit.user');
        Route::post('/add-new-user',  [App\Http\Controllers\Admin\AdminController::class, 'newUser'])->name('add.user');
        Route::get('/delete-user/{user}',  [App\Http\Controllers\Admin\AdminController::class, 'deleteUser'])->name('delete.user');

        // Route for viewing user details
        Route::get('/user/{id}', [App\Http\Controllers\Admin\AdminController::class, 'viewUser'])->name('admin.user.view');
        Route::post('/transfer/suspend/{id}', [App\Http\Controllers\Admin\AdminController::class, 'suspendTransfer'])->name('transfer.suspend');
        Route::post('/transfer/unblock/{id}', [App\Http\Controllers\Admin\AdminController::class, 'unblockTransfer'])->name('transfer.unblock');
        Route::post('/account/suspend/{id}', [App\Http\Controllers\Admin\AdminController::class, 'suspendAccount'])->name('account.suspend');
        Route::post('/account/unblock/{id}', [App\Http\Controllers\Admin\AdminController::class, 'unblockAccount'])->name('account.unblock');

        // Define the route for opening an account
        Route::get('/user/open', [App\Http\Controllers\Admin\AdminController::class, 'openAccount'])->name('admin.user.open');





        Route::post('credit-debit', [App\Http\Controllers\Admin\AdminController::class, 'creditDebit'])->name('credit-debit');
        Route::post('credit', [App\Http\Controllers\Admin\AdminController::class, 'credit'])->name('credit');
        Route::post('debit', [App\Http\Controllers\Admin\AdminController::class, 'debit'])->name('debit');





        // Route for updating user details
        Route::post('/user/update/{id}', [App\Http\Controllers\Admin\AdminController::class, 'updateUserDetail'])->name('update_user_detail');

        // Route for updating bank details
        Route::post('/user/update/bank/{id}', [App\Http\Controllers\Admin\AdminController::class, 'updateBankDetail'])->name('update_bank_detail');

        // Route for fund user
        Route::get('/user/fund/{accountnumber}/{id}', [App\Http\Controllers\Admin\AdminController::class, 'fundUser'])->name('fund_user');

        // Route for user transaction history
        Route::get('/user/transaction/{id}', [App\Http\Controllers\Admin\AdminController::class, 'userTransaction'])->name('user_transaction');

        // Route for user transfer tracking
        Route::get('/user/transfer/tracking/{id}', [App\Http\Controllers\Admin\AdminController::class, 'userTransferTracking'])->name('user_transfer_tracking');

        // Route for debit user
        Route::get('/user/debit/{accountnumber}/{id}', [App\Http\Controllers\Admin\AdminController::class, 'debitUser'])->name('debit_user');

        // Route for changing user photo
        Route::get('/user/photo/{id}', [App\Http\Controllers\Admin\AdminController::class, 'updatePhoto'])->name('update_photo');

        // Route for user activity
        Route::get('/user/activity/{id}', [App\Http\Controllers\Admin\AdminController::class, 'userActivity'])->name('user_activity');

        // Route for user password reset
        Route::get('/user/password/reset/{userid}', [App\Http\Controllers\Admin\AdminController::class, 'userPasswordReset'])->name('user_password_reset');


        // Route for changing email user
        Route::get('/send/email', [App\Http\Controllers\Admin\AdminController::class, 'sendEmailPage'])->name('send.email');
        Route::post('/send/email', [App\Http\Controllers\Admin\AdminController::class, 'sendEmail'])->name('send.mail');
        Route::post('/send-email-all', [App\Http\Controllers\Admin\AdminController::class, 'sendEmailToAllUsers'])->name('send.email.all');


        // Route for changing email user
        Route::get('/send/email', [App\Http\Controllers\Admin\AdminController::class, 'sendEmailPage'])->name('send.email.page');
        Route::post('/send/email', [App\Http\Controllers\Admin\AdminController::class, 'sendUserEmail'])->name('send.mail');


        Route::match(['get', 'post'], 'vat-code', [App\Http\Controllers\Admin\TransactionController::class, 'vatCode'])->name('vat-code');
        Route::post('/credit-savings', [App\Http\Controllers\Admin\TransactionController::class, 'creditSavings'])->name('credit.savings.balance');
        Route::post('/debit-savings', [App\Http\Controllers\Admin\TransactionController::class, 'debitSavings'])->name('debit.savings.balance');
        Route::post('/credit-checking', [App\Http\Controllers\Admin\TransactionController::class, 'creditChecking'])->name('credit.checking.balance');
        Route::post('/debit-checking', [App\Http\Controllers\Admin\TransactionController::class, 'debitChecking'])->name('debit.checking.balance');
        Route::post('/admin/update-user', [App\Http\Controllers\Admin\AdminController::class, 'adminUpdateUser'])->name('admin.updateUser');
        Route::post('/admin/toggle-account-status', [App\Http\Controllers\Admin\AdminController::class, 'toggleAccountStatus'])
            ->name('admin.toggleAccountStatus');
        Route::post('/admin/toggle-email-status', [App\Http\Controllers\Admin\AdminController::class, 'toggleEmailStatus'])
            ->name('admin.toggleEmailStatus');
        Route::post('/admin/user/toggle-email-status', [App\Http\Controllers\Admin\AdminController::class, 'toggleEmailStatus'])->name('admin.user.toggleEmailStatus');
        Route::post('/admin/user/toggle-user-status', [App\Http\Controllers\Admin\AdminController::class, 'toggleUserStatus'])->name('admin.user.toggleUserStatus');
        Route::post('/admin/transfers/update-status', [App\Http\Controllers\Admin\AdminController::class, 'updateStatus'])->name('admin.transfers.update-status');

        Route::get('getusers', [App\Http\Controllers\Admin\AdminController::class, 'getUsers'])->name('admin.getusers');
        Route::get('loan-history', [App\Http\Controllers\Admin\AdminController::class, 'loanHistory'])->name('admin.user.loan-history');
        Route::get('/transfer-histories', [\App\Http\Controllers\Admin\AdminController::class, 'transferHistory'])
            ->name('admin.transfers.index');
        Route::get('/cheque-deposits', [\App\Http\Controllers\Admin\AdminController::class, 'chequeHistory'])
            ->name('admin.cheque-deposits.index');

        Route::get('/cheque-deposits/{chequeDeposit}', [\App\Http\Controllers\Admin\AdminController::class, 'showChequeHistory'])
            ->name('admin.cheque-deposits.show');
        Route::get('/cheque-deposits/{chequeDeposit}', [App\Http\Controllers\Admin\ChequeDepositController::class, 'show'])->name('admin.cheque-deposits.show');
        Route::put('/cheque-deposits/{chequeDeposit}', [App\Http\Controllers\Admin\ChequeDepositController::class, 'update'])->name('admin.cheque-deposits.update');
        Route::delete('/cheque-deposits/{chequeDeposit}', [App\Http\Controllers\Admin\ChequeDepositController::class, 'destroy'])->name('admin.cheque-deposits.destroy');
    });
});
