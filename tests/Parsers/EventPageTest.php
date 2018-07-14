<?php

namespace Sportic\Omniresult\RaceTec\Tests\Parsers;

use Sportic\Omniresult\Common\Models\Result;
use Sportic\Omniresult\Common\Models\SplitCollection;
use Sportic\Omniresult\RaceTec\Scrapers\EventPage as EventPageScraper;
use Sportic\Omniresult\RaceTec\Parsers\EventPage as EventPageParser;

/**
 * Class EventPageTest
 * @package Sportic\Omniresult\RaceTec\Tests\Scrapers
 */
class EventPageTest extends AbstractPageTest
{
    public function testGenerateContentRaces()
    {
        self::assertCount(5, self::$parametersParsed['records']);
    }

    /**
     * @inheritdoc
     */
    protected static function getNewScraper()
    {
        return new EventPageScraper('16648', '2091', '1');
    }

    /**
     * @inheritdoc
     */
    protected static function getNewParser()
    {
        return new EventPageParser();
    }

    /**
     * @inheritdoc
     */
    protected static function getSerializedFile()
    {
        return 'event_page.serialized';
    }

    /**
     * @inheritdoc
     */
    protected static function getHtmlFile()
    {
        return 'event_page.html';
    }
}
