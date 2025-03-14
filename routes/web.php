<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('welcome');
});


/////////////
// admin
////////////

Route::get('admin/teacher', [TeacherController::class, 'displayTeacher'])->name('admin.teacher');
Route::post('admin/teacher/store', [TeacherController::class, 'store'])->name('teacher.store');
Route::put('admin/teacher/{id}', [TeacherController::class, 'updateTeacher'])->name('teacher.updateTeacher');

Route::get('/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('teacher', function () {
    return view('admin.teacher');
});
//student
Route::get('admin/student', [StudentController::class, 'displayStudent'])->name('admin.student');
Route::post('admin/student/storeStudent', [StudentController::class, 'storeStudent'])->name('student.storeStudent');
Route::put('/student/{id}', [StudentController::class, 'update'])->name('student.update');

Route::get('/scheldule', function () {
    return view('admin.scheldule');
});

Route::get('/users', function () {
    return view('admin.users');
});

Route::get('/message', function () {
    return view('admin.message');
});
