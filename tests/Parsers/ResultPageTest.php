<?php

namespace Sportic\Omniresult\RaceTec\Tests\Parsers;

use Sportic\Omniresult\Common\Content\ItemContent;
use Sportic\Omniresult\Common\Models\Result;
use Sportic\Omniresult\Common\Models\Split;
use Sportic\Omniresult\RaceTec\Scrapers\ResultPage as PageScraper;
use Sportic\Omniresult\RaceTec\Parsers\ResultPage as PageParser;

/**
 * Class ResultPageTest
 * @package Sportic\Omniresult\RaceTec\Tests\Scrapers
 */
class ResultPageTest extends AbstractPageTest
{
    public function testGenerateResultsBox()
    {
        $record = self::$parametersParsed->getRecord();

        self::assertInstanceOf(Result::class, $record);
        self::assertSame('Marius-Alexandru Dragu', $record->getFullName());

        self::assertSame('02:12:11.38', $record->getTime());

        self::assertSame('10', $record->getPosGen());
        self::assertSame('10', $record->getPosGender());
        self::assertSame('1', $record->getPosCategory());

        $participants = $record->getParameter('participants');
        self::assertSame('211', $participants['race']);
        self::assertSame('194', $participants['gender']);
        self::assertSame('28', $participants['category']);

        self::assertSame('188', $record->getBib());
        self::assertSame('male', $record->getgender());
        self::assertSame('Masculin 45-49', $record->getCategory());
        self::assertSame('Finished', $record->getStatus());
    }

    public function testSplits()
    {
        $record = self::$parametersParsed->getRecord();
        /** @var Split[] $splits */
        $splits = $record->getSplits();
        self::assertEquals(12, count($splits));

        self::assertInstanceOf(Split::class, $splits[0]);
        self::assertSame('Swim', $splits[0]->getName());
        self::assertSame('00:17:21.53', $splits[0]->getTime());

        self::assertInstanceOf(Split::class, $splits[8]);
        self::assertSame('Ciclism 7', $splits[8]->getName());
        self::assertSame('01:17:11.19', $splits[8]->getTimeFromStart());
        self::assertSame('00:08:50.52', $splits[8]->getTime());
    }

    /**
     * @inheritdoc
     */
    protected static function getNewScraper()
    {
        $parameters = ['uid' => '16648-2091-1-29925'];
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
        return 'result_page.serialized';
    }

    /**
     * @inheritdoc
     */
    protected static function getHtmlFile()
    {
        return 'result_page.html';
    }
}
