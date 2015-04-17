<?php

require_once 'config.php';
require_once __DIR__ . '/../vendor/autoload.php';

use TijsVerkoyen\VoipCenter\VoipCenter;

$voipCenter = new VoipCenter(
    ID,
    KEY,
    CLIENT_NUMBER,
    PASSWORD
);

try {
//    $response = $voipCenter->call('sumocoder1', '093950251');
//    $response = $voipCenter->getMenu('sipacc');
//    $response = $voipCenter->getMenu('did');
} catch (Exception $e) {
    var_dump($e);
}

// output
var_dump($response);
