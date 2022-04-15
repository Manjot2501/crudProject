<?php

use App\Http\Controllers\my_controller;
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

route::get('/', [my_controller::class, 'login'])->name('login');
route::post('/action/login', [my_controller::class, 'loginAction'])->name('loginSubmit');
route::group(['middleware' => 'adminAuth'], function () {
    route::get('/dashboard', [my_controller::class, 'dashboard'])->name('dashboard');
    route::get('/subjects', [my_controller::class, 'subject'])->name('subjects');
    route::post('/action/addSubject', [my_controller::class, 'addSubject'])->name('addSubject');
    route::post('/action/fetchDetail', [my_controller::class, 'subjectDetails'])->name('subjectsDetails');
    route::post('/action/deleteSubject', [my_controller::class, 'deleteSubject'])->name('deleteSubject');
    route::post('/action/editSubject', [my_controller::class, 'editSubject'])->name('editSubject');
});
