<?php

namespace VP2;

echo $_GET['ulr'];

ini_set('include_path',
    ini_get('include_path') . PATH_SEPARATOR .
    '../App'. PATH_SEPARATOR .
    '../Base'. PATH_SEPARATOR .
    '..'
);


// echo '<pre>' . print_r($_SERVER, 1);
// var_dump(getcwd());
// var_dump(ini_get('include_path'));

require '../Base/init.php';
$app = new Base_Application($appConfig);
$app->run();

