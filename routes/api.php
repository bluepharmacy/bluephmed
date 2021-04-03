<?php

use Illuminate\Http\Request;
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

//Create Product
Route::post('testcreateproduct', 'ApiTestController@createProduct');

// Create Unit
Route::post('testcreateunit', 'ApiTestController@createUnit');

// Create Selling
Route::post('testcreateselling', 'ApiTestController@createSelling');

// Create Prices
Route::post('testcreateprices', 'ApiTestController@createPrices');

// Create Order_Receipt
Route::post('testcreateorderreceipt', 'ApiTestController@createOrderReceipt');

// Create Or Number
Route::post('testcreateornumber', 'ApiTestController@createOrNumber');

// Create Stocks
Route::post('testcreatestocks', 'ApiTestController@createStocks');




// Test Only

Route::post('testPostMan','ApiTestController@testPostMan');

Route::get('testgetallusers','ApiTestController@getAllUsers');

Route::get('testUpdate','ApiTestController@testUpdate');

Route::post('testInsertToMultipleTable', 'ApiTestController@testInsertToMultipleTable');

Route::post('testInsertByLocation', 'ApiTestController@insertByLocation');

Route::get('testShowByLocation', 'ApiTestController@showByLocation');





//create in system

// create supplier
Route::post('insertSupplier', 'ApiTestController@createSupplier');

// create unit
Route::post('insertUnit', 'ApiTestController@createUnit');

// create classification
Route::post('insertClassification', 'ApiTestController@createClassification');

// create Map
Route::post('insertMap', 'ApiTestController@createMap');

// get list of Map
Route::get('getMaps', 'ApiTestController@getMaps');

// create Locate
Route::post('insertLocate', 'ApiTestController@createLocate');


// get all products
Route::get('getProducts', 'ApiTestController@getProducts');

// add Stocks
Route::post('insertStocks', 'ApiTestController@addStocks');

// get Units
Route::get('getUnits', 'ApiTestController@getUnits');

// get SoldFrom
Route::get('getSoldFrom', 'ApiTestController@getSoldFrom');

// get Classification
Route::get('getClassification', 'ApiTestController@getClassification');

// get Existing Record
Route::get('getExistingRecord', 'ApiTestController@getExistingRecord');

// insertProduct
Route::post('insertProduct', 'ApiTestController@insertProduct');


// getAllPendingSales
Route::get('getAllPendingSales', 'ApiTestController@getAllPendingSales');

// insertSales
Route::post('insertSales', 'ApiTestController@insertSales');

// removeInPendingSales
Route::post('removeInPendingSales', 'ApiTestController@removeInPendingSales');

// sendToCashier
Route::post('sendToCashier', 'ApiTestController@sendToCashier');

// getAllSalesToday
Route::get('getAllSalesToday', 'ApiTestController@getAllSalesToday');

// getMeAsUser
Route::get('getMeAsUser', 'ApiTestController@getMeAsUser');


// createUserType
Route::post('createUserType', 'ApiTestController@createUserType');







// Mobile Request Api ::::::::::::::::::::::::::::::::::::::

// getAllUsers
Route::get('getAllUsers', 'ApiMobileController@getAllUsers');

// getAllNewbies
Route::get('getAllNewbies', 'ApiMobileController@getAllNewbies');

// loginMyAcc
Route::post('loginMyAcc', 'ApiMobileController@loginMyAcc');

// regMyAcc
Route::post('regMyAcc', 'ApiMobileController@regMyAcc');

// removeThisInNewUsers 
Route::delete('removeThisInNewUsers', 'ApiMobileController@removeThisInNewUsers'); 

// removeThisListInNewUsers
Route::delete('removeThisListInNewUsers', 'ApiMobileController@removeThisListInNewUsers');

// singleAcceptNewUser
Route::put('singleAcceptNewUser', 'ApiMobileController@singleAcceptNewUser');

// multiAcceptNewUsers
Route::put('multiAcceptNewUsers', 'ApiMobileController@multiAcceptNewUsers');

// getAllStocks
Route::get('getAllStocks', 'ApiMobileController@getAllStocks');


// updateStock
Route::put('updateStock', 'ApiMobileController@updateStock');

// lowStocks
Route::get('lowStock', 'ApiMobileController@lowStock');

// getProduct
Route::post('getProduct', 'ApiMobileController@getProduct');

// getPendingSalesID
Route::post('getPendingSalesID', 'ApiMobileController@getPendingSalesID');