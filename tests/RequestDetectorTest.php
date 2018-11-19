<?php

namespace Sportic\Omniresult\Trackmyrace\Tests;

use Sportic\Omniresult\Trackmyrace\RequestDetector;

/**
 * Class RequestDetectorTest
 * @package Sportic\Omniresult\Trackmyrace\Tests
 */
class RequestDetectorTest extends AbstractTest
{
    /**
     * @param $url
     * @param $valid
     * @param $action
     * @param $params
     * @dataProvider detectProvider
     */
    public function testDetect($url, $valid, $action, $params)
    {
        $result = RequestDetector::detect($url);

        self::assertSame($valid, $result->isValid());
        self::assertSame($action, $result->getAction());
        self::assertSame($params, $result->getParams());
    }

    /**
     * @return array
     */
    public function detectProvider()
    {
        return [
            [
                'https://www.trackmyrace.com/running/event-zone/event/mtb-maraton-miercurea-ciuc/results/-293d130cc4/',
                true,
                'results',
                ['eventSlug' => 'mtb-maraton-miercurea-ciuc', 'raceSlug' => '-293d130cc4']
            ],
            [
            'https://www.trackmyrace.com/en/running/event-zone/event/mtb-maraton-miercurea-ciuc/results/-293d130cc4/',
                true,
                'results',
                ['eventSlug' => 'mtb-maraton-miercurea-ciuc', 'raceSlug' => '-293d130cc4']
            ],
            [
            'https://www.trackmyrace.com/en/romania/running/event-zone/event/mtb-maraton-miercurea-ciuc/results/-293d130cc4/',
                true,
                'results',
                ['eventSlug' => 'mtb-maraton-miercurea-ciuc', 'raceSlug' => '-293d130cc4']
            ],
            [
            'https://www.trackmyrace.com/en/romania/running/event-zone/event/maximum-table/sportguru-timisoara-21k/results/-2374d438ea/expanded/',
                true,
                'results',
                ['eventSlug' => 'sportguru-timisoara-21k', 'raceSlug' => '-2374d438ea']
            ]
        ];
    }
}
