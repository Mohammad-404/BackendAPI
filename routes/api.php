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
| flutter_api/admin/login
| Note Regardings the admin this is watershop.
| Note Regardings the customer this is a customer table.
| Note Regardings the delevary driver.
|
*/


Route::group(['middleware' => 'checkPassword'],function () {

    Route::group(['prefix' => 'watershop','namespace' => 'Admin'],function () {
        Route::post('login','loginController@login');
        Route::post('logout','loginController@logout')->middleware('assign.guard:admin-api');

    });

    Route::group(['prefix' => 'customer','namespace' => 'Customer'],function () {
        Route::post('login','loginController@login');
        Route::post('logout','loginController@logout')->middleware('assign.guard:customer-api');

    });

    Route::group(['prefix' => 'delivery','namespace' => 'Delivery'],function () {
        Route::post('login','loginController@login');
        Route::post('logout','loginController@logout')->middleware('assign.guard:delivery-api');

    });

});

//watershop all is done
Route::group(['prefix'=>'watershop','namespace' => 'Admin','middleware' => ['checkPassword','assign.guard:admin-api']],function () {
    
    Route::group(['prefix' => 'profile'],function(){
        Route::post('/','createWatershopController@profile');
    });
    
    Route::group(['prefix' => 'delivery'],function(){
        Route::post('/insert','addDeleviryController@setDelivery');
        Route::post('/view','addDeleviryController@getDelivery');
        Route::post('/edit/{id}','addDeleviryController@editDelivery');
        Route::post('/delete/{id}','addDeleviryController@deleteDelivery');
        Route::post('/update/{id}','addDeleviryController@updateDelivery');
    });
 
    Route::group(['prefix' => 'orders'],function(){
        Route::post('/','ordersController@getOrdersForWaterShop');
        Route::post('/send_order_to_delivery','ordersController@getOrdersForWaterShop');
    });

    Route::group(['prefix' => 'products'],function(){
        Route::post('/view','productsController@get');
        Route::post('/insert','productsController@insert');
        Route::post('/edit/{id}','productsController@edit');
        Route::post('/delete/{id}','productsController@delete');
        Route::post('/update/{id}','productsController@update');
    });

});

//customer
Route::group(['prefix'=>'customer','middleware' => ['checkPassword','assign.guard:customer-api']],function () {

    Route::group(['prefix' => 'profile','namespace' => 'Customer'],function(){
        Route::post('/','customerController@profile'); 
        Route::post('/updateProfile','customerController@updateProfile'); 
    });

    Route::group(['prefix' => 'payment_card','namespace' => 'Customer'],function(){
        // this group to save visa card to use it when he tried to use payment
        Route::post('/create','customerController@CreatePaymentCard'); 
        Route::post('/edit/{id}','customerController@EditPaymentCard'); 
        Route::post('/update/{id}','customerController@updatePaymentCard'); 
        Route::post('/delete/{id}','customerController@RemovePaymentCard'); 
    });

    Route::group(['prefix' => 'orders','namespace' => 'Admin'],function(){
        Route::post('/','ordersController@getOrdersForCustomers'); //to get orders history on customer profile
        Route::post('/purchase','ordersController@insert'); // this is to submit purchase. (insert)
    });

    Route::group(['prefix' => '/','namespace' => 'Customer'],function(){
        Route::post('/customer_info','customerController@getInfo'); 
        //this to take customer info when he want to purchase order
        // this is to view data. (getData).
    });
    
    //Favorite Section
    Route::group(['prefix' => 'favorite','namespace' => 'Favorite'],function(){
        Route::post('/','favoriteController@get'); //get favorite data
        Route::post('/add_favorite','favoriteController@insert'); //add favorite data
        Route::post('/remove/{id}','favoriteController@remove'); //remove favorite data
    });


    Route::group(['prefix' => '/','namespace' => 'Customer'],function(){
        // get all watershop
        Route::post('/getWaterShops','customerController@getWaterShops'); 
        // all watershop what's the product he has.        
        Route::post('/getProductsWaterShop','customerController@getProductsWaterShop'); 
        // after press on product to see all details
        Route::post('/getProductsDetails','customerController@getProductsDetails'); 
    });

    //create new tables for rate
    // most popular in your area, i think from emad side

});

//delivery
Route::group(['prefix'=>'delivery','middleware' => ['checkPassword','assign.guard:delivery-api']],function () {
    Route::post('/profile',function(){
        return \Auth::user();
    });
    

});
