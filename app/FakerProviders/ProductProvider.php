<?php

namespace App\FakerProviders;

use Faker\Provider\Base;

class ProductProvider extends Base
{
    protected static $productNames = [
        'adjective' => ['Small', 'Big', 'Black', 'Blue', 'Red', 'Original', 'Warm', 'Heavy', 'Light'],
        'material' => ['Plastic', 'Glass', 'Cotton', 'Wool', 'Leather', 'Silk', 'Iron'],
        'product' => ['Gloves', 'Hat', 'Umbrella', 'Coat', 'Shirt', 'Underwear', 'Coat', 'Jacket', 'Skirt']
    ];

    public function productName()
    {
        $adjective = static::randomElement(static::$productNames['adjective']);
        $material = static::randomElement(static::$productNames['material']);
        $product = static::randomElement(static::$productNames['product']);
        return "{$adjective} {$material} {$product}";
    }

    public function productCode()
    {
        $letterCode = strtoupper(static::randomLetter() . static::randomLetter() . static::randomLetter());
        $numberCode = static::randomNumber(2);
        return "{$letterCode}-{$numberCode}";
    }

    public function productPrice()
    {
        return rand(100, 3000) / 100;
    }
}
