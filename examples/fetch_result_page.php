<?php

require '../vendor/autoload.php';

$parameters = [
    'uid' => '16648-172-1-63070',
];

$client = new \Sportic\Omniresult\Trackmyrace\TrackmyraceClient();
$resultsParser = $client->result($parameters);
$resultsData   = $resultsParser->getContent();
var_dump($resultsData);
