<?php

class Risk
{
    private $db;
    private $lang;

    public function __construct()
    {
        $this->lang = strtoupper($_COOKIE['lang']);
        $this->db = Connexion::getConnexion();
    }

    /**
     * @return mixed
     */
    public function selectAll()
    {
        $selectAllRisk = $this->db->prepare('SELECT RISK_ID, PRODUCTION_CONDITION_'.$this->lang.' PRODUCTION_CONDITION, VALUE FROM risk');
        $selectAllRisk->execute();
        return $selectAllRisk->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     *
     * @return mixed
     */
    public function getAllRiskNotation(){
        $selectAllRiskNoation = $this->db->prepare('SELECT RISKNOTATION_ID, NAME_'. $this->lang .' AS NAME, VALUE_START, VALUE_END FROM risk_notation');
        $selectAllRiskNoation->execute();
        return $selectAllRiskNoation->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Calculate the maximum risk value from db
     *
     * @return mixed
     */
    public function getMaxRisk(){
        $selectMaxValue = $this->db->prepare('SELECT SUM(VALUE) AS MAX FROM risk');
        $selectMaxValue->execute();
        return $selectMaxValue->fetchAll(PDO::FETCH_ASSOC)[0]['MAX'];
    }

    /**
     * Create all the risks (empty) for an audit
     *
     * @param $idAudit
     * @return void
     */
    public function setAllRisk($idAudit)
    {
        for($i = 1; $i < 10; $i++){
            $insertEvaluate = $this->db->prepare("INSERT INTO evaluate (RISk_ID, AUDIT_ID) 
                                                VALUES(:riskId,:auditId)");
            $insertEvaluate->bindParam(':riskId', $i);
            $insertEvaluate->bindParam(':auditId', $idAudit);
            $insertEvaluate->execute();
        }
    }


    /**
     * Update db risks with auditor's information
     *
     * @param $aRisk
     * @return void
     *
     */
    public function updateAll($aRisk)
    {
        $insertEvaluate = $this->db->prepare("UPDATE evaluate
                                            SET RESULT = :result, CONTAMINATION = :contamination, AUDITOR_COMMENT	= :comment
                                            WHERE RISK_ID = :riskId
                                            AND AUDIT_ID = :auditId");
        $insertEvaluate->bindParam(':riskId', $aRisk['idRisk']);
        $insertEvaluate->bindParam(':auditId', $aRisk['idAudit']);
        $insertEvaluate->bindParam(':result', $aRisk['isResult']);
        $insertEvaluate->bindParam(':contamination', $aRisk['contamination']);
        $insertEvaluate->bindParam(':comment', $aRisk['comment']);
        $insertEvaluate->execute();
    }

    /**
     * Get all the risk table filled with auditor's information
     *
     * @param int $id ID of the audit report
     *
     * @return array
     */

    public function getAllEvaluateRiskByAudit(int $id): array
    {
        $selectAllEvaluateRisks = $this->db->prepare("SELECT RESULT, CONTAMINATION, AUDITOR_COMMENT
                                                    FROM evaluate
                                                    WHERE AUDIT_ID = :auditId");
        $selectAllEvaluateRisks->bindParam(':auditId', $id);
        $selectAllEvaluateRisks->execute();
        return $selectAllEvaluateRisks->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get the risk label according to score
     *
     * @param int $value Risk score of the audit
     *
     * @return array
     */

    public function getRiskNotation(int $value): array
    {
        $selectRiskNotationId = $this->db->prepare('SELECT RISKNOTATION_ID ID, NAME_'.$this->lang.' NAME
                                                    FROM risk_notation
                                                    WHERE VALUE_START < :value1
                                                    AND VALUE_END > :value2');
        $selectRiskNotationId->bindParam(':value1', $value);
        $selectRiskNotationId->bindParam(':value2', $value);
        $selectRiskNotationId->execute();

        return $selectRiskNotationId->fetchAll(PDO::FETCH_ASSOC)[0];
    }
}