<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Example route
Route::get('/example', function () {
    return 'Hello, World!';
});

Route::group(['middleware' => ['api']], function () {
  Route::get('articles', 'Api\ArticleController@index');
  Route::get('articles/{id}', 'Api\ArticleController@show');
  Route::post('articles', 'Api\ArticleController@store');
  Route::patch('articles/{id}', 'Api\ArticleController@update');
  Route::delete('articles/{id}', 'Api\ArticleController@destroy');
});