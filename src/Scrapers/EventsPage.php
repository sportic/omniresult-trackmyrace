<?php

namespace Sportic\Omniresult\Trackmyrace\Scrapers;

use Sportic\Omniresult\Trackmyrace\Parsers\EventsPage as Parser;

/**
 * Class CompanyPage
 * @package Sportic\Omniresult\Trackmyrace\Scrapers
 *
 * @method Parser execute()
 */
class EventsPage extends AbstractScraper
{
    /**
     * @inheritdoc
     */
    protected function generateCrawler()
    {
        $client = $this->getClient();
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
        $country = $this->getCountry();
        $page = $this->getPage() - 1;

        return $this->getCrawlerUriHost() . '/en'
            . ($country ? '/' . $country : '')
            . '/event-zone/ajax/event/list/expanded/coming/page'
            . '/' . $page
            . '/?';
    }

    /**
     * @throws \Sportic\Omniresult\Common\Exception\InvalidRequestException
     */
    protected function doCallValidation()
    {
        $this->validate('cId');
    }

    /**
     * @return string
     */
    protected function getCountry()
    {
        return $this->getParameter('country', false);
    }

    /**
     * @return mixed
     */
    protected function getPage()
    {
        return $this->getParameter('page', 1);
    }
}
