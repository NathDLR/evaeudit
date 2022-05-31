<?php

class ConclusionController
{

    private $view;
    private $audit;

    public function __construct($action)
    {
        switch ($action) {
            case 'default':
            case 'update':
                break;
            default:
                throw new Exception('Page introuvable');
                break;
        }
        $this->audit = new Audit();
        $audit = $this->audit->selectOne();
    }

    public function default()
    {
        $audit = new Audit();

        $audit = $audit->SelectOne();
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
                'active' => 'sidebarActive',
                'action' => ''
            ],[
                'href' => 'audit-admin/auditor/conclusion/finalize',
                'span' => lang['Finalize report'],
                'active' => '',
                'action' => 'finalize',
                'formId' => 'conclusionform'
            ]];
        $vue = ['controllerName' => 'ConclusionController', 'heading' => lang['Ongoing report'],'audit' => $audit, 'sidebarItems' => $sidebar,'notifs' => $notifs ?? []];
        $this->view = new View('audit/conclusion');
        return $this->view->generate($vue);
    }

    public function update()
    {
        $audit = new Audit();

        $audit->fillConclusion($_POST['auditorConclusion'], $_POST['vigilance'], $_POST['auditorRecommendation'], $_POST['complementaryAudit'] ?? '', $_POST['unannouncedControl'] ?? '', $_POST['attachment'] ?? '', $_POST['attachmentDetails'],$_POST['auditorOpinion'] ?? '', $_POST['adminOpinion'] ?? '' );
        $audit->updateConclusion();

        switch($_POST['submit']){

            case lang['Finalize']:
                require_once('controllers/FinalizeController.php');
                $intro = new FinalizeController('default');
                return $intro->default();
            case lang['Previous']:
                require_once('controllers/GridController.php');
                $grid = new GridController([$_SESSION['role'],'grid','default']);
                return $grid->default();
            default:
                return $this->default();
        }
    }
}