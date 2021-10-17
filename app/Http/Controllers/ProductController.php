<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseCodes;
use App\Helpers\WeatherAPI;
use App\Models\Product;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Throwable;

class ProductController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($city)
    {
        try {
            $weather = WeatherAPI::get($city);
            for ($i = 0; $i < count($weather); $i++) {
                $forcast = $weather[$i]["weather_forecast"];
                $weather[$i]["products"] = Product::select_by_weather($forcast);
            }
            $response = [
                "city" => $city,
                "recommendations" => $weather
            ];

            return response()->json($response);
        } catch (\Throwable $th) {
            if ($th->getCode() == 404) {
                return ResponseCodes::r404();
            } else {
                return ResponseCodes::r404();
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
