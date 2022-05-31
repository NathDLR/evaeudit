<?php

class UserController
{
    private $view;
    private $user;
    private $action;

    public function __construct($action)
    { $this->action = $action;
        switch ($action[2]) {
            case 'default':
                break;
            case 'disable':
            case 'enable':
                if(empty($action[3])){return $this->default();}
                break;
            default:
                throw new Exception('Page introuvable');
        }

    }

    public function default(){
        $this->user = new User();
        $users = $this->user->getAuditors();


        $vue = ['controllerName' => 'AuditorController', 'users' => $users, 'heading' => '', 'sidebarItems' => []];
        $this->view = new View('admin/manage-users');
        return $this->view->generate($vue);
    }

    public function disable(){
        $this->user = new User();
        $this->user->disable($this->action[3]);

        return $this->default();
    }

    public function enable(){
        $this->user = new User();
        $this->user->enable($this->action[3]);

        return $this->default();
    }

}