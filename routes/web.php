<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Spatie\Multitenancy\Models\Tenant;

// Route::get('/', function () {

//     return view('welcome');
// });


Route::get('/', function () {
    dd([
        'tenant' => Tenant::current()->id,
        'database' => Tenant::current()->database,
        'host' => request()->getHost(),
        'users' => User::firstWhere('id', 1)
    ]);
});
