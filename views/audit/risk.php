<?php $this->setT('Audit - Cotation des risques')?>
<script>
    history.replaceState('', '', '<?= URL . $_SESSION['role'] . '/risks'?>');
</script>
<h1 class="center-text center-text center-text row justify-content-between"><div class="col-auto">
        <button type="submit" name="submit" form="riskform" class="btn btn-secondary" value="<?= lang['Previous'] ?>"><i class="fas fa-arrow-left"></i></button>
    </div><?= lang['Risk rating'] ?>
    <div class="col-auto">
        <button type="submit" name="submit" form="riskform" class="btn btn-secondary" value="<?= lang['Next'] ?>"><i class="fas fa-arrow-right"></i></button>
    </div>
</h1>

<form action="<?= URL ?><?=$_SESSION['role'];?>/risks/update" id="riskform" method="post">
    <div class="form-group">
        <table class="table" id="participants">
            <thead>
            <tr>
                <th><?= lang['Ref'] ?></th>
                <th><?= lang['Production conditions'] ?></th>
                <th><?= lang['Result'] ?></th>
                <th><?= lang['Note'] ?></th>
                <th><?= lang['Contamination'] ?></th>
                <th><?= lang['Auditor comment'] ?></th>
            </tr>
            </thead>
            <tbody>
            <?php for($i = 0; $i < count($info); $i++){ ?>
                <tr class="trBody">
                    <td>1.<?= $info[$i]['RISK_ID']?></td>
                    <td><?= $info[$i]['PRODUCTION_CONDITION']?></td>
                    <td>
                        <select class="form-control selectResult" name="select_<?= $info[$i]['RISK_ID']?>" id="select_<?= $info[$i]['RISK_ID']?>" onchange="selectNote(<?= $info[$i]['VALUE'] ?>, <?= $info[$i]['RISK_ID']?>)" required>
                            <option value="">Cliquez-ici</option>
                            <?php if ($infoEvaluate[$i]['RESULT'] == "Yes"){ ?>
                                <option value="Yes" selected>Oui</option>
                                <option value="No" >Non</option>
                            <?php }else if ($infoEvaluate[$i]['RESULT'] == "No"){ ?>
                                <option value="Yes">Oui</option>
                                <option value="No" selected>Non</option>
                            <?php }else{ ?>
                                <option value="Yes">Oui</option>
                                <option value="No" selected>Non</option>
                            <?php } ?>
                        </select>
                    </td>
                    <td id="note_<?= $info[$i]['RISK_ID']?>" class="note" about="<?= $info[$i]['VALUE'] ?>">0</td>
                    <td><textarea class="area_<?= $info[$i]['RISK_ID']?>" name="contamination_<?= $info[$i]['RISK_ID']?>" cols="50" rows="3"><?= $infoEvaluate[$i]['CONTAMINATION'];?></textarea></td>
                    <td><textarea class="area_<?= $info[$i]['RISK_ID']?>" name="comment_<?= $info[$i]['RISK_ID']?>" cols="30" rows="3"><?= $infoEvaluate[$i]['AUDITOR_COMMENT'];?></textarea></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="center-text">
        <h2><?= lang['Total'] ?> : <span name="result"></span>/210 - <span id="risk"></span></h2>
        <input style="display: none" type="numbers" name="result">
    </div>
    <div class="form-group row">
        <input type="submit" name="submit" class="form-control btn btn-primary" value="<?= lang['Save'] ?>">
    </div>
</form>
<div class="row justify-content-between">
        <button type="submit" name="submit" form="riskform" class="btn btn-secondary" value="<?= lang['Previous'] ?>"><i class="fas fa-arrow-left"></i></button>
        <button type="submit" name="submit" form="riskform" class="btn btn-secondary" value="<?= lang['Next'] ?>"><i class="fas fa-arrow-right"></i></button>
</div>

<script>
    var riskNotation = [
        {'Name': <?= "'" . lang['Low risk'] . "'"?>, 'valueStart': -1, 'valueEnd': 61},
        {'Name': <?= "'" . lang['Minor danger'] . "'"?>, 'valueStart': 60, 'valueEnd': 131},
        {'Name': <?= "'" . lang['Moderate danger'] . "'"?>, 'valueStart': 130, 'valueEnd': 200},
        {'Name': <?= "'" . lang['Priority risk'] . "'"?>, 'valueStart': 199, 'valueEnd': 211}
    ]
</script>
<script type="text/javascript" src="<?= URL ?>public/js/risk.js"></script>