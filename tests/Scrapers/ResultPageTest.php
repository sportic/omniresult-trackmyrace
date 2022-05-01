<?php

namespace Sportic\Omniresult\Trackmyrace\Tests\Scrapers;

use PHPUnit\Framework\TestCase;
use Sportic\Omniresult\Trackmyrace\Scrapers\ResultPage;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class EventPageTest
 * @package Sportic\Omniresult\Trackmyrace\Tests\Scrapers
 */
class ResultPageTest extends TestCase
{
    public function testGetCrawlerUri()
    {
        $crawler = $this->getCrawler();

        static::assertInstanceOf(Crawler::class, $crawler);

        static::assertSame(
            'https://www.trackmyrace.com/en/event-zone/ajax/event/cozia-mountain-run-6/individual/-bf626f0882/1281/',
            $crawler->getUri()
        );
    }

    public function testGetCrawlerHtml()
    {
        $crawler = $this->getCrawler();

        static::assertInstanceOf(Crawler::class, $crawler);

        $html =  $crawler->html();
        static::assertStringContainsString('Cozia Mountain Run', $html);
        static::assertStringContainsString('Florin Dragos Caprita', $html);
//        file_put_contents(TEST_FIXTURE_PATH . '/Parsers/ResultPage/result_page.html', $crawler->html());
    }

    /**
     * @return Crawler
     */
    protected function getCrawler()
    {
        $params = ['uid' => 'cozia-mountain-run-6/individual/-bf626f0882/1281/'];
        $scraper = new ResultPage();
        $scraper->initialize($params);
        return $scraper->getCrawler();
    }
}
