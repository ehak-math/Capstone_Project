<?php

use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Exports\TeachersExport;
use App\Exports\StudentsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TeachersImport;
use App\Imports\StudentsImport;
use Illuminate\Http\Request;

use App\Http\Controllers\TelegramController;
use Telegram\Bot\Laravel\Facades\Telegram;

// export teacher
Route::get('/teachers/export', function () {
    return Excel::download(new TeachersExport, 'teachers.xlsx');
})->name('teachers.export');

// import teacher 
Route::post('/teachers/import', function (Request $request) {
    $request->validate([
        'file' => 'required|mimes:xlsx',
    ]);

    Excel::import(new TeachersImport, $request->file('file'));

    return redirect()->back()->with('success', 'Teachers imported successfully!');
})->name('teachers.import');

// export student
Route::get('/students/export', function () {
    return Excel::download(new StudentsExport, 'students.xlsx');
})->name('students.export');

// import student
Route::post('/students/import', function (Request $request) {
    $request->validate([
        'file' => 'required|mimes:xlsx',
    ]);

    Excel::import(new StudentsImport, $request->file('file'));

    return redirect()->back()->with('success', 'Students imported successfully!');
})->name('students.import');


Route::get('/', function () {
    return view('welcome');
});
//
//



///////////////
//// admin
//////////////

Route::post('admin.uploadImage', [AdminController::class, 'creatAdmin'])->name('uploadfile');
// Route::get('/subjects/{id}/edit', [TeacherController::class, 'edit'])->name('subject.edit');
Route::get('/subjects/{id}', [TeacherController::class, 'editsubject']);
Route::get('/subjects/{id}/edit', [TeacherController::class, 'editsubject'])->name('subject.edit');
Route::put('/subjects/{id}', [TeacherController::class, 'update'])->name('updatesub');



Route::get('admin',[TeacherController::class,'showsubject']);
Route::post('admin.store', [TeacherController::class, 'store'])->name('addsub');

Route::get('student',[AdminController::class,'displayOnStu']);
Route::get('details/{id}', [AdminController::class, 'selectbyId'])->name('showDetails');


Route::get('/admin/Schedule',[AdminController::class,'getschedule']);
Route::post('scheldule.crategrade',[AdminController::class,'createGrade'])->name('crategrade');
Route::post('scheldule.createcourse',[AdminController::class,'createCourse'])->name('createcourse');
Route::post('scheldule.createschedule',[AdminController::class,'createSchedule'])->name('createschedule');


// student

// Route::get('/student/login', [StudentController::class, 'showLoginForm'])->name('student.login');
// Route::post('/student/login', [StudentController::class, 'studentLogin'])->name('student.login.submit');
// Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');

Route::prefix('student')->group(function () {
    Route::get('/login', [StudentController::class, 'showLoginForm'])->name('student.login');
    Route::post('/login', [StudentController::class, 'studentLogin'])->name('student.login.submit');
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/courses/subject', [StudentController::class, 'displayCourseStudent']);
    Route::get('/courses/subject/{id}', [StudentController::class, 'submitAtt'])->name('student.course.submit.show');
    Route::post('/courses/subject/submit-attendance', [StudentController::class, 'subAttendance'])->name('student.course.submit');
    Route::get('/student/course/document/{id}', [StudentController::class, 'showDoc'])->name('student.course.document');    
    // Route::get('/attendance', function () {
    //     return view('student.courses.attendance');
    // });

    Route::post('/logout', [StudentController::class, 'logout'])->name('student.logout');
    Route::get('/score',  [StudentController::class, 'displayStudentSocre'])->name('student.score');
});

//
// teacher
//



Route::prefix('teacher')->group(function () {
    Route::get('/login', [TeacherController::class, 'TeacherLoginForm'])->name('teacherLogin');
    Route::post('/login', [TeacherController::class, 'TeacherLogin'])->name('teacher.login.submit');
    Route::get('/dashboard', [TeacherController::class, 'teacherDashbord'])->name('teacher.dashboard');
    Route::post('/logout', [TeacherController::class, 'logout'])->name('teacher.logout');
    Route::get('/course', [TeacherController::class, 'teacherCourse'])->name('teacher.course');
    // Route::get('/course/attendance/{id}', [TeacherController::class, 'teacherAttendance'])->name('attendance');
    Route::post('/attendance/close', [TeacherController::class, 'closeatt'])->name('teacher.attendance.close');
    Route::post('/attendance/open', [TeacherController::class, 'openatt'])->name('teacher.attendance.open');
    Route::get('/course/attendance/{id}', [TeacherController::class, 'teacherAttendance'])->name('teacher.attendance.show');
    Route::get('/course/score/{id}', [TeacherController::class, 'teacherScore'])->name('teacher.score.show');
    Route::post('/score/create', [TeacherController::class, 'createscore'])->name('teacher.score.create');
    Route::post('/score/add', [TeacherController::class, 'addscore'])->name('teacher.score.addscore');
    Route::get('/document', [TeacherController::class, 'showDocument'])->name('teacher.show.document');
    Route::post('/document/upload', [TeacherController::class, 'uploadDocument'])->name('teacher.document');
    Route::get('/teacher/document/download/{id}', [TeacherController::class, 'downloadDocument'])->name('teacher.document.download');
    Route::delete('/teacher/document/delete/{id}', [TeacherController::class, 'deleteDocument'])->name('teacher.document.delete');
});

////////////////////
// admin course///
///////////////////
Route::prefix('admin/courses')->group(function () {
    Route::get('/index', [AdminController::class, 'displayCourses'])->name('admin.courses.index');
    Route::post('/add', [AdminController::class, 'addCourse'])->name('admin.courses.add');
    Route::delete('/{id}', [AdminController::class, 'deleteCourse'])->name('admin.courses.delete');
    Route::get('/view_detail/{id}', [AdminController::class, 'viewCourseDetail'])->name('admin.courses.view_detail');
});
Route::get('admin/courses/index', [AdminController::class, 'displayCourses'])->name('admin.courses.index');
Route::post('admin/courses/add', [AdminController::class, 'addCourse'])->name('admin.courses.add');
Route::put('admin/courses/{id}', [AdminController::class, 'updateCourse'])->name('updateCourse');
Route::delete('admin/courses/{id}', [AdminController::class, 'deleteCourse'])->name('admin.courses.delete');
Route::get('admin/courses/view_detail/{id}', [AdminController::class, 'viewCourseDetail'])->name('admin.courses.view_detail');

//////////////////
//admin teahcer///
//////////////////
Route::get('admin/teachers/index', [AdminController::class, 'displayTeacher'])->name('admin.teachers.index');
Route::post('admin/teachers/add', [AdminController::class, 'addTeacher'])->name('admin.teachers.add');
Route::delete('admin/teachers/{id}', [AdminController::class, 'deleteTeacher'])->name('deleteTeacher');
Route::put('admin/teachers/{id}', [AdminController::class, 'updateTeacher'])->name('updateTeacher');
Route::get('admin/teachers/search', [AdminController::class, 'searchTeachers'])->name('searchTeachers');


//////////////////
//admin student///
/////////////////
Route::get('admin/students/index', [AdminController::class, 'displayOnStu'])->name('admin.students.index');
Route::delete('admin/students/{id}', [AdminController::class, 'deleteStudent'])->name('deleteStudent');
Route::put('admin/students/{id}', [AdminController::class, 'updateStudent'])->name('updateStudent');
Route::post('admin/students/add', [AdminController::class, 'addStudent'])->name('admin.students.add');
Route::get('admin/students/search', [AdminController::class, 'searchStudents'])->name('searchStudents');


///////////////////
// grade/subject///
//////////////////

Route::get('admin/grade_subject/index', [AdminController::class, 'displayGradeSubject'])->name('admin.grade_subject.index');
Route::post('admin/grade_subject/addGrade', [AdminController::class,'addGrade'])->name('addGrade');
Route::post('admin/grade_subject/addSubject', [AdminController::class, 'addSubject'])->name('addSubject');
Route::delete('admin/grade_subject/grade/{id}', [AdminController::class, 'deleteGrade'])->name('deleteGrade');
Route::put('admin/grade_subject/subject/{id}', [AdminController::class, 'updateSubject'])->name('updateSubject');
Route::put('admin/grade_subject/grade/{id}', [AdminController::class, 'updateGrade'])->name('updateGrade');
Route::delete('admin/grade_subject/subject/{id}', [AdminController::class, 'deleteSubject'])->name('deleteSubject');

/////////////
// schedule//
/////////////

Route::get('admin/schedule/index', [AdminController::class, 'displaySchedule'])->name('admin.schedule.index');
Route::post('admin/schedule/add', [AdminController::class, 'addSchedule'])->name('addSchedule');

Route::get('admin/dashboard', function () {
    return view('admin.dashboard');
});
