<?php

include_once 'Connexion.php';

class OrderForm
{
    private $db;
    private $id;
    private $creationDate;
    private $companyName;
    private $clientNb;
    private $prestationType;
    private $certifType;
    private $auditType;
    private $nbrMonth;
    private $isDistance;
    private $nbReport;
    private $period;
    private $officeName;
    private $officeAddress;
    private $officePostal;
    private $officeCity;
    private $officeCountry;
    private $officeContactName;
    private $officeContactFirstname;
    private $officeContactFunction;
    private $officeContactMail;
    private $officeContactPhone;
    private $fabricationName;
    private $fabricationAddress;
    private $fabricationPostal;
    private $fabricationCity;
    private $fabricationCountry;
    private $fabricationContactName;
    private $fabricationContactFirstname;
    private $fabricationContactFunction;
    private $fabricationContactMail;
    private $fabricationContactPhone;
    private $status;

    /**
     * @param $creationDate
     * @param $status
     */

    public function __construct()
    {
        $this->lang = strtoupper($_COOKIE['lang']);
        $this->db = Connexion::getConnexion();
        $this->creationDate = date('Y-m-d');
        $this->status = 0;

    }

    public function getAllOrderForms(){
        $selectAllOrderForm = $this->db->prepare('SELECT * FROM order_form O
                                                WHERE O.status = 0');
        $selectAllOrderForm->execute();
        return $selectAllOrderForm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderFormOnce($idOrderForm){
        $selectOrderFormOnce = $this->db->prepare('SELECT * FROM order_form O
                                                WHERE O.order_form_id = :id
                                                  AND O.status = 0');
        $selectOrderFormOnce->bindParam(':id', $idOrderForm);
        $selectOrderFormOnce->execute();

        $result = $selectOrderFormOnce->fetchAll(PDO::FETCH_ASSOC)[0];

        $editors = $this->getEditors($idOrderForm);

        $result["AUDITOR"] = $editors[0];
        $result["ADMIN"] = $editors[1];

        return $result;
    }

    public function getEditors($idOrderForm)
    {
        $selectEditors = $this->db->prepare('SELECT E.USER_ID, ROLE_ID, U.NAME, U.FIRSTNAME FROM editor E
                                                INNER JOIN user U ON E.USER_ID = U.USER_ID
                                                WHERE E.ORDER_FORM_ID = :id
                                                ORDER BY ROLE_ID DESC');
        $selectEditors->bindParam(':id', $idOrderForm);
        $selectEditors->execute();

        return $selectEditors->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($auditorId, $adminId){
        $insertOrderForm = $this->db->prepare('INSERT INTO order_form (CREATION_DATE, COMPANY_NAME, CLIENT_NB,	PRESTATION_TYPE, TYPE_CERTIF, TYPE_AUDIT, NBR_MONTH, IS_DISTANCE, NB_REPORT, PERIOD, OFFICE_NAME, OFFICE_ADDRESS, OFFICE_POSTAL,	OFFICE_CITY,	OFFICE_COUNTRY,	OFFICE_CONTACT_NAME,	OFFICE_CONTACT_FIRSTNAME,	OFFICE_CONTACT_FUNCTION,	OFFICE_CONTACT_MAIL,	OFFICE_CONTACT_PHONE,	FABRICATION_NAME,	FABRICATION_ADDRESS,	FABRICATION_POSTAL,	FABRICATION_CITY,	FABRICATION_COUNTRY, FABRICATION_CONTACT_NAME,	FABRICATION_CONTACT_FIRSTNAME,	FABRICATION_CONTACT_FUNCTION,	FABRICATION_CONTACT_MAIL,	FABRICATION_CONTACT_PHONE, STATUS) 
                                                VALUES (:creationDate, :companyName, :clientNb, :prestationType, :certifType, :auditType, :nbrMonth, :isDistance, :nbReport, :period, :officeName, :officeAddress, :officePostal, :officeCity, :officeCountry, :officeContactName, :officeContactFirstname, :officeContactFunction, :officeContactMail, :officeContactPhone, :fabricationName, :fabricationAddress, :fabricationPostal, :fabricationCity, :fabricationCountry, :fabricationContactName, :fabricationContactFirstname, :fabricationContactFunction, :fabricationContactMail, :fabricationContactPhone, :status)');
        $insertOrderForm->bindParam(':creationDate', $this->creationDate);
        $insertOrderForm->bindParam(':companyName', $this->companyName);
        $insertOrderForm->bindParam(':clientNb', $this->clientNb);
        $insertOrderForm->bindParam(':prestationType', $this->prestationType);
        $insertOrderForm->bindParam(':certifType', $this->certifType);
        $insertOrderForm->bindParam(':auditType', $this->auditType);
        $insertOrderForm->bindParam(':nbrMonth', $this->nbrMonth);
        $insertOrderForm->bindParam(':isDistance', $this->isDistance);
        $insertOrderForm->bindParam(':nbReport', $this->nbReport);
        $insertOrderForm->bindParam(':period', $this->period);
        $insertOrderForm->bindParam(':officeName', $this->officeName);
        $insertOrderForm->bindParam(':officeAddress', $this->officeAddress);
        $insertOrderForm->bindParam(':officePostal', $this->officePostal);
        $insertOrderForm->bindParam(':officeCity', $this->officeCity);
        $insertOrderForm->bindParam(':officeCountry', $this->officeCountry);
        $insertOrderForm->bindParam(':officeContactName', $this->officeContactName);
        $insertOrderForm->bindParam(':officeContactFirstname', $this->officeContactFirstname);
        $insertOrderForm->bindParam(':officeContactFunction', $this->officeContactFunction);
        $insertOrderForm->bindParam(':officeContactMail', $this->officeContactMail);
        $insertOrderForm->bindParam(':officeContactPhone', $this->officeContactPhone);
        $insertOrderForm->bindParam(':fabricationName', $this->fabricationName);
        $insertOrderForm->bindParam(':fabricationAddress', $this->fabricationAddress);
        $insertOrderForm->bindParam(':fabricationPostal', $this->fabricationPostal);
        $insertOrderForm->bindParam(':fabricationCity', $this->fabricationCity);
        $insertOrderForm->bindParam(':fabricationCountry', $this->fabricationCountry);
        $insertOrderForm->bindParam(':fabricationContactName', $this->fabricationContactName);
        $insertOrderForm->bindParam(':fabricationContactFirstname', $this->fabricationContactFirstname);
        $insertOrderForm->bindParam(':fabricationContactFunction', $this->fabricationContactFunction);
        $insertOrderForm->bindParam(':fabricationContactMail', $this->fabricationContactMail);
        $insertOrderForm->bindParam(':fabricationContactPhone', $this->fabricationContactPhone);
        $insertOrderForm->bindParam(':status', $this->status);
        $insertOrderForm->execute();
        $orderFormId = $this->db->lastInsertId();

        $insertEditor = $this->db->prepare('INSERT INTO `editor` (USER_ID, ORDER_FORM_ID) 
                                    VALUES (:auditorId, :orderForm1), (:adminId, :orderForm2) ');
        $insertEditor->bindValue(':auditorId',$auditorId, PDO::PARAM_INT);
        $insertEditor->bindValue(':orderForm1',$orderFormId, PDO::PARAM_INT);
        $insertEditor->bindValue(':adminId',$adminId, PDO::PARAM_INT);
        $insertEditor->bindValue(':orderForm2',$orderFormId, PDO::PARAM_INT);
        $insertEditor->execute();
    }

    public function update($idOrderForm){
        $updateOrderOne = $this->db->prepare('UPDATE order_form 
                                                SET CREATION_DATE = :creationDate,
                                                    COMPANY_NAME = :companyName,
                                                    CLIENT_NB = :clientNb,
                                                    PRESTATION_TYPE = :prestationType,
                                                    TYPE_CERTIF = :certifType,
                                                    TYPE_AUDIT = :auditType,
                                                    NBR_MONTH = :nbrMonth,
                                                    IS_DISTANCE = :isDistance,
                                                    NB_REPORT = :nbReport,
                                                    PERIOD = :period,
                                                    OFFICE_NAME = :officeName,
                                                    OFFICE_ADDRESS = :officeAddress,
                                                    OFFICE_POSTAL = :officePostal,
                                                    OFFICE_CITY = :officeCity,
                                                    OFFICE_COUNTRY = :officeCountry,
                                                    OFFICE_CONTACT_NAME = :officeContactName,
                                                    OFFICE_CONTACT_FIRSTNAME = :officeContactFirstname,
                                                    OFFICE_CONTACT_FUNCTION = :officeContactFunction,
                                                    OFFICE_CONTACT_MAIL = :officeContactMail,
                                                    OFFICE_CONTACT_PHONE = :officeContactPhone,
                                                    FABRICATION_NAME = :fabricationName,
                                                    FABRICATION_ADDRESS = :fabricationAddress,
                                                    FABRICATION_POSTAL = :fabricationPostal,
                                                    FABRICATION_CITY = :fabricationCity,
                                                    FABRICATION_COUNTRY = :fabricationCountry,
                                                    FABRICATION_CONTACT_NAME = :fabricationContactName,
                                                    FABRICATION_CONTACT_FIRSTNAME = :fabricationContactFirstname,
                                                    FABRICATION_CONTACT_FUNCTION = :fabricationContactFunction,
                                                    FABRICATION_CONTACT_MAIL = :fabricationContactMail,
                                                    FABRICATION_CONTACT_PHONE = :fabricationContactPhone
                                                    WHERE ORDER_FORM_ID = :id');
        $updateOrderOne->bindParam(':id', $idOrderForm);
        $updateOrderOne->bindParam(':creationDate', $this->creationDate);
        $updateOrderOne->bindParam(':companyName', $this->companyName);
        $updateOrderOne->bindParam(':clientNb', $this->clientNb);
        $updateOrderOne->bindParam(':prestationType', $this->prestationType);
        $updateOrderOne->bindParam(':certifType', $this->certifType);
        $updateOrderOne->bindParam(':auditType', $this->auditType);
        $updateOrderOne->bindParam(':nbrMonth', $this->nbrMonth);
        $updateOrderOne->bindParam(':isDistance', $this->isDistance);
        $updateOrderOne->bindParam(':nbReport', $this->nbReport);
        $updateOrderOne->bindParam(':period', $this->period);
        $updateOrderOne->bindParam(':officeName', $this->officeName);
        $updateOrderOne->bindParam(':officeAddress', $this->officeAddress);
        $updateOrderOne->bindParam(':officePostal', $this->officePostal);
        $updateOrderOne->bindParam(':officeCity', $this->officeCity);
        $updateOrderOne->bindParam(':officeCountry', $this->officeCountry);
        $updateOrderOne->bindParam(':officeContactName', $this->officeContactName);
        $updateOrderOne->bindParam(':officeContactFirstname', $this->officeContactFirstname);
        $updateOrderOne->bindParam(':officeContactFunction', $this->officeContactFunction);
        $updateOrderOne->bindParam(':officeContactMail', $this->officeContactMail);
        $updateOrderOne->bindParam(':officeContactPhone', $this->officeContactPhone);
        $updateOrderOne->bindParam(':fabricationName', $this->fabricationName);
        $updateOrderOne->bindParam(':fabricationAddress', $this->fabricationAddress);
        $updateOrderOne->bindParam(':fabricationPostal', $this->fabricationPostal);
        $updateOrderOne->bindParam(':fabricationCity', $this->fabricationCity);
        $updateOrderOne->bindParam(':fabricationCountry', $this->fabricationCountry);
        $updateOrderOne->bindParam(':fabricationContactName', $this->fabricationContactName);
        $updateOrderOne->bindParam(':fabricationContactFirstname', $this->fabricationContactFirstname);
        $updateOrderOne->bindParam(':fabricationContactFunction', $this->fabricationContactFunction);
        $updateOrderOne->bindParam(':fabricationContactMail', $this->fabricationContactMail);
        $updateOrderOne->bindParam(':fabricationContactPhone', $this->fabricationContactPhone);
        $updateOrderOne->execute();
    }


    /**
     * @param $creationDate
     * @param $companyName
     * @param $clientNb
     * @param $prestationType
     * @param $certifType
     * @param $auditType
     * @param $nbrMonth
     * @param $isDistance
     * @param $nbReport
     * @param $period
     * @param $officeName
     * @param $officeAddress
     * @param $officePostal
     * @param $officeCity
     * @param $officeCountry
     * @param $officeContactName
     * @param $officeContactFirstname
     * @param $officeContactFunction
     * @param $officeContactMail
     * @param $officeContactPhone
     * @param $fabricationName
     * @param $fabricationAddress
     * @param $fabricationPostal
     * @param $fabricationCity
     * @param $fabricationCountry
     * @param $fabricationContactName
     * @param $fabricationContactFirstname
     * @param $fabricationContactFunction
     * @param $fabricationContactMail
     * @param $fabricationContactPhone
     */

    public function setAll($companyName, $clientNb, $prestationType, $certifType, $auditType, $nbrMonth, $isDistance, $nbReport, $period, $officeName, $officeAddress, $officePostal, $officeCity, $officeCountry, $officeContactName, $officeContactFirstname, $officeContactFunction, $officeContactMail, $officeContactPhone, $fabricationName, $fabricationAddress, $fabricationPostal, $fabricationCity, $fabricationCountry, $fabricationContactName, $fabricationContactFirstname, $fabricationContactFunction, $fabricationContactMail, $fabricationContactPhone){
        $this->setAuditType($auditType);
        $this->setNbrMounth($nbrMonth);
        $this->setCertifType($certifType);
        $this->setClientNb($clientNb);
        $this->setCompanyName($companyName);
        $this->setFabricationAddress($fabricationAddress);
        $this->setFabricationCity($fabricationCity);
        $this->setFabricationContactFirstname($fabricationContactFirstname);
        $this->setFabricationContactFunction($fabricationContactFunction);
        $this->setFabricationContactMail($fabricationContactMail);
        $this->setFabricationContactName($fabricationContactName);
        $this->setFabricationContactPhone($fabricationContactPhone);
        $this->setFabricationCountry($fabricationCountry);
        $this->setFabricationName($fabricationName);
        $this->setFabricationPostal($fabricationPostal);
        $this->setIsDistance($isDistance);
        $this->setNbReport($nbReport);
        $this->setOfficeAddress($officeAddress);
        $this->setOfficeCity($officeCity);
        $this->setOfficeContactFirstname($officeContactFirstname);
        $this->setOfficeContactFunction($officeContactFunction);
        $this->setOfficeContactMail($officeContactMail);
        $this->setOfficeContactName($officeContactName);
        $this->setOfficeContactPhone($officeContactPhone);
        $this->setOfficeCountry($officeCountry);
        $this->setOfficeName($officeName);
        $this->setOfficePostal($officePostal);
        $this->setPeriod($period);
        $this->setPrestationType($prestationType);
    }

    public function getEditor($idOrderForm){
        $selectAllEditor = $this->db->prepare('SELECT user.USER_ID, ROLE_ID FROM user
                                                INNER JOIN editor ON user.USER_ID = editor.USER_ID
                                                WHERE ORDER_FORM_ID = :id');
        $selectAllEditor->bindParam(':id', $idOrderForm);
        $selectAllEditor->execute();
        return $selectAllEditor->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param mixed $creationDate
     */
    public function setCreationDate($creationDate)
    {

        $this->creationDate = date_format($creationDate, 'm-d-Y');
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
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
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
    public function setClientNb($clientNb)
    {
        $this->clientNb = $clientNb;
    }

    /**
     * @return mixed
     */
    public function getPrestationType()
    {
        return $this->prestationType;
    }

    /**
     * @param mixed $prestationType
     */
    public function setPrestationType($prestationType)
    {
        $this->prestationType = $prestationType;
    }

    /**
     * @return mixed
     */
    public function getCertifType()
    {
        return $this->certifType;
    }

    /**
     * @param mixed $certifType
     */
    public function setCertifType($certifType)
    {
        $this->certifType = $certifType;
    }

    /**
     * @return mixed
     */
    public function getAuditType()
    {
        return $this->auditType;
    }

    /**
     * @param mixed $auditType
     */
    public function setAuditType($auditType)
    {
        $this->auditType = $auditType;
    }

    /**
     * @return mixed
     */
    public function getNbrMounth()
    {
        return $this->nbrMonth;
    }

    /**
     * @param mixed $nbrMonth
     */
    public function setNbrMounth($nbrMonth): void
    {
        $this->nbrMonth = !empty($nbrMonth)? $nbrMonth : null;
    }

    /**
     * @return mixed
     */
    public function getIsDistance()
    {
        return $this->isDistance;
    }

    /**
     * @param mixed $isDistance
     */
    public function setIsDistance($isDistance)
    {
        $this->isDistance = $isDistance;
    }

    /**
     * @return mixed
     */
    public function getNbReport()
    {
        return $this->nbReport;
    }

    /**
     * @param mixed $nbReport
     */
    public function setNbReport($nbReport)
    {
        $this->nbReport = !empty($nbReport) ? $nbReport : null;
    }

    /**
     * @return mixed
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * @param mixed $period
     */
    public function setPeriod($period)
    {
        $this->period = $period;
    }

    /**
     * @return mixed
     */
    public function getOfficeName()
    {
        return $this->officeName;
    }

    /**
     * @param mixed $officeName
     */
    public function setOfficeName($officeName)
    {
        $this->officeName = $officeName;
    }

    /**
     * @return mixed
     */
    public function getOfficeAddress()
    {
        return $this->officeAddress;
    }

    /**
     * @param mixed $officeAddress
     */
    public function setOfficeAddress($officeAddress)
    {
        $this->officeAddress = $officeAddress;
    }

    /**
     * @return mixed
     */
    public function getOfficePostal()
    {
        return $this->officePostal;
    }

    /**
     * @param mixed $officePostal
     */
    public function setOfficePostal($officePostal)
    {
        $this->officePostal = !empty($officePostal) ? $officePostal :null;
    }

    /**
     * @return mixed
     */
    public function getOfficeCity()
    {
        return $this->officeCity;
    }

    /**
     * @param mixed $officeCity
     */
    public function setOfficeCity($officeCity)
    {
        $this->officeCity = $officeCity;
    }

    /**
     * @return mixed
     */
    public function getOfficeCountry()
    {
        return $this->officeCountry;
    }

    /**
     * @param mixed $officeCountry
     */
    public function setOfficeCountry($officeCountry)
    {
        $this->officeCountry = $officeCountry;
    }

    /**
     * @return mixed
     */
    public function getOfficeContactName()
    {
        return $this->officeContactName;
    }

    /**
     * @param mixed $officeContactName
     */
    public function setOfficeContactName($officeContactName)
    {
        $this->officeContactName = $officeContactName;
    }

    /**
     * @return mixed
     */
    public function getOfficeContactFirstname()
    {
        return $this->officeContactFirstname;
    }

    /**
     * @param mixed $officeContactFirstname
     */
    public function setOfficeContactFirstname($officeContactFirstname)
    {
        $this->officeContactFirstname = $officeContactFirstname;
    }

    /**
     * @return mixed
     */
    public function getOfficeContactFunction()
    {
        return $this->officeContactFunction;
    }

    /**
     * @param mixed $officeContactFunction
     */
    public function setOfficeContactFunction($officeContactFunction)
    {
        $this->officeContactFunction = $officeContactFunction;
    }

    /**
     * @return mixed
     */
    public function getOfficeContactMail()
    {
        return $this->officeContactMail;
    }

    /**
     * @param mixed $officeContactMail
     */
    public function setOfficeContactMail($officeContactMail)
    {
        $this->officeContactMail = $officeContactMail;
    }

    /**
     * @return mixed
     */
    public function getOfficeContactPhone()
    {
        return $this->officeContactPhone;
    }

    /**
     * @param mixed $officeContactPhone
     */
    public function setOfficeContactPhone($officeContactPhone)
    {
        $this->officeContactPhone = $officeContactPhone;
    }

    /**
     * @return mixed
     */
    public function getFabricationName()
    {
        return $this->fabricationName;
    }

    /**
     * @param mixed $fabricationName
     */
    public function setFabricationName($fabricationName)
    {
        $this->fabricationName = $fabricationName;
    }

    /**
     * @return mixed
     */
    public function getFabricationAddress()
    {
        return $this->fabricationAddress;
    }

    /**
     * @param mixed $fabricationAddress
     */
    public function setFabricationAddress($fabricationAddress)
    {
        $this->fabricationAddress = $fabricationAddress;
    }

    /**
     * @return mixed
     */
    public function getFabricationPostal()
    {
        return $this->fabricationPostal;
    }

    /**
     * @param mixed $fabricationPostal
     */
    public function setFabricationPostal($fabricationPostal)
    {
        $this->fabricationPostal = !empty($fabricationPostal)? $fabricationPostal: null;
    }

    /**
     * @return mixed
     */
    public function getFabricationCity()
    {
        return $this->fabricationCity;
    }

    /**
     * @param mixed $fabricationCity
     */
    public function setFabricationCity($fabricationCity)
    {
        $this->fabricationCity = $fabricationCity;
    }

    /**
     * @return mixed
     */
    public function getFabricationCountry()
    {
        return $this->fabricationCountry;
    }

    /**
     * @param mixed $fabricationCountry
     */
    public function setFabricationCountry($fabricationCountry)
    {
        $this->fabricationCountry = $fabricationCountry;
    }

    /**
     * @return mixed
     */
    public function getFabricationContactName()
    {
        return $this->fabricationContactName;
    }

    /**
     * @param mixed $fabricationContactName
     */
    public function setFabricationContactName($fabricationContactName)
    {
        $this->fabricationContactName = $fabricationContactName;
    }

    /**
     * @return mixed
     */
    public function getFabricationContactFirstname()
    {
        return $this->fabricationContactFirstname;
    }

    /**
     * @param mixed $fabricationContactFirstname
     */
    public function setFabricationContactFirstname($fabricationContactFirstname)
    {
        $this->fabricationContactFirstname = $fabricationContactFirstname;
    }

    /**
     * @return mixed
     */
    public function getFabricationContactFunction()
    {
        return $this->fabricationContactFunction;
    }

    /**
     * @param mixed $fabricationContactFunction
     */
    public function setFabricationContactFunction($fabricationContactFunction)
    {
        $this->fabricationContactFunction = $fabricationContactFunction;
    }

    /**
     * @return mixed
     */
    public function getFabricationContactMail()
    {
        return $this->fabricationContactMail;
    }

    /**
     * @param mixed $fabricationContactMail
     */
    public function setFabricationContactMail($fabricationContactMail)
    {
        $this->fabricationContactMail = $fabricationContactMail;
    }

    /**
     * @return mixed
     */
    public function getFabricationContactPhone()
    {
        return $this->fabricationContactPhone;
    }

    /**
     * @param mixed $fabricationContactPhone
     */
    public function setFabricationContactPhone($fabricationContactPhone)
    {
        $this->fabricationContactPhone = $fabricationContactPhone;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status, $idOrderForm)
    {
        $this->status = $status;
        $updateOrderOne = $this->db->prepare('UPDATE order_form 
                                                SET STATUS = :status
                                                    WHERE ORDER_FORM_ID = :id');
        $updateOrderOne->bindParam(':id', $idOrderForm);
        $updateOrderOne->bindParam(':status', $this->status);
    }





}