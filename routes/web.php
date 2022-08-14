<?php

use App\Http\Controllers\AppController;
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
Route::get('/', [AppController::class, 'view_index']);
Route::get('/import', [AppController::class, 'view_import'])->name('view_import');
Route::get('/filter_spam_time', [AppController::class, 'view_filter_spam_time'])->name('view_filter_spam_time');
Route::get('/filter_all_time', [AppController::class, 'view_filter_all_time'])->name('view_filter_all_time');
Route::get('/filter_fb_send_time', [AppController::class, 'view_filter_fb_send_time'])->name('view_filter_fb_send_time');
Route::get('/update_spam_time', [AppController::class, 'view_update_spam_time'])->name('view_update_spam_time');
Route::post('/import', [AppController::class, 'import'])->name('import');
Route::post('/update_spam_time', [AppController::class, 'update_spam_time'])->name('update_spam_time');
Route::post('/fill_fb_send_time', [AppController::class, 'fill_fb_send_time'])->name('fill_fb_send_time');
Route::post('/fill_all', [AppController::class, 'fill_all'])->name('fill_all');
Route::post('/fill_spam_time', [AppController::class, 'fill_spam_time'])->name('fill_spam_time');
