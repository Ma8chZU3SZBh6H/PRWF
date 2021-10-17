<?php

use App\FakerProviders\Product;
use App\Models\User;
use Faker\Provider\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\FakerProviders\ProductProvider;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Route::get('products', [ProductController::class, 'index']);
Route::get('products/recommended/{city}', [ProductController::class, 'index']);

Route::get('test', function () {
    $faker = \Faker\Factory::create();
    $faker->addProvider(new ProductProvider($faker));
    dd($faker->productPrice());
    return "wow";
});
