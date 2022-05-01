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
        $parametersParsed = static::initParserFromFixtures(
            new PageParser(),
            (new PageScraper()),
            'ResultsPage/event_page'
        );

        /** @var array|Result[] $results */
        $results = $parametersParsed['records'];

        self::assertCount(20, $results);
        self::assertInstanceOf(Result::class, $results[5]);
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
                'id' => 'cozia-mountain-run-6/individual/-bf626f0882/1363/',
                'parameters' => null,
                'splits' => [],
                'status' => null,
                'country' => 'Romania',
                'club' => null,
                'firstName' => 'Daniel',
                'lastName' => 'Tabirca',
                'timeGross' => null,
                'notes' => null
            ],
            $results[5]->__toArray()
        );
    }

    /** @noinspection PhpMethodNamingConventionInspection */
    public function testGenerateContentResultPagination()
    {
        $parametersParsed = static::initParserFromFixtures(
            new PageParser(),
            (new PageScraper()),
            'ResultsPage/event_page'
        );

        self::assertEquals(
            [
                'current' => '2',
                'all' => 8,
                'items' => 151,
                'nextUrl' => ''
            ],
            $parametersParsed['pagination']
        );
    }

    public function testGenerateRounds()
    {
        $parametersParsed = static::initParserFromFixtures(
            new PageParser(),
            (new PageScraper()),
            'ResultsPage/event_rounds_page'
        );

        /** @var array|Result[] $results */
        $results = $parametersParsed['records'];

        self::assertCount(20, $results);
        self::assertInstanceOf(Result::class, $results[18]);

        $params = require TEST_FIXTURE_PATH . DS . 'Parsers' . DS . 'ResultsPage' . DS . 'event_page.php';
        self::assertEquals(
            $params,
            $results[18]->__toArray()
        );
    }

    public function testGenerateContentAll()
    {
        $parametersParsed = static::initParserFromFixtures(
            new PageParser(),
            (new PageScraper()),
            'ResultsPage/event_page'
        );
        $parametersSerialized = static::getParametersFixtures('ResultsPage/event_page');

        self::assertEquals($parametersSerialized, $parametersParsed->all());
    }
}
