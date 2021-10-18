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
        "clear isolated-clouds scattered-clouds" => ["light%Shirt", "Small%Shirt", "Original%Shirt", "Small%Shirt", "light%Skirt", "Small%Skirt", "Original%Skirt", "Small%Skirt"],
        "overcast light-rain moderate-rain heavy-rain" => ["Umbrella", "Hat"],
        "sleet light-snow moderate-snow heavy-snow" => ["Heavy%Hat", "Heavy%Gloves", "Heavy%Coat", "Heavy%Coat"],
        "fog" => ["Suspicious%Underwear"],
        "na" => ["%"]
    ];

    static private function select_proper_items($weather)
    {
        $stuff = null;
        foreach (static::$stuff as $key => $value) {
            if (str_contains($key, $weather)) {
                $stuff = $value;
            }
        }
        return $stuff;
    }

    static public function select_by_weather($weather)
    {
        $stuff = static::select_proper_items($weather);

        $q = static::where("name", "like", "%{$stuff[0]}%");
        if (isset($stuff[1])) {
            for ($i = 1; $i < 2; $i++) {
                $q->orWhere("name", "like", "%{$stuff[$i]}%");
            }
        }
        return $q->get()->random(2);
    }
}
