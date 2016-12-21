<?php


namespace app\core;

/**
 *  Class Router is responsible for resolution of all incoming HTTP requests.
 *
 * It tries to parse `route` GET query parameter and define which controller and which controller's method should be called.
 *
 * @package app\core
 */

class Router
{

    /**
     * app configuration.
     *
     * @var \app\core\Config
     */
    public $config;

     /**
     * Resolved request route.
     *
     * @var array
     */
    protected $route = [];

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->config = new Config();
    }

    /**
     * Resolved request route by parsing `route` GET query parameter.
     *
     * @return $this
     */
    public function resolve()
    {
        $defaults = [
            'controller' => $this->config->get('defaultController'),
            'action' => 'index'
        ];

        $url = explode('/', $_SERVER['REQUEST_URI']);
        $route_path = [];

        if(!empty($url[0]))
        {
            $route_path = [
                "controller" => $url[0],
                "action" => !empty($url[1]) ? $url[1] : null,
            ];
        }

        $this->route = $route_path + $defaults;

        $controller = ucfirst($this->route['controller']) . 'Controller';
        $controller = "\\app\\controllers\\{$controller}";
        $action = 'action' . ucfirst($this->route['action']);

        $this->route = [
            'controller' => $controller,
            'action' => $action,
        ];


        return $this->route;


    }

     /**
     * Resolved incoming HTTP request.
     *
     * @return void
     */
    public function handleRequest()
    {
        $controller = $this->resolve()["controller"];
        $action = $this->resolve()["action"];


        if (!class_exists($controller)
            || !method_exists($controller, $action)
        ) {
            header('Not Found', true, 404);
            exit;
        }

        $controller = new $controller();
        call_user_func([$controller, $action]);
    }

    /**
     * Run app
     *
     * @return void
     */
    public function start()
    {
        $this->handleRequest();
    }

}
