<?php

namespace Sportic\Omniresult\Trackmyrace;

use Sportic\Omniresult\Common\RequestDetector\HasDetectorTrait;
use Sportic\Omniresult\Common\TimingClient;

/**
 * Class RaceTecClient
 * @package Sportic\Omniresult\Trackmyrace
 */
class RaceTecClient extends TimingClient
{
    use HasDetectorTrait;
}
