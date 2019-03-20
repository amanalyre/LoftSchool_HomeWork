<?php

require_once ROOT_DIR . '/vendor/autoload.php';
require ROOT_DIR . '/bootstrap.php';

use Illuminate\Database\Capsule\Manager as DataBase;

// Миграции стоит запускать по отдельности, закомментировав вторую часть.

DataBase::schema()->create('users', function ($table) { // описание, фотографию (URL).
    $table->increments('id');
    $table->string('email')->unique()->nullable(false);
    $table->text('name')->nullable(true)->default(NULL);
    $table->text('description')->nullable(true)->default(NULL);
    $table->text('password');
    $table->integer('age')->nullable(false);
    $table->text('avatar')->nullable(true)->default(NULL);
    $table->timestamp('created_at')->default(DataBase::raw('CURRENT_TIMESTAMP'));
    $table->timestamp('updated_at')->default(DataBase::raw('CURRENT_TIMESTAMP'));
});

//DataBase::schema()->create('files', function ($table) {
//    $table->increments('id');
//    $table->text('name')->nullable(false);
//    $table->integer('user_id')->unsigned()->nullable(false);
//    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
//    $table->timestamp('created_at')->default(DataBase::raw('CURRENT_TIMESTAMP'));
//    $table->timestamp('updated_at')->default(DataBase::raw('CURRENT_TIMESTAMP'));
//});