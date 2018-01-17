<?php
/**
 * Created by PhpStorm.
 * User: justOP
 * Date: 18.12.17
 * Time: 0:45
 */
Route::get('/',function(){
   return view('welcome');
});
Route::get('home','UserController@homePage');
