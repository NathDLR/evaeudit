<?php $this->setT('Création du bon de commande'); ?>

<style>
    .row {
        margin-top: 2%;
    }
</style>

<div class="container">
    <div class="card mb-4">
        <div class="card-header text-center">
            <h3>Création d'un bon de commande</h3>
        </div>
        <div class="card-body">
            <div class="group-form">
                <form action="<?= URL ?>admin/order_form/insert" method="post">
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <select class="form-control" name="auditor">
                                <option value="" selected hidden>Sélectionner un auditeur</option>
                                <?php foreach ($auditors as $anAuditor){ ?>
                                    <option value="<?= $anAuditor['USER_ID'];?>"><?= $anAuditor['NAME']. ' ' . $anAuditor['FIRSTNAME'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-4">
                            <select class="form-control" name="certif">
                                <option value="" selected hidden>Sélectionner un(e) chargé de certification</option>
                                <?php foreach ($admins as $anAdmin){ ?>
                                    <option value="<?= $anAdmin['USER_ID'];?>"><?= $anAdmin['NAME']. ' ' . $anAdmin['FIRSTNAME'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-5">
                            <input type="text" name="nomClient" class="form-control" placeholder="Nom du client">
                        </div>
                        <div class="col-3">
                            <input type="text" name="numClient" class="form-control" placeholder="N° du client">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-8">
                                <input value="" class="form-control" name="typePrestation" placeholder="Type de prestation(s)">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-4" style="font-size:1.1em; margin-left: 5%">
                            <input type="radio" class="form-check-input" name="certifCheck" id="Certification-Produit" value="Product" checked>
                            <label for="Certification-Produit">Certification Produit</label>
                        </div>
                        <div class="col-4" style="font-size:1.1em">
                            <input type="radio" class="form-check-input" name="certifCheck" id="Certification-Usine" value="Factory">
                            <label for="Certification-Usine">Certification Usine</label>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <select name="typeAudit" id="" class="form-control" >
                                <option value="" selected hidden>Type d'audit</option>
                                <option value="Audit de renouvellement 36 mois">Audit de renouvellement</option>
                                <option value="1er Audi">1er Audit</option>
                                <option value="Audit Complémentaire">Audit Complémentaire</option>
                                <option value="Audit inopiné">Audit inopiné</option>
                                <option value="Audit de renouvellement">Audit de renouvellement</option>
                            </select>
                        </div>
                        <div class="col-2" >
                            <select name="nbrMounth" id="" class="form-control" style="padding: 0; padding-left: 5px">
                                <option value="" selected hidden>Nombre de mois</option>
                                <option value="18">18 mois</option>
                                <option value="36">36 mois</option>
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
                            <input name="categoryClient" class="form-control" placeholder="Champ(s) d'application">
                        </div>
                        <div class="col-4">
                            <input name="timeAudit" class="form-control" placeholder="Temps d'audit prévue">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <input type="number" name="nbrAuditReport" class="form-control"
                                   placeholder="Rapport d'audit attendus(s)">
                        </div>
                        <div class="col-4">
                            <input name="periodAsk" class="form-control" placeholder="Période demandée">
                        </div>
                    </div>
                    <h2 style="margin-top: 2%; font-style: italic; text-decoration: underline;" class="center-text">
                        Coordonnées du siège social</h2>
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <input type="text" name="nomSiege" class="form-control" placeholder="Nom">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <input type="text" name="adresseSiege" class="form-control" placeholder="Adresse">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-2">
                            <input type="number" name="postalSiege" class="form-control" placeholder="Code Postal">
                        </div>
                        <div class="col-3">
                            <input type="text" name="villeSiege" class="form-control" placeholder="Ville">
                        </div>
                        <div class="col-3">
                            <input type="text" name="paysSiege" class="form-control" placeholder="Pays">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <input type="text" name="nomContactSiege" class="form-control" placeholder="Nom du contact">
                        </div>
                        <div class="col-4">
                            <input type="text" name="prenomContactSiege" class="form-control"
                                   placeholder="Prenom du contact">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <input type="text" name="fonctionContactSiege" class="form-control"
                                   placeholder="Fonction du contact">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <input type="email" name="emailContactSiege" class="form-control"
                                   placeholder="Email du contact">
                        </div>
                        <div class="col-4">
                            <input type="tel" name="telContactSiege" class="form-control"
                                   placeholder="Téléphone du contact">
                        </div>
                    </div>
                    <h2 style="margin-top: 2%; font-style: italic; text-decoration: underline;" class="center-text">
                        Coordonnées du lieu de fabrication</h2>
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <input type="text" name="nomFabrication" class="form-control" placeholder="Nom">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <input type="text" name="adresseFabrication" class="form-control" placeholder="Adresse">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-2">
                            <input type="number" name="postalFabrication" class="form-control"
                                   placeholder="Code Postal">
                        </div>
                        <div class="col-3">
                            <input type="text" name="villeFabrication" class="form-control" placeholder="Ville">
                        </div>
                        <div class="col-3">
                            <input type="text" name="paysFabrication" class="form-control" placeholder="Pays">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <input type="text" name="nomContactFabrication" class="form-control"
                                   placeholder="Nom du contact">
                        </div>
                        <div class="col-4">
                            <input type="text" name="prenomContactFabrication" class="form-control"
                                   placeholder="Prenom du contact">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <input type="text" name="fonctionContactFabrication" class="form-control"
                                   placeholder="Fonction du contact">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <input type="email" name="emailContactFabrication" class="form-control"
                                   placeholder="Email du contact">
                        </div>
                        <div class="col-4">
                            <input type="tel" name="telContactFabrication" class="form-control"
                                   placeholder="Téléphone du contact">
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
