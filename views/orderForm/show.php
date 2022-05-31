<a href="#" class="btn btn-success" data-toggle="modal" data-target="#validModal">Valider le bon de commande</a>
<?php $this->setT('Modification d\' un bon de commande');
?>

<style>
    .row {
        margin-top: 2%;
    }
</style>
<pre>
    <?php
    print_r($order);
    ?>
</pre>
<div class="container">
    <div class="card mb-4">
        <div class="card-header text-center">
            <h3>Modification d'un bon de commande</h3>
        </div>
        <div class="card-body">
            <div class="group-form">
                <form action="<?= URL ?>admin/order_form/update/<?=$order['ORDER_FORM_ID']?>" method="post">
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <select class="form-control" name="auditor">
                                <option value="" selected hidden>Sélectionner un auditeur</option>
                                <?php foreach ($auditors as $anAuditor){ ?>
                                    <option value="<?= $anAuditor['USER_ID'];?>" <?php if($anAuditor['USER_ID'] == $order["AUDITOR"]["USER_ID"] ){ echo "selected";} ?>><?= $anAuditor['NAME']. ' ' . $anAuditor['FIRSTNAME'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-4">
                            <select class="form-control" name="certif">
                                <option value="" selected hidden>Sélectionner un(e) chargé de certification</option>
                                <?php foreach ($admins as $anAdmin){ ?>
                                    <option value="<?= $anAdmin['USER_ID'];?>"  <?php if($anAdmin['USER_ID'] == $order["ADMIN"]["USER_ID"] ){ echo "selected";} ?> ><?= $anAdmin['NAME']. ' ' . $anAdmin['FIRSTNAME'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-5">
                            <input type="text" name="nomClient" class="form-control" placeholder="Nom du client" value="<?=$order['COMPANY_NAME']?>">
                        </div>
                        <div class="col-3">
                            <input type="text" name="numClient" class="form-control" placeholder="N° du client" value="<?=$order['CLIENT_NB']?>">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-8">
                                <input class="form-control" name="typePrestation" value="<?= $order['PRESTATION_TYPE']?>" placeholder="Type de prestation(s)">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-4" style="font-size:1.1em; margin-left: 5%">
                            <input type="radio" class="form-check-input" name="certifCheck" id="Certification-Produit" value="Product" <?php if(($order['TYPE_CERTIF'] == "Product") || empty($order['TYPE_CERTIF'])){ echo "checked"; } ?>>
                            <label for="Certification-Produit">Certification Produit</label>
                        </div>
                        <div class="col-4" style="font-size:1.1em">
                            <input type="radio" class="form-check-input" name="certifCheck" id="Certification-Usine" value="Factory" <?php if($order['TYPE_CERTIF'] == "Factory"){ echo "checked"; } ?>>
                            <label for="Certification-Usine">Certification Usine</label>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <select name="typeAudit" id="" class="form-control" >
                                <option value="" selected hidden>Type d'audit</option>
                                <option value="Audit de renouvellement" <?php if($order['TYPE_AUDIT'] === "Audit de renouvellement"){ echo "selected";} ?>>Audit de renouvellement</option>
                                <option value="1er audit" <?php if($order['TYPE_AUDIT'] === "1er audit"){ echo "selected";} ?>>1er Audit</option>
                                <option value="Audit complémentaire" <?php if($order['TYPE_AUDIT'] === "Audit complémentaire"){ echo "selected";} ?>>Audit Complémentaire</option>
                                <option value="Audit inopiné" <?php if($order['TYPE_AUDIT'] === "Audit inopiné"){ echo "selected";} ?>>Audit inopiné</option>
                                <option value="Audit de renouvellement" <?php if($order['TYPE_AUDIT'] === "Audit de renouvellement"){ echo "selected";} ?>>Audit de renouvellement</option>
                            </select>
                        </div>
                        <div class="col-2" >
                            <select name="nbrMounth" id="" class="form-control" style="padding: 0; padding-left: 5px">
                                <option value="" selected hidden>Nombre de mois</option>
                                <option value="18" <?php if($order['NBR_MONTH'] == "18"){ echo "selected"; } ?>>18 mois</option>
                                <option value="36" <?php if($order['NBR_MONTH'] == "36"){ echo "selected"; } ?>>36 mois</option>
                            </select>
                        </div>
                        <div class="col-2" style="font-size: 1.1em">
                            <input type="hidden" name="isDistance" id="Audit-Distance" value="1">
                            <input type="checkbox" name="isDistance" id="Audit-Distance" value="1">
                            <label class="form-check-label" for="Audit-Distance">Audit à Distance</label>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <input type="text" name="categoryClient" class="form-control" placeholder="Champ(s) d'application" value="<?=$order['APPLI_FIELD']?>">
                        </div>
                        <div class="col-4">
                            <input type="text" name="timeAudit" class="form-control" placeholder="Temps d'audit prévu" value="<?=$order['TIME_AUDIT']?>">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <input type="number" name="nbrAuditReport" class="form-control" placeholder="Rapport d'audit attendus(s)" value="<?=$order['NB_REPORT']?>">
                        </div>
                        <div class="col-4">
                            <input type="text" name="periodAsk" class="form-control" placeholder="Période demandée" value="<?=$order['PERIOD']?>">
                        </div>
                    </div>
                    <h2 style="margin-top: 2%; font-style: italic; text-decoration: underline;" class="center-text">Coordonnées du siège social</h2>
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <input type="text" name="nomSiege" class="form-control" placeholder="Nom" value="<?=$order['OFFICE_NAME']?>">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <input type="text" name="adresseSiege" class="form-control" placeholder="Adresse" value="<?=$order['OFFICE_ADDRESS']?>">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-2">
                            <input type="number" name="postalSiege" class="form-control" placeholder="Code Postal" value="<?=$order['OFFICE_POSTAL']?>">
                        </div>
                        <div class="col-3">
                            <input type="text" name="villeSiege" class="form-control" placeholder="Ville" value="<?=$order['OFFICE_CITY']?>">
                        </div>
                        <div class="col-3">
                            <input type="text" name="paysSiege" class="form-control" placeholder="Pays" value="<?=$order['OFFICE_COUNTRY']?>">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <input type="text" name="nomContactSiege" class="form-control" placeholder="Nom du contact" value="<?=$order['OFFICE_CONTACT_NAME']?>">
                        </div>
                        <div class="col-4">
                            <input type="text" name="prenomContactSiege" class="form-control" placeholder="Prenom du contact" value="<?=$order['OFFICE_CONTACT_FIRSTNAME']?>">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <input type="text" name="fonctionContactSiege" class="form-control"
                                   placeholder="Fonction du contact" value="<?=$order['OFFICE_CONTACT_FUNCTION']?>">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <input type="email" name="emailContactSiege" class="form-control"
                                   placeholder="Email du contact" value="<?=$order['OFFICE_CONTACT_MAIL']?>">
                        </div>
                        <div class="col-4">
                            <input type="tel" name="telContactSiege" class="form-control"
                                   placeholder="Téléphone du contact" value="<?=$order['OFFICE_CONTACT_PHONE']?>">
                        </div>
                    </div>
                    <h2 style="margin-top: 2%; font-style: italic; text-decoration: underline;" class="center-text">
                        Coordonnées du lieu de fabrication</h2>
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <input type="text" name="nomFabrication" class="form-control" placeholder="Nom" value="<?=$order['FABRICATION_NAME']?>">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <input type="text" name="adresseFabrication" class="form-control" placeholder="Adresse" value="<?=$order['FABRICATION_ADDRESS']?>">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-2">
                            <input type="number" name="postalFabrication" class="form-control"
                                   placeholder="Code Postal" value="<?=$order['FABRICATION_POSTAL']?>">
                        </div>
                        <div class="col-3">
                            <input type="text" name="villeFabrication" class="form-control" placeholder="Ville" value="<?=$order['FABRICATION_CITY']?>">
                        </div>
                        <div class="col-3">
                            <input type="text" name="paysFabrication" class="form-control" placeholder="Pays" value="<?=$order['FABRICATION_COUNTRY']?>">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <input type="text" name="nomContactFabrication" class="form-control"
                                   placeholder="Nom du contact" value="<?=$order['FABRICATION_CONTACT_NAME']?>">
                        </div>
                        <div class="col-4">
                            <input type="text" name="prenomContactFabrication" class="form-control"
                                   placeholder="Prenom du contact" value="<?=$order['FABRICATION_CONTACT_FIRSTNAME']?>">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <input type="text" name="fonctionContactFabrication" class="form-control"
                                   placeholder="Fonction du contact" value="<?=$order['FABRICATION_CONTACT_FUNCTION']?>">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <input type="email" name="emailContactFabrication" class="form-control"
                                   placeholder="Email du contact" value="<?=$order['FABRICATION_CONTACT_MAIL']?>">
                        </div>
                        <div class="col-4">
                            <input type="tel" name="telContactFabrication" class="form-control"
                                   placeholder="Téléphone du contact" value="<?=$order['FABRICATION_CONTACT_PHONE']?>">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <input class="btn btn-primary form-control" type="submit" id="admin_create_audit" value="Sauvegarder">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
