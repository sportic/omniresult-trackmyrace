<?php

namespace Sportic\Omniresult\Trackmyrace;

use Sportic\Omniresult\Common\RequestDetector\AbstractRequestDetector;

/**
 * Class RequestDetector
 * @package Sportic\Omniresult\Trackmyrace
 */
class RequestDetector extends AbstractRequestDetector
{
    protected $pathParts = null;

    /**
     * @inheritdoc
     */
    protected function isValidRequest()
    {
        if (in_array(
            $this->getUrlComponent('host'),
            ['www.trackmyrace.com', 'trackmyrace.com']
        )) {
            return true;
        }
        return parent::isValidRequest();
    }

    /**
     * @return string
     */
    protected function detectAction()
    {
        $pathParts = $this->getPathParts();

        if ($pathParts[1] != 'event-zone') {
            return '';
        }
        if ($pathParts[4] == 'results') {
            return 'results';
        }
        return 'event';
    }

    /**
     * @inheritdoc
     */
    protected function detectParams()
    {
        $pathParts = $this->getPathParts();

        $return = [];
        $return['eventSlug'] = $pathParts[3];
        $return['raceSlug'] = $pathParts[5];

        return $return;
    }

    /**
     * @return array
     */
    public function getPathParts(): array
    {
        if ($this->pathParts === null) {
            $this->detectUrlPathParts();
        }
        return $this->pathParts;
    }

    protected function detectUrlPathParts()
    {
        $path = strtolower($this->getUrlComponent('path'));
        $replacements = array_merge(
            array_map(function ($a) {
                return '/' . $a . '/';
            }, Helper::getLanguages()),
            array_map(function ($a) {
                return '/' . $a . '/';
            }, Helper::getRegions()),
            ['/maximum-table/', '/expanded/']
        );
        $path = trim(str_replace($replacements, '/', $path), '/');
        $this->pathParts = explode('/', $path);
    }
}
