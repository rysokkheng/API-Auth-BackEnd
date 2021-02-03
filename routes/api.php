<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
//Route::post('login', 'App\Http\Controllers\API\AuthController@login');
Route::post('login', 'App\Http\Controllers\API\LoginController@login');
Route::post('refresh_token', 'App\Http\Controllers\API\LoginController@refreshToken');
Route::post('register', 'App\Http\Controllers\API\AuthController@register');



// Route for admin permissions check verify token
Route::middleware( ['verify.token','auth:api'])->group(function() {
	Route::get('users', ['as' => 'users.index','uses' =>'App\Http\Controllers\API\UsersController@index']);
    Route::get('users/all', ['as' => 'users.all','uses' =>'App\Http\Controllers\API\UsersController@getAll']);
    Route::get('users/profiles',['as'=>'users.userProfiles', 'uses'=> 'App\Http\Controllers\API\UsersController@userProfiles']);
    Route::get('users/{user}', ['as' => 'users.show','uses' =>'App\Http\Controllers\API\UsersController@show']);
    Route::POST('users',['as'=>'users.store', 'uses'=> 'App\Http\Controllers\API\UsersController@store']);
    Route::POST('users/{id}/resetPassword',['as'=>'users.resetPass', 'uses'=> 'App\Http\Controllers\API\UsersController@resetPass']);
    Route::delete('users/{id}',['as'=>'users.destroy', 'uses'=> 'App\Http\Controllers\API\UsersController@destroy']);


    Route::post('roles',['as'=>'roles.store', 'uses'=> 'App\Http\Controllers\API\RolesController@store']);
    Route::get('roles', ['as' => 'roles.index','uses' =>'App\Http\Controllers\API\RolesController@index']);

    Route::post('permission',['as'=>'permission.store', 'uses'=> 'App\Http\Controllers\API\PermissionController@store']);
    Route::get('permission', ['as' => 'permission.index','uses' =>'App\Http\Controllers\API\PermissionController@index']);
    Route::get('permission/all', ['as' => 'permission.all','uses' =>'App\Http\Controllers\API\PermissionController@getAll']);
    Route::get('permission/{id}', ['as' => 'permission.show','uses' =>'App\Http\Controllers\API\PermissionController@show']);
    Route::delete('permission/{id}', ['as' => 'permission.destroy','uses' =>'App\Http\Controllers\API\PermissionController@destroy']);
    Route::get('permission-group/all', ['as' => 'permissionGroup.all','uses' =>'App\Http\Controllers\API\PermissionGroupController@getAll']);
});

Route::get('products', 'ProductController@index');
Route::get('products/{products}', 'ProductController@show');
Route::post('product', 'ProductController@store')->middleware(['auth:api', 'scope:create']);
Route::put('product/{product}', 'ProductController@update')->middleware(['auth:api', 'scope:edit']);
Route::delete('product/{product}', 'ProductController@destroy')->middleware(['auth:api', 'scope:delete']);
Route::fallback(function(){
    return response()->json(['message' => 'Page Not Found. If error persists, contact info@website.com','http_code' =>Response::HTTP_NOT_FOUND]);
})->name('api.fallback.404');
