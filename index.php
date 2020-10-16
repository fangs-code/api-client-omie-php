<?php

use Fangs\ApiClients\Omie\Models\Entities\CidadeEntityOmieModel;
use GuzzleHttp\Client;

// Composer autoloading
include __DIR__ . '/vendor/autoload.php';


$guzzle = new Client();

$cidade = new CidadeEntityOmieModel();

echo "<pre>";
var_dump($cidade);
var_dump($guzzle);
echo "</pre>";
die;
