<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Manufacture;
use App\Product;
use App\User;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    // return [
    //         'product_name' => $faker->word,
    //         'product_short_description' => $faker->paragraph,
    //         'product_long_description' => $faker->paragraph,
    //         'product_price' => $faker->numberBetween(1000, 20000),
    //         'product_size' => $faker->paragraph,
    //         'product_color' => $faker->paragraph,
    //         'publication_status' => $faker->numberBetween(0, 1),
            // 'user_id' => function() {
            //     return User::all()->random();
            // },
//             'category_id' => function() {
//                 return Category::all()->random();
//             },
//             'manufacture_id' => function() {
//                 return Manufacture::all()->random();
//         },
//     ];
});

