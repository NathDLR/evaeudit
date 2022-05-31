<?php

class Grid
{

    private $db;
    private $lang;

    public function __construct()
    {
        $this->lang = strtoupper($_COOKIE['lang']);
        $this->db = Connexion::getConnexion();
    }

    public function getAllRequirementType()
    {
        $selectAllRequirementType = $this->db->prepare('SELECT REQUIREMENTTYPE_ID, LABEL_'.$this->lang.' LABEL 
                                                        FROM requirement_type');
        $selectAllRequirementType->execute();
        return $selectAllRequirementType->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllRequirement()
    {
        $selectAllRequirement = $this->db->prepare('SELECT REQUIREMENTTYPE_ID, REQUIREMENT_ID, REQUIREMENT_'.$this->lang.' REQUIREMENT, EVALUATION_METHOD_'.$this->lang.' EVALUATION_METHOD 
                                                    FROM requirement');
        $selectAllRequirement->execute();
        return $selectAllRequirement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllCriterion()
    {

        $selectAllCriterion = $this->db->prepare('SELECT REQUIREMENTTYPE_ID, REQUIREMENT_ID, C.ID_CRITERIA ID_LETTER, L.LABEL LETTER, L.POINT POINTS, C.DESCRIPTION_'.$this->lang.' DESCRIPTION, C.CORRECTION_'.$this->lang.' CORRECTION
                                                FROM criterion C
                                                INNER JOIN letter L ON C.ID_CRITERIA = L.ID_LETTER
                                                ORDER by C.REQUIREMENTTYPE_ID, C.REQUIREMENT_ID, C.ID_CRITERIA');
        $selectAllCriterion->execute();
        return $selectAllCriterion->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllHistory()
    {
        $selectAllHistory = $this->db->prepare('SELECT HISTORY_ID, LABEL_'.$this->lang.' LABEL FROM history');;
        $selectAllHistory->execute();
        return $selectAllHistory->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectAll($idAudit)
    {
        $Requirement_Type = $this->getAllRequirementType();
        $Requirement = $this->getAllRequirement();
        $Criterion = $this->getAllCriterion();
        $dataGrid = $this->getAllDataGrid($idAudit);

        $bigArray = [];
        $count = 0;
        $countCritere = 0;

        for ($i = 0; $i < count($Requirement_Type); $i++){
            $bigArray[$i] = [];
            $bigArray[$i]['title'] = $Requirement_Type[$i]['LABEL'];
            $bigArray[$i]['idRequireType'] = $Requirement_Type[$i]['REQUIREMENTTYPE_ID'];
            $bigArray[$i]['RequirementList'] = [];


            for ($j = 0; $j < count($Requirement); $j++){

                if ($Requirement[$j]['REQUIREMENTTYPE_ID'] == $Requirement_Type[$i]['REQUIREMENTTYPE_ID']){
                    $bigArray[$i]['RequirementList'][$count] = [];
                    $bigArray[$i]['RequirementList'][$count]['RequirementId'] = $Requirement[$j]['REQUIREMENTTYPE_ID'].'.'.$Requirement[$j]['REQUIREMENT_ID'];
                    $bigArray[$i]['RequirementList'][$count]['Requirement'] = $Requirement[$j]['REQUIREMENT'];
                    $bigArray[$i]['RequirementList'][$count]['EvaluationMethod'] = $Requirement[$j]['EVALUATION_METHOD'];
                    $bigArray[$i]['RequirementList'][$count]['Critere'] = [];
                    $bigArray[$i]['RequirementList'][$count]['DataList'] = $dataGrid[$j];
                    if (isset($dataGrid[$j]['ID_CRITERION']) || empty($dataGrid[$j]['ID_CRITERION'])){
                        $bigArray[$i]['RequirementList'][$count]['isChoose'] = true;
                    }else{
                        $bigArray[$i]['RequirementList'][$count]['isChoose'] = false;
                    }
                    for ($k = 0; $k < count($Criterion); $k++){
//                        if ($Criterion[$k]['LETTER'] != 'NA'){

                            if ($Criterion[$k]['REQUIREMENTTYPE_ID'] == $Requirement_Type[$i]['REQUIREMENTTYPE_ID'] && $Criterion[$k]['REQUIREMENT_ID'] == $Requirement[$j]['REQUIREMENT_ID']){
                                $bigArray[$i]['RequirementList'][$count]['Critere'][$countCritere] = [];
                                $bigArray[$i]['RequirementList'][$count]['Critere'][$countCritere]['idCriteria'] = $Criterion[$k]['ID_LETTER'];
                                $bigArray[$i]['RequirementList'][$count]['Critere'][$countCritere]['Letter'] = $Criterion[$k]['LETTER'];
                                $bigArray[$i]['RequirementList'][$count]['Critere'][$countCritere]['Description'] = $Criterion[$k]['DESCRIPTION'];
                                $bigArray[$i]['RequirementList'][$count]['Critere'][$countCritere]['Points'] = $Criterion[$k]['POINTS'];
                                $bigArray[$i]['RequirementList'][$count]['Critere'][$countCritere]['Correction'] = $Criterion[$k]['CORRECTION'];
                                if ($Criterion[$k]['ID_LETTER'] == $dataGrid[$j]['ID_CRITERION']) {
                                    $bigArray[$i]['RequirementList'][$count]['Critere'][$countCritere]['isSelected'] = 'selected';
                                }else{
                                    $bigArray[$i]['RequirementList'][$count]['Critere'][$countCritere]['isSelected'] = '';
                                }

                                $countCritere++;
                            }else{
                                $countCritere = 0;
                            }
//                        }
                    }
                    $count++;
                }else{
                    $count = 0;
                }
            }
        }
        return $bigArray;
    }

    public function setGrid($idAudit){
        for($i = 1; $i < ($this->getRow()+1); $i++){
            $insertReview = $this->db->prepare("INSERT INTO review (REVIEW_ID, AUDIT_ID) 
                                                VALUES(:reviewId,:auditId)
                                                ");
            $insertReview->bindParam(':reviewId', $i);
            $insertReview->bindParam(':auditId', $idAudit);
            $insertReview->execute();
        }
    }

    public function updateAll($aRisk, $row){
        $updateGridRow = $this->db->prepare("UPDATE review
                                            SET ID_CRITERION = :letterId,
                                                REQUIREMENTTYPE_ID = :requiementTypeId, 
                                                REQUIREMENT_ID = :requirementId, 
                                                AUDITOR_COMMENT = :auditorComment, 
                                                CORRECTION_COMMENT = :correctionComment 
                                            WHERE REVIEW_ID = :reviewId
                                            AND AUDIT_ID = :auditId");
        $updateGridRow->bindParam(':reviewId', $row);
        $updateGridRow->bindParam(':auditId', $aRisk['idAudit']);
        $updateGridRow->bindParam(':letterId', $aRisk['idLetter']);
        $updateGridRow->bindParam(':requiementTypeId', $aRisk['requirementTypeId']);
        $updateGridRow->bindParam(':requirementId', $aRisk['requirementId']);
        $updateGridRow->bindParam(':auditorComment', $aRisk['auditorComment']);
        $updateGridRow->bindParam(':correctionComment', $aRisk['correctionExtra']);
        $updateGridRow->execute();
    }

    public function getRow(){
        $selectRowGrid = $this->db->prepare("SELECT count(*) FROM requirement");
        $selectRowGrid->execute();
        return $selectRowGrid->fetch()[0];
    }

    public function getAllDataGrid($auditId){
        $selectAllDataReview= $this->db->prepare("SELECT * FROM review
                                                WHERE AUDIT_ID = :id");
        $selectAllDataReview->bindParam(':id', $auditId);
        $selectAllDataReview->execute();
        return $selectAllDataReview->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCdDataGrid($auditId){
        $selectAllDataReview= $this->db->prepare("SELECT R.REVIEW_ID, R.ID_CRITERION, CLIENT_NB, COMPANY_NAME, L.LABEL LETTER, H.LABEL_$this->lang HISTORY, CONCAT(RE.REQUIREMENTTYPE_ID, '.', RE.REQUIREMENT_ID) REF, RE.REQUIREMENT_$this->lang REQUIREMENT, R.AUDITOR_COMMENT, C.CORRECTION_$this->lang CORRECTION, R.LIMIT_DATE, R.RETURN_DATE, R.OPERATOR_IN_CHARGE, R.OPERATOR_COMMENT, R.ATTACHMENT, E.LABEL_$this->lang EXAMEN, R.LIBERATION_DATE, R.LIBERATION_COMMENT
                                                FROM review R
                                                INNER JOIN audit A ON R.AUDIT_ID = A.AUDIT_ID
                                                LEFT JOIN eve_exam E ON R.EXAM_ID = E.EXAM_ID
                                                LEFT JOIN history H ON R.HISTORY_ID = H.HISTORY_ID
                                                INNER JOIN criterion C ON R.ID_CRITERION = C.ID_CRITERIA 
                                                    AND R.REQUIREMENTTYPE_ID = C.REQUIREMENTTYPE_ID 				 
                                                    AND R.REQUIREMENT_ID = C.REQUIREMENT_ID
                                                INNER JOIN requirement RE ON C.REQUIREMENT_ID = RE.REQUIREMENT_ID
                                                	AND C.REQUIREMENTTYPE_ID = RE.REQUIREMENTTYPE_ID
                                                INNER JOIN letter L ON C.ID_CRITERIA = L.ID_LETTER
                                                WHERE R.AUDIT_ID = :idAudit 
                                                AND (R.ID_CRITERION = 3 OR ID_CRITERION = 4)
                                                ORDER BY R.REVIEW_ID");
        $selectAllDataReview->bindParam(':idAudit', $auditId);
        $selectAllDataReview->execute();
        return $selectAllDataReview->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getExamEve(){
        $selectAllDataReview= $this->db->prepare("SELECT EXAM_ID, LABEL_$this->lang LABEL  FROM eve_exam");
        $selectAllDataReview->execute();
        return $selectAllDataReview->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectForPDF($id) :array{

        $stmt_total = "
        SELECT SUM(letter.POINT) AS `TOTAL`
        from review
        INNER JOIN criterion ON review.ID_CRITERION = criterion.ID_CRITERIA 
                                    AND review.REQUIREMENTTYPE_ID = criterion.REQUIREMENTTYPE_ID 				 
                                    AND review.REQUIREMENT_ID = criterion.REQUIREMENT_ID
        INNER JOIN letter ON criterion.ID_CRITERIA = letter.ID_LETTER
        WHERE AUDIT_ID = :AUDIT_ID                
        GROUP BY AUDIT_ID";

        $stmt_max = "SELECT ( (SELECT (count(*)*20) FROM `criterion` GROUP BY criterion.ID_CRITERIA LIMIT 1) - (SELECT COUNT(*)*20 FROM review WHERE review.ID_CRITERION = 5 AND AUDIT_ID = :AUDIT_ID)) AS MAX";

        $grid = $this->selectAll($id);

        $gridQuery = $this->db->prepare($stmt_total);
        $gridQuery->bindParam('AUDIT_ID', $id, PDO::PARAM_INT);
        $gridQuery->execute();
        $grid['TOTAL'] = $gridQuery->fetch(PDO::FETCH_ASSOC)['TOTAL'] ?? 0;

        $max = $this->db->prepare($stmt_max);
        $max->bindParam('AUDIT_ID', $id, PDO::PARAM_INT);
        $max->execute();
        $grid['MAX'] = $max->fetch(PDO::FETCH_ASSOC)['MAX'];

        return $grid;
    }

    public function updateCapa($aRisk){
        $updateGridRow = $this->db->prepare("UPDATE review
                                            SET EXAM_ID	= :exameId, 
                                                HISTORY_ID = :historyId, 
                                                LIMIT_DATE = :limitDate, 
                                                RETURN_DATE = :returnDate, 
                                                OPERATOR_IN_CHARGE = :operatorinCharge, 
                                                OPERATOR_COMMENT = :operatrComment, 
                                                ATTACHMENT = :attachement, 
                                                LIBERATION_DATE = :liberationDate, 
                                                LIBERATION_COMMENT = :liberationComment
                                            WHERE REVIEW_ID = :reviewId
                                            AND AUDIT_ID = :auditId");
        $updateGridRow->bindParam(':reviewId', $aRisk['reviewId']);
        $updateGridRow->bindParam(':auditId', $aRisk['idAudit']);
        $updateGridRow->bindParam(':exameId', $aRisk['examId']);
        $updateGridRow->bindParam(':historyId', $aRisk['historyId']);
        $updateGridRow->bindParam(':limitDate', $aRisk['limitDate']);
        $updateGridRow->bindParam(':returnDate', $aRisk['returnDate']);
        $updateGridRow->bindParam(':operatorinCharge', $aRisk['operatorInCharge']);
        $updateGridRow->bindParam(':operatrComment', $aRisk['operatorComment']);
        $updateGridRow->bindParam(':attachement', $aRisk['attachement']);
        $updateGridRow->bindParam(':liberationDate', $aRisk['liberationDate']);
        $updateGridRow->bindParam(':liberationComment', $aRisk['liberationComment']);
        $updateGridRow->execute();
    }

    public function reformNull($anSqlList){

        if (!empty($anSqlList)) {
            for ($i = 0; $i < count($anSqlList); $i++) {
                $ListKeys = array_keys($anSqlList[$i], '');
                foreach ($ListKeys as $Champs) {
                    $anSqlList[$i][$Champs] = ' - ';
                }
            }
            $anSqlList[0]['stat'] = 'good';
        }else{
            $anSqlList[0]['stat'] = 'pas de donnée';
        }
        return $anSqlList;
    }
}


