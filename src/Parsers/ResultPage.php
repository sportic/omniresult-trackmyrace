<?php

namespace Sportic\Omniresult\Trackmyrace\Parsers;

use DOMElement;
use Sportic\Omniresult\Common\Content\RecordContent;
use Sportic\Omniresult\Common\Models\Result;
use Sportic\Omniresult\Common\Models\Split;
use Sportic\Omniresult\Common\Models\SplitCollection;

/**
 * Class ResultPage
 * @package Sportic\Omniresult\Trackmyrace\Parsers
 */
class ResultPage extends AbstractParser
{
    protected $returnContent = [];

    /**
     * @inheritdoc
     */
    protected function generateContent()
    {
        $this->parseContent();
        $params = ['record' => new Result($this->returnContent)];
        return $params;
    }

    protected function parseContent()
    {
        $itemBoxes = $this->getCrawler()->filter('.item');

        foreach ($itemBoxes as $itemBox) {
            $this->parseItemBox($itemBox);
        }
    }

    /**
     * @param DOMElement $itemBox
     */
    protected function parseItemBox(DOMElement $itemBox)
    {
        $rows = $itemBox->getElementsByTagName('div');
        $title = trim(str_replace([':'], '', $rows->item(0)->textContent));
        $value = trim($rows->item(1)->textContent);

        $field = $this->parseItemBoxTitle($title);

        if ($field) {
            $this->returnContent[$field] = $value;
        }

    }

    /**
     * @param $title
     * @return false|int|string
     */
    protected function parseItemBoxTitle($title)
    {
        $search = array_search($title, self::getLabelMaps());

        return $search;
    }

    /**
     * @return array
     */
    protected static function getLabelMaps()
    {
        return [
//            'name' => 'Event',
            'fullName' => 'Name',
            'bib' => 'Number',
            'country' => 'Nationality',
            'time' => 'Time',
            'posGen' => 'Place',
            'category' => 'Age group',
            'posCategory' => 'Place in age group'
        ];
    }


    /** @noinspection PhpMissingParentCallCommonInspection
     * @inheritdoc
     */
    protected function getContentClassName()
    {
        return RecordContent::class;
    }

    /**
     * @inheritdoc
     */
    public function getModelClassName()
    {
        return Result::class;
    }
}
