<?php

use Illuminate\Http\Request;

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

Route::post('register', 'UserController@store');
Route::post('login', 'Api\AuthController@login');
Route::group(['middleware' => 'auth:api'], function () {
    Route::post('profile', 'Api\AuthController@profile');
});

Route::resource('user','UserController',['except'=>['show']]);

Route::resource('customer','CustomerController',['except'=>['create','show']]);
Route::post('customer/search','CustomerController@search');

Route::resource('sucursal','SucursalController',['except'=>['create','show']]);

Route::resource('inventory','InventoryController',['except'=>['show']]);
Route::post('inventory/{id}/baja','InventoryController@baja')->name('inventory.baja');
Route::post('inventory/{id}/alta','InventoryController@alta')->name('inventory.alta');
Route::post('inventory/search','InventoryController@search');
Route::get('consumed','InventoryController@consumedSupplies')->name('consumed.supplies');

Route::resource('wash-service','WashServiceController',['except'=>['create','show']]);

Route::resource('iron-service','IronServiceController',['except'=>['create','show']]);

Route::resource('dry-service','DryCleanerServiceController',['except'=>['create','show']]);

//Route::resource('order','OrderController',['except'=>['edit','update','destroy']]);
Route::get('order','OrderController@index')->name('order.index');
Route::post('order','OrderController@store')->name('order.store');
Route::get('order/create','OrderController@create')->name('order.create');
Route::get('o-r&d-e-r/{id}','OrderController@show')->name('order.show');
Route::post('order/search','OrderController@search');
Route::post('order/{id}/pay','OrderController@pay')->name('order.pay');
Route::get('order/{id}/delivery','OrderController@delivery');
Route::get('find','OrderController@searchCustomers');
Route::get('findorder','OrderController@searchOrders');
Route::get('getorder/{id}','OrderController@getOrder');
Route::post('localhost:8717/print_order','OrderController@print');

Route::resource('promotion','PromotionController',['except'=>['show','edit']]);
Route::get('promotion/status/{id}','PromotionController@changeStatus');
Route::get('promotion/{p}/requirement/create','PromotionController@createRequirement')->name('requirement.create');
Route::post('promotion/{p}/requirement','PromotionController@addRequirement')->name('requirement.store');
Route::get('promotion/{p}/requirement/{r}/edit','PromotionController@editRequirement')->name('requirement.edit');
Route::patch('promotion/{p}/requirement/{r}/edit','PromotionController@updateRequirement')->name('requirement.update');

Route::get('daily_cash','OrderController@dailyCash');
Route::get('not_delivered','OrderController@notDelivered');
Route::get('not_payed','OrderController@notPayed');
Route::get('total_balance','OrderController@totalBalance');
Route::get('total_charges','OrderController@totalCharges');
Route::get('late_not_delivered','OrderController@lateNotDelivered');

