<?php

namespace lmd\Model;

use lmd\Library\Msg;

class UserModel extends Database // Extend Database class
{
    // No constructor needed, as per DataModel
    public function __construct()
    {
    }

    public function login($username, $password)
    {
        try {
            $pdo = $this->linkDB();
            $stmt = $pdo->prepare("SELECT * FROM user WHERE username = :username AND pw = :password");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password); // WARNING: Store hashed passwords in production!
            $stmt->execute();
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($user) {
                $_SESSION['isLoggedIn'] = true;
                $_SESSION['username'] = $user['username'];
                return [
                    'isError' => false,
                    'isLogin' => true
                ];
            } else {
                $_SESSION['isLoggedIn'] = false;
                return [
                    'isError' => true,
                    'msg' => 'Benutzername und Passwort stimmen nicht überein',
                    'isLogin' => false
                ];
            }
        } catch (\PDOException $ex) {
            new Msg(true, 'Database error during login', $ex->getMessage());

            return [
                'isError' => true,
                'msg' => 'An unexpected database error occurred.',
                'isLogin' => false
            ];
        }
    }
}
