<?php

class IntroController
{

    private $view;
    private $audit;
    private $id;

    public function __construct($action)
    {
        switch ($action[2]) {
            case 'default':
            case 'delete_date':
            case 'delete_participant':
            case 'update':
                break;
            default:
                throw new Exception('Page introuvable');
                break;
        }
        $this->audit = new Audit();
        $this->id = $action[3] ?? null;
    }

    public function default()
    {
        $anAudit = new Audit();
        $audit = $anAudit->SelectOne($this->id);
        $sidebar = [
            [
                'href' => URL.$_SESSION["role"] .'/intro',
                'span' => lang['Intro'],
                'active' => 'sidebarActive',
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
                'href' => URL . $_SESSION["role"] .'/conclusion',
                'span' => lang['Conclusion'],
                'active' => '',
                'action' => ''
            ],[
                'href' => 'audit-admin/auditor/intro/finalize',
                'span' => lang['Finalize report'],
                'active' => '',
                'action' => 'finalize',
                'formId' => 'introform'
            ]];
        $vue = ['controllerName' => 'AuditorController', 'audit' => $audit, 'heading' => 'Rapport en cours', 'sidebarItems' => $sidebar];
        $this->view = new View('audit/intro');
        return $this->view->generate($vue);
    }

    public function delete_date(){
        $audit = new Audit();
        $audit->deleteDate($this->id);
        $this->id = $_SESSION['auditId'];
        return $this->default();
    }

    public function delete_participant(){
        $audit = new Audit();
        $audit->deleteParticipant($this->id);
        $this->id = $_SESSION['auditId'];
        return $this->default();
    }

    public function update()
    {
        require_once('models/Participant.php');

        $audit = new Audit();

        $dates = array_filter($_POST['auditDates']);
        $datesToInsert = [];
        for ($i = 1; $i <= count($dates); $i++) {
            if(strlen($_POST['auditDates'][$i - 1]) == 10){
                $date = [$_POST['auditDates'][$i - 1], $_POST['auditStartHour' . $i], $_POST['auditEndHour' . $i]];
                array_push($datesToInsert, $date);
            }
        }

        foreach($datesToInsert as $dateToInsert){
            $audit->insertDate($dateToInsert);
        }

        $audit->fillIntro($_POST['controlType'] ?? null, $_POST['subcontracting'] ?? null, $_POST['structure'] ?? null, $_POST['clientNb'], $_POST['companyName'], $_POST['headOffice'], $_POST['auditedSites'], $_POST['controlledActivities'], $_POST['otherAuditors']);
        $audit->updateIntro();

        $participants = array_filter($_POST['participantN']);
        for ($i = 1; $i <= count($participants); $i++) {

            if(!empty(trim($_POST['participantN'][$i - 1], '')) && !empty(trim($_POST['participantP'][$i - 1], '')) && !empty(trim($_POST['participantF'][$i - 1], ''))){
                $participant = new Participant($_POST['participantN'][$i - 1], $_POST['participantP'][$i - 1], $_POST['participantF'][$i - 1], isset($_POST['presenceStep1-' . $i]) ? $_POST['presenceStep1-' . $i] : 0, isset($_POST['presenceStep2-' . $i]) ? $_POST['presenceStep2-' . $i] : 0, isset($_POST['presenceStep3-' . $i]) ? $_POST['presenceStep3-' . $i] : 0, isset($_POST['presenceStep4-' . $i]) ? $_POST['presenceStep4-' . $i] : 0);
                $participant->insert();
            }
        }

        switch($_POST['submit']){

            case lang['Finalize']:
                require_once('controllers/FinalizeController.php');
                $intro = new FinalizeController('default');
                return $intro->default();
            case lang['Next']:
                require_once('controllers/RiskController.php');
                $risk = new RiskController('default');
                return $risk->default();
            default:
                return $this->default();
        }
    }
}