<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\Admin\StudentEnroll;

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
    return view('auth.login');
});


//For Admin
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->group(function () {
    Route::get('/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');
    Route::get('/student-enrol', StudentEnroll::class)->name('admin.student_enrol');

    Route::get('/logout', 'App\Http\Controllers\auth\LoginController@logout')->name('user.logout');
    
});

