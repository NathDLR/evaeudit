<?php $this->setT('Accueil auditeur')?>
<script>
    history.replaceState('', '', '<?= URL . $_SESSION['role'] . '/home'?>');
</script>
<?php

if (!empty($audits)) {
    ?>

    <table id="auditor_ongoing_reports">
    <thead>
        <tr>
            <th><?= lang['Creation date'] ?></th>
            <th><?= lang['Company name'] ?></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <?php
        foreach ($audits as $audit) {
        ?>
        <tr>
            <td><?= $audit['CREATION_DATE'] ?? null ?></td>
            <td><?= $audit['COMPANY_NAME'] ?></td>
            <td><a class="btn btn-primary" id="auditor_editaudit" href="<?= URL ?>auditor/intro/default/<?= $audit['AUDIT_ID']?>"><?= lang['Edit'] ?></a></td>
            <td><a class="btn btn-primary <?php if($audit['STATUS_ID'] == 0){ echo 'disabled';} ?>" <?php if($audit['STATUS_ID'] == 0){ echo 'disabled';} ?> target="_blank" id="" href="<?= URL ?>pdf/audit/<?= $audit['AUDIT_ID']?>"><?= lang['See report'] ?></a></td>
        </tr> <?php
    }
    ?></table><?php
}
?>
<?php
if (!empty($sentAudits)) {
    ?>
    <br>

    <table id="auditor_sent_reports">
    <thead>
        <tr>
            <th><?= lang['Creation date'] ?? null ?></th>
            <th><?= lang['Company name'] ?></th>
            <th></th>
            <th></th>

        </tr>
    </thead>
    <tbody>
    <?php foreach ($sentAudits as $audit) {
        ?>
        <tr>
            <td><?= $audit['FINALIZATION_DATE'] ?></td>
            <td><?= $audit['COMPANY_NAME'] ?></td>
            <td><a class="btn btn-primary disabled" disabled href="#"><?= lang['Edit'] ?></a></td>
            <td><a class="btn btn-primary" id="" target="_blank" href="<?= URL ?>pdf/audit/<?= $audit['AUDIT_ID']?>"><?= lang['See report'] ?></a></td>
        </tr> <?php
    }
    ?></tbody></table><?php
}
?>


