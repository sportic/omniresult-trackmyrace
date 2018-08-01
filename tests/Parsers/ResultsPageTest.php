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
                'country' => 'Romania'
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
                'current' => 2,
                'all' => 8,
                'items' => 151,
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
        self::assertEquals(
            [
                'posGen' => '39',
                'bib' => '108',
                'fullName' => '#vanatoriidehiene',
                'href' => null,
                'time' => '1:53:39.6',
                'category' => null,
                'posCategory' => '39',
                'gender' => null,
                'posGender' => null,
                'id' => 'semimaraton-gerar-2/individual/-e713f42c94/108/',
                'parameters' => null,
                'splits' => [
                    [
                        'name' => 'round1',
                        'time' => '0:17:05.8',
                        'timeFromStart' => null,
                        'parameters' => null
                    ],
                    [
                        'name' => 'round2',
                        'time' => '0:18:23.2',
                        'timeFromStart' => null,
                        'parameters' => null
                    ],
                    [
                        'name' => 'round3',
                        'time' => '0:19:06.3',
                        'timeFromStart' => null,
                        'parameters' => null
                    ],
                    [
                        'name' => 'round4',
                        'time' => '0:20:08.3',
                        'timeFromStart' => null,
                        'parameters' => null
                    ],
                    [
                        'name' => 'round5',
                        'time' => '0:19:35.2',
                        'timeFromStart' => null,
                        'parameters' => null
                    ],
                    [
                        'name' => 'round6',
                        'time' => '0:19:20.8',
                        'timeFromStart' => null,
                        'parameters' => null
                    ],
                ],
                'status' => null,
                'country' => 'Romania'
            ],
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
