<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;
$capsule->addConnection([
    "driver" => "mysql",
    "host" => "127.0.0.1",
    "database" => "vp2",
    "username" => "root",
    "password" => ""
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();