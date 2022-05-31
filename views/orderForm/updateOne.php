<a href="<?= URL ?>admin/order_form/valid" class="btn btn-success">Valider le bon de commande</a>
<?php $this->setT('Modification d\' un bon de commande') ?>

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
                            <select class="form-control" name="auditor" id="">
                                <option value="">Sélectionner un auditeur</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <select name="certif" class="form-control">
                                <option value="">Sélectionner un(e) chargé de certification</option>
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
                            <select class="form-control" name="typePrestation" id="">
                                <option value="">Type de prestation(s)</option>
                            </select>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-4" style="font-size:1.1em; margin-left: 5%">
                            <input type="radio" class="form-check-input" name="certifCheck" id="Certification-Produit">
                            <label for="Certification-Produit">Certification Produit</label>
                        </div>
                        <div class="col-4" style="font-size:1.1em">
                            <input type="radio" class="form-check-input" name="certifCheck" id="Certification-Usine">
                            <label for="Certification-Usine">Certification Usine</label>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <select name="typeAudit" id="" class="form-control">
                                <option value="">Type d'audit</option>
                                <option value="">Audit de renouvellement 36 mois</option>
                            </select>
                        </div>
                        <div class="col-4" style="font-size: 1.1em">
                            <input type="checkbox" name="isDistance" id="Audit-Distance" value="distance">
                            <label class="form-check-label" for="Audit-Distance">Audit à Distance</label>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <select name="categoryClient" class="form-control">
                                <option value="">Champ(s) d'application</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <select name="timeAudit" class="form-control">
                                <option value="">Temps d'audit prévu</option>
                            </select>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <input type="number" name="nbrAuditReport" class="form-control"
                                   placeholder="Rapport d'audit attendus(s)">
                        </div>
                        <div class="col-4">
                            <select name="periodAsk" class="form-control">
                                <option value="">Période demandée</option>
                            </select>
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
                        <div class="col-3">
                            <a href="#" class="btn btn-danger">Valider le bon de commande</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
