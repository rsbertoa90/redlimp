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



Route::post('/login','Auth\LoginController@login');
Route::get('/logout','Auth\LoginController@logout');
Route::get('/sitemap.xml','SitemapController@sitemap');
Route::middleware('CheckSuper')->prefix('super')->group(function(){
    

    Route::post('/category/image','CategoryController@uploadImage')->middleware('OptimizeImages');
    Route::post('/supercategory/image','SupercategoryController@uploadImage')->middleware('OptimizeImages');

    Route::put('/metadata','MetadataController@update');
});


Route::middleware('CheckAdmin')->prefix('admin')->group(function(){

   
    Route::post('/category','CategoryController@create');
    Route::put('/category','CategoryController@update');
    Route::put('/supercategory','SupercategoryController@update');


    Route::post('/product','ProductController@create');
    Route::put('/product','ProductController@update');
    Route::delete('/product/{id}','ProductController@destroy');

    Route::post('/product/image','ProductImageController@create')->middleware('OptimizeImages');
    Route::delete('/product/image/{id}','ProductImageController@destroy');

    Route::put('/order','OrderController@edit');
   
    Route::get('/getOrders','OrderController@getOrders');

    Route::put('/config','ConfigController@update');

    Route::get('/pdf/{order}','OrderController@toPDF');
});

Route::get('/pdf/{order}','OrderController@toPDF');

Route::get('/config','ConfigController@get');


Route::post('/regalos-empresariales','MailController@regalosEmpresariales')->middleware('OptimizeImages');;

Route::post('/franquicia','MailController@franquicia');
Route::post('/contacto','MailController@contacto');

Route::get('/logout',function(){
    Auth::logout();
    return redirect('/');
});



Route::get('/getUser','HomeController@getUser');

Route::post('/cotizer/send','OrderController@create');

Route::get('/lista-de-precios','PdfController@prices');

Route::post('/suscription','SuscriptionController@create');



Route::get('/{any}','SinglePageController@index')->where('any', '.*');

