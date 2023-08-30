<?php
/**
 * File name: api.php
 * Last modified: 2020.08.20 at 17:21:16
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
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

Route::prefix('manager')->group(function () {
    Route::post('login', 'API\Manager\UserAPIController@login');
    Route::post('register', 'API\Manager\UserAPIController@register');
    Route::post('send_reset_link_email', 'API\UserAPIController@sendResetLinkEmail');
    Route::get('user', 'API\Manager\UserAPIController@user');
    Route::get('logout', 'API\Manager\UserAPIController@logout');
    Route::get('settings', 'API\Manager\UserAPIController@settings');
});


Route::post('login', 'API\UserAPIController@login');
Route::post('register', 'API\UserAPIController@register');
Route::post('send_reset_link_email', 'API\UserAPIController@sendResetLinkEmail');
Route::get('user', 'API\UserAPIController@user');
Route::get('logout', 'API\UserAPIController@logout');
Route::get('settings', 'API\UserAPIController@settings');
Route::post('user-verify', 'API\UserAPIController@userVerify');

Route::resource('categories', 'API\CategoryAPIController');
Route::resource('shops', 'API\ShopAPIController');

Route::resource('faq_categories', 'API\FaqCategoryAPIController');
// Route::get('clothes/categories', 'API\ClothesAPIController@categories');
Route::resource('clothes', 'API\ClothesAPIController');
Route::resource('galleries', 'API\GalleryAPIController');
Route::resource('clothes_reviews', 'API\ClothesReviewAPIController');
Route::resource('extras', 'API\ExtraAPIController');
Route::resource('extra_groups', 'API\ExtraGroupAPIController');
Route::resource('faqs', 'API\FaqAPIController');
Route::resource('shop_reviews', 'API\ShopReviewAPIController');
Route::resource('currencies', 'API\CurrencyAPIController');
Route::resource('slides', 'API\SlideAPIController')->except([
    'show'
]);
Route::resource('offers', 'API\OfferAPIController')->except([
    'show'
]);
Route::middleware('auth:api')->group(function () {
    Route::group(['middleware' => ['role:manager']], function () {
        Route::prefix('manager')->group(function () {
            Route::post('users/{id}', 'API\UserAPIController@update');
            Route::get('users/drivers_of_shop/{id}', 'API\Manager\UserAPIController@driversOfShop');
            Route::get('dashboard/{id}', 'API\DashboardAPIController@manager');
            Route::resource('shops', 'API\Manager\ShopAPIController');
            Route::resource('faq_categories', 'API\FaqCategoryAPIController');
            Route::resource('faqs', 'API\FaqAPIController');
        });
    });
    Route::post('users/{id}', 'API\UserAPIController@update');

    Route::resource('order_statuses', 'API\OrderStatusAPIController');

    Route::get('payments/byMonth', 'API\PaymentAPIController@byMonth')->name('payments.byMonth');
    Route::resource('payments', 'API\PaymentAPIController');

    Route::get('favorites/exist', 'API\FavoriteAPIController@exist');
    Route::resource('favorites', 'API\FavoriteAPIController');

    Route::resource('orders', 'API\OrderAPIController');

    Route::resource('clothes_orders', 'API\ClothesOrderAPIController');

    Route::resource('notifications', 'API\NotificationAPIController');

    Route::get('carts/count', 'API\CartAPIController@count')->name('carts.count');
    Route::resource('carts', 'API\CartAPIController');

    Route::resource('delivery_addresses', 'API\DeliveryAddressAPIController');

    Route::resource('earnings', 'API\EarningAPIController');

    Route::resource('shopsPayouts', 'API\ShopsPayoutAPIController');

    Route::resource('coupons', 'API\CouponAPIController')->except([
        'show'
    ]);

    Route::resource('likes', 'API\LikeAPIController');

});
Route::get('clothes-categories', 'API\ClothesCategoryAPIController@index');
Route::get('colours-categories', 'API\ColourCategoryAPIController@index');
Route::get('shops-categories', 'API\ShopCategoryAPIController@index');
Route::get('sizes-categories', 'API\SizeCategoryAPIController@index');
// sub categorys 
Route::get('sizes-Subcategory', 'API\SizeCategoryAPIController@subsize');
Route::get('clothes-Subcategories', 'API\ClothesCategoryAPIController@subClothesCategory');
Route::get('shops-Subcategories', 'API\ShopCategoryAPIController@subShop');
Route::get('brands', 'API\BrandAPIController@index');

Route::resource('subcategory', 'API\SubCategoryController');

//get data
Route::get('get-categories','API\ProductDataContoller@getCategory');
Route::post('get-subcategories','API\ProductDataContoller@getSubCategory');

Route::get('get-clothescategory','API\ProductDataContoller@getClothesCategory');
Route::post('get-clothes-subcategories','API\ProductDataContoller@getClothesSubCategory');

Route::get('get-size-category','API\ProductDataContoller@getSizeCategory');
Route::post('get-size-subcategories','API\ProductDataContoller@getSizeSubCategory');


Route::get('get-data','API\ProductDataContoller@getAllData');

Route::middleware('auth:api')->group(function () {
    Route::get('user-items',"API\ClothesAPIController@userItems");

    Route::post('store-clothes',"API\ClothesAPIController@storeFromApp");
    Route::post('update-clothes/{id}',"API\ClothesAPIController@updateFromApp");

});


Route::post('search/clothes', 'API\ClothesAPIController@search');
Route::get('trending/categories', 'API\ClothesCategoryAPIController@topCategories');
Route::get('trending/categories/{category_id}/clothes', 'API\ClothesCategoryAPIController@topCategoriesClothes');
Route::get('shop-categories/{shop_id}', 'API\CategoryAPIController@shopCategories');
Route::get('shop-categories/{shop_id}/category/{category_id}/clothes', 'API\CategoryAPIController@shopCategoriesClothes');

Route::get('category/{category_id}/subcategories', 'API\ClothesCategoryAPIController@subCategories');
Route::get('category/{category_id}/subcategories/{sub_category_id}/clothes', 'API\ClothesCategoryAPIController@subCategoriesClothes');

Route::get('governorates/', 'API\GeoAPIController@governorates');
Route::get('cities/', 'API\GeoAPIController@cities');
Route::get('pricing/', 'API\PricingAPIController@index');

Route::get('colours/{colour_id}/clothes/{clothes_id}', 'API\ClothesAPIController@colours');
