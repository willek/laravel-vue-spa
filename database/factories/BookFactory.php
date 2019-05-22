<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Entities\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->realText,
        'year' => $faker->year('now')
    ];
});
