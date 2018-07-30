<?php

namespace Sportic\Omniresult\Trackmyrace\Scrapers;

use Sportic\Omniresult\Trackmyrace\Parsers\EventPage as Parser;

/**
 * Class CompanyPage
 * @package Sportic\Omniresult\Trackmyrace\Scrapers
 *
 * @method Parser execute()
 */
class EventPage extends AbstractScraper
{
    /**
     * @return mixed
     */
    public function getEventSlug()
    {
        return $this->getParameter('eventSlug');
    }

    /**
     * @throws \Sportic\Omniresult\Common\Exception\InvalidRequestException
     */
    protected function doCallValidation()
    {
        $this->validate('eventSlug');
    }

    /**
     * @inheritdoc
     */
    protected function generateCrawler()
    {
        $client  = $this->getClient();
        $crawler = $client->request(
            'GET',
            $this->getCrawlerUri()
        );

        return $crawler;
    }

    /**
     * @return string
     */
    public function getCrawlerUri()
    {
        return $this->getCrawlerUriHost().'/en/running/event-zone/event'
               . '/' . $this->getEventSlug()
               . '/';
    }
}
