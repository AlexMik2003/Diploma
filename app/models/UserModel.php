<?php

namespace app\models;

use app\App;
use app\core\Model;

/**
 * Class UserModel
 *
 * @package app\models
 */
class UserModel extends Model
{
    public function auth()
    {
        if($this->isEmptyPostData($_POST))
        {
            if($this->isUserAuthorized($_POST))
            {
                return true;
            }
        }

        return false;
    }

    protected function isEmptyPostData(array $data)
    {
        extract($data);
        if(!empty($data["username"]) || !empty($data["password"]))
        {
            return true;
        }

        return false;
    }

    protected function isUserAuthorized(array $data)
    {
        foreach ($data as $key => $value)
        {
            $data[$key]=stripcslashes($value);
            $data[$key]=htmlspecialchars($value);
            $data[$key]=trim($value);
        }

        extract($data);

        $query = App::$i->db->prepare("SELECT * FROM users WHERE login=:login");
        $query->bindValue(":login",$data["username"],\PDO::PARAM_STR);
        $query->execute();
        if($query->rowCount()>0)
        {
            $row = $query->fetch(\PDO::FETCH_LAZY);
            if(!password_verify($data["password"],$row["password"]))
            {
                return false;
            }
            $_SESSION["id"] = $row["id"];
            $_SESSION["login"] = $row["login"];
            return true;
        }
        return false;
    }
}