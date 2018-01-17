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

/*Route::get('auth', ['middleware' => 'auth', function()
{
    Route::get('/','UserController@homePage');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/','UserController@homePage');
    Route::post('/update/{id}','UserController@UserUpdate');
    Route::get('delete/{id}','UserController@deleteUserById');
    Route::post('createUser', 'UserController@createUser');
    Route::get('/create','UserController@createPage');

}]);*/
//Route::get('/', ['middleware' => 'auth', 'uses' => 'UserController@homePage']);
//Route::get('/create', ['middleware' => 'admin', 'uses' => 'UserController@createPage']);


//
//Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/',  'UserController@homePage');
//Route::get('/home', 'UserController@homePage');
//Route::get('/create', ['middleware' => 'auth', 'uses' => 'UserController@createPage']);

/*Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
    Route::get('/create', 'UserController@createPage');
});*/

Route::group(['middleware' => 'auth'], function () {
    Route::get('/','UserController@homePage');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/','UserController@homePage');
    Route::post('/update/{id}','UserController@UserUpdate');
    Route::get('delete/{id}','UserController@deleteUserById');
    //Route::post('createUser', 'UserController@createUser');
    Route::get('/create','UserController@createPage');
    Route::get('view', 'RoleController@homePage');
    Route::get('editRole/{id}', 'RoleController@editPage');
    Route::post('/updateRole/{id}','RoleController@RoleUpdate');
    Route::get('createRolePage/', 'RoleController@createRolePage');
    Route::get('deleteRole/{id}', 'RoleController@deleteRole');
    Route::post('createRole/', 'RoleController@createRole');
    Route::get('showUWR/{id}', 'RoleController@showUsersWithThisRole');
    Route::get('user/{id}', 'RoleController@getUserById');

    Route::group(['prefix' => 'admin',  'middleware' => 'admin'], function(){
        //Route::get('/','UserController@homePage');
        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/','UserController@homePage');
        Route::post('/update/{id}','UserController@UserUpdate');
        Route::get('delete/{id}','UserController@deleteUserById');
        Route::post('createUser', 'UserController@createUser');
        Route::get('view', 'RoleController@homePage');
        Route::get('editRole/{id}', 'RoleController@editPage');
        Route::post('/updateRole/{id}','RoleController@RoleUpdate');
        //Route::get('deleteRole/{id}', 'RoleController@deletePage');
        Route::get('deleteRole/{id}', 'RoleController@deleteRole');
        Route::get('createRole/', 'RoleController@createRole');
        Route::get('/create','UserController@createPage');

    });
});

