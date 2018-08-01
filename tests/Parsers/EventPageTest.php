<?php

namespace Sportic\Omniresult\Trackmyrace\Tests\Parsers;

use Sportic\Omniresult\Common\Models\Race;
use Sportic\Omniresult\Trackmyrace\Scrapers\EventPage as PageScraper;
use Sportic\Omniresult\Trackmyrace\Parsers\EventPage as PageParser;

/**
 * Class EventPageTest
 * @package Sportic\Omniresult\Trackmyrace\Tests\Scrapers
 */
class EventPageTest extends AbstractPageTest
{
    public function testGenerateContentRaces()
    {
        $parametersParsed = static::initParserFromFixtures(
            new PageParser(),
            (new PageScraper()),
            'EventPage\event_page'
        );

        $records = $parametersParsed['records'];

        self::assertCount(3, $records);

        $firstRace = reset($records);
        self::assertInstanceOf(Race::class, $firstRace);
        self::assertSame([
            'id' => '-bf626f0882',
            'name' => 'Cozia',
            'href' => 'en/running/event-zone/event/cozia-mountain-run-6/results/-bf626f0882/',
            'parameters' => null
        ], $firstRace->__toArray());
    }
}
