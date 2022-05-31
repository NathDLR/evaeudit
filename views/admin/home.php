<?php $this->setT('Accueil admin') ?>
<script>
    history.replaceState('', '', '<?= URL . $_SESSION['role'] . '/home'?>');
</script>
<?php
if (isset($audits)) {
    ?>
    <h1><?= lang['My reports'] ?></h1>
    <table id="audit_list">
    <thead>
    <tr>
        <th><?php lang['Name'] ?></th>
        <th><?php lang['Company name'] ?></th>
        <th><?php lang['Status'] ?></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <?php foreach ($audits as $audit) { ?>
        <tr>
        <td><?= $audit['AUDIT_ID'] ?></td>
        <td><?= $audit['COMPANY_NAME'] ?></td>
        <td><?= $audit['AUDITOR'] ?></td>
        <td><?= $audit['STATUS_ID'] . " - " . $audit['STATUS'] ?></td>
        <td>
    <form action="<?= URL ?>admin/change_status/<?= $audit['AUDIT_ID'] ?>" method="post">
        <select id="changestatus" class="form-control" name="changestatus" onchange='this.form.submit()'>

        <?php if ($audit['STATUS_ID'] < 2) { ?>
            <option disabled selected> <?= $audit['STATUS']; ?> </option>
            </select></form>
            </td>
            <td><a href="#" class="btn btn-primary disabled" disabled><?= lang['Edit'] ?></a>
            </td>
            <td><a href="#" target="_blank" class="btn btn-primary disabled" disabled>CAPA</a></td>
            <td><a href="<?= URL ?>pdf/audit/<?= $audit['AUDIT_ID'] ?>" target="_blank"
                   class="btn btn-primary <?php if ($audit['STATUS_ID'] == 0) {
                       echo 'disabled';
                   } ?>" <?php if ($audit['STATUS_ID'] == 0) {
                    echo 'disabled';
                } ?>><?= lang['See report'] ?></a></td>
            </tr>

        <?php } else {
            if ($audit['STATUS_ID'] === 2) {
                echo '<option disabled selected>2 - ' . lang['Delivered by auditor'] . ' </option>';
            }

            ?>
            <option value="3" <?php if ($audit['STATUS_ID'] == 3) {
                echo "selected";
            } ?>>3 - <?= lang['Under review'] ?></option>
            <option value="4" <?php if ($audit['STATUS_ID'] == 4) {
                echo "selected";
            } ?>>4 - <?= lang['Non conformity'] ?></option>
            <option value="5" <?php if ($audit['STATUS_ID'] == 5) {
                echo "selected";
            } ?>>5 - <?= lang['Closed'] ?></option>
            <option value="6">6 - <?= lang['Archived'] ?></option>
            </select>
            </form>
            </td>
            <td><a href="<?= URL ?>admin/intro/default/<?= $audit['AUDIT_ID'] ?>"
                   class="btn btn-primary"><?= lang['Edit'] ?></a>
            </td>

            <td><a href="<?= URL ?>pdf/capa/<?= $audit['AUDIT_ID'] ?>" target="_blank" class="btn btn-primary">CAPA</a>
            </td>
            <td><a href="<?= URL ?>pdf/audit/<?= $audit['AUDIT_ID'] ?>" target="_blank"
                   class="btn btn-primary"><?= lang['See report'] ?></a></td>
            </tr> <?php
        }
    }
    ?></table><?php
}
?><?php
if (isset($archived)) {
    ?>
    <h1><?= lang['Archived reports'] ?></h1>
    <table id="archived_audit_list">
    <thead>
    <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <?php foreach ($archived as $audit) {
        ?>
        <tr>
        <td><?= $audit['AUDIT_ID'] ?></td>
        <td><?= $audit['COMPANY_NAME'] ?></td>
        <td><?= $audit['AUDITOR'] ?></td>
        <td><?= $audit['STATUS_ID'] . " - " . $audit['STATUS'] ?></td>
        <td>
    <form action="<?= URL ?>admin/change_status/<?= $audit['AUDIT_ID'] ?>" method="post">
        <select id="changestatus" class="form-control" name="changestatus" onchange='this.form.submit()'>
        <?php
        if ($audit['STATUS_ID'] < 2) {
            echo '<option disabled selected>' . $audit['STATUS'] . ' </option>';
            ?>
            </td>
            <td><a href="#" class="btn btn-primary disabled" disabled><?= lang['Edit'] ?></a>
            </td>
            <td><a href="#" target="_blank" class="btn btn-primary disabled" disabled>CAPA</a></td>
            <td><a href="<?= URL ?>pdf/audit/<?= $audit['AUDIT_ID'] ?>" target="_blank"
                   class="btn btn-primary"><?= lang['See report'] ?></a></td>
            </tr>

        <?php } else {
            if ($audit['STATUS_ID'] === 2) {
                echo '<option disabled selected>2 - ' . lang['Delivered by auditor'] . ' </option>';
            }

            ?>
            <option value="3" <?php if ($audit['STATUS_ID'] == 3) {
                echo "selected";
            } ?>>3 - <?= lang['Under review'] ?></option>
            <option value="4" <?php if ($audit['STATUS_ID'] == 4) {
                echo "selected";
            } ?>>4 - <?= lang['Non conformity'] ?></option>
            <option value="5" <?php if ($audit['STATUS_ID'] == 5) {
                echo "selected";
            } ?>>5 - <?= lang['Closed'] ?></option>
            <option value="6" selected>6 - <?= lang['Archived'] ?></option>
            </select>
            </form>
            </td>
            <td><a href="<?= URL ?>admin/intro/default/<?= $audit['AUDIT_ID'] ?>"
                   class="btn btn-primary disabled"><?= lang['Details'] ?> / <?= lang['Edit'] ?></a>
            </td>
            <td><a href="<?= URL ?>pdf/capa/<?= $audit['AUDIT_ID'] ?>" target="_blank" class="btn btn-primary">CAPA
                    (PDF)</a></td>
            <td><a href="<?= URL ?>pdf/audit/<?= $audit['AUDIT_ID'] ?>" target="_blank"
                   class="btn btn-primary"><?= lang['AR'] ?> (PDF)</a></td>
            </tr> <?php
        }
    }
    ?></table><?php
}
?>
