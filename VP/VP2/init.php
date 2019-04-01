<?php

require_once './../../../vendor/autoload.php';
include 'config.php';

spl_autoload_register('_autoload', true, false);
function _autoload($className)
{
    $parts = explode('_', $className);
    $file = implode(DIRECTORY_SEPARATOR, $parts) . '.php';
    include $_SERVER['DOCUMENT_ROOT'] . '\\' . $file;
}