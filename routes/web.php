<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;


// ====>> FRONT VIEW
    // ====================================

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/test', function () {
        return view('test');
    });

    Route::get('/fitur', function () {
        return view('fitur');
    });

    Route::get('/kontak', function () {
        return view('kontak');
    });

    Route::get('/documentation', function () {
        return view('dokumentasi');
    });

// ====>> END FRONT VIEW


// ====>> DASHBOARD APPS
    // ====================================
    Route::prefix('apps')
        ->middleware(['auth'])
        ->group(function () {

            Route::get('/', [DashboardController::class, 'index'])->name('apps.dashboard');

            Route::get('/pos', [PosController::class, 'index'])->name('apps.pos.index');
            Route::post('/pos/checkout', [PosController::class, 'checkout'])->name('apps.pos.checkout');

            // Category Resource
            Route::resource('categories', CategoryController::class)->names('apps.categories');

            // Menu Resource
            Route::resource('menus', MenuController::class)->names('apps.menus');

            // Transactions (history & detail)
            Route::get('/transactions', [TransactionController::class, 'index'])->name('apps.transactions.index');
            Route::get('/transactions/{transaction}', [TransactionController::class, 'show'])->name('apps.transactions.show');
            Route::get('/transactions/{transaction}/print', [TransactionController::class, 'print'])->name('apps.transactions.print');
            Route::post('/transactions/{transaction}/void', [TransactionController::class, 'void'])->name('apps.transactions.void');

            // Shifts
            Route::get('/shifts', [ShiftController::class, 'index'])->name('apps.shifts.index');
            Route::get('/shifts/create', [ShiftController::class, 'create'])->name('apps.shifts.create');
            Route::post('/shifts', [ShiftController::class, 'store'])->name('apps.shifts.store');
            Route::get('/shifts/{shift}', [ShiftController::class, 'show'])->name('apps.shifts.show');
            Route::get('/shifts/{shift}/close', [ShiftController::class, 'closeForm'])->name('apps.shifts.close-form');
            Route::post('/shifts/{shift}/close', [ShiftController::class, 'close'])->name('apps.shifts.close');
            Route::post('/shifts/{shift}/cash', [ShiftController::class, 'cashInOut'])->name('apps.shifts.cash');
            Route::get('/shifts/{shift}/x-report', [ShiftController::class, 'xReport'])->name('apps.shifts.xreport');
            Route::get('/shifts/{shift}/z-report', [ShiftController::class, 'zReport'])->name('apps.shifts.zreport');

            // Reports
            Route::get('/reports/sales', [ReportController::class, 'sales'])->name('apps.reports.sales');

            // Expenses
            Route::resource('expenses', ExpenseController::class)->names('apps.expenses');

            // Users (Employees)
            // hanya role Admin
            Route::resource('users', UserController::class)->names('apps.users');

            // Profile (Restaurant settings)
            Route::get('/profile', [ProfileController::class, 'index'])->name('apps.profile.index');
            Route::post('/profile', [ProfileController::class, 'update'])->name('apps.profile.update');
            
    });
// ====>> END DASHBOARD APPS

// ====>> LOGIN REGISTER
    // ====================================

    use App\Http\Controllers\AuthController;

    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    // Additional route for checking block status
    Route::post('/check-block-status', [AuthController::class, 'checkBlockStatus'])->name('auth.check-block-status');

    // Optional: Admin routes for managing login attempts
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::post('/admin/clear-login-attempts', [AuthController::class, 'clearLoginAttempts'])->name('admin.clear-login-attempts');
        Route::get('/admin/login-attempts/{ip?}', [AuthController::class, 'getLoginAttempts'])->name('admin.login-attempts');
    });
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        });
    });

    use App\Http\Controllers\RegisterController;

    Route::middleware(['guest'])->group(function () {
        // Tampilkan form registrasi
        Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
            ->name('register');
        
        // Proses registrasi
        Route::post('/register', [RegisterController::class, 'register'])
            ->middleware(['throttle:5,1']); // Rate limiting: 5 percobaan per menit
    });

// ====>> END LOGIN REGISTER
