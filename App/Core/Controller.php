<?php


namespace App\Core;

/**
 * Class Base Controller
 *
 * @package App\Core
 */
class Controller
{
    public $model;
    public $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function actionIndex()
    {

    }
}