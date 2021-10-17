<?php

namespace App\Helpers;

use Carbon\Carbon;
use GuzzleHttp\Client;

class WeatherAPI
{
    static public function get($city)
    {
        $weather = static::get_weather($city);
        $weather = static::select_by_days($weather);
        $weather = array_slice($weather, 0, 3);
        $weather = static::filter($weather);
        return $weather;
    }

    static public function get_weather($city)
    {
        $httpClient = new Client();
        $response = $httpClient->get("https://api.meteo.lt/v1/places/{$city}/forecasts/long-term");
        $weather = json_decode($response->getBody()->getContents());
        $weather = $weather->forecastTimestamps;
        return $weather;
    }

    static public function select_by_days($weather)
    {
        $weather_by_days = [];
        $day = 0;
        for ($i = 0; $i < count($weather); $i++) {
            $hour = $weather[$i]->forecastTimeUtc;
            $date = new Carbon($hour);
            if ($date->day != $day) {
                array_push($weather_by_days, $weather[$i]);
            }
            $day = $date->day;
        }
        return $weather_by_days;
    }

    static public function filter($weather)
    {
        return array_map(function ($day) {
            return [
                "weather_forecast" => $day->conditionCode,
                "date" => $day->forecastTimeUtc
            ];
        }, $weather);
    }
}
