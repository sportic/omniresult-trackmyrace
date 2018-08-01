<?php

namespace Sportic\Omniresult\Trackmyrace\Tests\Scrapers;

use PHPUnit\Framework\TestCase;
use Sportic\Omniresult\Trackmyrace\Scrapers\EventPage as PageScraper;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class EventPageTest
 * @package Sportic\Omniresult\Trackmyrace\Tests\Scrapers
 */
class EventPageTest extends TestCase
{
    public function testGetCrawlerUri()
    {
        $crawler = $this->getCrawler();

        static::assertInstanceOf(Crawler::class, $crawler);

        static::assertSame(
            'https://www.trackmyrace.com/en/running/event-zone/event/cozia-mountain-run-6/',
            $crawler->getUri()
        );
    }

    public function testGetCrawlerHtml()
    {
        $crawler = $this->getCrawler();

        static::assertInstanceOf(Crawler::class, $crawler);

        $html =  $crawler->html();

        static::assertContains('Cozia Mountain Run', $html);
        static::assertContains('Cozia', $html);
        static::assertContains('Stanisoara', $html);

//        file_put_contents(TEST_FIXTURE_PATH . '/Parsers/EventPage/event_page.html', $crawler->html());
    }

    /**
     * @return Crawler
     */
    protected function getCrawler()
    {
        $params = ['eventSlug' => 'cozia-mountain-run-6'];
        $scraper = new PageScraper();
        $scraper->initialize($params);
        return $scraper->getCrawler();
    }
}
