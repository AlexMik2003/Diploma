<?php


namespace app\controllers;


use app\core\Controller;


class UserController extends Controller
{
    public function actionIndex()
    {
        $this->actionLogin();
    }

    public function actionLogin()
    {
        $this->view->render("login",['hello' => "HELLO WORLD!"]);
    }


}