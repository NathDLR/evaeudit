<?php

require_once('models/View.php');
require_once('controllers/AuthController.php');

class Router
{

    private $controller;
    private $view;
    private $auth;

    public function routeRequest()
    {
        try {
            $this->auth = new AuthController([1 => 'isLogged']);
            $isLogged = $this->auth->isLogged();
            if (isset($_GET['action']) && !empty($_GET['action']))
            {
                $actionBrut = str_replace('.php', '', $_GET['action']);
                $action = explode('/', filter_var($actionBrut, FILTER_SANITIZE_URL));
                if (count($action) == 1 || empty($action[1])){
                    $action[1] = 'default';
                }
                require_once 'LanguageController.php';
                $lang = new LanguageController();
                if($lang->changeLanguage($action[0])){
                    echo '<script>history.back()</script>';
                    die();
                }
                if (($isLogged && ($action[0] != 'auth' || $action[1] == 'logout')) || (!$isLogged && $action[0] == 'auth'))
                {
                    $controllerClass = ucfirst(strtolower($action[0]))."Controller";
                    $controllerFile = "controllers/".$controllerClass.".php";
                    if (file_exists($controllerFile)){
                        require_once($controllerFile);
                        $this->controller = new $controllerClass($action);
                        $methode = $action[1];
                        return $this->controller->$methode();

                    } else {
                        throw new Exception('Page introuvable');
                    }
                } elseif ($isLogged) {
                    //header('Location: /' . $_SESSION['role'] . '/home');
                    return $this->auth->goToYourIndex();
                    die();
                } else {
                    //$this->auth = new AuthController('default');
                    return $this->auth->default();
                }
            } elseif ($isLogged) {
                //header('Location: /'.$_SESSION['role'].'/home');
                return $this->auth->goToYourIndex();
                die();
            } else {
                return $this->auth->login();
            }
        } catch (Exception $e) {
            $vue = ['errorMsg' => $e->getMessage()];
            $this->view = new View('error/error404');
            return $this->view->generateWithoutTemplate($vue);
        }

    }
}