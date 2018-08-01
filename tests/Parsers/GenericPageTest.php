<?php

namespace Sportic\Omniresult\Trackmyrace\Tests\Parsers;

use Sportic\Omniresult\Common\Content\AbstractContent;
use Sportic\Omniresult\Trackmyrace\Scrapers\EventPage as PageScraper;
use Sportic\Omniresult\Trackmyrace\Parsers\EventPage as PageParser;

/**
 * Class EventPageTest
 * @package Sportic\Omniresult\Trackmyrace\Tests\Scrapers
 */
class GenericPageTest extends AbstractPageTest
{
    public function testGenerateContentRaces()
    {
        $parametersParsed = static::initParserFromFixtures(
            new PageParser(),
            (new PageScraper()),
            'EventPage/event_page'
        );

        self::assertInstanceOf(AbstractContent::class, $parametersParsed);
    }
}
