<?php

namespace app\web;


/**
 * Class Config - Application configuration wrapper class
 *
 * @package app\web
 */
class Config
{
    /**
     * Initial configuration array
     * from `/config/config.php'
     *
     * @var array
     */
    protected $config = [];
    /**
     * Instantiates configuration component.
     *
     * @param string $configFile Configuration filename.
     *
     * @throws \BadMethodCallException If no config file passed.
     * @throws \InvalidArgumentException If config file cannot be read.
     */
    public function __construct($configFile)
    {
        if (empty($configFile)) {
            throw new \BadMethodCallException('Configuration file name is empty.');
        }
        if (!file_exists($configFile)
            || !is_readable($configFile)
        ) {
            throw new \InvalidArgumentException('Config file does not exist or cannot be read.');
        }
        $this->config = require_once $configFile;
    }
    /**
     * Returns configuration item.
     *
     * @param string $path Config item path.
     *
     * @return mixed
     */
    public function get($path)
    {
        return array_key_exists($path, $this->config)
            ? $this->config[$path]
            : null;
    }
}