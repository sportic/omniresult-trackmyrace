<?php

namespace Sportic\Omniresult\Trackmyrace\Scrapers;

use Sportic\Omniresult\Trackmyrace\Parsers\ResultPage as Parser;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class CompanyPage
 * @package Sportic\Omniresult\Trackmyrace\Scrapers
 *
 * @method Parser execute()
 */
class ResultPage extends AbstractScraper
{
    /**
     * @throws \Sportic\Omniresult\Common\Exception\InvalidRequestException
     */
    protected function doCallValidation()
    {
        $this->validate('uid');
    }

    /**
     * @return mixed
     */
    public function getUid()
    {
        return $this->getParameter('uid');
    }

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

    /** @noinspection PhpMissingParentCallCommonInspection
     * @inheritdoc
     */
    public function getCrawlerUri()
    {
        return $this->getCrawlerUriHost()
            . '/en/event-zone/ajax/event/'
            . $this->getUid();
    }
}
