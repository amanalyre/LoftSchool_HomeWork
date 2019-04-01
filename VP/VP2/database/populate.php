<?php

require 'consts.php';
require 'autoloader.php';
require 'bootstrap.php';

use models\User\Users;
use Faker\Factory as Faker;

$faker = Faker::create();
for($i = 0; $i < 50; $i++) {

    $user = new Users();
    $user->name = $faker->firstName . ' ' . $faker->lastName;
    $user->email = $faker->safeEmail;
    $user->password = $faker->password;
    $user->description = $faker->text;
    $user->age = $faker->biasedNumberBetween($min = 10, $max = 63);
    $user->avatar = $faker->imageUrl(200, 200, 'cats');
    $user->created_at = $faker->dateTime;
    $user->save();

}

echo "Добавил {$i} пользователей в базу";

