<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardStudentController;
use App\Http\Controllers\DashboardTeacherController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JadwalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\StudentController;
use App\Livewire\DashboardStudent;
use App\Mail\NotificationMail;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Mail;

Route::get('/', [HomeController::class, 'index']);
Route::get('/jadwal_teacher/{id}', [HomeController::class, 'show'])->middleware('auth:user,student,teacher');;

Route::get('/login-latahzanEdu', [LoginController::class, 'index'])->name('login')->middleware('guest:user,student,teacher');
Route::post('/login-latahzanEdu', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest:user,student,teacher');
Route::post('/register', [RegisterController::class, 'store']);


// Dashboard Admin
Route::get('/dashboard', [DashboardUserController::class, 'dashboard'])->middleware('auth:user,teacher');


// Dashboard
// Route::resource('/dashboard/siswa', DashboardStudentController::class)->middleware('auth:user');
Route::resource('/dashboard/guru', DashboardTeacherController::class)->middleware('auth:user');
Route::get('/dashboard/guru/{id?}/{status}', [DashboardTeacherController::class, 'show'])->middleware('auth:user');
Route::resource('/dashboard/admin', DashboardUserController::class)->middleware('auth:user');
Route::resource('/dashboard/jadwal', JadwalController::class)->middleware('auth:user');
Route::get('dashboard/jadwal/create/{id_guru?}', [JadwalController::class, 'create'])->middleware('auth:user');
Route::get('dashboard/enrollment', [EnrollmentController::class, 'show_dashboard'])->middleware('auth:user');


Route::get('/dashboard/siswa', function (){
    return view('layouts.livewire.dashboard_student.student');
})->middleware('auth:user');

// Student
Route::resource('/enrollments', EnrollmentController::class)->middleware('auth:user,student,teacher');
Route::get('enrollments/create/{id?}', [EnrollmentController::class, 'create'])->middleware('auth:user,student,teacher');
Route::get('enrollments/status/{status}', [EnrollmentController::class, 'showStatus'])->middleware('auth:user,student,teacher');
Route::resource('/payment', PaymentController::class)->middleware('auth:user,student,teacher');
Route::get('/payment/success/{id_payment}', [PaymentController::class, 'success'])->name('payment_success')->middleware('auth:user,student,teacher');

// tambahkan route baru
// Route::get('/mail/send', function () {
//     $data = [
//         'subject' => 'Testing Kirim Email',
//         'title' => 'Testing Kirim Email',
//         'body' => 'Ini adalah email uji coba dari Tutorial Laravel: Send Email Via SMTP GMAIL @ qadrLabs.com'
//     ];

//     Mail::to('putra.yuniahans@gmail.com')->send(new NotificationMail($data));

// });