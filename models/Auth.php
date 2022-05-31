<?php

include_once 'Connexion.php';

class Auth {

    private $db;

    public function __construct(){
        $this->db = Connexion::getConnexion();
    }

    // Test si l'utilisateur existe, si son mot de passe est bon et met ses informations dans la session
    public function tryToConnect($username,$password){
        $selectUserTest = $this->db->prepare("SELECT USER_ID, NAME, FIRSTNAME, USERNAME, PASSWORD, R.LABEL ROLE
                                    FROM user U
                                    INNER JOIN role R ON U.ROLE_ID = R.ROLE_ID
                                    WHERE USERNAME = :username
                                    AND STATUS = 1");
        $selectUserTest->bindParam(':username', $username, PDO::PARAM_STR);
        $selectUserTest->execute();
        $user = $selectUserTest->fetchAll(PDO::FETCH_ASSOC);

        if (empty($user)){
            return ['isUserSet' => false];
        }else{
            $isPassGood = password_verify($password, $user[0]['PASSWORD']);
            if ($isPassGood) {
                $_SESSION['userId'] = $user[0]['USER_ID'];
                $_SESSION['username'] = $user[0]['USERNAME'];
                $_SESSION['name'] = $user[0]['NAME'];
                $_SESSION['firstname'] = $user[0]['FIRSTNAME'];
                $_SESSION['role'] = $user[0]['ROLE'];
                return ['isUserSet' => true, 'isPassGood' => $isPassGood, 'userId' => $user[0]['USER_ID']];
            }else{
                return ['isUserSet' => false, 'isPassGood' => false];
            }
        }
    }
}