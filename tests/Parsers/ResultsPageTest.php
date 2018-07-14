<?php

namespace Sportic\Omniresult\Trackmyrace\Tests\Parsers;

use Sportic\Omniresult\Common\Models\Result;
use Sportic\Omniresult\Trackmyrace\Scrapers\ResultsPage as PageScraper;
use Sportic\Omniresult\Trackmyrace\Parsers\ResultsPage as PageParser;

/**
 * Class EventPageTest
 * @package Sportic\Omniresult\Trackmyrace\Tests\Scrapers
 */
class ResultsPageTest extends AbstractPageTest
{

//    public function testGenerateContentResultHeader()
//    {
//        self::assertCount(8, self::$parametersParsed['results']['header']);
//    }

    public function testGenerateContentResultList()
    {
        self::assertCount(20, self::$parametersParsed['records']);
        self::assertInstanceOf(Result::class, self::$parametersParsed['records'][5]);
        self::assertEquals(
            [
                'posGen' => '26',
                'bib' => '1363',
                'fullName' => 'Daniel Tabirca',
                'href' => null,
                'time' => '04:12:31.8',
                'category' => 'M40-49',
                'posCategory' => '8',
                'gender' => 'male',
                'posGender' => '24',
                'id' => '1363',
                'parameters' => null,
                'splits' => [],
                'status' => null,
                'country' => 'Romania'
            ],
            self::$parametersParsed['records'][5]->__toArray()
        );
    }

    /** @noinspection PhpMethodNamingConventionInspection */
    public function testGenerateContentResultPagination()
    {
        self::assertEquals(
            [
                'current' => 2,
                'all' => 8,
                'items' => 151,
            ],
            self::$parametersParsed['pagination']
        );
    }

    public function testGenerateContentAll()
    {
        self::assertEquals(self::$parameters, self::$parametersParsed->all());
    }

    /**
     * @inheritdoc
     */
    protected static function getNewScraper()
    {
        return new PageScraper();
    }

    /**
     * @inheritdoc
     */
    protected static function getNewParser()
    {
        return new PageParser();
    }

    /**
     * @inheritdoc
     */
    protected static function getSerializedFile()
    {
        return 'ResultsPage/event_page.serialized';
    }

    /**
     * @inheritdoc
     */
    protected static function getHtmlFile()
    {
        return 'ResultsPage/event_page.html';
    }
}
