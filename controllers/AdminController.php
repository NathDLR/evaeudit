<?php

require_once('models/User.php');
require_once('models/Audit.php');
require_once('models/Risk.php');
require_once('models/Grid.php');

class AdminController
{
    private $view;
    private $actionAudit;
    private $user;
    private $valid;

    public function __construct($action)
    {
        switch ($action[1]) {
            case 'default':
            case 'create_audit':
            case 'insert_audit':
            case 'change_status':
            case 'create_auditor':
            case 'insert_auditor':
            case 'risks':
            case 'conclusion':
            case 'home':
            case 'valid':
                $this->actionAudit = $action[2] ?? 'default';
                break;
            case 'intro':
                $this->actionAudit = isset($action[2]) ? $action : ['admin', 'intro', 'default', $_SESSION['auditId']];
                break;
            case 'setPassword':
            case 'manage':
                $this->actionAudit = !empty($action[2]) ? $action : ['admin', 'manage', 'default'];
                break;
            case 'grid':
                $this->actionAudit = isset($action[2]) ? $action : ['admin', 'grid', 'default', $_SESSION['auditId']];
                break;
            case 'order_form':
                $this->actionAudit = isset($action[2]) ? $action : ['admin', 'order_form', 'default'];
                break;
            default:
                throw new Exception('Page introuvable');
                break;
        }
        if ($_SESSION['role'] != 'admin') {
            header('Location: ' . URL . 'auditor/home');
            die();
        }
    }

    public function create_auditor()
    {
        $users = new User();

        $vue = ['controllerName' => 'AdminController', 'heading' => '', 'sidebarItems' => []];
        $this->view = new View('admin/create-auditor');
        return $this->view->generate($vue);
    }

    public function insert_auditor()
    {
        if ($_POST['password'] == $_POST['passConfirm']) {
            $hashedPass = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $this->user = new User($_POST['name'], $_POST['firstname'], $_POST['username'], $hashedPass);
            $this->user->insert();
        }
        return $this->default();
    }

    public function setPassword(){
        if (isset($_POST['password'])){
            $user = new User();
            $user->setPassword($_POST['password']);
            $user->updatePassword($this->actionAudit[2]);
            $this->actionAudit[2] = 'default';
        }
        return $this->manage();
    }

    public function create_audit()
    {
        $users = new User();
        $auditors = $users->getAuditors();

        $vue = ['auditors' => $auditors, 'controllerName' => 'AdminController', 'heading' => '', 'sidebarItems' => []];
        $this->view = new View('admin/create-audit');
        return $this->view->generate($vue);
    }

    public function change_status(){
        if(isset($_POST['changestatus'])){
            $audit = new Audit();
            $audit->changeStatus($_POST['changestatus'], $this->actionAudit);
        }
        return $this->default();
    }

    public function insert_audit()
    {
        $audit = new Audit();
        $lastId = $audit->insert($_POST['auditor'], $_SESSION['userId'], $_POST['companyName']);

        return $this->default();
    }

    public function order_form()
    {
        require_once('controllers/OrderFormController.php');
        $order = new OrderFormController($this->actionAudit);
        $methode = $this->actionAudit[2];
        return $order->$methode();
    }

    public function valid_audit(){
        require_once('controllers/PdfController.php');

        $risk = new Risk();
        $grid = new Grid();

       /* $risk->setAllRisk($lastId);
        $grid->setGrid($lastId);

        $orderForm = new PdfController(['admin', 'orderForm', $lastId]);
        $contentOrderForm

        $this->view = new View('admin/orderForms');
        $vue = ['content' => $content];*/
         return $this->view->generateWithoutTemplate($vue);
    }

    public function intro()
    {
        require_once('controllers/IntroController.php');
        $intro = new IntroController($this->actionAudit);
        $methode = $this->actionAudit[2];
        return $intro->$methode();
    }

    public function manage()
    {
        require_once('controllers/UserController.php');
        $manage = new UserController($this->actionAudit);
        $methode = $this->actionAudit[2];
        return $manage->$methode();
    }

    public function risks()
    {
        require_once('controllers/RiskController.php');
        $Risk = new RiskController($this->actionAudit);
        $methode = $this->actionAudit;
        return $Risk->$methode();
    }

    public function conclusion()
    {
        require_once('controllers/ConclusionController.php');
        $conclusion = new ConclusionController($this->actionAudit);
        $methode = $this->actionAudit;
        return $conclusion->$methode();
    }


    private function back()
    {
        $vue = ['info' => '', 'controllerName' => 'AdminController', 'heading' => '', 'sidebarItems' => []];
        $this->view = new View('auditor/home');
        return $this->view->generate($vue);
    }

    public function home()
    {
        $this->unsetAuditId();
        $audit = new Audit();
        $audits = $audit->selectAllForAdmin();

        $vue = ['controllerName' => 'AuditorController', 'audits' => $audits['active'], 'archived' => $audits['archived'], 'heading' => '', 'sidebarItems' => []];

        /* Nom du dossier, Nom du template */
        $this->view = new View('admin/home');
        return $this->view->generate($vue);
    }

    private function unsetAuditId(){
        unset($_SESSION['auditId']);
        unset($_SESSION['companyName']);
    }

    public function default()
    {
        return $this->home();
    }

    public function grid()
    {
        require_once('controllers/GridController.php');
        $grid = new GridController($this->actionAudit);
        $methode = $this->actionAudit[2];
        return $grid->$methode();
    }

    public function valid(){
        return $this->default();
    }

}