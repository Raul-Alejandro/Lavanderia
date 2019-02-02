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

Route::get('/', function () {
    return Redirect::to('order');//view('order.index');
});

Route::resource('user','UserController');
Route::get('user/{id}/editprofile/','UserController@editprofile');
Route::patch('user/{id}/editprofile','UserController@updateProfile')->name('user.updateprofile');

Route::resource('customer','CustomerController');

Route::resource('sucursal','SucursalController');

Route::resource('inventory','InventoryController');
//Route::post('inventory/{id}/baja','InventoryController@baja')->name('inventory.baja');
//Route::post('inventory/{id}/alta','InventoryController@alta')->name('inventory.alta');
Route::get('inventory/{id}/baja','InventoryController@baja');
Route::get('inventory/{id}/alta','InventoryController@alta');

Route::resource('wash-service','WashServiceController');

Route::resource('iron-service','IronServiceController');

Route::resource('dry-service','DryCleanerServiceController');

Route::resource('order','OrderController');
//Route::post('order/{id}/pay','OrderController@pay')->name('order.pay');
Route::get('order/{id}/pay','OrderController@pay');
Route::get('order/{id}/delivery','OrderController@delivery');
Route::get('order/{id}/charge','OrderController@charge');
Route::get('find','OrderController@searchCustomers');
Route::get('findorder','OrderController@searchOrders');
Route::get('getorder/{id}','OrderController@getOrder');
Route::patch('add-weight/{id}','OrderController@editWeight')->name('edit-weight');
Route::get('order/{id}/add-iron-orders','OrderController@add_ironOrders')->name('order.add_iron');
Route::post('order/{id}/add-iron-orders','OrderController@store_ironOrders')->name('order.iron');
Route::post('localhost:8717/print_order','OrderController@print');

Route::resource('promotion','PromotionController');
Route::get('promotion/status/{id}','PromotionController@changeStatus');
Route::get('promotion/{p}/requirement/create','PromotionController@createRequirement')->name('requirement.create');
Route::post('promotion/{p}/requirement','PromotionController@addRequirement')->name('requirement.store');
Route::get('promotion/{p}/requirement/{r}/edit','PromotionController@editRequirement')->name('requirement.edit');
Route::patch('promotion/{p}/requirement/{r}/edit','PromotionController@updateRequirement')->name('requirement.update');

Route::get('get-requirements/{id}','PromotionController@getRequeriments');

Route::get('graphic/search_customers','GraphicController@customers')->name('search.customers');
Route::post('graphic/search_customers','GraphicController@customers')->name('search.customers');
Route::get('graphic/data_customers/{name}','GraphicController@graphicCustomer')->name('data.customers');

//Route::get('ajax-test','OrderController@ajax')->name('ajax');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


