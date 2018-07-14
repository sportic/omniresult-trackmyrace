<?php

namespace Sportic\Omniresult\Trackmyrace\Tests\Parsers;

use Sportic\Omniresult\Common\Content\AbstractContent;
use Sportic\Omniresult\Trackmyrace\Scrapers\EventPage as EventPageScraper;
use Sportic\Omniresult\Trackmyrace\Parsers\EventPage as EventPageParser;

/**
 * Class EventPageTest
 * @package Sportic\Omniresult\Trackmyrace\Tests\Scrapers
 */
class GenericPageTest extends AbstractPageTest
{
    public function testGenerateContentRaces()
    {
        self::assertInstanceOf(AbstractContent::class, self::$parametersParsed);
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
