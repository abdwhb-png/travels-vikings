<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController; 
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\MemberController; 
use App\Http\Controllers\RegisterController; 
use App\Http\Controllers\LoginController; 
use App\Http\Controllers\LogoutController; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

// Auth::routes();
// Route::get('register', [MemberController::class, 'register'])->name('register');

Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/tcs', [HomeController::class, 'tcs'])->name('tcs');

Route::group(['middleware' => ['guest']], function() {
    /**
     * Register Routes
     */
    Route::get('/register', [RegisterController::class, 'show'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');

    /**
     * Login Routes
     */
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login');

});

Route::middleware('auth')->group(function () {
    Route::get('/change-password', [HomeController::class, 'changePassword'])->name('change.password');
    Route::post('/change-password', [HomeController::class, 'performChangePassword'])->name('change.password');
    Route::prefix('admin')->name('admin.')->middleware('user.access:Admin')->group(function() {
        Route::resource('', AdminController::class);
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/deals/{param}', [AdminController::class, 'deals'])->name('deals');
        Route::get('/members/{param}', [AdminController::class, 'members'])->name('members');
        Route::get('/system/{param}', [AdminController::class, 'system'])->name('system');

        Route::get('/get/item/{param}/{id}', [AdminController::class, 'getItem']);
        Route::get('/get/list/{param}', [AdminController::class, 'getList']);
        Route::get('/create/{param}', [AdminController::class, 'create'])->name('create');

        Route::get('/edit/{param}/{id}', [AdminController::class, 'edit'])->name('edit');
        Route::post('/store/{param}', [AdminController::class, 'store']);
        Route::put('/change/member/password/{id}', [AdminController::class, 'changePassword']);
        Route::put('/change/customer-service/status/{id}', [AdminController::class, 'changeCustomerServiceStatus']);
        Route::put('/duplicate/deal', [AdminController::class, 'duplicateDeal']);
        Route::put('/change/member/status/{id}', [AdminController::class, 'changeMemberStatus']);
        Route::put('/update/{param}/{id}', [AdminController::class, 'update'])->name('update');
        Route::post('/make/withdrawal/{id}', [AdminController::class, 'makeWithdrawal']);
        Route::delete('/delete/{param}/{id}', [AdminController::class, 'destroy']);
        Route::get('/show/task/{member_id}', [AdminController::class, 'showTasks'])->name('show tasks');
    });

    Route::prefix('member')->name('member.')->middleware('user.access:Member')->group(function() {
        Route::resource('', MemberController::class);
        Route::get('/journey', [MemberController::class, 'journey'])->name('journey');
        Route::post('/submit/task/{id}', [MemberController::class, 'submitTask'])->name('submit-task');
        Route::get('/complete/task/{id}', [MemberController::class, 'completeTask'])->name('complete-task');
        Route::get('/dashboard', [MemberController::class, 'index'])->name('dashboard');
        Route::get('/fund-info', function () {
                return view('member.fund-info');
            })->name('fund-info');
        Route::post('/fund-info', [MemberController::class, 'addFundInfo'])->name('fund-info');
        Route::get('/account-settings', [MemberController::class, 'accountSettings'])->name('account.settings');
        Route::put('/update', [MemberController::class, 'update'])->name('update');
    });

    Route::get('/logout', [LogoutController::class, 'perform'])->name('logout.perform');
});