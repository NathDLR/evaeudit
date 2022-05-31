<script>
    history.replaceState('', '', '<?= URL . $_SESSION['role'] . '/finalization'?>');
</script>
<?php $this->setT('Audit - ' . lang['Finalization']) ?>
<div class="container col-6">
    <?php $counter = 0;
    foreach ($content['audit'] as $key => $item) {
        if (empty($item) && !empty(lang["f.$key"])) {
            echo "<p>" . lang["f.$key"] . "</p>";
            $counter++;
        }
    }

    if ($counter < 1) { ?>
        <p><b><?= lang['Finalize message'] ?></b></p>
        <a class="btn btn-primary form-control" href="#" data-toggle="modal" data-target="#finalizeModal">Finaliser</a>
    <?php } else { ?>
        <a class="btn btn-primary disabled form-control" disabled>Finaliser</a>
        <?php echo '<div style="color:red;">' . $counter . ' ' . lang['f.Count'] . ' </div>';
    } ?>

</div>
<style>
    p {
        margin-bottom: 8px;
    }
</style>