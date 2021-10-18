<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseCodes;
use App\Helpers\WeatherAPI;
use App\Models\Product;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Throwable;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     * @param  string  $city
     * @return \Illuminate\Http\Response
     */
    public function index($city)
    {
        try {
            if (strlen($city) > 255) {
                return ResponseCodes::r400();
            }

            if (Cache::has($city)) {
                return response()->json(Cache::get($city));
            } else {
                $weather = WeatherAPI::get($city);
                for ($i = 0; $i < count($weather); $i++) {
                    $forcast = $weather[$i]["weather_forecast"];
                    $weather[$i]["products"] = Product::select_by_weather($forcast);
                }
                $response = [
                    "city" => $city,
                    "recommendations" => $weather
                ];
                Cache::add($city, $response, 5 * 60);
                return response()->json($response);
            }
        } catch (\Throwable $th) {
            if ($th->getCode() == 404) {
                return ResponseCodes::r404();
            } else {
                error_log($th);
                return ResponseCodes::r500();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string $forcast
     * @return \Illuminate\Http\Response
     */
    public function show($forecast)
    {
        try {
            if (strlen($forecast) > 255) {
                return ResponseCodes::r400();
            }
            if (Cache::has($forecast)) {
                return response()->json(Cache::get($forecast)->original);
            } else {
                $products = response()->json(Product::select_by_weather($forecast));
                Cache::add($forecast, $products, 5 * 60);
                return $products;
            }
        } catch (\Throwable $th) {
            error_log($th);
            return ResponseCodes::r500();
        }
    }
}
