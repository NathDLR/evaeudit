<?php

require_once('models/OrderForm.php');
require_once('models/user.php');

class OrderFormController
{

    private $view;
    private $actionAudit;
    private $orderForm;
    private $user;
    private $idOrder;

    public function __construct($action)
    {
        switch ($action[2]) {
            case 'default':
            case 'create':
            case 'selectOne':
            case 'insert':
                $this->orderForm = new OrderForm();
                break;
            case 'show':
            case 'update':
            case 'valid':
                $this->orderForm = new OrderForm();
                if(!empty($action[3])){
                    $this->idOrder = $action[3];
                }else{
                    header('Location: '.URL.'admin/order_form');
                    die();
                }
                break;
            default:
                throw new Exception('Page introuvable');
                break;
        }
        if ($_SESSION['role'] != 'admin') {
            header('Location: '.URL.'auditor/home');
            die();
        }
    }

    public function default()
    {
        $allOrder = $this->orderForm->getAllOrderForms();

        $this->view = new View('orderForm/home');
        $vue = ['controllerName' => 'AuditorController', 'content' => $allOrder, 'heading' => '', 'sidebarItems' => []];

        return $this->view->generate($vue);
    }

    public function create(){
        $this->user = new User();
        $auditors = $this->user->getAuditors();
        $admins = $this->user->getAdmins();

        $this->view = new View('orderForm/create');
        $vue = ['controllerName' => 'AuditorController', 'heading' => '', 'sidebarItems' => [], 'auditors' => $auditors, 'admins' => $admins];
        return $this->view->generate($vue);
    }

    public function show(){
        $this->orderForm = new OrderForm();
        $contentOrderOne = $this->orderForm->getOrderFormOnce($this->idOrder);

        $this->user = new User();
        $auditors = $this->user->getAuditors();
        $admins = $this->user->getAdmins();

        $this->view = new View('orderForm/show');
        $vue = ['controllerName' => 'AuditorController', 'heading' => '', 'sidebarItems' => [], 'order' => $contentOrderOne, 'auditors' => $auditors, 'admins' => $admins];
        return $this->view->generate($vue);
    }

    public function valid(){
        $this->orderForm = new OrderForm();
        $this->orderForm->setStatus(1, $this->idOrder);
        $orderForm = $this->orderForm->getOrderFormOnce($this->idOrder);
        $editorData = $this->orderForm->getEditor($this->idOrder);

        foreach ($editorData as $anEditor){
            if ($anEditor['ROLE_ID'] == 1){
                $adminID = $anEditor['USER_ID'];
            }else{
                $auditorId = $anEditor['USER_ID'];
            }
        }

        $audit = new Audit();
        $lastId = $audit->insert($orderForm['COMPANY_NAME'], $orderForm['CREATION_DATE'], 0, $orderForm['ORDER_FORM_ID']);
        $risk = new Risk();
        $grid = new Grid();
        $risk->setAllRisk($lastId);
        $grid->setGrid($lastId);

        return $this->default();
    }

    public function insert(){
        $this->extracted();
        $this->orderForm->insert($_POST['auditor'], $_POST['certif']);

        return $this->default();
    }

    public function update(){
        $this->extracted();
        $this->orderForm->update($this->idOrder);

        return $this->show();
    }

    /**
     * @return void
     */
    public function extracted(): void
    {
        $this->orderForm->setAll($_POST['nomClient'], $_POST['numClient'], $_POST['typePrestation'], $_POST['certifCheck'], $_POST['typeAudit'], $_POST['nbrMounth'], $_POST['isDistance'], $_POST['nbrAuditReport'], $_POST['periodAsk'], $_POST['nomSiege'], $_POST['adresseSiege'], $_POST['postalSiege'], $_POST['villeSiege'], $_POST['paysSiege'], $_POST['nomContactSiege'], $_POST['prenomContactSiege'], $_POST['fonctionContactSiege'], $_POST['emailContactSiege'], $_POST['telContactSiege'], $_POST['nomFabrication'], $_POST['adresseFabrication'], $_POST['postalFabrication'], $_POST['villeFabrication'], $_POST['paysFabrication'], $_POST['nomContactFabrication'], $_POST['prenomContactFabrication'], $_POST['fonctionContactFabrication'], $_POST['emailContactFabrication'], $_POST['telContactFabrication']);
    }


}