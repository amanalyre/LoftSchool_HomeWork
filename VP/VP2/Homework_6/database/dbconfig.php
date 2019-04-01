<?php

require_once ROOT_DIR . './vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsules;

$capsule = new Capsules;
$capsule->addConnection([
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'database' => 'goods',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();


class Item extends Illuminate\Database\Eloquent\Model
{
    public $table = "items";
    protected $primaryKey = 'id_PK';
    public $timestamps = false;
}


class Type extends Illuminate\Database\Eloquent\Model
{
    public $table = "types";
    protected $primaryKey = 'id_PK';
    public $timestamps = false;
}