<?php


namespace App\Core;

/**
 * Class Request for HTTP request handling.
 *
 * @package App\Core
 */

class Request
{
    /**
     * Contains GET request query params.
     *
     * @var array
     */
    protected $getParams = [];

    /**
     * Contains POST request query params.
     *
     * @var array
     */
    protected $postParams = [];

    public function __construct()
    {
        $this->getParams = $_GET;
        $this->postParams = $_POST;
    }

    /**
     * Tries to find GET query parameter by it's name and return it's value if found.
     * If no such parameter was found, `$default` value will be returned.
     *
     * @param string     $name    GET parameter name.
     * @param mixed|null $default Default value, if parameter was not found.
     *
     * @return mixed|null
     */
    public function getParam($name, $default = null)
    {
        return isset($this->getParams[$name])
            ? $this->getParams[$name]
            : $default;
    }
}