<?php $this->setT('Création d\'audit')?>
<script>
    history.replaceState('', '', '<?= URL . $_SESSION['role'] . '/create'?>');
</script>
<div class="container d-flex justify-content-center align-items-center">
    <form class="col-5" style="background-color: rgb(232,232,232); padding: 20px" method="POST" action="<?= URL ?>auditor/insert">
        <h3>Création d'un rapport d'audit -- A traduire --</h3>
        <div id="formfields">
            <label for="companyName">Nom de la société auditée</label><br>
            <input id="companyName" class="form-control" name="companyName"><br>
            <label for="admin">Chargé de certification</label>
            <select id="admin" class="form-control" name="admin">
                <option value="false"></option>
                <?php foreach ($admins as $admin) {
                    ?>
                    <option value="<?= $admin['USER_ID']?>"><?= $admin['FIRSTNAME'] . " " . $admin['NAME'] ?></option><?php
                } ?>
            </select><br>
            <input class="btn btn-primary form-control" type="submit" id="auditor_create_audit" value="Envoyer">
        </div>
    </form>
</div>