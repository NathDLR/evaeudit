<?php

include_once 'Connexion.php';

class User{


    private $db;
    private $name;
    private $firstname;
    private $username;
    private $password;

    public function __construct($aName = null, $anFirstname = null, $anUsername = null, $aPassword = null){
        $this->db = Connexion::getConnexion();
        $this->name = $aName;
        $this->firstname = $anFirstname;
        $this->username = $anUsername;
        $this->password = $aPassword;
    }

    // Insertion d'un auditeur depuis la page d'administration
    public function insert(){
        $stmt = "INSERT INTO `user` (ROLE_ID, NAME, FIRSTNAME, USERNAME, PASSWORD) VALUES (2, :NAME, :FIRSTNAME, :USERNAME, :PASSWORD) ";
        $query = $this->db->prepare($stmt);
        $query->bindParam(':NAME', $this->name, PDO::PARAM_STR);
        $query->bindParam(':FIRSTNAME', $this->firstname, PDO::PARAM_STR);
        $query->bindParam(':USERNAME', $this->username, PDO::PARAM_STR);
        $query->bindParam(':PASSWORD', $this->password, PDO::PARAM_STR);
        $query->execute();
    }

    public function update($id){
        $updateUser = $this->db->prepare('UPDATE user 
                                    SET NAME = :NAME,
                                    FIRSTNAME = :FIRSTNAME, 
                                    USERNAME = :USERNAME, 
                                    PASSWORD = :PASSWORD
                                    WHERE USER_ID = :ID) ');
        $updateUser->bindParam(':ID', $id, PDO::PARAM_STR);
        $updateUser->bindParam(':NAME', $this->name, PDO::PARAM_STR);
        $updateUser->bindParam(':FIRSTNAME', $this->firstname, PDO::PARAM_STR);
        $updateUser->bindParam(':USERNAME', $this->username, PDO::PARAM_STR);
        $updateUser->bindParam(':PASSWORD', $this->password, PDO::PARAM_STR);
        $updateUser->execute();
    }

    public function updatePassword($id){
        $updateUser = $this->db->prepare('UPDATE user 
                                    SET PASSWORD = :PASSWORD
                                    WHERE USER_ID = :ID');
        $updateUser->bindParam(':ID', $id, PDO::PARAM_STR);
        $updateUser->bindParam(':PASSWORD', $this->password, PDO::PARAM_STR);
        $updateUser->execute();
    }

    public function disable($id){
        $stmt = "UPDATE user SET STATUS = 0 WHERE USER_ID = :USER_ID ";
        $query = $this->db->prepare($stmt);
        $query->bindParam(':USER_ID', $id, PDO::PARAM_INT);

        $query->execute();
    }

    public function enable($id){
        $stmt = "UPDATE user SET STATUS = 1 WHERE USER_ID = :USER_ID ";
        $query = $this->db->prepare($stmt);
        $query->bindParam(':USER_ID', $id, PDO::PARAM_INT);

        $query->execute();
    }

    // Sélectionne les administrateurs (chargés de certification) afin d'en assigner un a un audit, du côté auditeur
    public function getAdmins(){
        $stmt = "SELECT user.NAME, user.FIRSTNAME, user.USER_ID FROM user INNER JOIN role ON user.ROLE_ID = role.ROLE_ID WHERE user.ROLE_ID = 1";
        $query = $this->db->prepare($stmt);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Sélectionne les auditeurs afin d'en assigner un a un audit, du côté admin
    public function getAuditors(){
        $stmt = "SELECT user.NAME, user.FIRSTNAME, user.USER_ID, user.STATUS, user.USERNAME FROM user INNER JOIN role ON user.ROLE_ID = role.ROLE_ID WHERE user.ROLE_ID = 2";
        $query = $this->db->prepare($stmt);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCurrentUser()
    {
        $selectCurrentUser = $this->db->prepare("SELECT NAME, FIRSTNAME, USERNAME, R.LABEL ROLE
                                    FROM user U
                                    INNER JOIN role R ON U.ROLE_ID = R.ROLE_ID
                                    WHERE USER_ID = :id");
        $selectCurrentUser->bindParam(':id', $_SESSION['userId']);
        $selectCurrentUser->execute();
        return $selectCurrentUser->fetchAll(PDO::FETCH_ASSOC)[0];
    }

    public function getUsersByAudit($auditId){
        $selectUserByAudit = $this->db->prepare("SELECT ROLE_ID, CONCAT(NAME, ' ', FIRSTNAME) NAME FROM user 
                                                INNER JOIN editor ON user.USER_ID = editor.USER_ID
                                                INNER JOIN order_form ON order_form.ORDER_FORM_ID = editor.ORDER_FORM_ID 
                                                INNER JOIN audit ON order_form.ORDER_FORM_ID  =audit.ORDER_FORM_ID                
                                                WHERE order_form.AUDIT_ID = :idAudit
                                                ORDER BY ROLE_ID");
        $selectUserByAudit->bindParam(':idAudit', $auditId);
        $selectUserByAudit->execute();
        return $selectUserByAudit->fetchAll(PDO::FETCH_ASSOC);
    }

    // <editor-fold defaultstate="collapsed" desc="Getters & Setters">

    /**
     * @return mixed
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @param mixed $db
     */
    public function setDb($db): void
    {
        $this->db = $db;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }
    // </editor-fold>
}