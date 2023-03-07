<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Subs\SubController;
use Illuminate\Support\Facades\Route;

//use App\Http\Controllers\AuthController;

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

Auth::routes();

Route::controller(SubController::class)->group(function () {
    Route::put('/sub_create', 'create')->name('sub_create');
    Route::get('/sub_process', 'visual')->name('sub_process');
    Route::get('/sub_strong_delete', 'delete')->name('sub_strong_delete');
    Route::put('/sub_delete', 'remove')->name('sub_delete');
});

Route::controller(IndexController::class)
    ->group(function () {
        Route::get('/', 'index')->name('home');
        Route::get('/help', 'help')->name('help');
        Route::get('/about', 'about')->name('about');
        Route::get('/complexity', 'complexity')->name('complexity');
    });

Route::middleware('guest:web')->group(function () {
    Route::post('/login_process', [AuthController::class, 'login'])
        ->name('login_process');
//    Route::get('/login_remove', [AuthController::class, 'remove'])
//        ->name('login_remove');

    Route::post("/user_create", [RegController::class, "create"])->name('user_create');
    Route::post("/user_get", [RegController::class, "get"])->name('user_get');
    Route::post("/email_code", [RegController::class, "code"])->name('email_code');
    Route::get("/return_code", [RegController::class, "return_code"])->name('return_code');
    Route::get("/email_remove", [RegController::class, "remove"])->name('email_remove');
});

Route::middleware('auth:web')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::controller(IndexController::class)->group(function () {
        Route::get('/profile', 'profile')->name('profile');
        Route::redirect('/profile', '/profile/accounts');
        Route::get('/wallets', 'wallets')->name('wallets');
        Route::get('/history', 'history')->name('history');
        Route::get('/ref-page', 'ref_page')->name('ref_page');
        Route::get('/settings', 'settings')->name('settings');
        Route::prefix('/profile')->group(function () {
            Route::get('/accounts', 'accounts')->name('accounts');
            Route::get('/statistic', 'statistic')->name('statistic');
            Route::get('/workers', 'workers')->name('workers');
            Route::get('/payment', 'payment')->name('payment');
            Route::get('/accruals', 'accruals')->name('accruals');
            Route::get('/connecting', 'connecting')->name('connecting');
        });

    });
});

//Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//    $request->fulfill();
//
//    return redirect('/home');
//})->middleware(['auth', 'signed'])->name('verification.verify');

//require __DIR__.'/auth.php';
