<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Http\Livewire\Admin\AdminAttendance;
use App\Http\Livewire\Admin\AdminChatroom;
use App\Http\Livewire\Login;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\LoginForm;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\AdminEmploye;
use App\Http\Livewire\Admin\AdminDashboard;
use App\Http\Livewire\Admin\AdminDepartment;
use App\Http\Livewire\Employe\EmployeDashboard;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', LoginForm::class)->name('login');
// For employes
Route::middleware(['authuser'])->group(function () {
    Route::get('/Employe-dashboard', EmployeDashboard::class)->name('employeDashboard');
});

// for admin
Route::middleware(['authadmin'])->group(function () {
    Route::get('/Admin-dashboard', AdminDashboard::class)->name('adminDashboard');
    Route::get('/department', AdminDepartment::class)->name('department');
    Route::get('/employe', AdminEmploye::class)->name('employe');
    Route::get('/admin-attendance', AdminAttendance::class)->name('admin-attendance');
    Route::get('/admin-chatroom', AdminChatroom::class)->name('admin-chatroom');
});

// Route::get('logoutUser', [MainController::class, 'logout'])->name('signout');
Route::get('index', [MainController::class, 'index'])->name('index');

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
