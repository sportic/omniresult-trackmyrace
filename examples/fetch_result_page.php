<?php

require '../vendor/autoload.php';

$parameters = [
    'uid' => 'cozia-mountain-run-6/individual/-bf626f0882/1363/',
];

$client = new \Sportic\Omniresult\Trackmyrace\TrackmyraceClient();
$resultsParser = $client->result($parameters);
$resultsData   = $resultsParser->getContent();
var_dump($resultsData);
