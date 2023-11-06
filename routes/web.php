<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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

Auth::routes();

Route::get('/', 'WelcomeController@index');


//Route::get('/home', 'HomeController@index')->name('home');

//Google Login
//Route::get('/login/google', 'Auth\LoginController@redirectToGoogle')->name('login.google');
//Route::get('/login/google/callback', 'Auth\LoginController@handleGoogleCallback');

// Error Handler
//Route::get('web/error/handler/{code}/{message}', 'Error\ErrorController@redirectToWebErrorHandle')->name('web.error.handler');



// Vue Js Route
Route::get('vue/{index?}', 'LaravelVueController@index')->where('index', '(.*)');
