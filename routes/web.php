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
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'admin'], function() {
  Route::get('login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
  Route::post('login', 'Admin\Auth\LoginController@login')->name('admin.login');
  Route::get('logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');
  
  Route::get('register', 'Admin\Auth\RegisterController@showRegisterForm')->name('admin.register');
  Route::post('register', 'Admin\Auth\RegisterController@register')->name('admin.register');
 
  Route::get('home', 'Admin\HomeController@index')->name('admin.home');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function()
{
    Route::resource('player', 'Admin\PlayerController');
    Route::resource('club', 'Admin\ClubController');
    Route::resource('game', 'Admin\GameController');
    Route::get('top', 'Admin\TopController@index');
});


Route::get('/home', 'HomeController@index')->name('home');

//Twitter
Route::get('auth/login/twitter', 'Auth\SocialController@getTwitterAuth');
Route::get('auth/login/callback/twitter', 'Auth\SocialController@getTwitterAuthCallback');