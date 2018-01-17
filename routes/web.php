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

Route::get('/',function(){
    return view('/login');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    //general
    Route::get('/','UserController@homePage');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/','UserController@homePage');
    // Users
    Route::post('/update/{id}','UserController@UserUpdate');
    Route::get('delete/{id}','UserController@deleteUserById');
    Route::post('createUser', 'UserController@createUser');
    Route::get('/create','UserController@createPage');
    // Roles
    Route::get('editRole/{id}', 'RoleController@editPage');
    Route::post('updateRole/{id}','RoleController@RoleUpdate');
    Route::post('createRole/', 'RoleController@createRole');
    Route::get('createRolePage/', 'RoleController@createRolePage');
    Route::get('deleteRole/{id}', 'RoleController@deleteRole');
    Route::get('showUWR/{id}', 'RoleController@showUsersWithThisRole');
    Route::get('user/{id}', 'RoleController@getUserById');
    Route::get('view', 'RoleController@homePage');

    // Tests
    Route::get('hello','HelloController@helloWorld')->name('hello');

    //Admin Routes NOT WORK!
    Route::group(['prefix' => 'admin',  'middleware' => 'admin'], function(){
        //general
        Route::get('/','UserController@homePage');
        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/','UserController@homePage');
        // Users
        Route::post('/update/{id}','UserController@UserUpdate');
        Route::get('delete/{id}','UserController@deleteUserById');
        Route::post('createUser', 'UserController@createUser');
        Route::get('/create','UserController@createPage');
        // Roles
        Route::get('editRole/{id}', 'RoleController@editPage');
        Route::post('updateRole/{id}','RoleController@RoleUpdate');
        Route::post('createRole/', 'RoleController@createRole');
        Route::get('createRolePage/', 'RoleController@createRolePage');
        Route::get('deleteRole/{id}', 'RoleController@deleteRole');
        Route::get('showUWR/{id}', 'RoleController@showUsersWithThisRole');
        Route::get('user/{id}', 'RoleController@getUserById');
        Route::get('/admin/view', 'RoleController@homePage');


    });
});

