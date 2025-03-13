<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;

Route::get('/', function () {
    return view('welcome');
});


/////////////
// admin
////////////

Route::get('/admin/teacher', [TeacherController::class, 'displayTeacher'])->name('admin.teacher');
Route::post('/admin/teacher/store', [TeacherController::class, 'store'])->name('teacher.store');

Route::get('/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/teacher', function () {
    return view('admin.teacher');
});

Route::get('/student', function () {
    return view('admin.student');
});

Route::get('/scheldule', function () {
    return view('admin.scheldule');
});

Route::get('/users', function () {
    return view('admin.users');
});

Route::get('/message', function () {
    return view('admin.message');
});