<?php

namespace Sportic\Omniresult\Trackmyrace;

/**
 * Class Helper
 * @package Sportic\Omniresult\Trackmyrace
 */
class Helper extends \Sportic\Omniresult\Common\Helper
{

    /**
     * @return array
     */
    public static function getLanguages()
    {
        return ['de', 'fr', 'it', 'en', 'ro'];
    }

    /**
     * @return array
     */
    public static function getRegions()
    {
        return ['europe', 'germany', 'france', 'romania'];
    }
}
