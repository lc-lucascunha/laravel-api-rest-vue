<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Api'], function () {

    /*
    |--------------------------------------------------------------------------
    | CATEGORIAS
    |--------------------------------------------------------------------------
    */

    Route::group(['prefix' => 'categories'], function () {
        Route::get(''       , 'CategoryController@index');
        Route::get('{id}'   , 'CategoryController@show');
        Route::post(''      , 'CategoryController@store');
        Route::put('{id}'   , 'CategoryController@update');
        Route::delete('{id}', 'CategoryController@destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | PRODUTOS
    |--------------------------------------------------------------------------
    */

    Route::group(['prefix' => 'products'], function () {
        Route::get(''       , 'ProductController@index');
        Route::get('{id}'   , 'ProductController@show');
        Route::post(''      , 'ProductController@store');
        Route::put('{id}'   , 'ProductController@update');
        Route::delete('{id}', 'ProductController@destroy');
    });

});
