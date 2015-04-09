<?php

require_once 'config.php';
require_once __DIR__ . '/../vendor/autoload.php';

use TijsVerkoyen\VoipCenter;

$voipcenter = new VoipCenter();

try {
} catch (Exception $e) {
    var_dump($e);
}

// output
var_dump($response);
