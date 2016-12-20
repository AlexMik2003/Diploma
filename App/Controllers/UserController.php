<?php


namespace App\Controllers;


use App\Core\Controller;
use App\Core\View;

class UserController extends Controller
{
    public function actionIndex()
    {
        $this->actionLogin();
    }

    public function actionLogin()
    {
        $this->view->render("login");
    }
}