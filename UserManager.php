<?php
require_once "Manager.php";

class UserManager extends Manager
{
    public function getUser(User $user)
    {
        $req = $this->getDb()->prepare("SELECT * FROM user WHERE name = :name AND password = :password");
        $req->execute(array(
          'name' => $user->login(),
          'password' => $user->password(),
   ));
        $data = $req->fetch();
        return $data;

    }
}
