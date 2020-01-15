<?php

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

Route::get('/', 'PublicController@index')->name('index');
Route::get('/about', 'PublicController@about')->name('about');
Route::get('/contact', 'PublicController@contact')->name('contact');
Route::post('/contact', 'PublicController@contactPost')->name('contactPost');
Route::get('/payments', 'PublicController@payments')->name('payments');

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::prefix('student')->group(function(){
    Route::get('dashboard', 'StudentController@dashboard')->name('studentDashboard');
    Route::get('notifications', 'StudentController@notifications')->name('studentNotifications');
    Route::get('payments', 'StudentController@payments')->name('studentPayments');
    Route::post('/payments_view', 'StudentController@paymentMonthFilterPost');
    //Route::post('payments', 'StudentController@paymentMonthFilterPost')->name('studentPaymentMonthFilter');
    //Route::post('payments', 'StudentController@paymentsPost')->name('studentPaymentsPost');
    Route::post('payments/new', 'StudentController@newPaymentPost')->name('studentNewPaymentPost');
    Route::get('messages', 'StudentController@messages')->name('studentMessages');
    Route::get('profile','StudentController@profile')->name('studentProfile');
    Route::post('profile','StudentController@profilePost')->name('studentProfilePost');
});

Route::prefix('teacher')->group(function(){
    Route::get('dashboard', 'TeacherController@dashboard')->name('teacherDashboard');
    Route::get('students', 'TeacherController@students')->name('teacherStudents');
    Route::get('messages', 'TeacherController@messages')->name('teacherMessages');
});

Route::prefix('admin')->group(function(){
    Route::get('/dashboard','AdminController@dashboard')->name('adminDashboard');
    Route::get('students','AdminController@students')->name('adminStudents');
    Route::get('teachers','AdminController@teachers')->name('adminTeachers');
    Route::get('payments','AdminController@payments')->name('adminPayments');
    Route::get('messages','AdminController@messages')->name('adminMessages');
    Route::get('profile','AdminController@profile')->name('adminProfile');
    Route::post('profile','AdminController@profilePost')->name('adminProfilePost');

    Route::get('students/new', 'AdminController@newStudent')->name('adminNewStudent');
    Route::post('students/new', 'AdminController@newStudentPost')->name('adminNewStudent');

    Route::get('students/{id}', 'AdminController@editStudent')->name('adminEditStudent');
    Route::post('students/{id}', 'AdminController@editStudentPost')->name('adminEditStudent');
    Route::post('students/{id}/delete', 'AdminController@deleteStudent')->name('adminDeleteStudent');

    Route::get('teachers/new', 'AdminController@newTeacher')->name('adminNewTeacher');
    Route::post('teachers/new', 'AdminController@newTeacherPost')->name('adminNewTeacher');

    Route::get('teachers/{id}', 'AdminController@editTeacher')->name('adminEditTeacher');
    Route::post('teachers/{id}', 'AdminController@editTeacherPost')->name('adminEditTeacher');
    Route::post('teachers/{id}/delete', 'AdminController@deleteTeacher')->name('adminDeleteTeacher');
});
