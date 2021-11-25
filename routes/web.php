<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/testNotinficationsWithWebPush', 'NotificationController@testNotinficationsWithWebPush')->name('testNotinficationsWithWebPush');

Route::get('SeeAllNotifications', ['as' => 'SeeAllNotifications', 'uses' => 'NotificationController@seeAllNotifications'])->middleware(['web', 'auth']);

Route::post('push','PushController@store');
//make a push notification.
Route::get('push','PushController@push')->name('push');
