<?php

namespace Sportic\Omniresult\Trackmyrace\Tests\Parsers;

use Sportic\Omniresult\Common\Models\Result;
use Sportic\Omniresult\Trackmyrace\Scrapers\ResultPage as PageScraper;
use Sportic\Omniresult\Trackmyrace\Parsers\ResultPage as PageParser;

/**
 * Class ResultPageTest
 * @package Sportic\Omniresult\Trackmyrace\Tests\Scrapers
 */
class ResultPageTest extends AbstractPageTest
{
    public function testGenerateResultsBox()
    {
        $parametersParsed = static::initParserFromFixtures(
            new PageParser(),
            (new PageScraper()),
            'ResultPage\result_page'
        );

        $record = $parametersParsed->getRecord();

        self::assertInstanceOf(Result::class, $record);
        self::assertSame('Florin Dragos Caprita', $record->getFullName());

        self::assertSame('04:02:24.0', $record->getTime());

        self::assertSame('21', $record->getPosGen());
        self::assertSame('5', $record->getPosCategory());

        self::assertSame('1281', $record->getBib());
        self::assertSame('M18-29', $record->getCategory());
    }

    /**
     * @inheritdoc
     */
    protected static function getNewScraper()
    {
        $parameters = ['id' => 'cozia-mountain-run-6/individual/-bf626f0882/1281/'];
        $scraper = new PageScraper();
        $scraper->initialize($parameters);
        return $scraper;
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
        return 'ResultPage/result_page.serialized';
    }

    /**
     * @inheritdoc
     */
    protected static function getHtmlFile()
    {
        return 'ResultPage/result_page.html';
    }
}
