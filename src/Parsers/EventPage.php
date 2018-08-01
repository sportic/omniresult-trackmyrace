<?php

namespace Sportic\Omniresult\Trackmyrace\Parsers;

use DOMElement;
use Sportic\Omniresult\Common\Content\ListContent;
use Sportic\Omniresult\Common\Models\Race;
use Sportic\Omniresult\Common\Models\Result;

/**
 * Class EventPage
 * @package Sportic\Omniresult\Trackmyrace\Parsers
 */
class EventPage extends AbstractParser
{
    protected $returnContent = [];

    /**
     * @return array
     */
    protected function generateContent()
    {
        $this->returnContent['records'] = $this->parseRaces();
        return $this->returnContent;
    }

    /**
     * @return array
     */
    protected function parseRaces()
    {
        $return = [];
        $eventMenu = $this->getCrawler()->filter('table.courses');
        if ($eventMenu->count() > 0) {
            $raceLinks = $eventMenu->filter('td > a.tip');
            foreach ($raceLinks as $link) {
                $parameters = [
                    'name' => $link->nodeValue,
                    'href' => $link->getAttribute('href')
                ];
                $parameters['id'] = $this->parseRaceIdFromHref($parameters['href']);
                $return[] = new Race($parameters);
            }
        }

        return $return;
    }

    /**
     * @param string $href
     * @return string
     */
    protected function parseRaceIdFromHref($href)
    {
        $pos = strpos($href, '/results/');
        if ($pos > 0) {
            $raceId = substr($href, $pos + 9);
            $raceId = str_replace('/', '', $raceId);
            return $raceId;
        }
        return '';
    }

    /** @noinspection PhpMissingParentCallCommonInspection
     * @inheritdoc
     */
    protected function getContentClassName()
    {
        return ListContent::class;
    }

    /** @noinspection PhpMissingParentCallCommonInspection
     * @inheritdoc
     */
    public function getModelClassName()
    {
        return Race::class;
    }
}
