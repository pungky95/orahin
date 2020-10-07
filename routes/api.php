<?php


/**
 *  Copyright (c) 2019. Orahin
 * @author Pungky Kristianto
 * @url https://orahin.id
 * @date 12/15/19, 3:35 PM
 */

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

Route::group(['prefix' => 'auth'], function () {
    Route::group(['middleware' => ['guest:api']], function () {
        Route::post('login', 'API\CustomerController@login');
        Route::post('register', 'API\CustomerController@register');
    });
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('logout', 'API\CustomerController@logout');
    });
});
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('current-customer', 'API\CustomerController@currentCustomer');
    Route::post('update-photo-profile-customer', 'API\CustomerController@updatePhotoProfile');
    Route::post('update-customer', 'API\CustomerController@update');
    Route::post('update-verify-email-customer', 'API\CustomerController@verifyEmail');

    Route::patch('vendor/update', 'API\VendorController@update');
    Route::get('vendor/show', 'API\VendorController@myVendor');
    Route::post('vendor/update/logo', 'API\VendorController@updateLogo');
    Route::get('vendor/detail/{vendor}', 'API\VendorController@show');
    Route::ApiResource('vendor', 'API\VendorController')->only('store');
    Route::ApiResource('province', 'API\ProvinceController')->only('index', 'show');
    Route::ApiResource('city', 'API\CityController')->only('index', 'show');
    Route::ApiResource('district', 'API\DistrictController')->only('index', 'show');
    Route::ApiResource('village', 'API\VillageController')->only('index', 'show');
    Route::ApiResource('banner', 'API\BannerController')->only('index', 'show');
    Route::ApiResource('category', 'API\CategoryController')->only('index', 'show');
    Route::ApiResource('subcategory', 'API\SubcategoryController')->only('index', 'show');
    Route::post('service/{service}/images', 'API\ServiceController@updateImages');
    Route::ApiResource('service', 'API\ServiceController');
    Route::ApiResource('favorite-item', 'API\FavoriteItemController');
    Route::ApiResource('order', 'API\OrderController')->only('index', 'store', 'update', 'show');
    Route::get('vendor-order/{order}', 'API\VendorOrderController@show');
    Route::get('vendor-order', 'API\VendorOrderController@index');
    Route::patch('vendor-order/{order}', 'API\VendorOrderController@update');
});
Route::post('xendit-callback', 'API\XenditPaymentCallbackController@callback');
