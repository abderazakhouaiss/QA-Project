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

use Illuminate\Support\Facades\Route;

Route::get('/',function (){
    return redirect('/login');
});

Route::get('/logout',function (){
    \Illuminate\Support\Facades\Session::forget('_id');
    return redirect('login');
});
Route::get('/login','login\LoginController@login')->name('login');
Route::get('/register', 'reg\RegistrationController@register');
Route::post('/login/check','login\LoginController@loginCheck')->name('login_check');


Route::get('/timeline','actualite\ActualiteController@home')->middleware('check.session')->middleware('check.session');
Route::post('/timeline/response/{idUser}/{idQuestion}','actualite\ActualiteController@addResponse')->middleware('check.session');
Route::get('/timeline/response/vote/{idAnswer}','actualite\ActualiteController@voteResponse')->middleware('check.session');
Route::get('/timeline/follow/{idUser}','actualite\ActualiteController@follow')->middleware('check.session');

Route::get('/question','question\QuestionController@index')->name('question')->middleware('check.session');
Route::get('/question/update','question\QuestionController@updateQuestion')->name('update_question')->middleware('check.session');;
Route::get('/question/delete/{id}','question\QuestionController@deleteQuestion')->name('delete_question')->middleware('check.session');;
Route::post('/question/add','question\QuestionController@addQuestion')->name('add_question')->middleware('check.session');;
Route::get('/continue_register','profile\ProfileController@continueRegister')->middleware('check.session');;
Route::get('/account/', 'profile\ProfileController@profile')->name('account')->middleware('check.session');
Route::get('/account/update/{id}', 'profile\ProfileController@updateProfile')->name('update')->middleware('check.session');
Route::get('/account/follow/{id}','profile\ProfileController@follow')->name('update')->middleware('check.session');

Route::get('/{provider}', 'reg\LoginController@googleData');
Route::get('login/{provider}', 'reg\LoginController@redirectToProvider')->name('social');
Route::get('login/{provider}/callback', 'reg\LoginController@handleProviderCallback')->name('social-redirect');

