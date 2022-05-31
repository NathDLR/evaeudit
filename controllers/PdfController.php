<?php

require_once 'models/Audit.php';
require_once 'models/User.php';
require_once 'models/Grid.php';
require_once 'models/Risk.php';
require_once 'models/OrderForm.php';

class PdfController
{
    private $view;
    private $auditId;

    public function __construct($action)
    {
        switch ($action[1]) {
            case 'audit':
            case 'capa':
            case 'order':
                if(empty($action[2])){
                    $action[2] = 'default';
                }else{
                    $this->auditId = $action[2];
                }
                break;
            default:
                throw new Exception('Page introuvable');
        }

    }

    public function default(){
        $sidebar = [
            [
                'href' => '/'.$_SESSION["role"] .'/intro',
                'span' => lang['Intro'],
                'active' => '',
                'action' => ''
            ], [
                'href' => '/'.$_SESSION["role"] .'/risks',
                'span' => lang['Risk rating'],
                'active' => '',
                'action' => ''
            ], [
                'href' => '/'.$_SESSION["role"] .'/grid',
                'span' => lang['Audit grid'],
                'active' => 'sidebarActive',
                'action' => ''

            ],[
                'href' => '/'.$_SESSION["role"] .'/conclusion',
                'span' => lang['Conclusion'],
                'active' => '',
                'action' => ''
            ],[
                'href' => '/auditor/grid/finalize',
                'span' => lang['Finalize report'],
                'active' => '',
                'action' => 'finalize',
                'formId' => 'gridform'
            ]];
        $this->view = new View($_SESSION['role'].'/home');
        return $this->view->generate(['sidebar' => $sidebar]);
    }

    public function audit(){
        $audit = new Audit();
        $content['audit'] = $audit->selectOne($this->auditId, 'pdf');
        $risks = new Risk();
        $allRisks = $risks->selectAll();
        $allEvaluate = $risks->getAllEvaluateRiskByAudit($this->auditId);
        $content['risks'] = ['info' => $allRisks, 'infoEvaluate' => $allEvaluate];
        $content['riskNotation'] = $risks->getAllRiskNotation();
        $content['MaxRisk'] = $risks->getMaxRisk();
        $grid = new Grid();
        $content['grid'] = $grid->selectForPDF($this->auditId);
        $vue = ['content' => $content];
        $this->view = new View('pdf/audit');
        return $this->view->generatePdf($vue);
    }

    public function capa(){
        $audit = new  Audit();
        $grid = new Grid();
        $user = new User();
        $contentCapa = $grid->getCdDataGrid($this->auditId);
        $contentUsers = $user->getUsersByAudit($this->auditId);
        $contentDates = $audit->getDatesByAudit($this->auditId);

        $sidebar = [
            [
                'href' => '/'.$_SESSION["role"] .'/intro',
                'span' => lang['Intro'],
                'active' => '',
                'action' => ''
            ], [
                'href' => '/'.$_SESSION["role"] .'/risks',
                'span' => lang['Risk rating'],
                'active' => '',
                'action' => ''
            ], [
                'href' => '/'.$_SESSION["role"] .'/grid',
                'span' => lang['Audit grid'],
                'active' => 'sidebarActive',
                'action' => ''

            ],[
                'href' => '/'.$_SESSION["role"] .'/conclusion',
                'span' => lang['Conclusion'],
                'active' => '',
                'action' => ''
            ],[
                'href' => '/auditor/grid/finalize',
                'span' => lang['Finalize report'],
                'active' => '',
                'action' => 'finalize',
                'formId' => 'gridform'
            ]];
        $this->view = new View('pdf/capa');
        $vue = ['infoCapas' => $contentCapa, 'infoUsers' => $contentUsers, 'infoDates' => $contentDates, 'heading' => lang['Ongoing report'], 'sidebarItems' => $sidebar];

        return $this->view->generate($vue);
    }

    public function order(){
        if ($_SESSION['role'] != 'admin') {
            header('Location: ' . URL . 'auditor/home');
            die();
        }

        $order = new OrderForm();
        $content = $order->getOrderFormOnce($this->auditId);

/*        echo '<pre>';
        print_r($content);
        echo '</pre>';*/

        $this->view = new View('pdf/order');
        $vue = ['content' => $content];
        return $this->view->generate($vue);
    }


}