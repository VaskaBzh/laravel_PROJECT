<?php

use App\Http\Controllers\Auth\Sub\SubController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

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
Route::controller(SubController::class)->group(function () {
    Route::post('/sub_create', 'create')->name('sub_create');
    Route::get('/sub_delete', 'remove')->name('sub_delete');
    Route::redirect("/create", '/#create')
        ->name('sub');
    Route::get('/sub_process', 'visual')->name('sub_process');
});

Route::controller(IndexController::class)
    ->group(function () {
        Route::get('/', 'index')->name('home');
        Route::get('/help', 'help')->name('help');
        Route::get('/about', 'about')->name('about');
        Route::get('/complexity', 'complexity')->name('complexity');
    });

Route::middleware('guest:web')->group(function () {
    Route::redirect("/login", '/#login')
        ->name('login');
    Route::post('/login_process', [AuthController::class, 'login'])
        ->name('login_process');

    Route::redirect('/email', "/#email")->name('email');
    Route::post("email_process", [AuthController::class, "validation_email"])->name('email_process');
});

Route::middleware('auth:web')->group(function () {
    Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])
        ->name('logout');

    Route::controller(IndexController::class)->group(function () {
        Route::get('/profile', 'profile')->name('profile');
//        Route::redirect('/profile', '/profile/accounts');
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
