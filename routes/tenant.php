<?php

use App\Tenants\Manager;

Route::get('test', function () {

    dd(app(Manager::class)->getTenant());

});
