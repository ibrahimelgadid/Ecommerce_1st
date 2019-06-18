<?php

///////////// #HOME ROUTE ////////////
Route::get('/', 'HomeController@index');

Route::get('/product_by_category/{id}', 'HomeController@product_by_category');

Route::get('/product_by_manufacture/{id}', 'HomeController@product_by_manufacture');

Route::get('/view_product/{id}', 'HomeController@view_product');



///////////// #ADMIN ROUTE ////////////
Route::get('/admin', 'AdminController@index');

Route::get('/dashboard', 'SuperAdminController@index');

Route::post('/admin-dashboard','AdminController@dashboard');

Route::get('/logout','SuperAdminController@logout');


///////////// #Category ROUTE ////////////
Route::get('/add_category','CategoryController@index');

Route::get('/all_category','CategoryController@all_category');

Route::post('/save_category','CategoryController@save_category');

Route::get('/unactive_category/{id}','CategoryController@unactive_category');

Route::get('/active_category/{id}','CategoryController@active_category');

Route::get('/edit_category/{id}','CategoryController@edit_category');

Route::get('/delete_category/{id}','CategoryController@delete_category');

Route::post('/update_category/{id}','CategoryController@update_category');


///////////// #MANUFACTURE ROUTE ////////////
Route::get('/add_manufacture','ManufactureController@index');

Route::get('/all_manufacture','ManufactureController@all_manufacture');

Route::post('/save_manufacture','ManufactureController@save_manufacture');

Route::get('/unactive_manufacture/{id}','ManufactureController@unactive_manufacture');

Route::get('/active_manufacture/{id}','ManufactureController@active_manufacture');

Route::get('/edit_manufacture/{id}','ManufactureController@edit_manufacture');

Route::post('/update_manufacture/{id}','ManufactureController@update_manufacture');

Route::get('/delete_manufacture/{id}','ManufactureController@delete_manufacture');


///////////// #PRODUCT ROUTE ////////////
Route::get('/add_product','ProductController@index');

Route::get('/all_product','ProductController@all_product');

Route::post('/save_product','ProductController@save_product');

Route::get('/unactive_product/{id}','ProductController@unactive_product');

Route::get('/active_product/{id}','ProductController@active_product');

Route::get('/edit_product/{id}','ProductController@edit_product');

Route::post('/update_product/{id}','ProductController@update_product');

Route::get('/delete_product/{id}','ProductController@delete_product');



///////////// #SLIDER ROUTE ////////////
Route::get('/add_slider','SliderController@index');

Route::get('/all_slider','SliderController@all_slider');

Route::post('/save_slider','SliderController@save_slider');

Route::get('/unactive_slider/{id}','SliderController@unactive_slider');

Route::get('/active_slider/{id}','SliderController@active_slider');

Route::get('/edit_slider/{id}','SliderController@edit_slider');

Route::get('/delete_slider/{id}','SliderController@delete_slider');

Route::post('/update_slider/{id}','SliderController@update_slider');



///////////// #CART ROUTE ////////////
Route::post('/add_to_cart', 'CartController@add_to_cart');

Route::get('/show_cart', 'CartController@show_cart');

Route::post('/update_cart', 'CartController@update_cart');

Route::get('/delete_cart/{id}', 'CartController@delete_cart');

Route::get('/destroy', 'CartController@destroy');


///////////// #CHECKOUT ROUTE ////////////
Route::get('/login_check', 'CheckoutController@login_check');

Route::get('/checkout', 'CheckoutController@checkout');

Route::post('/save_shipping', 'CheckoutController@save_shipping');

Route::get('/payment', 'CheckoutController@payment');

Route::post('/order_place', 'CheckoutController@order_place');


///////////// #CUSTOMER ROUTE ////////////
Route::post('/login', 'CheckoutController@login');

Route::post('/register', 'CheckoutController@register');

Route::get('/logout', 'CheckoutController@logout');