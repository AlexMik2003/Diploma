<?php

namespace app;
use app\helpers\Session;
use app\web\Config;
use app\web\Request;

/**
 * Class App  - Service Locator Class
 *
 * @package app
 */
class App
{
    /**
     * Contains current application instance.
     *
     * @var App
     */
    public static $i;

    /**
     * Request handling component.
     *
     * @var Request
     */
    public $request;

    /**
     * Contains curent database instance
     *
     * @var Database
     */
    public $db;

    /**
     * App configuration.
     *
     * @var Config
     */
    public $config;


    /**
     * Instantiated application.
     */
    public function __construct()
    {
        $this->init();
        self::$i = $this;
        Session::init();
    }

    /**
     * Inits generic components.
     *
     * @return void
     */
    protected function init()
    {
        foreach (static::coreComponents() as $prop => $component) {
            $this->{$prop} = $component;
        }
    }

    /**
     * Bootstraps a set of core components, required by application to operate normally.
     *
     * @return array
     */
    protected function coreComponents()
    {
        $configFile = ROOT_PATH . '/config/config.php';
        $config = new Config($configFile);
        extract($config->get('database'));
        $dsn = "mysql:host={$host};dbname={$dbname}";
        $db = new \PDO($dsn, $user, $password);
        return [
            'config' => $config,
            'db' => $db,
            'request' => new Request(),
        ];
    }

    /**
     * Actually, runs an application.
     *
     * @return void
     */
    public function run()
    {
        $this->request->handleRequest();
    }
}