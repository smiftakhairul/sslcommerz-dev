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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//SSLCZ
Route::get('/sslcommerz/hosted', 'SSLCommerzController@hosted')->name('sslcommerz.hosted');
Route::get('/sslcommerz/checkout', 'SSLCommerzController@checkout')->name('sslcommerz.checkout');
Route::post('/sslcommerz/checkout/init-via-ajax', 'SSLCommerzController@initViaAjax')->name('sslcommerz.checkout.init-via-ajax');
Route::post('/sslcommerz/success', 'SSLCommerzController@success')->name('sslcommerz.success');
Route::post('/sslcommerz/fail', 'SSLCommerzController@fail')->name('sslcommerz.fail');
Route::post('/sslcommerz/cancel', 'SSLCommerzController@cancel')->name('sslcommerz.cancel');
Route::post('/sslcommerz/ipn', 'SSLCommerzController@ipn')->name('sslcommerz.ipn');
