<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use App\Models\Tenant;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'tenant_id' => factory(Tenant::class),
        'name' => $faker->unique()->name,
        'description' => $faker->sentence,
        'image' => 'pizza.png',
        'price' => 12.9//(float)rand(10, 10000) / 100
    ];
});
