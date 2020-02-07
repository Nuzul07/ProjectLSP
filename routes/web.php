<?php
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

Route::get('/images/{filename}', function ($filename) {
    $path = storage_path('images') . '/' . $filename;
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file);
    $response->header("Content-Type", $type);
    return $response;
});

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::group(["middleware" => "auth"], function () {
    Route::get('home', 'HomeController@index')->name('home');
});

Route::resource("users", "UserController");
Route::resource("food", "FoodController");
Route::resource("order", "OrderController");
Route::resource("orderdetail", "OrderDetailsController");
Route::resource("transaksi", "TransaksiController");
Route::get('transaksiClean', 'TransaksiController@transaksiClean')->name('transaksiClean');
Route::resource('checkout', 'CheckoutController');
Route::resource('invoice', 'InvoiceController');
Route::post('updatestatus', 'OrderDetailsController@update');

Route::group(["prefix" => "print"], function () {
    Route::get('users', 'UserController@print')->name("printUsers");
});
