<?php

require '../vendor/autoload.php';

$parameters = [
    'eventSlug' => 'cozia-mountain-run-6',
    'raceSlug' => '-bf626f0882',
    'page' => 7,
];

$client = new \Sportic\Omniresult\Trackmyrace\TrackmyraceClient();
$resultsParser = $client->results($parameters);
$resultsData   = $resultsParser->getContent();

var_dump($resultsData);
