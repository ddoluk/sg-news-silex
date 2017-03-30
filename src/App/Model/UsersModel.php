<?php
/**
 * Created by PhpStorm.
 * User: ddoluk
 * Date: 3/28/17
 * Time: 1:15 PM
 */

namespace App\Model;

use App\Core\Model;

class UsersModel extends Model
{
    public function __construct($connection)
    {
        parent::__construct($connection);
    }

    public function getUser($login, $password)
    {
        $this->qb
            ->select('*')
            ->from('users')
            ->where('login = :login AND password = :password')
            ->setParameters(array(
                'login' => $login,
                'password' => md5($password)
            ));

        $user = $this->qb->execute();

        return $user->fetch();
    }

}