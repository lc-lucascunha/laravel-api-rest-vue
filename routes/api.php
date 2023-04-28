<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Api'], function () {

    /*
    |--------------------------------------------------------------------------
    | API CATEGORIAS
    |--------------------------------------------------------------------------
    */

    Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
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

    Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
        Route::get(''       , ['as' => 'index'  , 'uses' => 'ProductController@index']);
        Route::get('{id}'   , ['as' => 'show'   , 'uses' => 'ProductController@show']);
        Route::post(''      , ['as' => 'store'  , 'uses' => 'ProductController@store']);
        Route::put('{id}'   , ['as' => 'update' , 'uses' => 'ProductController@update']);
        Route::delete('{id}', ['as' => 'destroy', 'uses' => 'ProductController@destroy']);
    });

});
