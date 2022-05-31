<?php

include_once 'Connexion.php';
include_once 'Mail.php';

class Audit
{
    private $db;
    private $auditId;

    private $coAuditor;
    private $controlTypeId;
    private $subcontractingId;
    private $structureId;
    private $statusId;
    private $clientNb;
    private $companyName;
    private $headOffice;
    private $auditedSite;
    private $startHour;
    private $endHour;
    private $controlledActivity;
    private $auditorConclusion;
    private $vigilance;
    private $recommendation;
    private $complementaryAudit;
    private $unannouncedControl;
    private $auditorOpinion;
    private $adminOpinion;
    private $attachment;
    private $attachmentDetails;
    private $lang;

    /**
     * Set the lang to select for database and get connexion Singleton
     */

    public function __construct()
    {
        $this->lang = strtoupper($_COOKIE['lang']);
        $this->db = Connexion::getConnexion();
    }

    // Set les variables correspondant à l'introduction

    /**
     * Set all information related to the introduction to the object Audit
     *
     * @param $controlTypeId
     * @param $subcontractingId
     * @param $structureId
     * @param $clientNb
     * @param $companyName
     * @param $headOffice
     * @param $auditedSite
     * @param $controlledActivity
     * @param $coAuditor
     * @return void
     */
    public function fillIntro($controlTypeId, $subcontractingId, $structureId, $clientNb, $companyName, $headOffice, $auditedSite, $controlledActivity, $coAuditor)
    {
        $this->setControlTypeId($controlTypeId);
        $this->setSubcontractingId($subcontractingId);
        $this->setStructureId($structureId);
        $this->setStatusId(1);
        $this->setClientNb($clientNb);
        $this->setCompanyName($companyName);
        $this->setHeadOffice($headOffice);
        $this->setAuditedSite($auditedSite);
        $this->setControlledActivity($controlledActivity);
        $this->setCoAuditor($coAuditor);
    }

    // Set les variables correspondant à la conclusion

    /**
     * Set all information related to the conclusion to the object Audit
     *
     * @param $auditorConclusion
     * @param $vigilance
     * @param $recommendation
     * @param $complementaryAudit
     * @param $unannouncedControl
     * @param $attachment
     * @param $attachmentDetails
     * @param $auditorOpinion
     * @param $adminOpinion
     * @return void
     */
    public function fillConclusion($auditorConclusion, $vigilance, $recommendation, $complementaryAudit, $unannouncedControl, $attachment, $attachmentDetails, $auditorOpinion, $adminOpinion)
    {
        $this->setAuditorConclusion($auditorConclusion);
        $this->setVigilance($vigilance);
        $this->setRecommendation($recommendation);
        $this->setComplementaryAudit($complementaryAudit);
        $this->setUnannouncedControl($unannouncedControl);
        $this->setAttachment($attachment);
        $this->setAttachmentDetails($attachmentDetails);
        $this->setAuditorOpinion($auditorOpinion);
        $this->setAdminOpinion($adminOpinion);

    }

    /**
     * Insert an empty audit when its created except for users related to it and the company name
     *
     * @param $auditorId
     * @param $adminId
     * @param $companyName
     * @return void
     */
    public function insert($companyName, $creation_date, $status, $orderFormId)
    {
        $stmt = "INSERT INTO `audit` (COMPANY_NAME, CREATION_DATE, STATUS_ID) VALUES (:companyName, :date, :status);";
        $query = $this->db->prepare($stmt);
        $query->bindValue(':companyName', $companyName, PDO::PARAM_STR);
        $query->bindValue(':date', $creation_date, PDO::PARAM_STR);
        $query->bindValue(':status', $status, PDO::PARAM_STR);
        $query->execute();

        $id = $this->db->lastInsertId();

        $stmt = "UPDATE `order_form` SET AUDIT_ID = :auditId, STATUS = 1 WHERE ORDER_FORM_ID = :orderId";
        $query = $this->db->prepare($stmt);
        $query->bindValue(':auditId', $id, PDO::PARAM_STR);
        $query->bindValue(':orderId', $orderFormId, PDO::PARAM_STR);
        $query->execute();

        return $id;
    }

    // Mise a jour de l'introduction du rapport depuis le formulaire

    /**
     * Update all information related to the introduction of an audit
     *
     * @return void
     */
    public function updateIntro()
    {
        try {
            $stmt = "UPDATE `audit` SET `CONTROL_TYPE_ID` = :CONTROL_TYPE_ID, `SUBCONTRACTING_ID` = :SUBCONTRACTING_ID, `STRUCTURE_ID` = :STRUCTURE_ID, `CLIENT_NB` = :CLIENT_NB, `COMPANY_NAME` = :COMPANY_NAME, `HEAD_OFFICE` = :HEAD_OFFICE, `AUDITED_SITE` = :AUDITED_SITE, `CONTROLLED_ACTIVITY` = :CONTROLLED_ACTIVITY, `CO_AUDITOR` = :CO_AUDITOR WHERE AUDIT_ID = :AUDIT_ID";
            $query = $this->db->prepare($stmt);
            $query->bindParam(':CONTROL_TYPE_ID', $this->controlTypeId, PDO::PARAM_INT);
            $query->bindParam(':SUBCONTRACTING_ID', $this->subcontractingId, PDO::PARAM_INT);
            $query->bindParam(':STRUCTURE_ID', $this->structureId, PDO::PARAM_INT);
            $query->bindParam(':CLIENT_NB', $this->clientNb, PDO::PARAM_STR);
            $query->bindParam(':COMPANY_NAME', $this->companyName, PDO::PARAM_STR);
            $query->bindParam(':HEAD_OFFICE', $this->headOffice, PDO::PARAM_STR);
            $query->bindParam(':AUDITED_SITE', $this->auditedSite, PDO::PARAM_STR);
            $query->bindParam(':CONTROLLED_ACTIVITY', $this->controlledActivity, PDO::PARAM_STR);
            $query->bindParam(':CO_AUDITOR', $this->coAuditor, PDO::PARAM_STR);
            $query->bindParam(':AUDIT_ID', $_SESSION['auditId'], PDO::PARAM_INT);
            $query->execute();
        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }

    /**
     *  Insert or Update a date and its corresponding hours with the good format for MySQL
     *
     * @param array $date
     * @return void
     */
    public function insertDate(array $date)
    {
        $date[0] = $date[0];
        $date[1] = $date[1] ? $date[1] . ":00" : null;
        $date[2] = $date[2] ? $date[2] . ":00" : null;

        $stmt = "INSERT INTO `audit_date` (AUDIT_ID, DATE, START_HOUR, END_HOUR)
             VALUES (:AUDIT_ID, :DATE, :START_HOUR, :END_HOUR)
             ON DUPLICATE KEY UPDATE START_HOUR = VALUES(START_HOUR), END_HOUR = VALUES(END_HOUR)";
        $query = $this->db->prepare($stmt);

        $query->bindParam(":AUDIT_ID", $_SESSION['auditId'], PDO::PARAM_INT);
        $query->bindParam(":DATE", $date[0], PDO::PARAM_STR);
        $query->bindParam(":START_HOUR", $date[1], PDO::PARAM_STR);
        $query->bindParam(":END_HOUR", $date[2], PDO::PARAM_STR);

        $query->execute();

    }

    /**
     * Delete a date( Date, Starting hour, Ending hour ) by its ID if he belongs to the audit
     *
     * @param $date
     * @return void
     */
    public function deleteDate($date)
    {
        $stmt = "DELETE FROM audit_date WHERE DATE = :DATE AND AUDIT_ID = :AUDIT_ID";
        $query = $this->db->prepare($stmt);
        $query->bindParam(':AUDIT_ID', $_SESSION['auditId'], PDO::PARAM_INT);
        $query->bindParam(':DATE', $date, PDO::PARAM_STR);
        $query->execute();
    }

    // Supprime un participant de l'audit

    /**
     * Delete a participant by its ID if he belongs to the audit
     *
     * @param $id
     * @return void
     */
    public function deleteParticipant($id)
    {
        $stmt = "DELETE FROM participant WHERE PARTICIPANT_ID = :PARTICIPANT_ID AND AUDIT_ID = :AUDIT_ID";
        $query = $this->db->prepare($stmt);
        $query->bindParam(':AUDIT_ID', $_SESSION['auditId'], PDO::PARAM_INT);
        $query->bindParam(':PARTICIPANT_ID', $id, PDO::PARAM_STR);
        $query->execute();
    }

    // Mise a jour de la conclusion du rapport depuis le formulaire

    /**
     * Update all information related to the conclusion of an audit
     *
     * @return void
     */
    public function updateConclusion()
    {
        try {
            $stmt = "UPDATE `audit` SET `AUDITOR_CONCLUSION` = :AUDITOR_CONCLUSION, `VIGILANCE` = :VIGILANCE, `RECOMMENDATION` = :RECOMMENDATION, `COMPLEMENTARY_AUDIT` = :COMPLEMENTARY_AUDIT, `UNANNOUNCED_CONTROL` = :UNANNOUNCED_CONTROL, `ATTACHMENT` = :ATTACHMENT, `ATTACHMENT_DETAILS` = :ATTACHMENT_DETAILS WHERE AUDIT_ID = :AUDIT_ID";
            $query = $this->db->prepare($stmt);
            $query->bindParam(':AUDITOR_CONCLUSION', $this->auditorConclusion, PDO::PARAM_STR);
            $query->bindParam(':VIGILANCE', $this->vigilance, PDO::PARAM_STR);
            $query->bindParam(':COMPLEMENTARY_AUDIT', $this->complementaryAudit, PDO::PARAM_BOOL);
            $query->bindParam(':UNANNOUNCED_CONTROL', $this->unannouncedControl, PDO::PARAM_BOOL);
            $query->bindParam(':RECOMMENDATION', $this->recommendation, PDO::PARAM_STR);
            $query->bindParam(':ATTACHMENT', $this->attachment, PDO::PARAM_BOOL);
            $query->bindParam(':ATTACHMENT_DETAILS', $this->attachmentDetails, PDO::PARAM_STR);
            $query->bindParam(':AUDIT_ID', $_SESSION['auditId'], PDO::PARAM_INT);

            $query->execute();

            if (isset($this->auditorOpinion)) {
                $this->insertOrUpdateOpinion();
            }

            if (isset($this->adminOpinion)) {
                $this->insertOrUpdateOpinion();
            }

        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }


    /**
     * Select all audits of the auditor with necessary information
     *
     * @return mixed
     */
    public function selectAll()
    {
        $stmt = "SELECT audit.AUDIT_ID, audit.COMPANY_NAME, STATUS_ID, FINALIZATION_DATE, audit.CREATION_DATE 
                    FROM audit 
                        INNER JOIN order_form ON audit.AUDIT_ID = order_form.AUDIT_ID 
                        INNER JOIN editor ON order_form.ORDER_FORM_ID = editor.ORDER_FORM_ID 
                    WHERE editor.USER_ID = :auditorId 
                    AND STATUS_ID IN (0, 1, 2, 3)";
            $query = $this->db->prepare($stmt);
            $query->bindParam(':auditorId', $_SESSION['userId'], PDO::PARAM_INT);
            $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * Select all the audits of the certification officer with necessary information
     *
     * @return array
     */
    public function selectAllForAdmin(): array
    {
        $stmt = "SELECT audit.AUDIT_ID, audit.COMPANY_NAME, audit.STATUS_ID, status.LABEL_$this->lang AS STATUS 
                    FROM audit 
                        INNER JOIN order_form ON audit.AUDIT_ID = order_form.AUDIT_ID 
                        INNER JOIN editor ON order_form.ORDER_FORM_ID = editor.ORDER_FORM_ID 
                        INNER JOIN status ON audit.STATUS_ID = status.STATUS_ID 
                    WHERE USER_ID = :adminId 
                    ORDER BY audit.STATUS_ID ASC";

        $allAudits = $this->db->prepare($stmt);
        $allAudits->bindParam(':adminId', $_SESSION['userId'], PDO::PARAM_INT);
        $allAudits->execute();

        $dbAudits = $allAudits->fetchAll(PDO::FETCH_ASSOC);

        $audits['active'] = [];
        $audits['archived'] = [];

        foreach ($dbAudits as $audit) {
            if ($audit['STATUS_ID'] == 6) {
                array_push($audits['archived'], $audit);
            } else {
                array_push($audits['active'], $audit);
            }
        }

        $stmt = "SELECT CONCAT(user.NAME, ' ', user.FIRSTNAME) AS NAME, editor.ORDER_FORM_ID

                FROM editor 
                    INNER JOIN user ON editor.USER_ID = user.USER_ID 
                                           AND user.ROLE_ID = 2";
        $auditors = $this->db->prepare($stmt);
        $auditors->execute();
        $auditors = $auditors->fetchAll(PDO::FETCH_ASSOC);
        foreach ($auditors as $auditor) {
            $auditors[$auditor['ORDER_FORM_ID']] = $auditor['NAME'];
        }

        /*echo '<pre>';
        print_r($auditors);
        echo '</pre>';
        die();*/
        foreach ($audits['active'] as $key => $audit) {
            $audits['active'][$key]['AUDITOR'] = $auditors[$audit['AUDIT_ID']+1];
        }
        foreach ($audits['archived'] as $key => $audit) {
            $audits['archived'][$key]['AUDITOR'] = $auditors[$audit['AUDIT_ID']];
        }

        return $audits;
    }


    /**
     * Select all information of an audit except Risks and Audit grid
     *
     * @param $id
     * @param string $use
     * @return mixed |void
     * @throws Exception
     */
    public function selectOne($id = null, string $use = 'edit')
    {
        $this->auditId = $id ?? $_SESSION['auditId'];

        $status = '';

        // L'auditeur ne peut sélectionner que les audits au statut 0 - créé, ou 1- sauf si
        // c'est pour prévisualiser son rapport, statut 2 - Envoyé autorisé
        if ($_SESSION['role'] == 'auditor') {
            switch ($use) {
                case 'pdf':
                    break;
                default:
                    $status = 'AND STATUS_ID IN (0,1)';
                    break;
            }
        }

        $result = $this->getAudit($status);

        $audit = $result[0];

        // Si l'audit a été récupéré, la sélection continue, sinon retour a l'accueil
        if (!empty($audit['AUDIT_ID'])) {

            $audit['ADMIN'] = ['NAME' => $result[0]['NAME'],
                'FIRSTNAME' => $result[0]['FIRSTNAME'],
                'ID' => $result[0]['USER_ID']];
            $audit['AUDITOR'] = ['NAME' => $result[1]['NAME'],
                'FIRSTNAME' => $result[1]['FIRSTNAME'],
                'ID' => $result[1]['USER_ID']];


            // If the user is an auditor, check that the audit belongs to him, if not, send him to the home page

            if (($audit['AUDITOR']['ID'] != $_SESSION['userId'] && $_SESSION['role'] == 'auditor')) {
                require_once 'controllers/AuthController.php';
                $controller = new AuthController(['', 'goToYourIndex']);
                $controller->goToYourIndex();
            }

            $audit['dates'] = $this->getDatesByAudit($this->auditId);

            $audit['activity'] = $this->getActivityDetails();

            $audit['total_time'] = $this->getAuditTotalTime();

            $audit['participants'] = $this->getAuditParticipants();

            $opinions = $this->getAuditOpinions();

            $audit['AUDITOR_OPINION'] = $opinions[0] ?? [];
            $audit['ADMIN_OPINION'] = $opinions[1] ?? [];

            // Change les informations de session seulement si ce n'est pas pour visualiser l'audit
            if ($use !== 'pdf') {
                $_SESSION['auditId'] = intval($this->auditId);
                $_SESSION['companyName'] = $audit['COMPANY_NAME'];
            }

            if ($audit['STATUS_ID'] == 0) {
                $this->changeStatus(1);
            } elseif ($audit['STATUS_ID'] == 2) {
                $this->changeStatus(3, $audit["AUDIT_ID"]);
            }

            return $audit;

        } else {
            require_once 'controllers/AuthController.php';
            $controller = new AuthController(['', 'goToYourIndex']);
            $controller->goToYourIndex();
        }
    }

    /**
     * @param $idAudit
     * @return mixed
     */
    public function getDatesByAudit($idAudit)
    {
        $stmt = "SELECT audit_date.AUDIT_ID, DATE, START_HOUR, END_HOUR FROM audit_date
                        INNER JOIN audit ON audit_date.AUDIT_ID = audit.AUDIT_ID
                        WHERE audit.AUDIT_ID = :auditId";
        $query = $this->db->prepare($stmt);
        $query->bindParam(':auditId', $idAudit, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $status
     * @param $auditId
     * @return void
     */
    public function changeStatus($status, $auditId = null)
    {
        if ($auditId == null) {
            $auditId = $_SESSION['auditId'];
        }
        $updateRiskAudit = $this->db->prepare('UPDATE audit
                                            SET STATUS_ID = :STATUS_ID
                                            WHERE AUDIT_ID = :AUDIT_ID');
        $updateRiskAudit->bindParam(':STATUS_ID', $status, PDO::PARAM_INT);
        $updateRiskAudit->bindParam(':AUDIT_ID', $auditId, PDO::PARAM_INT);
        $updateRiskAudit->execute();
    }

    /**
     * @param $idRisk
     * @param $idAudit
     * @return void
     */
    public function updateRiskAudit($idRisk, $idAudit)
    {
        $updateRiskAudit = $this->db->prepare('UPDATE audit 
                                            SET RISKNOTATION_ID = :idRisk
                                            WHERE AUDIT_ID = :idAudit');
        $updateRiskAudit->bindParam(':idRisk', $idRisk, PDO::PARAM_INT);
        $updateRiskAudit->bindParam(':idAudit', $idAudit, PDO::PARAM_INT);
        $updateRiskAudit->execute();
    }

    // Met le statut à 2, l'auditeur ne pourra plus le sélectionner

    /**
     * @return void
     */
    public function finalize()
    {
        $stmt = "UPDATE `audit` SET `STATUS_ID` = 2, `FINALIZATION_DATE` = :FINALIZATION_DATE WHERE AUDIT_ID = :AUDIT_ID";
        $query = $this->db->prepare($stmt);
        $query->bindParam(':AUDIT_ID', $_SESSION['auditId'], PDO::PARAM_INT);

        $date = date('Y-m-d');

        $query->bindParam(':FINALIZATION_DATE', $date, PDO::PARAM_STR);
        $query->execute();

        //$mail = new Mail();
        //$mail->sendNotif();
    }

    /**
     * @return mixed
     */
    public function selectNotifs()
    {
        $status = '0';
        if ($_SESSION['role'] == 'admin') {
            $status = 2;
        }
        $stmt = "SELECT audit.COMPANY_NAME, audit.AUDIT_ID 
                    FROM audit 
                        INNER JOIN order_form ON audit.ORDER_FORM_ID = order_form.ORDER_FORM_ID 
                        INNER JOIN editor ON order_form.ORDER_FORM_ID = editor.ORDER_FORM_ID 
                    WHERE editor.USER_ID = :auditorId 
                      AND STATUS_ID = :status";
        $query = $this->db->prepare($stmt);
        $query->bindParam(':auditorId', $_SESSION['userId'], PDO::PARAM_INT);
        $query->bindValue('status', $status, PDO::PARAM_INT);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return array|mixed
     */
    private function getActivityDetails()
    {
        $stmt = "SELECT subcontracting.LABEL_$this->lang as ST_LABEL, control_type.LABEL_$this->lang as CT_LABEL, structure.LABEL_$this->lang as S_LABEL
                        FROM audit
                        INNER JOIN structure ON audit.STRUCTURE_ID = structure.STRUCTURE_ID
                        INNER JOIN subcontracting ON audit.SUBCONTRACTING_ID = subcontracting.SUBCONTRACTING_ID
                        INNER JOIN control_type ON audit.CONTROL_TYPE_ID = control_type.CONTROL_TYPE_ID
                        WHERE AUDIT_ID = :AUDIT_ID";
        $query = $this->db->prepare($stmt);
        $query->bindParam(':AUDIT_ID', $this->auditId, PDO::PARAM_INT);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC)[0] ?? [];
    }

    /**
     * @param $status
     * @return mixed
     */
    private function getAudit($status)
    {
        $stmt = "SELECT * FROM audit                        
			INNER JOIN order_form ON audit.AUDIT_ID = order_form.AUDIT_ID
            INNER JOIN editor ON order_form.ORDER_FORM_ID = editor.ORDER_FORM_ID
            INNER JOIN user ON editor.USER_ID = user.USER_ID
            INNER JOIN role ON user.ROLE_ID = role.ROLE_ID
            WHERE audit.AUDIT_ID = :auditId
            " . $status . "
            ORDER BY `role`.`ROLE_ID` ASC";
        $query = $this->db->prepare($stmt);
        $query->bindParam(':auditId', $this->auditId, PDO::PARAM_INT);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return mixed|string
     */
    private function getAuditTotalTime()
    {
        $stmt = "SELECT time_format(SUM(abs(timediff(`START_HOUR`, `END_HOUR`))),'%H\h%i') as SUM from audit_date WHERE AUDIT_ID = :AUDIT_ID GROUP BY AUDIT_ID";
        $query = $this->db->prepare($stmt);
        $query->bindParam(':AUDIT_ID', $this->auditId, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC)[0]['SUM'] ?? '00:00';
    }

    /**
     * @return mixed
     */
    private function getAuditParticipants()
    {
        $stmt = "SELECT * 
                        FROM participant
                        WHERE participant.AUDIT_ID = :auditId
                        ORDER BY PARTICIPANT_ID";
        $query = $this->db->prepare($stmt);
        $query->bindParam(':auditId', $this->auditId, PDO::PARAM_INT);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return mixed
     */
    private function getAuditOpinions()
    {
        $stmt = "SELECT comment.OPINION_ID, comment.AUDIT_ID, comment.USER_ID, opinion.LABEL_$this->lang AS LABEL
                        FROM comment
                        INNER JOIN user ON comment.USER_ID = user.USER_ID
                        INNER JOIN opinion ON comment.OPINION_ID = opinion.OPINION_ID
                        WHERE comment.AUDIT_ID = :auditId
                        ORDER BY user.ROLE_ID DESC";
        $query = $this->db->prepare($stmt);
        $query->bindParam(':auditId', $this->auditId, PDO::PARAM_INT);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     *  Insert or update if opinion already exist for this audit and person
     *
     * @return void
     */
    private function insertOrUpdateOpinion()
    {
        $stmt = "INSERT INTO comment (OPINION_ID, AUDIT_ID, USER_ID) VALUES (:OPINION_ID, :AUDIT_ID, :USER_ID) ON DUPLICATE KEY UPDATE OPINION_ID = VALUES(OPINION_ID)";
        $query = $this->db->prepare($stmt);

        if ($this->adminOpinion == -1) {
            $this->setAdminOpinion(null);
        }

        $query->bindParam(':OPINION_ID', $this->adminOpinion, PDO::PARAM_INT);
        $query->bindParam(':AUDIT_ID', $_SESSION['auditId'], PDO::PARAM_INT);
        $query->bindParam(':USER_ID', $_SESSION['userId'], PDO::PARAM_INT);

        $query->execute();
    }

    // <editor-fold defaultstate="collapsed" desc="Getters & Setters">


    /**
     * @return integer
     */
    public function getControlTypeId(): int
    {
        return $this->controlTypeId;
    }

    /**
     * @param integer $controlTypeId
     */
    public function setControlTypeId($controlTypeId): void
    {
        $this->controlTypeId = $controlTypeId ?: null;

    }

    /**
     * @return mixed
     */
    public function getSubcontractingId(): int
    {
        return $this->subcontractingId;
    }

    /**
     * @param mixed $subcontractingId
     */
    public function setSubcontractingId($subcontractingId): void
    {
        $this->subcontractingId = $subcontractingId ?: null;
    }

    /**
     * @return mixed
     */
    public function getStructureId()
    {
        return $this->structureId;
    }

    /**
     * @param mixed $structureId
     */
    public function setStructureId($structureId): void
    {
        $this->structureId = $structureId ?: null;
    }

    /**
     * @return mixed
     */
    public function getStatusId()
    {
        return $this->statusId;
    }

    /**
     * @param mixed $statusId
     */
    public function setStatusId($statusId): void
    {
        $this->statusId = $statusId ?: null;
    }

    /**
     * @return mixed
     */
    public function getClientNb()
    {
        return $this->clientNb;
    }

    /**
     * @param mixed $clientNb
     */
    public function setClientNb($clientNb): void
    {
        $this->clientNb = $clientNb ?: null;
    }

    /**
     * @return mixed
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @param mixed $companyName
     */
    public function setCompanyName($companyName): void
    {
        $this->companyName = $companyName ?: null;
    }

    /**
     * @return mixed
     */
    public function getHeadOffice()
    {
        return $this->headOffice;
    }

    /**
     * @param mixed $headOffice
     */
    public function setHeadOffice($headOffice): void
    {
        $this->headOffice = $headOffice ?: null;
    }

    /**
     * @return mixed
     */
    public function getAuditedSite()
    {
        return $this->auditedSite;
    }

    /**
     * @param mixed $auditedSite
     */
    public function setAuditedSite($auditedSite): void
    {
        $this->auditedSite = $auditedSite ?: null;
    }

    /**
     * @return mixed
     */
    public function getStartHour()
    {
        return $this->startHour;
    }

    /**
     * @param mixed $startHour
     */
    public function setStartHour($startHour): void
    {
        $this->startHour = $startHour ?: null;
    }

    /**
     * @return mixed
     */
    public function getEndHour()
    {
        return $this->endHour;
    }

    /**
     * @param mixed $endHour
     */
    public function setEndHour($endHour): void
    {
        $this->endHour = $endHour ?: null;
    }

    /**
     * @return mixed
     */
    public function getControlledActivity()
    {
        return $this->controlledActivity;
    }

    /**
     * @param mixed $controlledActivity
     */
    public function setControlledActivity($controlledActivity): void
    {
        $this->controlledActivity = $controlledActivity ?: null;
    }

    /**
     * @return mixed
     */
    public function getAuditorConclusion()
    {
        return $this->auditorConclusion;
    }

    /**
     * @param mixed $auditorConclusion
     */
    public function setAuditorConclusion($auditorConclusion): void
    {
        $this->auditorConclusion = $auditorConclusion ?: null;
    }

    /**
     * @return mixed
     */
    public function getVigilance()
    {
        return $this->vigilance;
    }

    /**
     * @param mixed $vigilance
     */
    public function setVigilance($vigilance): void
    {
        $this->vigilance = $vigilance ?: null;
    }

    /**
     * @return mixed
     */
    public function getRecommendation()
    {
        return $this->recommendation;
    }

    /**
     * @param mixed $recommendation
     */
    public function setRecommendation($recommendation): void
    {
        $this->recommendation = $recommendation ?: null;
    }

    /**
     * @return mixed
     */
    public function getComplementaryAudit()
    {
        return $this->complementaryAudit;
    }

    /**
     * @param mixed $complementaryAudit
     */
    public function setComplementaryAudit($complementaryAudit): void
    {
        $this->complementaryAudit = $complementaryAudit ?: 0;
    }

    /**
     * @return mixed
     */
    public function getUnannouncedControl()
    {
        return $this->unannouncedControl;
    }

    /**
     * @param mixed $unannouncedControl
     */
    public function setUnannouncedControl($unannouncedControl): void
    {
        $this->unannouncedControl = $unannouncedControl ?: 0;
    }

    /**
     * @return mixed
     */
    public function getAttachment()
    {
        return $this->attachment;
    }

    /**
     * @param mixed $attachment
     */
    public function setAttachment($attachment): void
    {
        $this->attachment = $attachment ?: 0;
    }

    /**
     * @return mixed
     */
    public function getAttachmentDetails()
    {
        return $this->attachmentDetails;
    }

    /**
     * @param mixed $attachmentDetails
     */
    public function setAttachmentDetails($attachmentDetails): void
    {
        $this->attachmentDetails = $attachmentDetails ?: null;
    }

    /**
     * @return mixed
     */
    public function getCoAuditor()
    {
        return $this->coAuditor;
    }

    /**
     * @param mixed $coAuditor
     */
    public function setCoAuditor($coAuditor): void
    {
        $this->coAuditor = $coAuditor ?: null;
    }

    /**
     * @return mixed
     */
    public function getAuditorOpinion()
    {
        return $this->auditorOpinion;
    }

    /**
     * @param mixed $auditorOpinion
     */
    public function setAuditorOpinion($auditorOpinion): void
    {
        $this->auditorOpinion = $auditorOpinion ?: null;
    }

    /**
     * @return mixed
     */
    public function getAdminOpinion()
    {
        return $this->adminOpinion;
    }

    /**
     * @param mixed $adminOpinion
     */
    public function setAdminOpinion($adminOpinion): void
    {
        $this->adminOpinion = $adminOpinion ?: null;
    }

// </editor-fold>


}