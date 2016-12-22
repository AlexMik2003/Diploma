<?php


namespace app\models;


use app\core\Model;
use app\core\Session;

/**
 * Class UserModel
 *
 * @package app\models
 *
 */
class UserModel extends Model
{

    public function auth()
    {
        if($this->isEmptyData($_POST))
        {
            return false;
        }

        $login = $_POST["username"];
        $password = $_POST["password"];

        $login = stripcslashes($login);
        $login = htmlspecialchars($login);
        $login = trim($login);

        $password = stripcslashes( $password);
        $password = htmlspecialchars( $password);
        $password = trim($password);
    }

    /**
     * Check for empty POST data from user
     *
     * @param array $params POST data - login and password
     *
     * @return bool
     */
    protected function isEmptyData(array $params=[])
    {
        if(!empty($params["username"]) || !empty($params["password"]))
        {
            return true;
        }

        return false;
    }

    /**
     * Checks, whether user is authorized.
     *
     * @param string $login User login
     *
     * @param string $password User password
     *
     * @return bool
     */
    protected function isUserAuthorized($login,$password)
    {
        
    }
}