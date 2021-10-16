<?php

namespace Database\Factories;

use App\FakerProviders\ProductProvider;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker->addProvider(new ProductProvider($this->faker));

        return [
            'name' => $this->faker->productName(),
            'sku' => $this->faker->productCode(),
            'price' => $this->faker->productPrice(),
        ];
    }
}
