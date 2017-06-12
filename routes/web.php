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

Route::get('/', function () {
    return view('index');
});

/* Visitors Middleware -> Prevent access to these routes if already logged in */
/* -------------------------------------------------------------------------- */
Route::group(['middleware' => 'visitors'], function() {
    /* Routes for registration */
    Route::get('/register', 'RegistrationController@register');
    Route::post('/register', 'RegistrationController@postRegister');

    /* Routes for login */
    Route::get('/login', 'LoginController@login');
    Route::post('/login', 'LoginController@postLogin');

    /* Routes to reset password */
    Route::get('/forgot-password', 'ForgotPasswordController@forgotPassword');
    Route::post('/forgot-password', 'ForgotPasswordController@postForgotPassword');
    Route::get('/reset/{resetCode}', 'ForgotPasswordController@resetPassword');
    Route::post('/reset/{resetCode}', 'ForgotPasswordController@postResetPassword');
});

/* Route for logout */
/* ---------------- */
Route::post('/logout', 'LoginController@logout');


/* Route for Dashboard */
/* ------------------- */
Route::get('/dashboard', 'TutorController@index');

Route::get('/profile-setup', 'TutorController@setup');
Route::post('/profile-setup', 'TutorController@postSetup');

Route::get('/subjects', 'TutorController@subjects');
Route::post('/addSubject', 'TutorController@addSubject');
Route::post('/delSubject', 'TutorController@delSubject');
Route::post('/newSubject', 'TutorController@newSubject');

Route::get('students/enroll', 'StudentController@enrollStudent')->name('students.enroll');
Route::resource('students', 'StudentController');
Route::get('/delete-student/{id}', 'StudentController@confirmDelete');
Route::post('/coursesEnrolled', 'StudentController@coursesEnrolled');
Route::post('/coursesAvailable', 'StudentController@coursesAvailable');
Route::post('/enrollStudent', 'StudentController@enrollToCourse');
Route::post('/disenrollStudent', 'StudentController@disenrollCourse');

Route::get('/profile-details/{id}', 'TutorController@show');

/* Route to activate a user's account */
Route::get('/activate/{activationCode}', 'RegistrationController@activate');
