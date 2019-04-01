<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

require_once 'dbconfig.php';

// Создаем таблицу Items
Capsule::schema()->dropIfExists('items');

Capsule::schema()->create('items', function (Blueprint $table) {
    $table->increments('id_PK');
    $table->string('name'); //varchar 255
    $table->integer('price')->unsigned();
    $table->string('description')->nullable(true)->default(NULL);; //varchar 255
    $table->string('picture'); //varchar 255
    $table->unsignedInteger('types_ID_FK');
});

// Создаем таблицу Categories
Capsule::schema()->dropIfExists('categories');

Capsule::schema()->create('categories', function (Blueprint $table) {
    $table->increments('id_PK');
    $table->string('categories'); //varchar 255
});

// Связать Items и Categories
$query = "ALTER TABLE `goods`.`items`
ADD CONSTRAINT `types_ID_FK` FOREIGN KEY (`types_ID_FK`) REFERENCES `goods`.`categories` (`id_PK`);";
Capsule::connection()->statement($query);