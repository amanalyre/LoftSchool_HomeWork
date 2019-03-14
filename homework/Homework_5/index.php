<?php

namespace Homework_5;

require_once 'ImageRotation.php';

$img = new Image();

$img->change();

header('Content-Type: image/jpg');
readfile(__DIR__ . '/resultImage.jpg');