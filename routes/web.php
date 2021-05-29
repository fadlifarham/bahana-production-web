<?php

Auth::routes();
Route::get('/', 'LandingController@index')->name('landing');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::group(['prefix' => 'admin'], function () {
        Route::group(['prefix' => 'orders'], function () {
            Route::get('/', 'Admin\OrderController@index')->name('adminOrderIndex');
            Route::get('/{id}', 'Admin\OrderController@detail')->name('adminOrderDetail');
            Route::post('/{id}/confirm', 'Admin\OrderController@postConfirm')->name('adminOrderPostConfirm');
        });

        Route::group(['prefix' => 'products'], function () {
            Route::get('/', 'Admin\ProductController@index')->name('adminProductIndex');
            Route::get('/create', 'Admin\ProductController@create')->name('adminProductCreate');
            Route::post('/create', 'Admin\ProductController@store')->name('adminProductStore');
            Route::get('/edit/{id}', 'Admin\ProductController@edit')->name('adminProductEdit');
            Route::post('/edit/{id}', 'Admin\ProductController@update')->name('adminProductUpdate');
            Route::post('/delete/{id}', 'Admin\ProductController@destroy')->name('adminProductDelete');
        });
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', 'UserController@index')->name('userIndex');
        Route::get('/create', 'UserController@create')->name('userCreate');
        Route::post('/create', 'UserController@store')->name('userCreatePost');
        Route::get('/edit/{id}', 'UserController@edit')->name('userEdit');
        Route::post('/edit/{id}', 'UserController@update')->name('userUpdate');
        Route::get('/password/{id}', 'UserController@editPassword')->name('userEditPassword');
        Route::post('/password/{id}', 'UserController@updatePassword')->name('userUpdatePassword');
        Route::post('/delete/{id}', 'UserController@destroy')->name('userDelete');
    });

    Route::group(['prefix' => 'products'], function () {
        Route::get('/', 'ProductController@index')->name('productIndex');
        Route::get('/{id}/order', 'ProductController@order')->name('productOrder');
        Route::post('/{id}/order', 'ProductController@postOrder')->name('productPostOrder');
    });

    Route::group(['prefix' => 'orders'], function () {
        Route::get('/', 'OrderController@index')->name('orderIndex');
        Route::get('/{id}', 'OrderController@detail')->name('orderDetail');
        Route::post('/{id}/proof-of-payment', 'OrderController@proofOfPayment')->name('orderProofOfPayment');
    });

    Route::group(['prefix' => 'carts'], function () {
        Route::get('/', 'ProductOrderController@index')->name('cartIndex');
        Route::post('/{id}', 'ProductOrderController@post')->name('cartPost');
        Route::get('/{id}/delete', 'ProductOrderController@delete')->name('cartDelete');
    });
});
