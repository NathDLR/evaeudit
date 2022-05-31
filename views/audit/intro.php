<?php $this->setT('Audit - Introduction')?>
<script>
    history.replaceState('', '', '<?= URL . $_SESSION['role'] . '/intro'?>');
</script>
<h1 class="center-text center-text row justify-content-between">    <div class="col-auto">
    <div class="col-auto">
    </div>
    </div><?= lang['Intro'] ?>
    <div class="col-auto">
        <button type="submit" name="submit" form="introform" class="btn btn-secondary" value="<?= lang['Next'] ?>"><i class="fas fa-arrow-right"></i></button>
    </div></h1>
<hr/>
<form action="<?= URL ?><?= $_SESSION['role'] ?>/intro/update" onsubmit="//return handleData()" id="introform" method="post">
    <div class="container col-8">
    <div class="form-group row">
        <label for="clientNb" class="col-3 col-form-label"><?= lang['Client number'] ?></label>
        <div class="col-9">
            <input name="clientNb" value="<?= $audit['CLIENT_NB'] ?: ""; ?>" type="text" class="form-control"
                   id="clientNb">
        </div>
    </div>
    <div class="form-group row">
        <label for="companyName" class="col-3 col-form-label"><?= lang['Company name'] ?></label>
        <div class="col-9">
            <input name="companyName" value="<?= $audit['COMPANY_NAME'] ?: ""; ?>" type="text" class="form-control"
                   id="companyName">
        </div>
    </div>
    <div class="form-group row">
        <label for="headOffice" class="col-3 col-form-label"><?= lang['Head office'] ?></label>
        <div class="col-9">
            <input name="headOffice" value="<?= $audit['HEAD_OFFICE'] ?: ""; ?>" type="text" class="form-control"
                   id="headOffice">
        </div>
    </div>
    <div class="form-group row">
        <label for="auditedSites" class="col-3 col-form-label"><?= lang['Audited sites'] ?></label>
        <div class="col-9">
            <textarea name="auditedSites" type="text" class="form-control"
                      id="auditedSites"><?= $audit['AUDITED_SITE'] ?: ""; ?></textarea>
                </div>
            </div>
            <hr/>
            <div id="datetimes">
                <div class="form-group row" id="dates">
                    <label for="auditDates" class="col-3 col-form-label"><?= lang['Date'] ?></label>
                    <div class="col-8">
                        <input name="auditDates[]" value="<?= $audit['dates'][0]['DATE'] ?? ""; ?>" type="date" class="form-control">
                    </div>
                    <div class="col-1">
                        <?php
                            if(!empty($audit['dates'][0]['DATE'])){?>
                            <a href="<?= URL ?><?= $_SESSION['role'] ?>/intro/delete_date/<?= $audit['dates'][0]['DATE'] ?? '#' ?>" class="btn btn-secondary form-control" value="<?= $audit['dates'][0]['DATE'] ?>">-</a>
        <!--                        <a href="<?/*= URL */?><?/*= $_SESSION['role'] */?>/intro/delete_date/<?/*= $audit['dates'][0]['DATE'] ?? '#' */?>" class="btn btn-outline-danger form-control p-2" style="text-align: center; border-radius: 5px" value="<?/*= $audit['dates'][0]['DATE'] */?>"><div style="width: 30px; height: 10px; border-radius: 5px;" class="mt-1 bg-danger"></div></a>-->
                        <?php } ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="auditStartHour1" class="col-3 col-form-label"><?= lang['Starting hour'] ?></label>
                    <div class="col-9">
                        <input name="auditStartHour1" value="<?php if(isset($audit['dates'][0]['START_HOUR'])){ echo substr_replace( $audit['dates'][0]['START_HOUR'], "", 5, 3);}else{ echo '';} ?>" type="time"
                               class="form-control" id="auditStartHour1">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="auditEndHour1" class="col-3 col-form-label"><?= lang['End hour'] ?></label>
                    <div class="col-9">
                        <input name="auditEndHour1" value="<?php if(isset($audit['dates'][0]['END_HOUR'])){ echo substr_replace( $audit['dates'][0]['END_HOUR'], "", 5, 3);}else{ echo '';} ?>" type="time" class="form-control"
                               id="auditEndHour">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <button type="button" class="btn btn-secondary form-control" id="add-date">+</button>
            </div>
            <hr/>
            <div class="form-group row">
                <label for="Service" class="col-3 col-form-label"><?= lang['Service'] ?></label>
                <div class="col-9">
                    <input name="Service" type="text" class="form-control" id="Service"
                           value="<?= lang['Standard'] ?>" disabled>
                </div>
            </div>
            <div class="form-group row">
                <label for="controlledActivities" class="col-3 col-form-label"><?= lang['Controlled activities'] ?></label>
                <div class="col-9">
            <textarea name="controlledActivities" type="text"
                      class="form-control" id="controlledActivities"><?= $audit['CONTROLLED_ACTIVITY'] ?: ""; ?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="structure" class="col-3 col-form-label"><?= lang['Structure'] ?></label>
                <div class="col-9">
                    <select form="introform" class="form-select form-control" name="structure" id="structure">
                        <option value="" disabled selected hidden><?= lang['Select structure'] ?></option>
                        <option name="structure" value="1" <?php if ($audit['STRUCTURE_ID'] == 1) {
                            echo 'selected';
                        }; ?> ><?= lang['Vegan activity'] ?>
                        </option>
                        <option name="structure" value="2" <?php if ($audit['STRUCTURE_ID'] == 2) {
                            echo 'selected';
                        }; ?>><?= lang['Mixed activity'] ?>
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="subcontractin" class="col-3 col-form-label"><?= lang['Outsourcing'] ?></label>
                <div class="col-9">
                    <select form="introform" class="form-select form-control" name="subcontracting" id="subcontracting">
                        <option value="" disabled selected hidden><?= lang['Select outsourcing'] ?></option>
                        <option name="subcontracting" <?php if(!empty($audit['SUBCONTRACTING_ID'])){ if($audit['SUBCONTRACTING_ID'] == 1){
                            echo 'selected';
                        }}; ?> value="1"><?= lang['Uses subcontracting'] ?>
                        </option>
                        <option name="subcontracting" <?php if(!empty($audit['SUBCONTRACTING_ID'])){ if($audit['SUBCONTRACTING_ID'] == 2){
                            echo 'selected';
                        }}; ?> value="2"><?= lang['Works as subcontractor'] ?>
                        </option>
                        <option name="subcontracting" <?php if(!empty($audit['SUBCONTRACTING_ID'])){ if($audit['SUBCONTRACTING_ID'] == 3){
                            echo 'selected';
                        }}; ?> value="3"><?= lang['Not concerned'] ?>
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="controlType" class="col-3 col-form-label"><?= lang['Audit type'] ?></label>
                <div class="col-9">
                    <select form="introform" class="form-select form-control" name="controlType" id="controlType">
                        <option value="" disabled selected hidden><?= lang['Select audit type'] ?></option>
                        <optgroup label="<?= lang['With appointment'] ?>">
                            <option name="controlType" <?php if ($audit['CONTROL_TYPE_ID'] == 1) {
                                echo 'selected';
                            }; ?> value="1"><?= lang['Initial check'] ?>
                            </option>
                            <option name="controlType" <?php if ($audit['CONTROL_TYPE_ID'] == 2) {
                                echo 'selected';
                            }; ?> value="2"><?= lang['Renewal audit'] ?>
                            </option>
                        </optgroup>
                        <optgroup label="<?= lang['Without appointment'] ?>">
                            <option name="controlType" <?php if ($audit['CONTROL_TYPE_ID'] == 3) {
                                echo 'selected';
                            }; ?> value="3"><?= lang['Unannounced check'] ?>
                            </option>
                        </optgroup>
                    </select>
                </div>
            </div>
            <hr/>
            <div class="form-group row">
                <label for="NameFirstname" class="col-3 col-form-label"><?= lang['Auditor'] ?></label>
                <div class="col-9">
                    <input name="NameFirstname" type="text"
                           value="<?= $audit['AUDITOR']['NAME'] . " " . $audit['AUDITOR']['FIRSTNAME'] ?>"
                           class="form-control" id="NameFirstname" disabled>
                </div>
            </div>
            <div class="form-group row">
                <label for="otherAuditors" class="col-3 col-form-label"><?= lang['Co-auditor'] ?></label>
                <div class="col-9">
                    <input name="otherAuditors" type="text" class="form-control" value="<?= $audit['CO_AUDITOR'] ?: ""; ?>" id="otherAuditors">
                </div>
            </div>
            <div class="form-group row">
                <label for="NameFirstname" class="col-3 col-form-label"><?= lang['Certification officer'] ?></label>
                <div class="col-9">
                    <input name="NameFirstname" type="text"
                           value="<?= $audit['ADMIN']['NAME'] . " " . $audit['ADMIN']['FIRSTNAME'] ?>" class="form-control"
                           id="NameFirstname" disabled>
                </div>
            </div>
        </div>
        <br><br>
        <div class="form-group">
            <table class="table table-hover" id="participants">
                <thead>
                <tr>
                    <th style="text-align: center; padding: 0; border-top: none;" colspan="7"><h4><?= lang['Participants'] ?></h4></th>
                </tr>
                <tr>
                    <th class="center-text"><?= lang['Name'] ?></th>
                    <th class="center-text"><?= lang['Firstname'] ?></th>
                    <th class="center-text"><?= lang['Function'] ?></th>
                    <th class="center-text"><?= lang['Opening meeting'] ?></th>
                    <th class="center-text"><?= lang['Document review'] ?></th>
                    <th class="center-text"><?= lang['Field inspection'] ?></th>
                    <th class="center-text"><?= lang['Closing meeting'] ?></th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="participants-body">
                <tr>
                    <td><input type="text" name="participantN[]" value="<?php $name = isset($audit['participants'][0]) ? $audit['participants'][0]['NAME'] : ''; echo $name;?>" class="form-control"></td>
                    <td><input type="text" name="participantP[]" value="<?php $name = isset($audit['participants'][0]) ? $audit['participants'][0]['FIRSTNAME'] : ''; echo $name;?>" class="form-control"></td>
                    <td><input type="text" name="participantF[]" value="<?php $name = isset($audit['participants'][0]) ? $audit['participants'][0]['FUNCTION'] : ''; echo $name;?>" class="form-control"></td>
                    <td class="align-middle participant"><input class="form-control" value="1" type="checkbox" name="presenceStep1-1" <?php if(isset($audit['participants'][0])){ if($audit['participants'][0]['PRESENCE_STEP1'] == 1){ echo 'checked';}}?>></td>
                    <td class="align-middle participant"><input class="form-control" value="1" type="checkbox" name="presenceStep2-1" <?php if(isset($audit['participants'][0])){ if($audit['participants'][0]['PRESENCE_STEP2'] == 1){ echo 'checked';}}?>></td>
                    <td class="align-middle participant"><input class="form-control" value="1" type="checkbox" name="presenceStep3-1" <?php if(isset($audit['participants'][0])){ if($audit['participants'][0]['PRESENCE_STEP3'] == 1){ echo 'checked';}}?>></td>
                    <td class="align-middle participant"><input class="form-control" value="1" type="checkbox" name="presenceStep4-1" <?php if(isset($audit['participants'][0])){ if($audit['participants'][0]['PRESENCE_STEP4'] == 1){ echo 'checked';}}?>></td>
                    <?php if($_SESSION['role'] == 'auditor'){
                    if(!empty($audit['participants'][0]['PARTICIPANT_ID'])){?>
                        <td><a href="<?= URL ?>auditor/intro/delete_participant/<?= $audit['participants'][0]['PARTICIPANT_ID']?>" class="btn btn-secondary form-control">-</a></td>
                    <?php }} ?>
                </tr>
                <tr>
                    <td><input type="text" name="participantN[]" value="<?php $name = isset($audit['participants'][1]) ? $audit['participants'][1]['NAME'] : ''; echo $name;?>" class="form-control"></td>
                    <td><input type="text" name="participantP[]" value="<?php $name = isset($audit['participants'][1]) ? $audit['participants'][1]['FIRSTNAME'] : ''; echo $name;?>" class="form-control"></td>
                    <td><input type="text" name="participantF[]" value="<?php $name = isset($audit['participants'][1]) ? $audit['participants'][1]['FUNCTION'] : ''; echo $name;?>" class="form-control"></td>
                    <td class="align-middle participant"><input class="form-control" value="1" type="checkbox" name="presenceStep1-2" <?php if(isset($audit['participants'][1])){ if($audit['participants'][1]['PRESENCE_STEP1'] == 1){ echo 'checked';}}?>></td>
                    <td class="align-middle participant"><input class="form-control" value="1" type="checkbox" name="presenceStep2-2" <?php if(isset($audit['participants'][1])){ if($audit['participants'][1]['PRESENCE_STEP2'] == 1){ echo 'checked';}}?>></td>
                    <td class="align-middle participant"><input class="form-control" value="1" type="checkbox" name="presenceStep3-2" <?php if(isset($audit['participants'][1])){ if($audit['participants'][1]['PRESENCE_STEP3'] == 1){ echo 'checked';}}?>></td>
                    <td class="align-middle participant"><input class="form-control" value="1" type="checkbox" name="presenceStep4-2" <?php if(isset($audit['participants'][1])){ if($audit['participants'][1]['PRESENCE_STEP4'] == 1){ echo 'checked';}}?>></td>
                    <?php if($_SESSION['role'] == 'auditor'){
                    if(!empty($audit['participants'][1]['PARTICIPANT_ID'])){?>
                        <td><a href="<?= URL ?>auditor/intro/delete_participant/<?= $audit['participants'][1]['PARTICIPANT_ID']?>" class="btn btn-secondary form-control">-</a></td>
                    <?php }} ?>
                </tr>
                <tr>
                    <td><input type="text" name="participantN[]" class="form-control"  value="<?php $name = isset($audit['participants'][2]) ? $audit['participants'][2]['NAME'] : ''; echo $name;?>"  ></td>
                    <td><input type="text" name="participantP[]" class="form-control"  value="<?php $name = isset($audit['participants'][2]) ? $audit['participants'][2]['FIRSTNAME'] : ''; echo $name;?>"  ></td>
                    <td><input type="text" name="participantF[]" class="form-control"  value="<?php $name = isset($audit['participants'][2]) ? $audit['participants'][2]['FUNCTION'] : ''; echo $name;?>"  ></td>
                    <td class="align-middle participant"><input class="form-control" value="1" type="checkbox" name="presenceStep1-3" <?php if(isset($audit['participants'][2])){ if($audit['participants'][2]['PRESENCE_STEP1'] == 1){ echo 'checked';}}?>></td>
                    <td class="align-middle participant"><input class="form-control" value="1" type="checkbox" name="presenceStep2-3" <?php if(isset($audit['participants'][2])){ if($audit['participants'][2]['PRESENCE_STEP2'] == 1){ echo 'checked';}}?>></td>
                    <td class="align-middle participant"><input class="form-control" value="1" type="checkbox" name="presenceStep3-3" <?php if(isset($audit['participants'][2])){ if($audit['participants'][2]['PRESENCE_STEP3'] == 1){ echo 'checked';}}?>></td>
                    <td class="align-middle participant"><input class="form-control" value="1" type="checkbox" name="presenceStep4-3" <?php if(isset($audit['participants'][2])){ if($audit['participants'][2]['PRESENCE_STEP4'] == 1){ echo 'checked';}}?>></td>
                    <?php if($_SESSION['role'] == 'auditor'){
                    if(!empty($audit['participants'][2]['PARTICIPANT_ID'])){?>
                        <td><a href="<?= URL ?>auditor/intro/delete_participant/<?= $audit['participants'][2]['PARTICIPANT_ID']?>" class="btn btn-secondary form-control">-</a></td>
                    <?php }} ?>
                </tr>
                <tr>
                    <td><input type="text" name="participantN[]" class="form-control"  value="<?php $name = isset($audit['participants'][3]) ? $audit['participants'][3]['NAME'] : ''; echo $name;?>"  ></td>
                    <td><input type="text" name="participantP[]" class="form-control"  value="<?php $name = isset($audit['participants'][3]) ? $audit['participants'][3]['FIRSTNAME'] : ''; echo $name;?>"  ></td>
                    <td><input type="text" name="participantF[]" class="form-control"  value="<?php $name = isset($audit['participants'][3]) ? $audit['participants'][3]['FUNCTION'] : ''; echo $name;?>"  ></td>
                    <td class="align-middle participant"><input class="form-control" value="1" type="checkbox" name="presenceStep1-4" <?php if(isset($audit['participants'][3])){ if($audit['participants'][3]['PRESENCE_STEP1'] == 1){ echo 'checked';}}?>></td>
                    <td class="align-middle participant"><input class="form-control" value="1" type="checkbox" name="presenceStep2-4" <?php if(isset($audit['participants'][3])){ if($audit['participants'][3]['PRESENCE_STEP2'] == 1){ echo 'checked';}}?>></td>
                    <td class="align-middle participant"><input class="form-control" value="1" type="checkbox" name="presenceStep3-4" <?php if(isset($audit['participants'][3])){ if($audit['participants'][3]['PRESENCE_STEP3'] == 1){ echo 'checked';}}?>></td>
                    <td class="align-middle participant"><input class="form-control" value="1" type="checkbox" name="presenceStep4-4" <?php if(isset($audit['participants'][3])){ if($audit['participants'][3]['PRESENCE_STEP4'] == 1){ echo 'checked';}}?>></td>
                    <?php if($_SESSION['role'] == 'auditor'){
                    if(!empty($audit['participants'][3]['PARTICIPANT_ID'])){?>
                        <td><a href="<?= URL ?>auditor/intro/delete_participant/<?= $audit['participants'][3]['PARTICIPANT_ID']?>" class="btn btn-secondary form-control">-</a></td>
                    <?php }} ?>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="8">
                        <button type="button" class="btn btn-secondary form-control" id="add-participant">+</button>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    <div class="form-group row">
        <input type="submit" name="submit"  class="form-control btn btn-primary" value="<?= lang['Save'] ?>">
    </div>
</form>
<div class="row justify-content-between">
    <div class="col-auto"></div>
    <button type="submit" name="submit" form="introform" class="btn btn-secondary" value="<?= lang['Next'] ?>"><i class="fas fa-arrow-right"></i></button>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="<?= URL ?>/public/js/auditor.js"></script>
<?php
array_shift($audit['dates']);
if (count($audit['dates']) > 0) {echo '<script>';
    foreach ($audit['dates'] as $date) {
        echo " addDate('" . $date['DATE'] . "','" . substr_replace( $date['START_HOUR'], "", 5, 3) . "','" . substr_replace( $date['END_HOUR'], "", 5, 3) . "');";
    } echo '</script>';
}

array_shift($audit['participants']);
array_shift($audit['participants']);
array_shift($audit['participants']);
array_shift($audit['participants']);

if (count($audit['participants']) > 0) {echo '<script>';
    foreach ($audit['participants'] as $participant) {
        echo "addParticipant('" . $participant['PARTICIPANT_ID'] ?? '#' . "','" . $participant['NAME'] . "','" . $participant['FIRSTNAME'] . "', '" . $participant['FUNCTION'] . "', '" . $participant['PRESENCE_STEP1'] . "', '" . $participant['PRESENCE_STEP2'] . "', '" . $participant['PRESENCE_STEP3'] . "', '" . $participant['PRESENCE_STEP4'] . "', '" . $_SESSION['role'] . "');";
    } echo '</script>';
}
?>