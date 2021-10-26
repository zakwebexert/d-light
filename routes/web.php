<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


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

//Route::get('/', function () {
//    return view('auth.login');
//});
Route::get('/clear',function(){
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
});

Auth::routes();


//start site routes

Route::get('/', 'Site\SiteController@index')->name('site.home');
Route::get('category/{id}','Site\SiteController@category_product')->name('category_product');
Route::get('categories','Site\SiteController@categories')->name('categories');
Route::get('style_products/{id}','Site\SiteController@styles_product')->name('styles_products');
Route::get('all-flash-items/{num}/{name}','Site\SiteController@all_flash_items')->name('all_flash_items');
Route::get('shop-grid/{num}','Site\SiteController@shop_grid')->name('shop_grid');
Route::get('shop-list/{num}','Site\SiteController@shop_list')->name('shop_list');
Route::get('all_pages','Site\UserController@showallpages')->name('all_pages');
Route::post('search-items', 'Site\SiteController@search_item')->name('search_item');

Route::group([
    'prefix'        => 'site',
    'namespace'     => 'Site'
], function () {
    Route::get('/category/{id}', 'SiteController@show')->name('site.category');
    Route::resource('product', 'ProductController');
});

//end site routes

Route::group([
    'middleware'    => ['auth'],
    'prefix'        => 'site',
    'namespace'     => 'Site'
], function ()
{

    //cart routes
    Route::get('cart','CartController@cart')->name('cart');
    Route::get('checkout','CartController@showCheckout')->name('checkout');
    Route::get('checkout-payment','CartController@checkout_payment')->name('checkout_payment');
    Route::get('payment-methods','CartController@payment_methods')->name('payment_methods');

    //end cart routes
    Route::get('/dashboard', 'UserController@index')->name('client.dashboard');
	Route::get('/profile', 'UserController@edit')->name('client-profile');
	Route::post('/admin-update', 'UserController@update')->name('client-update');

	Route::post('storeCartItem','ProductController@storeCartItem')->name('storeCartItem');
	Route::get('storeCartItemSingle','ProductController@storeCartItemSingle')->name('storeCartItemSingle');
    Route::get('remove/{id}','CartController@remove')->name('remove');

    Route::get('edit-profile','UserController@edit_profile')->name('edit_profile');
    Route::post('update-profile','UserController@update_profile')->name('update_profile');

    Route::get('credit-card','CartController@credit_card')->name('credit_card');
    Route::get('bank','CartController@bank')->name('bank');
    Route::get('paypal','CartController@paypal')->name('paypal');
    Route::get('cash','CartController@cash')->name('cash');

    Route::get('paypal/success','PaypalController@success');
    Route::get('paypal/fail','PaypalController@fail');

    Route::post('/str','StripeController@stripe')->name('str');

    Route::post('change-profile-pic','UserController@update_profile_image')->name('update_profile_image');

    Route::get('change-password','UserController@show_change_password_form')->name('change_password_form');
    Route::post('update-password','UserController@update_password')->name('update_password');

    Route::get('my-orders','UserController@show_my_orders')->name('my_orders');
    Route::post('wishlist', 'UserController@wishlist')->name('wishlist');
    Route::get('my-wish-list', 'UserController@my_wish_grid')->name('my_wish_list');
    Route::get('wishlist-list', 'UserController@wishlist_list')->name('wishlist_list');
    Route::post('wishlist-cart', 'UserController@wishlist_cart')->name('wishlist_cart');



});

Route::group([
    'middleware'    => ['auth','is_admin'],
    'prefix'        => 'admin',
    'namespace'     => 'Admin'
], function ()
{
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::get('/profile', 'AdminController@edit')->name('admin-profile');
    Route::post('/admin-update', 'AdminController@update')->name('admin-update');
    //Setting Routes
    Route::resource('setting','SettingController');

    //Product routes
    Route::resource('products','ProductController');
    Route::post('get-products', 'ProductController@getProducts')->name('admin.getProducts');
    Route::post('product_detail', 'ProductController@productDetail')->name('product_detail');
    Route::get('product/delete/{id}', 'ProductController@destroy');
    Route::post('delete-selected-products', 'ProductController@deleteSelectedProducts')->name('admin.delete-selected-products');
    Route::get('add-colors/{id}', 'ProductController@addColors')->name('products.addColorsget');
    Route::post('add-colors', 'ProductController@storeColors')->name('products.addColors');
    Route::get('add-options/{id}', 'ProductController@addOptions')->name('products.addOptionsget');
    Route::post('add-options', 'ProductController@storeOptions')->name('products.addOptions');


    Route::post('import-products', 'ProductController@importProducts')->name('import-products');
    Route::get('import-products-sample', 'ProductController@importProductsSample')->name('import-products-sample');
    Route::post('import-images', 'ProductController@importImages')->name('import-images');

    //Front page customize routes
    Route::resource('front-page','HomePageContentController');

    Route::get('custom_front-page/{num}','HomePageContentController@show_slide_show_form')->name('slide-form');
    Route::post('show-slide-show-page','HomePageContentController@store_slide_show')->name('store-slide-form');


    //User Routes
	Route::resource('clients','ClientController');
	Route::post('get-clients', 'ClientController@getClients')->name('admin.getClients');
	Route::post('get-client', 'ClientController@clientDetail')->name('admin.getClient');
	Route::get('client/delete/{id}', 'ClientController@destroy');
	Route::post('delete-selected-clients', 'ClientController@deleteSelectedClients')->name('admin.delete-selected-clients');

	Route::get('admins','ClientController@admin_index')->name('admins');
    Route::post('get-admins', 'ClientController@getAdmins')->name('admin.getAdmins');
    Route::post('get-admin', 'ClientController@adminDetail')->name('admin.getAdmin');


    Route::resource('categories','CategoryController');
    Route::post('get-categories', 'CategoryController@getCategories')->name('admin.getCategories');
    Route::post('get-category', 'CategoryController@categorydetail')->name('admin.categorydetail');
    Route::get('category/delete/{id}', 'CategoryController@destroy');
    Route::post('delete-selected-categories', 'CategoryController@deleteSelectedCategories')->name('admin.delete-selected-categories');


    Route::resource('orders','PaidOrderController');
    Route::post('get-orders', 'PaidOrderController@getOrders')->name('admin.getOrders');
    Route::post('get-order', 'PaidOrderController@Orderdetail')->name('admin.Order');
    Route::get('order/delete/{id}', 'PaidOrderController@destroy');
    Route::post('delete-selected-orders', 'PaidOrderController@deleteSelectedOrders')->name('admin.delete-selected-orders');

    Route::get('change_order_status/{id}','PaidOrderController@change_status')->name('change_order_status');

    Route::get('processed-orders','PaidOrderController@processedindex')->name('admin.processedindex');
    Route::post('get-processed-orders', 'PaidOrderController@getProcessedOrders')->name('admin.getProcessedOrders');
    Route::get('processed-order/{id}', 'PaidOrderController@ProcessedOrderShow')->name('admin.ProcessedOrder');
    Route::get('processed-order/delete/{id}', 'PaidOrderController@Pdestroy');


    Route::resource('styles','StyleController');
    Route::post('get-styles', 'StyleController@getStyles')->name('admin.getStyles');
    Route::post('get-style', 'StyleController@Styledetail')->name('admin.Style');
    Route::post('get-category-styles', 'StyleController@CategoryStyles')->name('admin.category_styles');
    Route::get('style/delete/{id}', 'StyleController@destroy');
});

