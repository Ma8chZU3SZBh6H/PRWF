<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sku',
        'price'
    ];

    private static $stuff = [
        "clear" => ["Shirt", "Skirt", "light", "Underwear"],
        "isolated-clouds" => ["Shirt", "Skirt", "light"],
        "scattered-clouds" => ["Shirt", "Skirt", "light"],
        "overcast" => ["Shirt", "Skirt", "light"],
        "light-rain" => ["Umbrella", "Hat"],
        "moderate-rain" => ["Umbrella", "Hat"],
        "heavy-rain" => ["Umbrella", "Hat"],
        "sleet" => ["warm", "Gloves"],
        "light-snow " => ["warm", "Coat", "Gloves"],
        "moderate-snow" => ["warm", "Coat", "Gloves"],
        "heavy-snow" => ["Heavy", "Coat", "Gloves"],
        "fog" => ["light"],
        "na" => [""],
    ];

    static public function select_by_weather($weather)
    {
        $props = static::$stuff[$weather];
        $q = static::where("name", "like", "%{$props[0]}%");
        for ($i = 1; $i < 2; $i++) {
            $q->orWhere("name", "like", "%{$props[$i]}%");
        }
        return $q->get()->random(2);
    }
}
