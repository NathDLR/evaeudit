<?php
require_once('models/User.php');
require_once('models/Audit.php');
require_once('models/Risk.php');
require_once('models/Grid.php');

class AuditorController
{
    private $view;
    private $actionAudit;

    public function __construct($action){
        if($_SESSION['role'] != 'auditor'){
            header('Location: ' . URL . '/admin/home');
            die();
        }

        switch ($action[1]){
            case 'home':
            case 'test':
            case 'default':
            case 'create':
            case 'risks':
            case 'conclusion':
            case 'finalization':
            case 'insert':
                $this->actionAudit = $action[2] ?? 'default';
                break;
            case 'finalize':
                $this->actionAudit = isset($action[2]) ? $action : ['auditor','finalize','default'];
                break;
            case 'intro':
                $this->actionAudit = isset($action[2]) ? $action : ['auditor','intro','default', $_SESSION['auditId']];
                break;
            case 'grid':
                $this->actionAudit = isset($action[2]) ? $action : ['admin', 'grid', 'default', $_SESSION['auditId']];
                break;
            default:
                throw new Exception('Page introuvable');
        }
    }

    public function intro()
    {
        require_once('controllers/IntroController.php');
        $intro = new IntroController($this->actionAudit);
        $methode = $this->actionAudit[2];
        return $intro->$methode();
    }

    public function finalize(){
        require_once('controllers/FinalizeController.php');
        $finalize = new FinalizeController($this->actionAudit[2]);
        $methode = $this->actionAudit[2];
        return $finalize->$methode();
    }

    public function finalization (){
        require_once('controllers/FinalizeController.php');
        $intro = new FinalizeController('default');
        return $intro->default();
    }

    public function conclusion()
    {
        require_once('controllers/ConclusionController.php');
        $conclusion = new ConclusionController($this->actionAudit);
        $methode = $this->actionAudit;
        return $conclusion->$methode();
    }

    public function create()
    {
            require_once('models/User.php');
            $users = new User();
            $admins = $users->getAdmins();

            $vue = ['admins' => $admins, 'controllerName' => 'AuditorController', 'heading' => '', 'sidebarItems' => []];
            $this->view = new View('auditor/create');
            return $this->view->generate($vue);
    }

    public function insert()
    {
            $audit = new Audit();
            $risk = new Risk();
            $grid = new Grid();
            $lastId = $audit->insert($_SESSION['userId'], $_POST['admin'], $_POST['companyName']);
            $risk->setAllRisk($lastId);
            $grid->setGrid($lastId);
            return $this->default();
    }

    // Affiche la vue et lui passe une variable contenant tout les audits liés a l'utilisateur connecté
    public function default()
    {
        $this->unsetAuditId();
        $audit = new Audit();
        $audits = $audit->selectAll();
        $newAudits = [];
        $sentAudits = [];
        foreach($audits as $audit){
            if($audit['STATUS_ID'] > 1){
                array_push($sentAudits, $audit);
            }else{
                array_push($newAudits, $audit);
            }
        }
        $vue = ['controllerName' => 'AuditorController', 'audits' => $newAudits, 'sentAudits' => $sentAudits,  'heading' => '', 'sidebarItems' => []];
        /* Nom du dossier, Nom du template */
        $this->view = new View('auditor/home');
        return $this->view->generate($vue);
    }

    // Supprime l'id de l'audit de la session
    private function unsetAuditId(){
        unset($_SESSION['auditId']);
        unset($_SESSION['companyName']);
    }

    public function home()
    {
        return $this->default();
    }

    //Appel et renvoi des données du controller Risk
    public function risks()
    {
        require_once('controllers/RiskController.php');
        $risk = new RiskController($this->actionAudit);
        $methode = $this->actionAudit;
        return $risk->$methode();
    }

    //Appel et renvoi des données du controller Grid
    public function grid()
    {
        require_once('controllers/GridController.php');
        $grid = new GridController($this->actionAudit);
        $methode = $this->actionAudit[2];
        return $grid->$methode();
    }

}