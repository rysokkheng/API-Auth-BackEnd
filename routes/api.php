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


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Auth routes
Route::post('login', 'App\Http\Controllers\API\AuthController@login');
Route::post('register', 'App\Http\Controllers\API\AuthController@register');

// Route for admin permissions
Route::middleware('auth:api')->group(function() {
	Route::get('users', [ 'as' => 'users.index','uses' =>'App\Http\Controllers\API\UsersController@index']);
    Route::POST('users',['as'=>'users.store', 'uses'=> 'App\Http\Controllers\API\UsersController@store']);
	// Route::post('login', 'API/AuthController@adminLogin');
	// Route::post('register', 'API/AuthController@adminRegister');
    Route::post('roles', 'App\Http\Controllers\API\RolesController@store');
    Route::post('permission', 'App\Http\Controllers\API\PermissionController@store');
});

Route::get('products', 'ProductController@index');
Route::get('products/{products}', 'ProductController@show');
Route::post('product', 'ProductController@store')->middleware(['auth:api', 'scope:create']);
Route::put('product/{product}', 'ProductController@update')->middleware(['auth:api', 'scope:edit']);
Route::delete('product/{product}', 'ProductController@destroy')->middleware(['auth:api', 'scope:delete']);
