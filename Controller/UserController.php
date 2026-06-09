<?php

namespace lmd\Controller;

use lmd\Model\UserModel;
use lmd\Library\Msg;

class UserController
{
    public function __construct()
    {
    }

    public function login()
    {
        $userModel = new UserModel();
        $username = $_GET['username'] ?? '';
        $password = $_GET['pw'] ?? '';
        echo json_encode($userModel->login($username, $password));
    }

    public function isLogin()
    {
        $isLoggedIn = isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true;
        echo json_encode(['isLogin' => $isLoggedIn]);
    }
}
