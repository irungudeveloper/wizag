<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;

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

Route::get('/', function () 
{
    return view('home');
});


Route::post('login',[LoginController::class,'login'])->name('login');

Route::group(['middleware' => ['auth']], function()
{

Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard.index');
Route::resource('company',CompanyController::class);
Route::resource('employee',EmployeeController::class);

});