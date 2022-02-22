<?php

use Illuminate\Support\Str;

$factory->define('App\Models\Post', function (Faker\Generator $faker) {
    return [
        'subcategory_id' => $faker->randomElement($array = array(1, 2, 3, 4, 5)),
        'position_id' => 1,
        'user_id' => 1,
        'retracts' => $faker->word,
        'title' => $title = $faker->sentence,
        'titleadapter' => $title,
        'slug' => Str::slug($title, '-'),
        'subtitle' => $faker->text(100),
        'text' => $faker->text(1200),
        'image' => $faker->randomElement($array = array(
            '-foto:_20211005183218.jpg',
            '-foto:_20200816125615.jpg',
            '-foto:_20201223052634.jpg',
            '-foto:_20201230215542.jpg',
        )),
        'image_credit' => 'Divulgação',
        'image_subtitle' => $faker->sentence,
        'tags' => "$faker->word, $faker->word, $faker->word",
        'status' => 1,
        'date_start' => date('Y-m-d'),
        'will_restrict_users' => 0

    ];
});
