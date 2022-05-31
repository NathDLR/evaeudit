<?php

require_once('models/Auth.php');
require_once('models/User.php');

class AuthController
{
    private $view;

    public function __construct($action)
    {
        switch ($action[1]) {
            case 'login':
            case 'default':
            case 'logout':
            case 'log':
            case 'isLogged':
            case 'goToYourIndex':
                break;
            default:
                throw new Exception('Page introuvable');
                break;
        }
    }

    public function log()
    {
        $this->view = new View('auth/login');
        if (isset($_POST['username']) && isset($_POST['password'])){
            $auth = new Auth();
            $testUserConnexion = $auth->tryToConnect($_POST['username'], $_POST['password']);
            if ($testUserConnexion['isUserSet'] && $testUserConnexion['isPassGood'] == true){
                return $this->goToYourIndex();
            }else{
                $vue = ['info' => 'Nom d\'utilisateur ou mot de passe incorrect'];
                return $this->view->generateWithoutTemplate($vue);
            }
        }else{
            $vue = ['info' => 'Veuillez inscrire vos identifiants et mot de passe'];
            return $this->view->generateWithoutTemplate($vue);
        }
    }

    public function login()
    {
        $vue = ['info' => ''];
        $this->view = new View('auth/login');
        return $this->view->generateWithoutTemplate($vue);
    }

    public function default()
    {
        return $this->login();
    }

    
    public function logout()
    {
        if (session_unset()){
            return $this->default();
        }else{
            throw new Exception('Une erreur s\'est produite lors de la déconnexion');
        }
    }

    public function goToYourIndex(){
        $role = $_SESSION['role'];
        header('Location: ' . URL .$role.'/default');
        die();
    }

    public function isLogged(){
        $result = false;
        if(isset($_SESSION['role'])){
            $result = true;
        }
        return $result;
    }


}