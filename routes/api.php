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

Route::get('products/recommended/{forecast}', [ProductController::class, 'show'])->where("forecast", "clear|isolated-clouds|scattered-clouds|overcast|light-rain|moderate-rain|heavy-rain|sleet|light-snow|moderate-snow|heavy-snow|fog|na");
Route::get('products/recommended/{city}', [ProductController::class, 'index']);
