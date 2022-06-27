<?php

use App\Models\Customer;
use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\Route;

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
    $repository = new OrderRepository();

    $order1 = $repository->save([
        1 => 5,
        2 => 12,
    ], Customer::first());

    $order2 = $repository->save([
        2 => 105,
    ], Customer::first());

    return $order1->total / 100 . '<br>' . $order2->total / 100;
});
