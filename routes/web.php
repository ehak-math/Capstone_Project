<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


/////////////
// admin
////////////

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