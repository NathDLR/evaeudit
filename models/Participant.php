<?php

class Participant
{
    private $name;
    private $firsname;
    private $function;
    private $presence1;
    private $presence2;
    private $presence3;
    private $presence4;
    private $db;

    public function __construct($name, $firsname, $function, $presence1, $presence2, $presence3, $presence4){
        $this->name = $name;
        $this->firsname = $firsname;
        $this->function = $function;
        $this->presence1 = $presence1;
        $this->presence2 = $presence2;
        $this->presence3 = $presence3;
        $this->presence4 = $presence4;
        $this->db = Connexion::getConnexion();
    }


    // Insertion du participant
    public function insert(){
        $stmt = "INSERT INTO `participant` (`AUDIT_ID`, `NAME`, `FIRSTNAME`, `FUNCTION`,  `PRESENCE_STEP1`, `PRESENCE_STEP2`, `PRESENCE_STEP3`, `PRESENCE_STEP4`) 
                VALUES (:AUDIT_ID, :NAME,  :FIRSTNAME,  :FUNCTION, :PRESENCE_STEP1, :PRESENCE_STEP2, :PRESENCE_STEP3, :PRESENCE_STEP4)
                ON DUPLICATE KEY UPDATE PRESENCE_STEP1 = VALUES(PRESENCE_STEP1), PRESENCE_STEP2 = VALUES(PRESENCE_STEP2), PRESENCE_STEP3 = VALUES(PRESENCE_STEP3),PRESENCE_STEP4 = VALUES(PRESENCE_STEP4) ";
        $query = $this->db->prepare($stmt);
        $query->bindValue('AUDIT_ID', $_SESSION['auditId'], PDO::PARAM_INT);
        $query->bindValue('NAME', $this->name, PDO::PARAM_STR);
        $query->bindValue('FIRSTNAME', $this->firsname, PDO::PARAM_STR);
        $query->bindValue('FUNCTION', $this->function, PDO::PARAM_STR);
        $query->bindValue('PRESENCE_STEP1', $this->presence1, PDO::PARAM_INT);
        $query->bindValue('PRESENCE_STEP2', $this->presence2, PDO::PARAM_INT);
        $query->bindValue('PRESENCE_STEP3', $this->presence3, PDO::PARAM_INT);
        $query->bindValue('PRESENCE_STEP4', $this->presence4, PDO::PARAM_INT);
        $query->execute();
    }
}