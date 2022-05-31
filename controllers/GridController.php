<?php

include_once ('models/Grid.php');
include_once ('models/Audit.php');

class GridController
{
    private $view;
    private $grid;
    private $audit;
    private $requirementId;

    public function __construct($action)
    {
        switch ($action[2]) {
            case 'default':
            case 'insert':
            case 'update':
                break;
            case 'updateCapa':
                    $this->requirementId = $action[3];
                break;
            default:
                throw new Exception('Page introuvable');
                break;
        }
        $this->grid = new Grid();
        $this->audit = new Audit();
    }

    public function default()
    {
        $allGrid = $this->grid->selectAll($_SESSION['auditId']);
        $allHistory = $this->grid->getAllHistory();
        $allCapa = $this->grid->getAllDataGrid($_SESSION['auditId']);
        $allExamEve = $this->grid->getExamEve();

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
                'active' => 'sidebarActive',
                'action' => ''

            ],[
                'href' => URL.$_SESSION["role"] .'/conclusion',
                'span' => lang['Conclusion'],
                'active' => '',
                'action' => ''
            ],[
                'href' => 'audit-admin/auditor/grid/finalize',
                'span' => lang['Finalize report'],
                'active' => '',
                'action' => 'finalize',
                'formId' => 'gridform'
            ]];
        $vue = ['info' => $allGrid, 'infoHistory' => $allHistory, 'infoCapa' => $allCapa, 'infoExamEve' => $allExamEve, 'heading' => lang['Ongoing report'], 'sidebarItems' => $sidebar];

        $this->view = new View('audit/grid');
        return $this->view->generate($vue);
    }

    public function update(){
        $grid = [];

        for ($i = 0; $i< $_POST['nbrRow']; $i++)
        {
            if ($_POST['note_'.$i] != 'none'){

                list($requirementTypeId, $requirementId, $idLetter, $points) = explode('.', $_POST['note_'.$i]);

                $grid[$i]['idRow'] = $i;

                if ($_SESSION['role'] == 'admin'){
                    $grid[$i]['returnDate'] = '';
                    $grid[$i]['examId'] = null;
                    $grid[$i]['operatorInCharge'] = '';
                    $grid[$i]['operatorComment'] = '';
                    $grid[$i]['attachement'] = '';
                    $grid[$i]['liberationDate'] = '';
                    $grid[$i]['liberationComment'] = '';
                }else{
                    $grid[$i]['returnDate'] = '';
                    $grid[$i]['examId'] = '';
                    $grid[$i]['operatorInCharge'] = '';
                    $grid[$i]['operatorComment'] = '';
                    $grid[$i]['attachement'] = '';
                    $grid[$i]['liberationDate'] = '';
                    $grid[$i]['liberationComment'] = '';
                }

                $grid[$i]['idAudit'] = $_SESSION['auditId'];
                $grid[$i]['requirementTypeId'] = $requirementTypeId;
                $grid[$i]['requirementId'] = $requirementId;
                $grid[$i]['idLetter'] = $idLetter;
                $grid[$i]['auditorComment'] = $_POST['comment_'.$i];
                $grid[$i]['correctionExtra'] = $_POST['supplement_'.$i];
                $this->grid->updateAll($grid[$i], ($i+1));
            }
        }
        switch($_POST['submit']){

            case lang['Finalize']:
                require_once('controllers/FinalizeController.php');
                $final = new FinalizeController('default');
                return $final->default();
            case lang['Previous']:
                require_once('controllers/RiskController.php');
                $risk = new RiskController('default');
                return $risk->default();
            case lang['Next']:
                require_once('controllers/ConclusionController.php');
                $conclusion = new ConclusionController('default');
                return $conclusion->default();
            default:
                return $this->default();
        }
    }

    public function updateCapa(){
        $capa = [];

        $capa['idAudit'] = $_SESSION['auditId'];
        $capa['reviewId'] = $this->requirementId;
        $capa['historyId'] = intval($_POST['history']);
        $capa['limitDate'] = $_POST['limitDate'] ?: null;
        $capa['returnDate'] = $_POST['returnDate'];
        $capa['operatorInCharge'] = $_POST['responsable'];
        $capa['operatorComment'] = $_POST['commentsOperator'];
        $capa['attachement'] = $_POST['attachment'];
        $capa['examId'] = intval($_POST['examEve']) ?: null;
        $capa['liberationDate'] = $_POST['dateCheck'];
        $capa['liberationComment'] = $_POST['commentsLiberation'];

        $this->grid->updateCapa($capa);
        return $this->default();
    }
}