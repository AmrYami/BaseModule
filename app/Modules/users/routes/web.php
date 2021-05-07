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
Route::namespace(buildControllerNamespace('Users'))->group(function () {//config take 2 values first our value second default value config(our value , default value)
    Route::get('users/trash', 'UsersController@trash')->name('users.trash')->middleware(['web', 'auth']);
    Route::PUT('users/freeze/{id}', 'UsersController@freeze')->name('users.freeze')->middleware(['web', 'auth']);
    Route::PUT('users/banned_until/{id}', 'UsersController@banned_until')->name('users.banned_until')->middleware(['web', 'auth']);
    Route::put('users/update_password/{id}', 'UsersController@update_password')->name('users.update_password')->middleware(['web', 'auth']);
    Route::get('/users/restore/{id}', 'UsersController@restoreUser')->middleware(['web', 'auth'])->name('users.restore');
    Route::resource('users', 'UsersController')->middleware(['web', 'auth']);
    Route::resource('roles', 'RoleController')->middleware(['web', 'auth']);
    Route::get('/my-profile', 'UsersController@myProfile')->middleware(['web', 'auth'])->name('my_profile');
    Route::get('/all_users', 'UserApiController@index')->middleware(['web', 'auth'])->name('all_users');

    Route::post('/my-profile/update/{id}', 'UsersController@updateMyProfile')->middleware(['web', 'auth'])->name('my_profile.update');
});
