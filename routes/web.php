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
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return redirect()->route('users.main');
});

Route::prefix('countries')->name('countries.')->group(function(){ $c='CountriesController@';
    Route::get('', $c.'main')->name('main');
    Route::get('add', $c.'add')->name('add');
    Route::put('add', $c.'add_put');
    Route::get('edit/{id}', $c.'edit')->name('edit');
    Route::patch('edit/{id}', $c.'edit_patch');
    Route::delete('delete', $c.'delete')->name('delete');
});

Route::prefix('users')->name('users.')->group(function(){ $c='UsersController@';
    Route::get('', $c.'main')->name('main');
    Route::get('add', $c.'add')->name('add');
    Route::put('add', $c.'add_put');
    Route::get('edit/{id}', $c.'edit')->name('edit');
    Route::patch('edit/{id}', $c.'edit_patch');
    Route::delete('delete', $c.'delete')->name('delete');
});
