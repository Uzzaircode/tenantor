<?php

use App\Company;


Route::get('/', function () {

    Company::create([
        'name' => 'Uzzair Web Studio',        
    ]);

    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
