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

Route::get('tenant/{company}/', 'TenantsController@switch')->name('tenants.switch');
Route::resource('companies', 'CompaniesController');
