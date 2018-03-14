<?php

namespace Grinderspro\Screenshotlayer\Helper;

/**
 * Class OptionsHelper
 *
 *  @package Grinderspro\Screenshotlayer\Helper
 */

class OptionsHelper
{
    public static function arrayToString(array $options)
    {
        $resultStr = '';

        foreach ($options as $option=>$value) {
            $resultStr .= '&'.$option.'='.$value;
        }

        return $resultStr;
    }
}