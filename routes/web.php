<?php


/**
 *  Copyright (c) 2019. Orahin
 * @author Pungky Kristianto
 * @url https://orahin.id
 * @date 12/15/19, 3:35 PM
 */

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

Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::prefix('select2')->group(function () {
        Route::get('role-select', 'Dashboard\Select2Controller@select2Role')->name('select2.role');
        Route::get('category-select', 'Dashboard\Select2Controller@select2Category')->name('select2.category');
        Route::get('company-select', 'Dashboard\Select2Controller@select2Company')->name('select2.company');
        Route::get('province-select', 'Dashboard\Select2Controller@select2Province')->name('select2.province');
        Route::get('city-select', 'Dashboard\Select2Controller@select2City')->name('select2.city');
        Route::get('district-select', 'Dashboard\Select2Controller@select2District')->name('select2.district');
        Route::get('village-select', 'Dashboard\Select2Controller@select2Village')->name('select2.village');
        Route::get('customer-select', 'Dashboard\Select2Controller@select2Customer')->name('select2.customer');
    });
    Route::get('/', 'Dashboard\HomeController@home')->name('home');
    Route::get('dashboard', 'Dashboard\HomeController@home')->name('home');
    Route::prefix('dashboard')->group(function () {
        Route::get('personal-information', 'Dashboard\ProfileController@personalInformation')
            ->name('personal-information');
        Route::patch('personal-information', 'Dashboard\ProfileController@updatePersonalInformation')
            ->name('personal-information');
        Route::get('change-password', 'Dashboard\ProfileController@changePassword')->name('change-password');
        Route::patch('change-password', 'Dashboard\ProfileController@updateChangePassword')->name('change-password');

        Route::get('user/list', 'Dashboard\UserController@list')->name('user.list');
        Route::resource('user', 'Dashboard\UserController');
        Route::get('role/list', 'Dashboard\RoleController@list')->name('role.list');
        Route::get('role-permission/{role}', 'Dashboard\RoleController@permissionSetting')->name('role.permission');
        Route::post('update-role-permission/{role}', 'Dashboard\RoleController@updatePermissionSetting')
            ->name('update-role-permission');
        Route::resource('role', 'Dashboard\RoleController');
        Route::get('customer/list', 'Dashboard\CustomerController@list')->name('customer.list');
        Route::patch('customer/update/email_verified/{customer}', 'Dashboard\CustomerController@updateStatus')
            ->name('customer.update.email_verified');
        Route::resource('customer', 'Dashboard\CustomerController');
        Route::get('category/list', 'Dashboard\CategoryController@list')->name('category.list');
        Route::patch('category/update/status/{category}', 'Dashboard\CategoryController@updateStatus')
            ->name('category.update.status');
        Route::resource('category', 'Dashboard\CategoryController');
        Route::get('subcategory/list', 'Dashboard\SubcategoryController@list')->name('subcategory.list');
        Route::patch('subcategory/update/status/{subcategory}', 'Dashboard\SubcategoryController@updateStatus')
            ->name('subcategory.update.status');
        Route::resource('subcategory', 'Dashboard\SubcategoryController');

        Route::get('company/list', 'Dashboard\CompanyController@list')->name('company.list');
        Route::get('company/detail/logo/{company}', 'Dashboard\CompanyController@logoDetail')
            ->name('company.detail.logo');
        Route::post('company/store/logo', 'Dashboard\CompanyController@logoStore')->name('company.store.logo');
        Route::delete('company/destroy/logo/{company}', 'Dashboard\CompanyController@logoDestroy')
            ->name('company.destroy.logo');
        Route::patch('company/update/status/{company}', 'Dashboard\CompanyController@updateStatus')
            ->name('company.update.status');
        Route::resource('company', 'Dashboard\CompanyController');

        Route::get('bulletin/list', 'Dashboard\BulletinController@list')->name('bulletin.list');
        Route::resource('bulletin', 'Dashboard\BulletinController');

        Route::get('banner/list', 'Dashboard\BannerController@list')->name('banner.list');
        Route::resource('banner', 'Dashboard\BannerController');

        Route::get('vendor/list', 'Dashboard\VendorController@list')->name('vendor.list');
        Route::patch('vendor/update/status/{vendor}', 'Dashboard\VendorController@updateStatus')
            ->name('vendor.update.status');
        Route::patch('vendor/update/id_card_verified/{vendor}/verify',
            'Dashboard\VendorController@updateIdCardVerify')
            ->name('vendor.update.id_card.verify');
        Route::patch('vendor/update/id_card_verified/{vendor}/reject',
            'Dashboard\VendorController@updateIdCardReject')
            ->name('vendor.update.id_card.reject');
        Route::resource('vendor', 'Dashboard\VendorController');
        Route::get('order/list', 'Dashboard\OrderController@list')->name('order.list');
        Route::resource('order', 'Dashboard\OrderController')->only('index', 'show', 'update');
    });
});
