<?php

use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\TeacherController;
//use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;


Route::get('/', function () {
    return view('welcome');
});
//
//
///////////////
//// admin
//////////////
///
Route::post('admin.uploadImage', [AdminController::class, 'creatAdmin'])->name('uploadfile');

Route::get('admin',[AdminController::class,'displayAdmin']);
Route::get('student',[AdminController::class,'displayOnStu']);
Route::post('student.addStudent',[AdminController::class,'addStudent'])->name('addStudent');
Route::get('details/{id}', [AdminController::class, 'selectbyId'])->name('showDetails');


Route::get('scheldule',[AdminController::class,'getschedule']);
Route::post('scheldule.crategrade',[AdminController::class,'createGrade'])->name('crategrade');
Route::post('scheldule.createcourse',[AdminController::class,'createCourse'])->name('createcourse');
Route::post('scheldule.createschedule',[AdminController::class,'createSchedule'])->name('createschedule');


// student
Route::get('/student/dashboard', function () {
    return view('student.dashboard');
});

Route::get('/student/subject', function () {
    return view('student.subject');
});

//Route::get('admin/teacher', [TeacherController::class, 'displayTeacher'])->name('admin.teacher');
//Route::post('admin/teacher/store', [TeacherController::class, 'store'])->name('teacher.store');
//Route::put('admin/teacher/{id}', [TeacherController::class, 'updateTeacher'])->name('teacher.updateTeacher');
//
// Route::get('/dashboard', function () {
//    return view('admin.dashboard');
// });

// Route::get('teacher', function () {
//    return view('admin.teacher');
// });
////student
//Route::get('admin/student', [StudentController::class, 'displayStudent'])->name('admin.student');
//Route::post('admin/student/storeStudent', [StudentController::class, 'storeStudent'])->name('student.storeStudent');
//Route::put('/student/{id}', [StudentController::class, 'update'])->name('student.update');
//

//
//Route::get('/users', function () {
//    return view('admin.users');
//});
//
//Route::get('/message', function () {
//    return view('admin.message');
//});
