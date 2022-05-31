<?php $this->setCss('<link href="'.URL.'public/css/grid.css" rel="stylesheet">');?>
<?php $_SESSION['tab_index'] = $_COOKIE['tab_index'] ?? 0;
setcookie("tab_index", "", '0', '/audit-admin/admin/grid');
;?>
<script>
    history.replaceState('', '', '<?= URL . $_SESSION['role'] . '/grid'?>');
</script>


<h1 class="center-text center-text center-text row justify-content-between"><div class="col-auto">
        <button type="submit" name="submit" form="gridform" class="btn btn-secondary" value="<?= lang['Previous'] ?>"><i class="fas fa-arrow-left"></i></button>
    </div><?= lang['Audit grid'] ?>
    <div class="col-auto">
        <button type="submit" name="submit" form="gridform" class="btn btn-secondary" value="<?= lang['Next'] ?>"><i class="fas fa-arrow-right"></i></button>
    </div>
</h1>

<form action="<?= URL . $_SESSION['role']; ?>/grid/update" id="gridform" method="post">
    <div class="form-group">
        <div class="row justify-content-start">
            <?php
            $countGrid = 0;
            foreach ($info as $grid) { ?>
                <div class="col-1-5">
                    <a style="font-size: 0.9em; font-weight: bold;" class="btn btn-outline-primary btnCategory" href="#" onclick="displayTable(<?= ($grid['idRequireType'] - 1); ?>,<?= $countGrid; ?>)"><?= $grid['title']; ?></a>
                </div>
                <?php $countGrid++;
            } ?>
        </div>
        <?php
        $count = 0;
        foreach ($info as $grid) {
            ?>
            <div class="category">
                <hr>
                <?php foreach ($grid['RequirementList'] as $Requirement) { ?>
                    <div style="text-align: start; font-size: 1em" class="row justify-content-between principalHead" id="<?= $Requirement['RequirementId']; ?>">
                        <div class="col-0-5 ref">Ref.</div>
                        <div class="col-1-5 require">Exigence</div>
                        <div class="col-1 eval">Méthode d'évaluation</div>
                        <div class="col-2 letters" id="A">A</div>
                        <div class="col-2 letters" id="B">B</div>
                        <div class="col-2 letters" id="C">C</div>
                        <div class="col-2 letters" id="D">D (Majeure)</div>
                        <div class="col-1 selectNoteHead">Note</div>
                        <div class="col-0-5 pts hidden">Pts</div>
                        <div class="col-2 commentAudit hidden">Commentaire</div>
                        <div class="col-2 correctionAudit hidden">Correction</div>
                        <div class="col-2 correctionSuppAudit hidden">Commentaire additionnel (correction)</div>
                        <?php if ($_SESSION['role'] == 'admin') { ?>
                            <div class="capa-button col-2 hidden">Fiche capa</div>
                        <?php } ?>
                    </div>
                    <hr>
                    <!----------------------------------------------------------------------------------->
                    <div class="row justify-content-between principalBody" style="text-align: start; font-size: 0.8em">
                        <div class="col-0-5 ref"><?= $Requirement['RequirementId']; ?></div>
                        <div class="col-1-5 require" name="requirement" ><p><?= $Requirement['Requirement']; ?></p></div>
                        <div class="col-1 eval"><p><?= $Requirement['EvaluationMethod']; ?></p></div>
                        <?php for ($i = 0; $i < 4; $i++){ ?>
                            <div class="col-2 criteres" id="<?= $Requirement['Critere'][$i]['Letter']; ?>">
                                <p><?= $Requirement['Critere'][$i]['Description']; ?></p>
                            </div>
                        <?php } ?>
                        <div class="col-1 selectNoteBody">
                            <select style="padding: 1px; font-size: 1.2em" class="form-control" name="note_<?= $count ?>" onchange="setNote(<?= $Requirement['RequirementId']; ?>, <?= $count; ?>)">
                                <?php if ($Requirement['isChoose']) { ?>
                                    <option value="none">Cliquez-ici</option>
                                <?php } else { ?>
                                    <option value="none" selected>Cliquez-ici</option>
                                <?php } ?>
                                <?php foreach ($Requirement['Critere'] as $Critere) {
                                    if ($Critere['Description'] != 'Notation non permise.' && $Critere['Description'] != 'Scoring not allowed.') {?>
                                        <option class="io" value="<?= $Requirement['RequirementId'] . '.' . $Critere['idCriteria'] . '.' . $Critere['Points']; ?>" <?= $Critere['isSelected']; ?>><?= $Critere['Letter']; ?></option>
                                    <?php } } ?>
                            </select>
                        </div>
                        <div class="col-0-5 pts"><span id="points_<?= $count ?>"></span></div>
                        <div class="col-2 commentAudit">
                            <textarea class="form-control" rows="4" name="comment_<?= $count ?>"><?= $Requirement['DataList']['AUDITOR_COMMENT']; ?></textarea>
                        </div>
                        <?php foreach ($Requirement['Critere'] as $Critere) { ?>
                            <div class="col-2 correctionAudit" id="<?=$Critere['Letter'];?>">
                                <p><?= $Critere['Correction']; ?></p>
                            </div>
                        <?php } ?>
                        <div class="col-2 correctionSuppAudit">
                            <textarea class="form-control" rows="4" name="supplement_<?= $count ?>"><?= $Requirement['DataList']['CORRECTION_COMMENT']; ?></textarea>
                        </div>
                        <?php if ($_SESSION['role'] == 'admin') { ?>
                            <div class="col-auto capa-button">
                                <a style="font-size: 1.1em" class="btn btn-success" data-toggle="modal" data-target="#capa" href="#" onclick="setDataCapa(<?=$count;?>, '<?=$_SESSION['role'];?>' );">Fiche Capa</a>
                            </div>
                        <?php } ?>
                        <div class="capa hidden">
                            <?php foreach ($Requirement['DataList'] as $keyCapa => $CapaElement){ ?>
                                <label name="<?=$keyCapa;?>"><?= $CapaElement ?></label>
                            <?php } ?>
                        </div>
                    </div>
                    <hr>
                    <?php $count++;} ?>
            </div>
        <?php } ?>
        <input type="hidden" value="<?= $count ?>" name="nbrRow">

    </div>
    <div class="form-group row">
        <input type="submit" name="submit" class="form-control btn btn-primary" value="Sauvegarder">
    </div>
</form>
<div class="row justify-content-between">
    <button type="submit" name="submit" form="gridform" class="btn btn-secondary" value="<?= lang['Previous'] ?>"><i class="fas fa-arrow-left"></i></button>
    <button type="submit" name="submit" form="gridform" class="btn btn-secondary" value="<?= lang['Next'] ?>"><i class="fas fa-arrow-right"></i></button>
</div>


<form id="formUpdate" method="post">
    <div class="modal fade bd-example-modal-lg" id="capa" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalTitle">Fiche Capa de la référence : <span id="ref">1.1</span> | Non-conformité <span id="note">D</span></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div class="container">
                        <div style="margin-top: 2%" class="form-row ">
                            <div class="col">
                                <label id="RequirementTitle">Le(s) référent(s) EVE VEGAN® (déclaration opérateur) sont en charge de la surveillance qualité des produits de l’opérateur.</label>
                            </div>
                        </div>
                        <div class="form-row justify-content-around">
                            <div class="col-5">
                                <label>Historique</label>
                                <select class="form-control" name="history" id="history">
                                    <option value="" selected>Cliquez-ici</option>
                                    <?php foreach ($infoHistory as $history){?>
                                        <option value="<?= $history['HISTORY_ID'];?>"><?= $history['LABEL'];?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-5">
                                <label>Date limite</label>
                                <input class="form-control" name="limitDate" id="limitDate" type="date">
                            </div>
                        </div>
                        <hr>
                        <a style="font-weight: bold;" href="#" onclick="document.getElementById('operator-section').classList.toggle('hidden');">Retour de l'opérateur</a>
                        <hr>
                        <div class="hidden" id="operator-section">
                            <div class="form-row justify-content-around">
                                <div class="col-5">
                                    <label>Date du retour</label>
                                    <input class="form-control" name="returnDate" id="returnDate" type="date">
                                </div>
                                <div class="col-5">
                                    <label>Responsable</label>
                                    <input class="form-control" name="responsable" id="responsable" type="text">
                                </div>
                            </div>
                            <div style="margin-top: 1%" class="form-row justify-content-around">
                                <div class="col-5">
                                    <label>Commentaires</label>
                                    <textarea class="form-control" name="commentsOperator" id="commentsOperator"></textarea>
                                </div>
                                <div class="col-5">
                                    <label>Pièces jointes</label>
                                    <textarea class="form-control" name="attachment" id="attachment"></textarea>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <a style="font-weight: bold;" href="#" onclick="document.getElementById('liberation-eve').classList.toggle('hidden');">Libération par EVE</a>
                        <hr>
                        <div class="hidden" id="liberation-eve">
                            <div class="form-row justify-content-around">
                                <div class="col-5">
                                    <label>Examen par Eve</label>
                                    <select class="form-control" name="examEve" id="examEve">
                                        <option value="">Cliquez-ici</option>
                                        <?php foreach ($infoExamEve as  $examEve){ ?>
                                            <option value="<?= $examEve['EXAM_ID'];?>"><?= $examEve['LABEL'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-5">
                                    <label>Date</label>
                                    <input class="form-control" name="dateCheck" id="dateCheck" type="date">
                                </div>
                            </div>
                            <div style="margin-top: 2%" class="form-row text-center">
                                <div class="col">
                                    <label>Commentaire(s)</label>
                                    <textarea class="form-control" name="commentsLiberation" id="commentLiberation"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-primary" value="Valider">
                </div>
            </div>
        </div>
    </div>
</form>

<script>

    /*
     * Initialise tous les paramètres et affiche par défault les notes choisies et entêtes de première ligne
     */

    var theadRowByClass = document.getElementsByClassName('principalHead');
    var tbodyRowByClass = document.getElementsByClassName('principalBody');

    for (const theTheadElement of theadRowByClass) {
        if (theTheadElement.getAttribute('id').substr(2) !== 1) {
            theTheadElement.style.display = 'none';
        }
    }

    try {
        const cookieValue = document.cookie
            .split('; ')
            .find(row => row.startsWith('categoryIndex='))
            .split('=')[1];
    }catch {

    }

    if (typeof cookieValue !== 'undefined' && typeof cookieValue !== null){
        displayTable(parseInt(cookieValue));
    }else{
        document.cookie = 'categoryIndex=0; path=/audit-admin/admin/grid';
        displayTable(0);
    }

    refreshNote();

    /**
     * Procédure pour afficher l'entête du taleaux pour la première ligne
     * @param int id     id correspondant au champ requirement_type
     */

    function displayTable(id) {
        let theThead = document.getElementById((id + 1) + '.1');
        theThead.classList.remove('hidden');

        let requireTypeDiv = document.getElementsByClassName('category');
        let btnTypeDiv = document.getElementsByClassName('btnCategory');

        for (let i = 0; i < requireTypeDiv.length; i++) {
            if (i != id) {
                requireTypeDiv[i].classList.add('hidden');
                btnTypeDiv[i].classList.remove('active');
            } else {
                requireTypeDiv[id].classList.remove('hidden');
                btnTypeDiv[id].classList.add('active');
            }
        }
     
        document.cookie = 'categoryIndex=' + id + '; path=/audit-admin/<?= $_SESSION['role']?>/grid';

        restartTopHead((id + 1) + '.1', id);
    }

    function refreshNote() {
        let allRow = document.getElementsByClassName('principalBody');
        for (const allRowElement of allRow) {
            let selectNote = allRowElement.getElementsByClassName('selectNoteBody')[0].getElementsByTagName('select')[0].getAttribute('onchange');
            let infoNote = selectNote.substr(8, selectNote.length - 9);
            let allId = infoNote.split(',');
            setNote(parseInt(allId[0]), parseInt(allId[1]));
        }

    }

    /**
     * Procédure servant à afficher les bonnes cases selon la note choisi
     * @param int id     id correspondant au champ requirement
     * @param int idtr     id pour identifier la ligne
     */

    function setNote(id, idtr) {
        let indexTheadRow = idtr;

        let theThead = theadRowByClass[indexTheadRow];
        let theTbody = tbodyRowByClass[indexTheadRow];

        // console.log(theThead);
        const divThead = theThead.getElementsByTagName('div');
        const divTbody = theTbody.getElementsByTagName('div');

        let points = document.getElementById('points_' + idtr);

        //Selection du bon select et de la bonne note de ce dernier
        let note = theTbody.getElementsByTagName('select')[0];

        let valueOptionOfSelect = note.getElementsByTagName('option')[note.selectedIndex].innerHTML;
        let pointOptionOfSelect = note.getElementsByTagName('option')[note.selectedIndex].value.split('.')[3];


        try {
            let noteNext = tbodyRowByClass[indexTheadRow + 1].getElementsByTagName('select')[0];
            var optionNoteNext = noteNext.getElementsByTagName('option')[noteNext.selectedIndex].innerHTML;

            let notePrev = document.getElementsByName('note_' + (idtr - 1))[0];
            var optionNotePrev = notePrev.getElementsByTagName('option')[notePrev.selectedIndex].innerHTML;
        } catch (e) {
        }

        /* define variale */
        let refHead = theThead.getElementsByClassName('ref')[0];
        let requireHead = theThead.getElementsByClassName('require')[0];
        let evalHead = theThead.getElementsByClassName('eval')[0];
        const letters = theThead.getElementsByClassName('letters');
        let selectNoteHead = theThead.getElementsByClassName('selectNoteHead')[0];
        let ptsHead = theThead.getElementsByClassName('pts')[0];
        let commentAuditHead = theThead.getElementsByClassName('commentAudit')[0];
        let correctionAuditHead = theThead.getElementsByClassName('correctionAudit')[0];
        let correctionSuppAuditHead = theThead.getElementsByClassName('correctionSuppAudit')[0];
        let capaHead = theThead.getElementsByClassName('capa-button')[0];

        let refBody = theTbody.getElementsByClassName('ref')[0];
        let requireBody = theTbody.getElementsByClassName('require')[0];
        let evalBody = theTbody.getElementsByClassName('eval')[0];
        const criteres = theTbody.getElementsByClassName('criteres');
        let selectNoteBody = theTbody.getElementsByClassName('selectNoteBody')[0];
        let ptsBody = theTbody.getElementsByClassName('pts')[0];
        let commentAuditBody = theTbody.getElementsByClassName('commentAudit')[0];
        const correctionAuditBody = theTbody.getElementsByClassName('correctionAudit');
        let correctionSuppAuditBody = theTbody.getElementsByClassName('correctionSuppAudit')[0];
        let capaBody = theTbody.getElementsByClassName('capa-button')[0];

        switch (valueOptionOfSelect) {
            case "Cliquez-ici":
            case "Click-here":
                refHead.setAttribute('class', 'col-0-5 ref');
                refBody.setAttribute('class', 'col-0-5 ref');
                requireHead.setAttribute('class', 'col-1-5 require');
                requireBody.setAttribute('class', 'col-1-5 require');
                evalHead.setAttribute('class', 'col-1 eval');
                evalBody.setAttribute('class', 'col-1 eval');
                for (let i = 0; i < letters.length; i++) {
                    letters[i].setAttribute('class', 'col-2 letters');
                    criteres[i].setAttribute('class', 'col-2 criteres');
                }
                selectNoteHead.setAttribute('class', 'col-1 selectNoteHead');
                selectNoteBody.setAttribute('class', 'col-1 selectNoteBody');
                ptsHead.classList.add('hidden');
                ptsBody.classList.add('hidden');
                commentAuditHead.classList.add('hidden');
                commentAuditBody.classList.add('hidden');
                correctionAuditHead.classList.add('hidden');
                for (const correctionAuditElement of correctionAuditBody) {
                    correctionAuditElement.classList.add('hidden');
                }
                correctionSuppAuditHead.classList.add('hidden');
                correctionSuppAuditBody.classList.add('hidden');

                try {
                    capaHead.classList.add('hidden');
                    capaBody.classList.add('hidden');
                } catch (e) {
                }

                if (optionNoteNext == 'Cliquez-ici' || optionNoteNext == 'Click-here') {
                    theadRowByClass[indexTheadRow + 1].style.display = 'none';
                }

                if (optionNotePrev == 'Cliquez-ici' || optionNotePrev == 'Click-here'){
                    theThead.style.display = 'none';
                }

                break;
            case "A":
                refHead.setAttribute('class', 'col-1 ref');
                refBody.setAttribute('class', 'col-1 ref');
                requireHead.setAttribute('class', 'col-2 topComment require');
                requireBody.setAttribute('class', 'col-2 topComment require');
                evalHead.setAttribute('class', 'col-2 eval');
                evalBody.setAttribute('class', 'col-2 eval');
                for (let i = 0; i < letters.length; i++) {
                    if (letters[i].innerText === 'A'){
                        letters['A'].setAttribute('class', 'col-2 letters');
                        criteres['A'].setAttribute('class', 'col-2 criteres');
                    }else{
                        letters[i].classList.add('hidden');
                        criteres[i].classList.add('hidden');
                    }
                }
                selectNoteHead.setAttribute('class', 'col-1 selectNoteHead');
                selectNoteBody.setAttribute('class', 'col-1 selectNoteBody');
                ptsHead.setAttribute('class', 'headComment col-1 pts');
                ptsBody.setAttribute('class', 'bodyComment col-1 pts');
                commentAuditHead.setAttribute('class', 'col-2 commentAudit');
                commentAuditBody.setAttribute('class', 'col-2 commentAudit');
                correctionAuditHead.classList.add('hidden');
                for (const correctionAuditElement of correctionAuditBody) {
                    correctionAuditElement.classList.add('hidden');
                }
                correctionSuppAuditHead.classList.add('hidden');
                correctionSuppAuditBody.classList.add('hidden');
                try {
                    capaHead.classList.add('hidden');
                    capaBody.classList.add('hidden');
                    theadRowByClass[indexTheadRow + 1].style.display = null;
                } catch (e) {}
                theThead.style.display = null;
                break;

            case "B":
                refHead.setAttribute('class', 'col-0-5 ref');
                refBody.setAttribute('class', 'col-0-5 ref');
                requireHead.setAttribute('class', 'col-1-5 topComment require');
                requireBody.setAttribute('class', 'col-1-5 topComment require');
                evalHead.setAttribute('class', 'col-1 eval');
                evalBody.setAttribute('class', 'col-1 eval');
                for (let i = 0; i < letters.length; i++) {
                    if (letters[i].innerText === 'B'){
                        letters['B'].setAttribute('class', 'col-2 letters');
                        criteres['B'].setAttribute('class', 'col-2 criteres');
                    }else{
                        letters[i].classList.add('hidden');
                        criteres[i].classList.add('hidden');
                    }
                }
                selectNoteHead.setAttribute('class', 'col-0-5 selectNoteHead');
                selectNoteBody.setAttribute('class', 'col-0-5 selectNoteBody');
                ptsHead.setAttribute('class', 'headComment col-0-5 pts');
                ptsBody.setAttribute('class', 'bodyComment col-0-5 pts');
                commentAuditHead.setAttribute('class', 'col-2 commentAudit');
                commentAuditBody.setAttribute('class', 'col-2 commentAudit');
                correctionAuditHead.setAttribute('class', 'col-2 correctionAudit');
                for (const correctionAuditElement of correctionAuditBody) {
                    if (correctionAuditElement.getAttribute('id') === "B"){
                        correctionAuditElement.setAttribute('class', 'col-2 correctionAudit');
                    }else{
                        correctionAuditElement.classList.add('hidden');
                    }
                }
                correctionSuppAuditHead.setAttribute('class', 'col-2 correctionSuppAudit');
                correctionSuppAuditBody.setAttribute('class', 'col-2 correctionSuppAudit');
                try {
                    capaHead.classList.add('hidden');
                    capaBody.classList.add('hidden');
                } catch (e) {}
                theadRowByClass[indexTheadRow + 1].style.display = null;
                theThead.style.display = null;
                break;

            case "C":
                refHead.setAttribute('class', 'col-0-5 ref');
                refBody.setAttribute('class', 'col-0-5 ref');
                requireHead.setAttribute('class', 'col-1-5 topComment require');
                requireBody.setAttribute('class', 'col-1-5 topComment require');
                evalHead.setAttribute('class', 'col-1 eval');
                evalBody.setAttribute('class', 'col-1 eval');
                for (let i = 0; i < letters.length; i++) {
                    if (letters[i].innerText === 'C'){
                        letters['C'].setAttribute('class', 'col-2 letters');
                        criteres['C'].setAttribute('class', 'col-2 criteres');
                    }else{
                        letters[i].classList.add('hidden');
                        criteres[i].classList.add('hidden');
                    }
                }
                selectNoteHead.setAttribute('class', 'col-0-5 selectNoteHead');
                selectNoteBody.setAttribute('class', 'col-0-5 selectNoteBody');
                ptsHead.setAttribute('class', 'headComment col-0-5 pts');
                ptsBody.setAttribute('class', 'bodyComment col-0-5 pts');
                commentAuditHead.setAttribute('class', 'col-1-5 commentAudit');
                commentAuditBody.setAttribute('class', 'col-1-5 commentAudit');
                correctionAuditHead.setAttribute('class', 'col-2 correctionAudit');
                for (const correctionAuditElement of correctionAuditBody) {
                    if (correctionAuditElement.getAttribute('id') === "C"){
                        correctionAuditElement.setAttribute('class', 'col-2 correctionAudit');
                    }else{
                        correctionAuditElement.classList.add('hidden');
                    }
                }
                correctionSuppAuditHead.setAttribute('class', 'col-1-5 correctionSuppAudit');
                correctionSuppAuditBody.setAttribute('class', 'col-1-5 correctionSuppAudit');
                try {
                    capaHead.setAttribute('class', 'col-1 capa-button');
                    capaBody.setAttribute('class', 'col-1 capa-button');
                } catch (e) {}
                theadRowByClass[indexTheadRow + 1].style.display = null;
                theThead.style.display = null;
                break;

            case "D":
                refHead.setAttribute('class', 'col-0-5 ref');
                refBody.setAttribute('class', 'col-0-5 ref');
                requireHead.setAttribute('class', 'col-1-5 topComment require');
                requireBody.setAttribute('class', 'col-1-5 topComment require');
                evalHead.setAttribute('class', 'col-1 eval');
                evalBody.setAttribute('class', 'col-1 eval');
                for (let i = 0; i < letters.length; i++) {
                    if (letters[i].innerText === 'D'){
                        letters[i].setAttribute('class', 'col-2 letters');
                        criteres[i].setAttribute('class', 'col-2 criteres');
                    }else{
                        letters[i].classList.add('hidden');
                        criteres[i].classList.add('hidden');
                    }
                }
                selectNoteHead.setAttribute('class', 'col-0-5 selectNoteHead');
                selectNoteBody.setAttribute('class', 'col-0-5 selectNoteBody');
                ptsHead.setAttribute('class', 'headComment col-0-5 pts');
                ptsBody.setAttribute('class', 'bodyComment col-0-5 pts');
                commentAuditHead.setAttribute('class', 'col-1-5 commentAudit');
                commentAuditBody.setAttribute('class', 'col-1-5 commentAudit');
                correctionAuditHead.setAttribute('class', 'col-2 correctionAudit');
                for (const correctionAuditElement of correctionAuditBody) {
                    if (correctionAuditElement.getAttribute('id') === "D"){
                        correctionAuditElement.setAttribute('class', 'col-2 correctionAudit');
                    }else{
                        correctionAuditElement.classList.add('hidden');
                    }
                }
                correctionSuppAuditHead.setAttribute('class', 'col-1-5 correctionSuppAudit');
                correctionSuppAuditBody.setAttribute('class', 'col-1-5 correctionSuppAudit');
                try {
                    capaHead.setAttribute('class', 'col-1 capa-button');
                    capaBody.setAttribute('class', 'col-1 capa-button');
                } catch (e) {}
                theadRowByClass[indexTheadRow + 1].style.display = null;
                theThead.style.display = null;
                break;

            case "NA":
                refHead.setAttribute('class', 'col-1 ref');
                refBody.setAttribute('class', 'col-1 ref');
                requireHead.setAttribute('class', 'col-2 topComment require');
                requireBody.setAttribute('class', 'col-2 topComment require');
                evalHead.setAttribute('class', 'col-2 eval');
                evalBody.setAttribute('class', 'col-2 eval');
                for (let i = 0; i < letters.length; i++) {
                    letters[i].classList.add('hidden');
                    criteres[i].classList.add('hidden');
                }
                selectNoteHead.setAttribute('class', 'col-1 selectNoteHead');
                selectNoteBody.setAttribute('class', 'col-1 selectNoteBody');
                ptsHead.setAttribute('class', 'col-1 pts');
                ptsBody.setAttribute('class', 'col-1 pts');
                commentAuditHead.setAttribute('class', 'col-3 commentAudit');
                commentAuditBody.setAttribute('class', 'col-3 commentAudit');
                correctionAuditHead.classList.add('hidden');
                for (const correctionAuditElement of correctionAuditBody) {
                    correctionAuditElement.classList.add('hidden');
                }
                correctionSuppAuditHead.classList.add('hidden');
                correctionSuppAuditBody.classList.add('hidden');
                capaHead.classList.add('hidden');
                capaBody.classList.add('hidden');
                theadRowByClass[indexTheadRow + 1].style.display = null;
                theThead.style.display = null;
                break;

            default:
                break;
        }
        points.innerHTML = pointOptionOfSelect
    }

    function setDataCapa(idRow, role) {
        let form = document.getElementById('formUpdate');
        let divCapa = document.getElementsByClassName('capa')[idRow];
        let CapaLabel = divCapa.getElementsByTagName('label');
        let requirement = tbodyRowByClass[idRow].getElementsByTagName('div')[1];

        let allDataCapa = [];
        for (const capaLabelElement of CapaLabel) {
            allDataCapa[capaLabelElement.getAttribute('name')] = capaLabelElement.innerHTML;
        }

        let reference = document.getElementById('ref');
        let note = document.getElementById('note');
        let requirementTitle = document.getElementById('RequirementTitle');
        let historyOptions = document.getElementById('history').getElementsByTagName('option');
        let limitDate = document.getElementById('limitDate');
        let returnDate = document.getElementById('returnDate');
        let operator = document.getElementById('responsable');
        let operatorComment =document.getElementById('commentsOperator');
        let attachments = document.getElementById('attachment');
        let exam = document.getElementById('examEve');
        let liberationDate = document.getElementById('dateCheck');
        let liberationComments = document.getElementById('commentLiberation');

        form.setAttribute('action', '/audit-admin/'+role+'/grid/updateCapa/'+ allDataCapa['REVIEW_ID']);
        reference.innerText = allDataCapa['REQUIREMENTTYPE_ID'] + '.' + allDataCapa['REQUIREMENT_ID'];
        note.innerText = allDataCapa['ID_CRITERION'];
        requirementTitle.innerText = requirement.innerText;

        for (const anOption of historyOptions) {
            if (anOption.value === allDataCapa['HISTORY_ID']){
                anOption.setAttribute('selected', true);
            }else{
                anOption.removeAttribute('selected');
            }
        }

        limitDate.value = allDataCapa['LIMIT_DATE'];
        returnDate.value = allDataCapa['RETURN_DATE'];
        operator.value = allDataCapa['OPERATOR_IN_CHARGE'];
        operatorComment.innerText = allDataCapa['OPERATOR_COMMENT'];
        attachments.innerText = allDataCapa['ATTACHMENT'];
        for (const examElement of exam) {
            if (examElement.value === allDataCapa['EXAM_ID']){
                examElement.setAttribute('selected', true);
            }else{
                examElement.removeAttribute('selected');
            }
        }
        liberationDate.value = allDataCapa['LIBERATION_DATE'];
        liberationComments.innerText = allDataCapa['LIBERATION_COMMENT'];


    }

    /**
     * retourne le bon index correspondant à la ligne de requirement, pour le tableau qui contient toutes les ligne de requirement.
     * @param  array theadArray     tableau de contenant la ligne cible
     * @param  int idRequirement     id pour identifier la ligne cible
     * @return int             index de la bonne ligne
     */

    function getIndexTheadRow(theadArray, idRequirement) {
        for (let i = 0; i < theadArray.length; i++) {
            if (theadArray[i].getAttribute('id') == 'principaleHead_' + idRequirement) {
                return i;
            }
        }
    }

    function restartTopHead(id, idtr) {
        if (id.toString().substr(2) == 1) {
            let head = document.getElementById(id);
            head.setAttribute('class', 'row justify-content-between principalHead');

            let theTbody = tbodyRowByClass[idtr];

            let note = theTbody.getElementsByTagName('select')[0];
            let valueOptionOfSelect = note.getElementsByTagName('option')[note.selectedIndex].innerHTML;

            let divHead = head.getElementsByTagName('div');
            if (valueOptionOfSelect === 'Cliquez-ici' || valueOptionOfSelect === 'Click-here') {
                for (let i = 0; i < divHead.length; i++) {
                    if (i < 8) {
                        divHead[i].classList.remove('hidden');
                    } else {
                        divHead[i].classList.add('hidden');
                    }
                }
            }
        }
    }

</script>
