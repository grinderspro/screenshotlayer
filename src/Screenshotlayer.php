<?php

namespace Grinderspro\Screenshotlayer;

/**
 * Screenshotlayer
 *
 * Класс-обертка для сервиса скриншотов Screenshotlayer.com
 *
 * @author Grigoriy Miroschnichenko <grinderspro@gmail.com>
 * @link http://grinderspro.ru
 */

use Grinderspro\Screenshotlayer\Helper\OptionsHelper;
use Grinderspro\DirectoryManipulator\DirectoryManipulator;

class Screenshotlayer
{
    const SERVICE_URL = 'https://api.screenshotlayer.com/api/capture';

    private $url;
    private $api_key;
    private $secret_key;
    private $options = array();

    public function __construct($api_key, $secret_key = '')
    {
        $this->api_key = $this->sanitizeValue($api_key);
        $this->secret_key = $this->sanitizeValue($secret_key);
    }

    /**
     * @param array $options
     * @example (new Screenshotlayer())->options(['viewport' => '1440x900'], 'format' => 'JPG')
     * @return $this
     */
    public function options(array $options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @param string $url
     * @return $this
     */
    public function url($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @param string $pathToImg полный путь сохраняемого скриншота
     * @return $this|void
     */
    public function save($pathToImg)
    {
        if (!$this->createDirectory(dirname($pathToImg)))
            return;

        $screen = file_get_contents($this->getFullUrl());
        file_put_contents($pathToImg, $screen);

        return $this;
    }

    /**
     * Возвращает полный-финальный Url
     * @return string
     */
    public function stringUrl()
    {
        return $this->getFullUrl();
    }

    private function sanitizeValue($value)
    {
        // TODO: дописать реализацию
        return trim($value);
    }

    private function getFullUrl()
    {
        $optionsString = $this->options ? OptionsHelper::arrayToString($this->options) : '';
        return self::SERVICE_URL . '?access_key=' . $this->api_key . '&url=' . $this->url . $optionsString;
    }

    private function createDirectory($path)
    {
        (new DirectoryManipulator())->location($path)->create();
        return file_exists($path) ? true : false;
    }

}