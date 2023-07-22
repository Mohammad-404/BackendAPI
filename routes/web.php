<?php

use Illuminate\Support\Facades\Route;
use App\Models\Admin;

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

Route::get('/', function () {
    return "hi";
    // Admin::create([
    //     'phonenumber'       => '0795439152',
    //     'name'              => 'mohammad almasri',
    //     'email'             => 'm.almasri97.me@gmail.com',
    //     'password'          => bcrypt('12345'),
    // ]);
    // Customer::create([
    //     'phonenumber'       => '0785462597',
    //     'username'              => 'osama almasri',
    //     'email'             => 'osama.almasri97.me@gmail.com',
    //     'password'          => bcrypt('12345'),
    //     'address'          => 'Amman, Jordan',
    // ]);

    // Admin::create([
    //     'phonenumber'       => '0795439152',
    //     'name'              => 'mohammad almasri',
    //     'email'             => 'm.almasri97.me@gmail.com',
    //     'password'          => bcrypt('12345'),
    // ]);

});

