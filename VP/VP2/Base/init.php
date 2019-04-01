<?php

namespace VP2;


include 'config.php';

spl_autoload_register('VP2\_autoload', true, false);
function _autoload($className)
{
    $parts = explode('_', $className);
    $file = implode(DIRECTORY_SEPARATOR, $parts) . '.php';
    include $file;
}