<?php

class FinalizeController
{
    private $view;
    private $auditId;

    public function __construct($action)
    {
        switch ($action) {
            case 'default':
            case 'display':
            case 'update':
                $this->auditId = $_SESSION['auditId'] ?? '';
                break;
            default:
                throw new Exception('Page introuvable');
                break;
        }
    }

    public function default()
    {
        require_once 'models/Audit.php';
        require_once 'models/Risk.php';
        require_once 'models/Grid.php';
        $audit = new Audit();
        $risks = new Risk();
        $grid = new Grid();

        $content = [];
        $content['audit'] = $audit->selectOne($this->auditId); ;
        $allRisks = $risks->selectAll();
        $allEvaluate = $risks->getAllEvaluateRiskByAudit($this->auditId);
        $content['risks'] = ['info' => $allRisks, 'infoEvaluate' => $allEvaluate];
        $content['grid'] = [] ;

        $sidebar = [
            [
                'href' => URL.$_SESSION["role"] .'/intro',
                'span' => lang['Intro'],
                'active' => '',
                'action' => ''
            ], [
                'href' => URL.$_SESSION["role"] .'/risks',
                'span' => lang['Risk rating'],
                'active' => '',
                'action' => ''
            ], [
                'href' => URL.$_SESSION["role"] .'/grid',
                'span' => lang['Audit grid'],
                'active' => '',
                'action' => ''
            ],[
                'href' => URL.$_SESSION["role"] .'/conclusion',
                'span' => lang['Conclusion'],
                'active' => '',
                'action' => ''
            ],[
                'href' => 'audit-admin/auditor/finalize',
                'span' => lang['Finalize report'],
                'active' => 'sidebarActive',
                'action' => 'finalize',
                'formId' => '#'
            ]];
        $vue = ['controllerName' => 'ConclusionController', 'heading' => lang['Ongoing report'],'content' => $content, 'sidebarItems' => $sidebar];
        $this->view = new View('audit/finalization');
        return $this->view->generate($vue);
    }

    public function display(){
        return $this->default();
    }

    public function update(){
        require_once 'models/Audit.php';
        $audit = new Audit();
        $audit->finalize();

        require_once('controllers/AuditorController.php');
        $finalize = new AuditorController(['auditor','default']);
        return $finalize->default();
    }
}