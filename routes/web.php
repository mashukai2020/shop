<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

//搭建模板
Route::prefix('/index')->group(function(){
    Route::get('/index','Index\IndexController@index');
    Route::get('/login','Index\IndexController@login');
    Route::get('/register','Index\IndexController@register');
    Route::get('/list/{id}','Index\IndexController@list');
    Route::get('/cart','Index\IndexController@cart');
    Route::get('/goods','Index\IndexController@goods');
    Route::get('/tui','Index\IndexController@tui');
});

//登入
Route::prefix('/login')->group(function(){
    Route::post('/store','Login\RegisterController@store');
    Route::post('/login_do','Login\LoginController@login_do');
    Route::get('/code','Login\RegisterController@code');
});

Route::get('/api/test','Index\IndexController@test');

//购物车
Route::prefix('/cart')->group(function(){
    Route::get('/cart_do','Cart\CartController@cart_do');
    Route::get('/cartlist','Cart\CartController@cartlist');
    Route::get('/delete/{cart_id}','Cart\CartController@delete');
    Route::get('/zong/{cart_id}','Cart\CartController@zong');
    Route::get('/deng','Cart\CartController@deng');

});
Route::get('/tian','Index\IndexController@tian');
Route::get('/diqu','Index\IndexController@diqu');
Route::get('/pooo','Index\IndexController@pooo');
Route::get('/chou','Chou\ChouController@index');
Route::get('/chou/yunqi','Chou\ChouController@yunqi');
Route::get('/dian','Dian\DianController@index');
Route::get('/dian/create/{id}','Dian\DianController@create');
Route::get('/spon','Spon\SponController@index');
Route::get('/spon','Spon\SponController@index');
Route::get('/loc','Spon\SponController@loc');
Route::get('/xunhuan','Spon\XunController@index');
Route::get('/suan','Spon\XunController@suan');
Route::get('/create','Spon\XunController@create');
Route::get('/login/xcx','Spon\XunController@xcx');
Route::get('/api/goods','Spon\XunController@goods');
Route::get('/api/list','Spon\XunController@list');
Route::get('/api/cart','Spon\XunController@cart');
Route::post('/api/getuser','Spon\XunController@getuser');





















