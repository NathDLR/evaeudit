<?php $this->SetT('Gestion des auditeurs') ?>
<script>
    history.replaceState('', '', '<?= URL . $_SESSION['role'] . '/manage'?>');
</script>
<table class="container">
    <thead>
        <tr>
        <th><?= lang['Name'] ?></th>
            <th><?= lang['Firstname'] ?></th>
            <th><?= lang['Username'] ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $user){ ?>

            <tr <?php if($user['STATUS'] == 0){ echo "style='background-color: rgba(255,0,0,0.2)'";}else{echo "style='background-color: rgba(0,255,0,0.2)'";}?>>
                <td><?= $user['NAME'] ?></td>
                <td><?= $user['FIRSTNAME'] ?></td>
                <td><?= $user['USERNAME'] ?></td>
                <td><a class="btn btn-secondary" data-toggle="modal" data-target="#mdpModal" onclick="changeMDP(<?= $user['USER_ID'] ?>);" href="#">Changer mdp</a></td>
                <td><?php if($user['STATUS'] == 1){ ?>
                        <a class="btn btn-secondary" href="<?= URL ?>admin/manage/disable/<?= $user['USER_ID'] ?>">Désactiver</a>
                    <?php }else{ ?><a class="btn btn-secondary" href="<?= URL ?>admin/manage/enable/<?= $user['USER_ID'] ?>">Réactiver</a> <?php } ?>
                </td>
            </tr>
        <?php }?>
    </tbody>
</table>


    <div class="modal fade" id="mdpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reinitialisation du mot de passe</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="" method="POST" id="mdpModalForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mot de passe</label>
                            <input type="password" class="form-control" id="password" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Confirmer le mot de passe</label>
                            <input type="password" name="password" class="form-control" id="passConfirm" placeholder="Password" onkeyup='check()' required>
                        </div>
                        <span id='message'></span>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script type="text/javascript">

    function changeMDP(id) {
        let modal = document.getElementById("mdpModalForm");
        modal.action = "<?= URL ?>" + "/admin/setPassword/" + id;
    }

    const check = function () {
        if (document.getElementById('password').value.length > 0 && (document.getElementById('password').value ===
            document.getElementById('passConfirm').value)) {
            document.getElementById('message').style.color = 'green';
            document.getElementById('message').innerHTML = 'Correspond';
            return true;
        } else {
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'Ne correspond pas';
            return false;
        }
    };

</script>
