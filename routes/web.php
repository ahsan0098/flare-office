<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Http\Livewire\Admin\AddRolesAndPermission;
use App\Http\Livewire\Admin\AdminAttendance;
use App\Http\Livewire\Admin\AdminChatroom;
use App\Http\Livewire\Login;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\LoginForm;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\AdminEmploye;
use App\Http\Livewire\Admin\AdminDashboard;
use App\Http\Livewire\Admin\AdminDepartment;
use App\Http\Livewire\Admin\AdminExpense;
use App\Http\Livewire\Admin\AdminProfileComponent;
use App\Http\Livewire\Admin\AdminPublicChat;
use App\Http\Livewire\Admin\AdminRolesAndPermissions;
use App\Http\Livewire\Admin\AdminSalaryManagement;
use App\Http\Livewire\Admin\PermissionMangement;
use App\Http\Livewire\Employe\EmployeAttendance;
use App\Http\Livewire\Employe\EmployeChatRoom;
// use App\Http\Livewire\Emloye\EmployeChat;
use App\Http\Livewire\Employe\EmployeDashboard;
use App\Http\Livewire\Employe\EmployeProfile;
use App\Http\Livewire\Employe\EmployePublicChat;
use App\Libraries\Permissions;

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
    Route::get('/employe-profile', EmployeProfile::class)->name('employe-profile');
    Route::get('/employe-chatroom', EmployeChatRoom::class)->name('employe-chatroom');
    Route::get('/employe-public-chatroom', EmployePublicChat::class)->name('employe-public-chatroom');
    Route::get('/employe-attendance', EmployeAttendance::class)->name('employe-attendance');
});

// for admin
Route::middleware(['authadmin'])->group(function () {
    Route::get('/Admin-dashboard', AdminDashboard::class)->name('adminDashboard');
    Route::get('/department', AdminDepartment::class)->name('department');
    Route::get('/employe', AdminEmploye::class)->name('employe')->middleware('Permission:true');
    Route::get('/admin-attendance', AdminAttendance::class)->name('admin-attendance');
    Route::get('/admin-chatroom', AdminChatroom::class)->name('admin-chatroom');
    Route::get('/admin-public-chatroom', AdminPublicChat::class)->name('admin-public-chatroom');
    Route::get('/admin-profile', AdminProfileComponent::class)->name('admin-profile');
    Route::get('/admin-expense', AdminExpense::class)->name('admin-expense');
    Route::get('/admin-salary-management', AdminSalaryManagement::class)->name('admin-salary-management');
    Route::get('admin-roles-and-permissions', AdminRolesAndPermissions::class)->name('admin-roles-and-permissions');
    Route::get('/permission-management/{role_name}', PermissionMangement::class)->name('permission-management');
    Route::get('/add-role-and-permission', AddRolesAndPermission::class)->name('add-role-and-permission');
});
// $permission = new Permissions;
// $check = $permission->hasPermission('user', 'view');
// if ($check['status'] == 1 && $check['message'] == 1) {
//     Route::get('/employe', AdminEmploye::class)->name('employe')->middleware('Permission:true');
// }
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
