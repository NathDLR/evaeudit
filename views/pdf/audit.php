<link rel="stylesheet" href="https://kendo.cdn.telerik.com/2020.1.219/styles/kendo.common.min.css">
<link rel="stylesheet" href="https://kendo.cdn.telerik.com/2020.1.219/styles/kendo.rtl.min.css">
<link rel="stylesheet" href="https://kendo.cdn.telerik.com/2020.1.219/styles/kendo.default.min.css">
<link rel="stylesheet" href="https://kendo.cdn.telerik.com/2020.1.219/styles/kendo.mobile.all.min.css">
<style>

    .col-0-5 {
        flex: 0 0 4.2%;
        width: 4.2%;
        padding-right: 1%;
    }

    .col-1-5 {
        flex: 0 0 auto;
        width: 12.33333333%;
        padding-right: 1%;
    }

    /*    th {
            background-color: rgba(59, 159, 59, 0.56);
            border-spacing: 0px !important;
            margin: 0px !important;
        }

        table {
            border-spacing: 0px !important;;
        }

        tr {
            border-bottom: 1px solid black;
            width: 100%;
        }

        th {
            border-right: solid black 1px;
            border-bottom: solid black 1px;
        }

        td {
            border-bottom: 1px solid rgba(0, 0, 0, 0.3);
            font-size: 0.9em;
        }*/

    #pdf {
        font-size: 0.9em;
    }

    #header {
        top: 20px;
        position: absolute;
        left: 35px;
        right: 35px;
        font-size: 90%;
    }

    #footer {
        bottom: 20px;
        position: absolute;
        left: 35px;
        right: 35px;
        font-size: 90%;
    }

    #pdf .title {
        background-color: #86c388;
        text-align: center;
        padding-left: 5px;
        padding-right: 5px;
        margin: 0px;
    }

    #pdf .row div {
        padding: 0px;
    }

    .title .row {
        padding: 0px;
    }

    #pdf .row {
        margin: 0px !important;

    }

    .container {
        padding: 0px !important;
    }

    #pdf h1, h2, h3, h4, h5, h6 {
        margin: 0px;
        padding-left: 5px;
        padding-right: 5px;
    }

    .border-top {
        border-top: 1px black solid !important;
    }

    .border-bottom {
        border-bottom: 1px black solid !important;
    }

    .border-right {
        border-right: 1px black solid !important;
    }

    .border-left {
        border-left: 1px black solid !important;
    }

    #pdf {
        color: black;
    }

    .grid-cell {
        border-bottom: 1px rgb(200, 200, 200) solid;
        border-right: 1px rgb(200, 200, 200) solid;
        padding-left: 5px !important;
    }

    .grid-last-cell {
        border-bottom: 1px rgb(200, 200, 200) solid;
        padding-left: 5px !important;
    }

    #pdf #audit_grid .title .row > * {
        border-right: 1px rgb(0, 0, 0) solid;
        border-left: 1px rgb(0, 0, 0) solid;
        padding-left: 5px;
    }

    /*
        Use the DejaVu Sans font for display and embedding in the PDF file.
        The standard PDF fonts have no support for Unicode characters.
    */

    .k-grid {
        font-family: "DejaVu Sans", "Arial", sans-serif;
        width: 400px;
    }

</style>
<button id="cmd" onclick="ExportPdf();">Generate PDF</button>
<!-- Begin Page Content -->
<div class="container" style="break-inside: avoid" id="pdf">
    <div style="border: 1px solid black" class="container">
        <div class="container text-center title border-bottom">
            <h4><?= mb_strtoupper(lang['Intro']) ?></h4>
        </div>
        <div class="container">
            <div class="container row no-break">
                <div class="grid-cell col-6"><?= lang['Client number'] ?></div>
                <div class="grid-last-cell col-6"><?= $content['audit']['CLIENT_NB'] ?? '' ?></div>
            </div>
            <div class="container row no-break">
                <div class="grid-cell col-6"><?= lang['Company name'] ?></div>
                <div class="grid-last-cell col-6"><?= $content['audit']['COMPANY_NAME'] ?? '' ?></div>
            </div>
            <div class="container row no-break">
                <div class="grid-cell col-6"><?= lang['Head office'] ?></div>
                <div class="grid-last-cell col-6"><?= $content['audit']['HEAD_OFFICE'] ?? '' ?></div>
            </div>
            <?php
            $dates = [];
            $hours = [];
            if (!empty($content['audit']['dates'])) {
                foreach ($content['audit']['dates'] as $date) {
                    $aDate = new DateTime($date['DATE']);

                    $startHour = $date['START_HOUR'] ? new DateTime($date['START_HOUR']) : '';
                    $startHour = $startHour ? $startHour->format('H\hi') : '';

                    $endHour = $date['END_HOUR'] ? new DateTime($date['END_HOUR']) : '';
                    $endHour = $endHour ? $endHour->format('H\hi') : '';
                    array_push($dates, $aDate->format('d/m/Y'));
                    if ((!empty($startHour) && !empty($endHour)) || (!empty($startHour) || !empty($endHour))) {
                        array_push($hours, $startHour . ' - ' . $endHour);
                    } else {
                        array_push($hours, '');
                    }

                }
            }

            ?>
            <div class="container row no-break">
                <div class="grid-cell col-6"><?= lang['Date'] ?>(s)</div>
                <div class="grid-last-cell col-6"><?= implode(',', $dates); ?></div>
            </div>
            <div class="container row no-break">
                <div class="grid-cell col-6"><?= lang['Schedule'] ?></div>
                <div class="grid-last-cell col-6"><?= implode(',', $hours); ?></div>
            </div>
            <div class="container row no-break">
                <div class="grid-cell col-6"><?= lang['Total time'] ?></div>
                <div class="grid-last-cell col-6"><?php print_r($content['audit']['total_time']) ?></div>
            </div>
            <div class="container row no-break">
                <div class="grid-cell col-6"><?= lang['Service'] ?></div>
                <div class="grid-last-cell col-6"><?= lang['Standard'] ?></div>
            </div>
            <div class="container row no-break">
                <div class="grid-cell col-6"><?= lang['Controlled activities'] ?></div>
                <div class="grid-last-cell col-6"><?= $content['audit']['CONTROLLED_ACTIVITY'] ?></div>
            </div>
            <div class="container row no-break ">
                <div class="grid-cell col-6"><?= lang['Structure'] ?></div>
                <div class="grid-last-cell col-6"><?= $content['audit']['activity']['S_LABEL'] ?? '' ?></div>
            </div>
            <div class="container row no-break">
                <div class="grid-cell col-6"><?= lang['Outsourcing'] ?></div>
                <div class="grid-last-cell col-6"><?= $content['audit']['activity']['ST_LABEL'] ?? '' ?></div>
            </div>
            <div class="container row no-break">
                <div class="grid-cell col-6"><?= lang['Audit type'] ?></div>
                <div class="grid-last-cell col-6"><?= $content['audit']['activity']['CT_LABEL'] ?? '' ?></div>
            </div>
        </div>
        <div class="container text-center title  border-top  border-bottom">
            <h4><?= lang['Auditors'] ?></h4>
        </div>
        <div class="container">
            <div class="container row no-break">
                <div class="grid-cell col-6"><?= lang['Name'] . ' & ' . lang['Firstname'] ?></div>
                <div class="grid-last-cell col-6"><?= $content['audit']['AUDITOR']['NAME'] . ' ' . $content['audit']['AUDITOR']['FIRSTNAME'] ?></div>
            </div>
            <div class="container row no-break">
                <div class="grid-cell col-6"><?= lang['Co-auditor'] ?></div>
                <div class="grid-last-cell col-6"><?= $content['audit']['CO_AUDITOR'] ?></div>
            </div>
            <div class="container row no-break">
                <div class="grid-cell col-6"><?= lang['Certification officer'] ?></div>
                <div class="grid-last-cell col-6"><?= $content['audit']['ADMIN']['NAME'] . ' ' . $content['audit']['ADMIN']['FIRSTNAME'] ?></div>
            </div>
        </div>
    </div>
    <br>
    <div style="border: 1px solid black" class="container text-center">
        <div class="container title">
            <h4 style="margin: 0px;" class="border-bottom"><?= mb_strtoupper(lang['Participants']) ?></h4>

            <div class="container row text-center border-bottom" style="margin: 0px !important;">
                <div class="col" style="border-right: 1px solid black"><?= lang['Name'] ?></div>
                <div class="col-2" style="border-right: 1px solid black"><?= lang['Firstname'] ?></div>
                <div class="col-2" style="border-right: 1px solid black"><?= lang['Function'] ?></div>
                <div class="col-1-5" style="border-right: 1px solid black"><?= lang['Opening meeting'] ?></div>
                <div class="col-1-5" style="border-right: 1px solid black"><?= lang['Document review'] ?></div>
                <div class="col-1-5" style="border-right: 1px solid black"><?= lang['Field inspection'] ?></div>
                <div class="col-1-5"><?= lang['Closing meeting'] ?></div>
            </div>
        </div>
        <div class="container">
            <?php
            if (!empty($content['audit']['participants'])) {
                foreach ($content['audit']['participants'] as $participant) {
                    ?>
                    <div class="container row no-break">
                        <div class="grid-cell col"><?= $participant['NAME'] ?></div>
                        <div class="grid-cell col-2"><?= $participant['FIRSTNAME'] ?></div>
                        <div class="grid-cell col-2"><?= $participant['FUNCTION'] ?></div>
                        <div class="grid-cell col-1-5"><?php if ($participant['PRESENCE_STEP1'] == 1) {
                                echo 'X';
                            } ?></div>
                        <div class="grid-cell col-1-5"><?php if ($participant['PRESENCE_STEP2'] == 1) {
                                echo 'X';
                            } ?></div>
                        <div class="grid-cell col-1-5"><?php if ($participant['PRESENCE_STEP3'] == 1) {
                                echo 'X';
                            } ?></div>
                        <div class="grid-last-cell col-1-5"><?php if ($participant['PRESENCE_STEP4'] == 1) {
                                echo 'X';
                            } ?></div>

                    </div>
                <?php }
            }

            ?>
        </div>
    </div>
    <br>
    <div style="border: 1px black solid" class="container">
        <div class="container title border-bottom">
            <h4><?= mb_strtoupper(lang['Risk rating']) ?></h4>
        </div>

        <div class="container row title border-bottom">
            <div class="col-1" style="border-right: 1px black solid"><?= lang['Ref'] ?></div>
            <div class="col-3" style="border-right: 1px black solid"><?= lang['Production conditions'] ?></div>
            <div class="col-1" style="border-right: 1px black solid"><?= lang['Result'] ?></div>
            <div class="col-1" style="border-right: 1px black solid"><?= lang['Score'] ?></div>
            <div class="col-3" style="border-right: 1px black solid"><?= lang['Contamination'] ?></div>
            <div class="col-3"><?= lang['Auditor comment'] ?></div>
        </div>
        <div class="container">
            <?php
            $total = 0;
            for ($i = 0; $i < count($content['risks']['info']); $i++) {
                ?>
                <div class="container row no-break">
                    <div class="grid-cell col-1">1.<?= $content['risks']['info'][$i]['RISK_ID'] ?></div>
                    <div class="grid-cell col-3"><?= $content['risks']['info'][$i]['PRODUCTION_CONDITION'] ?></div>
                    <div class="grid-cell col-1"><?php if ($content['risks']['infoEvaluate'][$i]['RESULT'] === 'Yes') {
                            echo lang['Yes'];
                        } else {
                            echo lang['No'];
                        } ?></div>
                    <div class="grid-cell col-1"><?php if ($content['risks']['infoEvaluate'][$i]['RESULT'] === 'Yes') {
                            echo $content['risks']['info'][$i]['VALUE'];
                            $total += $content['risks']['info'][$i]['VALUE'];
                        } else {
                            echo 0;
                        } ?></div>
                    <div class="grid-cell col-3"><?= $content['risks']['infoEvaluate'][$i]['CONTAMINATION']; ?></div>
                    <div class="grid-last-cell col-3"><?= $content['risks']['infoEvaluate'][$i]['AUDITOR_COMMENT']; ?></div>
                </div>
            <?php }; ?>
            <div class="container row title border-top">
                <div class="col-1"><?= lang['Total'] ?> </div>
                <div class="col-3"></div>
                <div class="col-1"></div>
                <div class="col-1"><?= $total ?> </div>
                <div class="col-3" style="text-align: left"> / <?= $content['MaxRisk'] ?></div>
            </div>
        </div>
    </div>
    <br>
    <div class="container no-break" style="border: 1px black solid">
        <div>
        <div class="container title border-bottom">
            <h4><?= lang['Risk notation'] ?></h4>
        </div>
        <div class="container">
            <?php
            foreach ($content['riskNotation'] as $notation) { ?>
                <div class="container row no-break">
                    <div class="grid-cell col-1"><?= $notation['RISKNOTATION_ID'] ?></div>
                    <div class="grid-cell col-2"><?= $notation['NAME'] ?></div>
                    <div class="grid-cell col-1"><?php
                        switch ($notation['RISKNOTATION_ID']) {
                            case '1':
                                echo '&lt; ' . $notation['VALUE_END'];
                                break;
                            default:
                                echo '> ' . $notation['VALUE_START'];
                                break;
                        }
                        ?>
                    </div>
                    <?php if ($total > $notation['VALUE_START'] && $total < $notation['VALUE_END']) { ?>
                        <div class="grid-last-cell col" style="background-color: rgba(255,242,0,0.82); text-align: center">X</div>
                    <?php } else { ?>
                        <div class="grid-last-cell col" class="text-center"></div>

                    <?php } ?>       </div>
            <?php } ?>
            <div class="container title border-top">
                <h6><?= lang['Risk info'] ?></h6>
            </div>
        </div>
        </div>
    </div>
    <br>
    <div class="container" id="audit_grid" style="border: 1px black solid">
        <div class="container">
            <h4 class="center-text container title"><?= mb_strtoupper(lang['Audit grid']) ?></h4>
            <div class="container row  title border-bottom border-top">
                <div class="col-0-5"><?= lang['Ref'] ?></div>
                <div class="col-2" style="border-left: 1px solid black"><?= lang['Requirements'] ?></div>
                <div class="col-0-5" style="border-left: 1px solid black"><?= lang['Score'] ?></div>
                <div class="col-0-5" style="border-left: 1px solid black"><?= lang['Pts'] ?></div>
                <div class="col-2" style="border-left: 1px solid black">  <?= lang['Situation'] ?></div>
                <div class="col-2" style="border-left: 1px solid black">   <?= lang['Auditor comment'] ?></div>
                <div class="col" style="border-left: 1px solid black">      <?= lang['Corrective action'] ?></div>
                <div class="col-2" style="border-left: 1px solid black">   <?= lang['Additional comment'] ?></div>
            </div>
        </div>
        <div class="container">

            <?php
            $cCount = 0;
            $dCount = 0;
            foreach ($content['grid'] as $row) {
                if (!empty($row['title'])) {
                    ?>
                    <div class="title border-bottom border-top" style="text-align: left">
                        <h5><?= $row['idRequireType'] . ". " . $row['title'] ?></h5>
                    </div>
                    <div class="container grid-row">

                    <?php foreach ($row['RequirementList'] as $requirement) {
                        if ($requirement['DataList']['ID_CRITERION'] == 3) {
                            $cCount++;
                        } elseif ($requirement['DataList']['ID_CRITERION'] == 4) {
                            $dCount++;
                        }
                        ?>
                        <?php if (!($requirement['DataList']['ID_CRITERION'] == 5)) { ?>
                            <div class="container row no-break" style="font-size : 0.7em;">
                                <div class="grid-cell col-0-5"><?= $requirement['RequirementId'] ?></div>
                                <div class="grid-cell col-2">   <?= $requirement['Requirement'] ?></div>
                                <div class="grid-cell col-0-5"><?= $requirement['Critere'][$requirement['DataList']['ID_CRITERION'] - 1]['Letter'] ?? '<span style="color:red">Non noté</span>' ?></div>
                                <div class="grid-cell col-0-5"><?= $requirement['Critere'][$requirement['DataList']['ID_CRITERION'] - 1]['Points'] ?? '' ?></div>
                                <div class="grid-cell col-2">  <?= $requirement['Critere'][$requirement['DataList']['ID_CRITERION'] - 1]['Description'] ?? '' ?></div>
                                <div class="grid-cell col-2"
                                     style="word-wrap: anywhere"><?= $requirement['DataList']['AUDITOR_COMMENT'] ?? '' ?></div>
                                <div class="grid-cell col">    <?= $requirement['Critere'][$requirement['DataList']['ID_CRITERION'] - 1]['Correction'] ?? '' ?></div>
                                <div class="grid-last-cell col-2"
                                     style="word-wrap: anywhere"><?= $requirement['DataList']['CORRECTION_COMMENT'] ?? '' ?></div>
                            </div>
                        <?php } else { ?>
                            <div class="container row no-break" style="font-size : 0.7em;">
                                <div class="grid-cell col-0-5"><?= $requirement['RequirementId'] ?></div>
                                <div class="grid-cell col-2">  <?= $requirement['Requirement'] ?></div>
                                <div class="grid-cell col-0-5"><?= 'NA' ?></div>
                                <div class="grid-cell col-0-5"><?= '0' ?></div>
                                <div class="grid-cell col-2">  <?= '' ?></div>
                                <div class="grid-cell col-2"
                                     style="word-wrap: anywhere"><?= $requirement['DataList']['AUDITOR_COMMENT'] ?? '' ?></div>
                                <div class="grid-cell col">    <?= '' ?></div>
                                <div class="grid-last-cell col-2"
                                     style="word-wrap: anywhere"><?= $requirement['DataList']['CORRECTION_COMMENT'] ?? '' ?></div>
                            </div>
                        <?php }
                    } ?> </div> <?php
                }
            }
            ?>
        </div>
    </div>
    <br>
    <div class="break"></div>
    <div class="container" id="conclusion" style="border: 1px black solid">
        <div class="container">
            <h4 class="container center-text  title border-bottom"><?= mb_strtoupper(lang['Conclusion']) ?></h4>
            <h5 style="text-align: left" class="title border-bottom"><?= mb_strtoupper(lang['Result']) ?></h5>
        </div>
        <div class="container">
            <div class="container row no-break">
                <div class="grid-cell col-6"><?= lang['Audit total'] ?></div>
                <div class="grid-last-cell col-6"><?= $content['grid']['TOTAL'] . ' / ' . $content['grid']['MAX'] . " " . lang['Pts'] ?></div>
            </div>
            <div class="container row no-break">
                <div class="grid-cell col-6"><?= lang['Scoring rate'] ?></div>
                <div class="grid-last-cell col-6"><?= round((($content['grid']['TOTAL'] / $content['grid']['MAX']) * 100), 2) . ' %' ?></div>
            </div>
            <div class="container title border-bottom border-top">
                <h6 style="text-align: left">1. <?= mb_strtoupper(lang['Auditor conclusion']) ?></h6>
            </div>
            <div class="container row no-break">
                <div class="grid-cell col-6"><?= lang['Minor non-conformity'] ?> (C)</div>
                <div class="grid-last-cell col-6"><?= $cCount ?></div>
            </div>
            <div class="container row no-break">
                <div class="grid-cell col-6"><?= lang['Major non-conformity'] ?> (D)</div>
                <div class="grid-last-cell col-6"><?= $dCount ?></div>
            </div>
            <div class="container row no-break" style="padding: 5px !important;">
            <span style="border: 1px solid black; padding: 2px" class="col-12"><?= $content['audit']['AUDITOR_CONCLUSION'] ?? '' ?></span>
            </div>
            <div class="container title border-bottom border-top">
                <h6 style="text-align: left">2. <?= mb_strtoupper(lang['Vigilance']) ?></h6>
            </div>
            <div class="container row no-break" style="padding: 5px !important;">
            <span style="border: 1px solid black;" class="col-12"><?= $content['audit']['VIGILANCE'] ?? lang['No comment'] ?></span>
            </div>
            <div class="container title border-bottom border-top">
                <h6 style="text-align: left">3. <?= mb_strtoupper(lang['Recommendations']) ?></h6>
            </div>
            <div class="container row no-break">
                <div class="grid-cell col-6"><?= lang['Complementary audit'] ?></div>
                <div class="grid-last-cell col-6"> <?= $content['audit']['COMPLEMENTARY_AUDIT'] ? lang['Recommended'] : lang['Not recommended'] ?></div>
            </div>
            <div class="container row no-break">
                <div class="grid-cell col-6"><?= lang['Unannounced check'] ?> </div>
                <div class="grid-last-cell col-6"><?= $content['audit']['UNANNOUNCED_CONTROL'] ? lang['Recommended'] : lang['Not recommended'] ?></div>
            </div>
            <div class="container row no-break border-bottom" style="padding: 5px !important;">
            <span style="border: 1px solid black;" class="col-12 "><?= $content['audit']['RECOMMENDATION'] ?? lang['No comment'] ?></span>
            </div>
            <div class="container title border-bottom">
                <h6 style="text-align: left">4.1 <?= mb_strtoupper(lang['Auditor opinion']) ?></h6>
            </div>
            <div class="container no-break">
                <div class="container border-bottom" style="padding-left: 5px !important;"><?= $content['audit']['AUDITOR_OPINION']['LABEL'] ?? '' ?></div>
                <div class="container">
                    <div class="container row no-break">
                    <div class="grid-cell col-6"><?= lang['Attachment'] ?></div>
                    <div class="grid-last-cell col-6"><?php if ($content['audit']['ATTACHMENT'] == 0) {
                            echo lang['No'];
                        } else {
                            echo lang['Yes'];
                        } ?>
                    </div>
                    </div>
                    <div class="col-12" style="padding: 5px !important;">
                        <div class="container" style="border: 1px solid black; padding-left: 5px !important;"><?= $content['audit']['ATTACHMENT_DETAILS'] ?? lang['No details'] ?></div>
                    </div>
                </div>
            </div>
            <div class="container title border-bottom border-top">
                <h6 style="text-align: left">4.2 <?= mb_strtoupper(lang['Officer opinion']) ?></h6>
            </div>
            <div class="container row no-break grid-last-cell">
                <div class="container" style="padding-left: 5px !important;"><?= $content['audit']['ADMIN_OPINION']['LABEL'] ?? lang['No comment'] ?></div>
            </div>

        </div>
    </div>
</div>
<script type="x/kendo-template" id="page-template">
    <div class="page-template" style="position:absolute; top:0; left:0; width:100%; height:100%">
        <div class="header" style="position: absolute;top: 20px; left: 35px;right: 35px;font-size: 90%;">
            <div style="float: right; top: 0px"><img width="200px" src="<?= URL ?>public/img/logo-vegan.png"></div>
            <div style="float: left; font-weight: bold; color:black"><?= lang['Audit report'] . ' EVE VEGAN' ?></div><br>
            <div style="float: left;  color:black"><?= lang['Version'] . ' ' . Version ?></div><br>
            <div style="float: left;  color:black"><?= lang['Confidential document'] . ' ' . date('d-m-Y')?></div>
        </div>
        <div class="footer" style="position: absolute;bottom: 20px; left: 35px;right: 35px;font-size: 90%;">
            <span>Expertise Vegane Europe, 3 rue Auguste Rodin, 28630 Le Coudray, France</span>
            <div style="float: right"><?= lang['Page'] ?> #: pageNum # / #: totalPages #</div>
        </div>
    </div>
</script>


<script charset="UTF-8" src="https://kendo.cdn.telerik.com/2017.2.621/js/jquery.min.js"></script>
<script charset="UTF-8" src="https://kendo.cdn.telerik.com/2017.2.621/js/jszip.min.js"></script>
<script charset="UTF-8" src="https://kendo.cdn.telerik.com/2017.2.621/js/kendo.all.min.js"></script>

<script>
    // Import DejaVu Sans font for embedding. WebComponentsIcons is the font used for the Kendo font icons only
    kendo.pdf.defineFont({
        "DejaVu Sans": "https://kendo.cdn.telerik.com/2022.1.119/styles/fonts/DejaVu/DejaVuSans.ttf",
        "DejaVu Sans|Bold": "https://kendo.cdn.telerik.com/2022.1.119/styles/fonts/DejaVu/DejaVuSans-Bold.ttf",
        "DejaVu Sans|Bold|Italic": "https://kendo.cdn.telerik.com/2022.1.119/styles/fonts/DejaVu/DejaVuSans-Oblique.ttf",
        "DejaVu Sans|Italic": "https://kendo.cdn.telerik.com/2022.1.119/styles/fonts/DejaVu/DejaVuSans-Oblique.ttf",
        "WebComponentsIcons": "https://kendo.cdn.telerik.com/2022.1.119/styles/fonts/glyphs/WebComponentsIcons.ttf"
    });
</script>
<script charset="UTF-8">

    const ExportPdf = async () => {
        kendo.drawing
            .drawDOM("#pdf",
                {
                    allPages: true,
                    paperSize: "A4",
                    margin: {top: "2.3cm", bottom: "1.5cm", right: "1cm", left: "1cm"},
                    scale: 0.8,
                    height: 500,
                    landscape: true,
                    template: $("#page-template").html(),
                    keepTogether: ".no-break",
                    repeatHeaders: true,
                    forcePageBreak: '.break'

            })
            .then(function (group) {
                kendo.drawing.pdf.saveAs(group, "Exported.pdf")
            });
    }
</script>
<!-- End of Page Wrapper -->

</body>
</html>
