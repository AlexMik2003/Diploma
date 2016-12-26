<?php

namespace app\controllers;
use app\core\Controller;
use app\helpers\Session;
use app\models\UserModel;

/**
 * Class UserController
 *
 * @package app\controllers
 */
class UserController extends Controller
{
    public function actionIndex()
    {
        $this->actionLogin();
    }

    public function actionLogin()
    {
        $this->model = new UserModel();
        if(!$this->model->auth())
        {
            $this->view->render("login");
        }
        else
        {
            $login = Session::get("login");
            $id = Session::get("id");
            if(empty($login) || empty($id))
            {
                Session::destroy();
                $this->view->render("login");
            }
            else{
                $this->view->render("index");
            }

        }
    }
}