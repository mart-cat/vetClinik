<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AppointController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ServiceController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('app');

//Пути пользователя

Route::get('/services', [ServiceController::class, 'index'])->name('services');
Route::get('/services/{id}', [ServiceController::class, 'show'])->name('service.show');
Route::get('/appointment', [AppointController::class, 'index'])->name('appointment');
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::post('/appointment/record', [AppointController::class, 'store'])->name('appointment.record');
//Формы пользователя
Route::post('/store', [AppointController::class, 'store'])->name('appointment.new');

Route::post('/signUp', [ConsultationController::class, 'store'])->name('consultation.store');


//Авторизация
Route::get('/auth', [AuthController::class, 'index'])->name('auth');
Route::post('/auth/go', [AuthController::class, 'authenticate'])->name('auth.go');
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('logout');

//Пути сотрудника
Route::get('/schedule', [EmployeeController::class, 'index'])->name('schedule')->middleware(RoleMiddleware::class . ':doctor');


//Пути админа

Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware(RoleMiddleware::class . ':admin');
Route::get('/admin/service', [AdminController::class, 'service'])->name('service')->middleware(RoleMiddleware::class . ':admin');
Route::get('/admin/doctors', [AdminController::class, 'doctors'])->name('doctors')->middleware(RoleMiddleware::class . ':admin');
Route::get('/admin/consultation', [AdminController::class, 'consultations'])->name('admin.consultations');

Route::get('/admin/index', [AppointController::class, 'store'])->name('appointments.store')->middleware(RoleMiddleware::class . ':admin');
Route::get('/admin/consultations', [ConsultationController::class, 'index'])->name('admin.consultations')->middleware(RoleMiddleware::class . ':admin');

//Route::get('/api/dates/{serviceId}/{data}', [AppointController::class, 'getAllDatesInMonth']);
Route::get('/api/get-available-times ', [AppointController::class, 'getAvailableTimes'])->name('getTimeIntervals');

//Формы админа
Route::post('/admin/store', [ServiceController::class, 'store'])->name('service.store');
Route::post('/admin/doctor', [DoctorController::class, 'store'])->name('doctor.store');
Route::post('//admin/index', [AppointController::class, 'store'])->name('appointments.store');


Route::resource('appointments', AppointController::class);
Route::resource('service', ServiceController::class);
Route::resource('consultations', ConsultationController::class);
Route::resource('doctors', DoctorController::class);

Route::get('//admin/index', action: [AppointController::class, 'adminIndex'])->name('admin.index');
Route::post('//admin/index', [AppointController::class, 'adminIndex'])->name('admin.index');
Route::get('/admin/services', action: [ServiceController::class, 'adminIndex'])->name('admin.services.index');
Route::post('/admin/services', action: [ServiceController::class, 'adminIndex'])->name('admin.service.index');


Route::patch('/consultations/{id}/soft-delete', [ConsultationController::class, 'softDelete'])->name('consultations.softDelete');
Route::delete('/consultations/{id}', [ConsultationController::class, 'destroy'])->name('consultations.destroy');


Route::put('/admin/service/{id}', [ServiceController::class, 'update'])->name('service.update');

Route::put('//admin/index/{id}', [AppointController::class, 'update'])->name('appointments.update');
Route::put('/admin/doctors/{id}', [DoctorController::class, 'update'])->name('doctors.update');

Route::resource('appointments', AppointController::class);
Route::resource('consultations', ConsultationController::class);


