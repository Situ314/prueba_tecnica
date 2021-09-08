<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('login','Api\LoginController@login')->name('login');
Route::post('register','Api\LoginController@register');
Route::post('me', 'Api\LoginController@me')->middleware('auth:sanctum');
Route::post('signout', 'Api\LoginController@signout')->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function () {

    //Editar Perfil
    Route::put('/profile/edit/{user_id}','Api\UserController@updateProfile');

    //Gestion de roles
    Route::post('/rol/create','Api\UserController@createRole');
    Route::post('/rol/set_user/{user_id}','Api\UserController@setRoleUser');
    //Gestion de permisos
    Route::post('/permission/create','Api\UserController@createPermission');
    Route::post('/permission/set_role/{role_id}','Api\UserController@setRolePermission');

    Route::post('/get_permissions/{user_id}','Api\UserController@getPermissions');
    Route::post('/get_no_permissions/','Api\UserController@getNoPermission');
});
