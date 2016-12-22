<?php


namespace app\controllers;


use app\core\Controller;
use app\core\Model;
use app\core\Session;
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
        Session::init();
        $login = Session::get("login");
        $id = Session::get("id");
        if(empty($login) || empty($id))
        {
            Session::destroy();
            $this->actionLogin();

        }
        else{
            $this->view->render("index");
        }
    }

    /**
     * Authorization for users
     *
     * @return void
     */
    protected function actionLogin()
    {
        $this->model = new UserModel();
        if($this->model->auth())
        {
            $this->view->render("index");
        }
        else{
            $this->view->render("login");
        }
    }

}