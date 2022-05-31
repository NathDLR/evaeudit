<?php

include_once ('models/Risk.php');
include_once ('models/Audit.php');

class RiskController
{
    private $view;
    private $risk;
    private $audit;

    public function __construct($action)
    {
        switch ($action) {
            case 'default':
            case 'insert':
            case 'update':
            case 'finalize':
                break;
            default:
                throw new Exception('Page introuvable');
                break;
        }
        $this->risk = new Risk();
        $this->audit = new Audit();
    }


    public function default(){
        $allRisks = $this->risk->selectAll();
        $allEvaluate = $this->risk->getAllEvaluateRiskByAudit($_SESSION['auditId']);
        $sidebar = [
            [
                'href' => URL.$_SESSION["role"] .'/intro',
                'span' => lang['Intro'],
                'active' => '',
                'action' => ''
            ], [
                'href' => URL.$_SESSION["role"] .'/risks',
                'span' => lang['Risk rating'],
                'active' => 'sidebarActive',
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
                'href' => URL . 'auditor/risk/finalize',
                'span' => lang['Finalize report'],
                'active' => '',
                'action' => 'finalize',
                'formId' => 'riskform'
            ]];
        $vue = ['info' => $allRisks, 'infoEvaluate' => $allEvaluate, 'heading' => lang['Ongoing report'], 'sidebarItems' => $sidebar];
        $this->view = new View('audit/risk');
        return $this->view->generate($vue);
    }

    public function update(){
        $risks = [];
        $result = $_POST['result'];
        $riskNotationId = null;

        for ($i = 0; $i<10; $i++)
        {
            $risks[$i]['idRisk'] = $i;
            $risks[$i]['idAudit'] = $_SESSION['auditId'];

            if (isset($_POST['select_'.$i]) and !empty($_POST['select_'.$i])){
                if ($_POST['select_'.$i] == "Yes"){
                    $risks[$i]['isResult'] = "Yes";
                    $risks[$i]['contamination'] = $_POST['contamination_'.$i];
                    $risks[$i]['comment'] = $_POST['comment_'.$i];
                }else{
                    $risks[$i]['isResult'] = "No";
                    $risks[$i]['contamination'] = $_POST['contamination_'.$i];
                    $risks[$i]['comment'] = $_POST['comment_'.$i];
                }
            }

        }


        foreach ($risks as $aRisk){
            $this->risk->updateAll($aRisk);
        }
        $riskNotation = $this->risk->getRiskNotation($result);
        $this->audit->updateRiskAudit($riskNotation['ID'], $_SESSION['auditId']);

        switch($_POST['submit']){

            case lang['Finalize']:
                require_once('controllers/FinalizeController.php');
                $final = new FinalizeController('default');
                return $final->default();
            case lang['Previous']:
                require_once('controllers/IntroController.php');
                $intro = new IntroController([$_SESSION['role'], 'intro', 'default']);
                return $intro->default();
            case lang['Next']:
                require_once('controllers/GridController.php');
                $grid = new GridController([$_SESSION['role'], 'grid', 'default']);
                return $grid->default();
            default:
                return $this->default();
        }

    }



}