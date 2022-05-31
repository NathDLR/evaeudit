<?php $this->setT('Audit - Conclusion')?>
<script>
    history.replaceState('', '', '<?= URL . $_SESSION['role'] . '/conclusion'?>');
</script>
<h1 class="center-text row justify-content-between">
    <div class="col-auto">
        <button type="submit" name="submit" form="conclusionform" class="btn btn-secondary" value="<?= lang['Previous'] ?>"><i class="fas fa-arrow-left"></i></button>
    </div>
    Conclusion<?php if ($_SESSION['role'] == 'auditor') { ?>
        <div>
            <input type="submit" form="conclusionform" name="submit" class="btn btn-secondary form-control" value="<?= lang['Finalize'] ?>">
        </div>
    <?php }else{ ?>     <div class="col-auto">
    </div> <?php } ?></h1>
<hr/>
<form action="<?= URL ?><?= $_SESSION['role'] ?>/conclusion/update" onsubmit="//return handleData()" id="conclusionform" method="post">
    <div class="container col-8">
        <div class="form-group">
            <label for="auditorConclusion"><?= lang['Auditor conclusion'] ?></label>
            <textarea class="form-control" id="auditorConclusion" name="auditorConclusion"
                      rows="8" type="text"><?= $audit['AUDITOR_CONCLUSION'] ?: ""; ?></textarea>
        </div>
        <div class="form-group">
            <label for="vigilance"><?= lang['Vigilance'] ?></label>
            <textarea class="form-control" id="vigilance" name="vigilance"
                      rows="4" type="text" ><?= $audit['VIGILANCE'] ?: ""; ?></textarea>
        </div>
        <div class="form-group">
            <label for="auditorRecommendation"><?= lang['Recommendations'] ?></label>
            <textarea class="form-control" id="auditorRecommendation" name="auditorRecommendation"
                      rows="4" type="text" ><?= $audit['RECOMMENDATION'] ?: ""; ?></textarea>
        </div>
        <div class="form-group row">
            <label for="complementaryAudit" class="col-3 col-form-label"><?= lang['Complementary audit'] ?></label>
            <div class="col-1">
                <input name="complementaryAudit" type="checkbox" value="1" class="form-control"
                       id="complementaryAudit" <?php if(!empty($audit['COMPLEMENTARY_AUDIT'])){ echo 'checked';} ?>>
            </div>
        </div>
        <div class="form-group row">
            <label for="unannouncedControl" class="col-3 col-form-label"><?= lang['Unannounced check'] ?></label>
            <div class="col-1">
                <input name="unannouncedControl" type="checkbox" value="1" class="form-control"
                       id="unannouncedControl" <?php if(!empty($audit['UNANNOUNCED_CONTROL'])){ echo 'checked';} ?>>
            </div>
        </div>


        <div class="form-group">
            <label for="auditorOpinion"><?= lang['Auditor opinion'] ?></label>
                <select form="conclusionform" name="auditorOpinion" id="auditorOpinion" class="form-select form-control" <?php if($_SESSION['role'] == 'admin'){ echo 'disabled';}?>>
                    <option disabled selected><?= lang['Choose option'] ?></option>
                    <option value="1" <?php if(!empty($audit['AUDITOR_OPINION'])){ if($audit['AUDITOR_OPINION']['OPINION_ID'] == 1){echo 'selected';}} ?>><?= lang['Positive'] ?></option>
                    <option value="2" <?php if(!empty($audit['AUDITOR_OPINION'])){ if($audit['AUDITOR_OPINION']['OPINION_ID'] == 2){echo 'selected';}} ?>><?= lang['Favourable'] ?></option>
                    <option value="3" <?php if(!empty($audit['AUDITOR_OPINION'])){ if($audit['AUDITOR_OPINION']['OPINION_ID'] == 3){echo 'selected';}} ?>><?= lang['Unfavourable'] ?></option>
                </select>
        </div>
        <?php if($_SESSION['role'] == 'admin'){?>
            <div class="form-group">
                <label for="adminOpinion"><?= lang['Officer opinion'] ?></label>
                    <select form="conclusionform" name="adminOpinion" id="adminOpinion" class="form-select form-control">
                        <option value="-1" selected><?= lang['Choose option'] ?></option>
                        <option value="1" <?php if(!empty($audit['ADMIN_OPINION'])){ if($audit['ADMIN_OPINION']['OPINION_ID'] == 1){echo 'selected';}} ?>><?= lang['Positive'] ?></option>
                        <option value="2" <?php if(!empty($audit['ADMIN_OPINION'])){ if($audit['ADMIN_OPINION']['OPINION_ID'] == 2){echo 'selected';}} ?>><?= lang['Favourable'] ?></option>
                        <option value="3" <?php if(!empty($audit['ADMIN_OPINION'])){ if($audit['ADMIN_OPINION']['OPINION_ID'] == 3){echo 'selected';}} ?>><?= lang['Unfavourable'] ?></option>
                    </select>
            </div>
        <?php } ?>
        <div class="form-group row">
            <label for="attachment" class="col-auto col-form-label"><?= lang['Attachment'] ?> ?</label>
            <div class="col-1">
                <input name="attachment" type="checkbox" value="1" class="form-control"
                       id="attachment" <?php if(!empty($audit['ATTACHMENT'])){ echo 'checked';} ?>>
            </div>
        </div>
        <div class="form-group row">
            <label for="attachmentDetails" class="col-3 col-form-label"><?= lang['Attachment details'] ?></label>
            <div class="col-9">
                <textarea name="attachmentDetails" type="text"
                          class="form-control" id="attachmentDetails"><?= $audit['ATTACHMENT_DETAILS'] ?: "";?></textarea>
            </div>
        </div>
        <input type="submit" name="submit" class="form-control btn btn-primary" value="Sauvegarder">
    </div>
</form>
<div class="row justify-content-between">
    <div class="col-auto">
        <button type="submit" name="submit" form="conclusionform" class="btn btn-secondary" value="<?= lang['Previous'] ?>"><i class="fas fa-arrow-left"></i></button>
    </div>
    <div class="col-auto">
        <?php if($_SESSION['role'] == 'auditor'){ ?>
            <input type="submit" form="conclusionform" name="submit" class="btn btn-secondary form-control" value="<?= lang['Finalize'] ?>">
        <?php } ?>
    </div>
</div>