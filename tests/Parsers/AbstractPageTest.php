<?php

namespace Sportic\Omniresult\RaceTec\Tests\Parsers;

use PHPUnit\Framework\TestCase;
use Sportic\Omniresult\Common\Content\GenericContent;
use Sportic\Omniresult\Common\Content\ListContent;
use Sportic\Omniresult\Common\Content\RecordContent;
use Sportic\Omniresult\RaceTec\Scrapers\AbstractScraper;
use Sportic\Omniresult\RaceTec\Parsers\EventPage as EventPageParser;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class AbstractPageTest
 * @package Sportic\Omniresult\RaceTec\Tests\Scrapers
 */
abstract class AbstractPageTest extends TestCase
{
    protected static $parameters;

    /**
     * @var EventPageParser
     */
    protected static $parser;

    /**
     * @var GenericContent|ListContent|RecordContent
     */
    protected static $parametersParsed;

    public static function setUpBeforeClass()
    {
        self::$parameters = unserialize(
            file_get_contents(TEST_FIXTURE_PATH . DS . 'Parsers' . DS . static::getSerializedFile())
        );

        $scrapper = static::getNewScraper();

        $crawler = new Crawler(null, $scrapper->getCrawlerUri());
        $crawler->addContent(
            file_get_contents(
                TEST_FIXTURE_PATH . DS . 'Parsers' . DS . static::getHtmlFile()
            ),
            'text/html;charset=utf-8'
        );

        self::$parser = static::getNewParser();
        self::$parser->setScraper($scrapper);
        self::$parser->setCrawler($crawler);

        self::$parametersParsed = self::$parser->getContent();

//        file_put_contents(
//            TEST_FIXTURE_PATH . DS . 'Parsers' . DS . static::getSerializedFile(),
//            serialize(self::$parser->getContent()->all())
//        );
    }

    /**
     * @return string
     */
    abstract protected static function getSerializedFile();

    /**
     * @return string
     */
    abstract protected static function getHtmlFile();

    /**
     * @return AbstractScraper
     */
    abstract protected static function getNewScraper();

    /**
     * @return AbstractScraper
     */
    abstract protected static function getNewParser();
}
