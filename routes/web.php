<?php

use App\Http\Controllers\DashboardWidgetController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome');

Route::get('admin/dashboard',[DashboardWidgetController::class, 'index'])->middleware(['auth', 'verified'])->name('admin');

Route::post('/admin/dashboard',[DashboardWidgetController::class, 'store']);

Route::put('/admin/dashboard/update/{id}',[DashboardWidgetController::class, 'update']);

Route::delete('/admin/dashboard',[DashboardWidgetController::class, 'destroy']);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
