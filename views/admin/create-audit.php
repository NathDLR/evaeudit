<?php $this->setT('Création d\'audit')?>
<script>
    history.replaceState('', '', '<?= URL . $_SESSION['role'] . '/create_audit'?>');
</script>
<div class="container d-flex justify-content-center align-items-center">
    <form class="col-5" style="background-color: rgb(232,232,232); padding: 20px" method="POST" action="<?= URL ?>admin/insert_audit">
        <h3>Création d'un rapport d'audit</h3>
        <div id="formfields">
            <label for="companyName">Nom de la société auditée</label><br>
            <input id="companyName" class="form-control" name="companyName"><br>
            <label for="auditor">Auditeur à assigner</label>
            <select id="auditor" class="form-control" name="auditor">
                <option value="false"></option>
                <?php foreach ($auditors as $auditor) {
                    ?>
                    <option value="<?= $auditor['USER_ID']?>"><?= $auditor['FIRSTNAME'] . " " . $auditor['NAME'] ?></option><?php
                } ?>
            </select><br>
            <input class="btn btn-primary form-control" type="submit" id="admin_create_audit" value="Envoyer">
        </div>
    </form>
</div>