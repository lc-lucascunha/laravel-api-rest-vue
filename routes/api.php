<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API CATEGORIAS
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'categorias', 'as' => 'categories.'], function () {
    Route::get(''       , ['as' => 'index'  , 'uses' => 'CategoryController@index']);
    Route::get('{id}'   , ['as' => 'show'   , 'uses' => 'CategoryController@show']);
    Route::post(''      , ['as' => 'store'  , 'uses' => 'CategoryController@store']);
    Route::put('{id}'   , ['as' => 'update' , 'uses' => 'CategoryController@update']);
    Route::delete('{id}', ['as' => 'destroy', 'uses' => 'CategoryController@destroy']);
});

/*
|--------------------------------------------------------------------------
| API PRODUTOS
|--------------------------------------------------------------------------
*/

