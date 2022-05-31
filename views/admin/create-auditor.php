<?php $this->setT('Création d\'auditeur')?>
<script>
    history.replaceState('', '', '<?= URL . $_SESSION['role'] . '/create_auditor'?>');
</script>
<div class="container d-flex justify-content-center align-items-center">
    <form class="col-5" style="background-color: rgb(232,232,232); padding: 15px" method="POST"
          action="<?= URL ?>admin/insert_auditor" onsubmit="return check()">
        <h3>Création d'un auditeur</h3>
        <div id="formfields">
            <label for="name">Nom </label>
            <input id="name" class="form-control" name="name" type="text"><br>
            <label for="firstname">Prénom </label>
            <input id="firstname" class="form-control" name="firstname" type="text"><br>
            <label for="username">Identifiant </label>
            <input id="username" class="form-control" name="username" type="text"><br>
            <label for="password">Mot de passe </label>
            <input id="password" class="form-control" name="password" type="password"><br>
            <label for="passConfirm">Confirmation du mot de passe </label>
            <input id="passConfirm" class="form-control" name="passConfirm" type="password" onkeyup='check()'><span id='message'></span><br>
            <input class="btn btn-primary form-control" type="submit" id="admin_create_audit" value="Envoyer">
        </div>
    </form>
</div>
<script>
    const check = function () {
        if ((document.getElementById('password').value ==
            document.getElementById('passConfirm').value) && document.getElementById('password').value.length > 0 ) {
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