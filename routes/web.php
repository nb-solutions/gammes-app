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

Route::get('/home', function () {
	return redirect(route('gammes.index'));
});

Auth::routes();
Route::middleware('auth')->group(function(){
	Route::get('/',function(){
		return redirect(route('gammes.index'));
	})->name('home');
	Route::resource('gammes','GammesController');
	Route::post('/gammes/{gamme}/items/add','GammesController@addItem')->name('gammes.add-item');
	Route::get('/gammes/{gamme}/form','GammesController@showForm')->name('gammes.show-form');
	Route::post('/gammes/{gamme}/form/submit','GammesController@submitForm')->name('gammes.submit-form');
});

