<?php

require '../vendor/autoload.php';

$parameters = [
    'cId' => 16648
];

$client = new \Sportic\Omniresult\Trackmyrace\TrackmyraceClient();
$resultsParser = $client->events($parameters);
$resultsData = $resultsParser->getContent();

var_dump($resultsData);
