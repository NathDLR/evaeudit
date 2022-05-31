<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapport - <?= $content['audit']['COMPANY_NAME'] ?? 'PDF' ?></title>
</head>
<body id="page-top">

<style>
    :root {
        --breakpoint-xs: 0;
        --breakpoint-sm: 576px;
        --breakpoint-md: 768px;
        --breakpoint-lg: 992px;
        --breakpoint-xl: 1200px;
        --font-family-sans-serif: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        --font-family-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
    }

    html {
        font-family: sans-serif;
        line-height: 1.15;
        -webkit-text-size-adjust: 100%;
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    }

    body {
        margin: 0;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        text-align: left;
        background-color: #fff;
    }

    .container {
        width: 100%;
        margin-right: auto;
        margin-left: auto;
    }

    .text-center {
        text-align: center;
    }

    .col-1 {
        flex: 0 0 8.333333%;
        width: 8.333333%;
    }

    .col-2 {
        flex: 0 0 16.666667%;
        width: 16.666667%;
    }

    .col-3 {
        flex: 0 0 25%;
        width: 25%;
    }

    .col-4 {
        flex: 0 0 33.333333%;
        width: 33.333333%;
    }

    .col-5 {
        flex: 0 0 41.666667%;
        width: 41.666667%;
    }

    .col-6 {
        flex: 0 0 50%;
        width: 50%;
    }

    .col-7 {
        flex: 0 0 58.333333%;
        width: 58.333333%;
    }

    .col-8 {
        flex: 0 0 66.666667%;
        width: 66.666667%;
    }

    .col-9 {
        flex: 0 0 75%;
        width: 75%;
    }

    .col-10 {
        flex: 0 0 83.333333%;
        width: 83.333333%;
    }

    .col-11 {
        flex: 0 0 91.666667%;
        width: 91.666667%;
    }

    .col-12 {
        flex: 0 0 100%;
        width: 100%;
    }

    footer {
        padding-bottom: 15px;
        padding-top: 15px;
    }

    th {
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
    }

    @page {
        counter-increment: page;
        margin-bottom: 60px;
        margin-top: 100px;
    }

    td {
        padding-left: 5px;
    }

</style>
<!-- Begin Page Content -->
<div class="container" style="break-inside: avoid" id="pdf">
    <table style="border: 1px solid black" class="container">
        <thead>
        <tr>
            <th class="center-text" colspan="2"><?= mb_strtoupper(lang['Intro']) ?></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?= lang['Client number'] ?></td>
            <td><?= $content['audit']['CLIENT_NB'] ?? '' ?></td>
        </tr>
        <tr>
            <td><?= lang['Company name'] ?></td>
            <td><?= $content['audit']['COMPANY_NAME'] ?? '' ?></td>
        </tr>
        <tr>
            <td><?= lang['Head office'] ?></td>
            <td><?= $content['audit']['HEAD_OFFICE'] ?? '' ?></td>
        </tr>
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
        <tr>
            <td><?= lang['Date'] ?>(s)</td>
            <td><?= implode(',', $dates); ?>
            </td>
        </tr>
        <tr>
            <td><?= lang['Schedule'] ?></td>
            <td><?= implode(',', $hours); ?>
            </td>
        </tr>
        <tr>
            <td><?= lang['Total time'] ?></td>
            <td><?php print_r($content['audit']['total_time']) ?></td>
        </tr>
        <tr>
            <td><?= lang['Service'] ?></td>
            <td><?= lang['Standard'] ?></td>
        </tr>
        <tr>
            <td><?= lang['Controlled activities'] ?></td>
            <td><?= $content['audit']['CONTROLLED_ACTIVITY'] ?></td>
        </tr>
        <tr>
            <td><?= lang['Structure'] ?></td>
            <td><?= $content['audit']['activity']['S_LABEL'] ?? '' ?></td>
        </tr>
        <tr>
            <td><?= lang['Outsourcing'] ?></td>
            <td><?= $content['audit']['activity']['ST_LABEL'] ?? '' ?></td>
        </tr>
        <tr>
            <td><?= lang['Audit type'] ?></td>
            <td><?= $content['audit']['activity']['CT_LABEL'] ?? '' ?></td>
        </tr>
        <tr>
            <th colspan="2"><?= mb_strtoupper(lang['Auditors']) ?></th>
        </tr>
        <tr>
            <td><?= lang['Name'] . ' & ' . lang['Firstname'] ?></td>
            <td><?= $content['audit']['AUDITOR']['NAME'] . ' ' . $content['audit']['AUDITOR']['FIRSTNAME'] ?></td>
        </tr>
        <tr>
            <td><?= lang['Co-auditor'] ?></td>
            <td><?= $content['audit']['CO_AUDITOR'] ?></td>
        </tr>
        <tr>
            <td><?= lang['Certification officer'] ?></td>
            <td><?= $content['audit']['ADMIN']['NAME'] . ' ' . $content['audit']['ADMIN']['FIRSTNAME'] ?></td>
        </tr>

        </tbody>
    </table>
    <table style="border: 1px solid black" class="container text-center">
        <thead>
        <tr>
            <th scope="col" colspan="7"><?= mb_strtoupper(lang['Participants']) ?></th>
        <tr>
        <tr>
            <th scope="col"><?= lang['Name'] ?></th>
            <th scope="col"><?= lang['Firstname'] ?></th>
            <th scope="col"><?= lang['Function'] ?></th>
            <th scope="col"><?= lang['Opening meeting'] ?></th>
            <th scope="col"><?= lang['Document review'] ?></th>
            <th scope="col"><?= lang['Field inspection'] ?></th>
            <th scope="col"><?= lang['Closing meeting'] ?></th>
        </tr>
        </thead>
        <?php
        if (!empty($content['audit']['participants'])) {
            foreach ($content['audit']['participants'] as $participant) {
                ?>
                <tr>
                    <td><?= $participant['NAME'] ?></td>
                    <td><?= $participant['FIRSTNAME'] ?></td>
                    <td><?= $participant['FUNCTION'] ?></td>
                    <td><?php if ($participant['PRESENCE_STEP1'] == 1) {
                            echo 'X';
                        } ?></td>
                    <td><?php if ($participant['PRESENCE_STEP2'] == 1) {
                            echo 'X';
                        } ?></td>
                    <td><?php if ($participant['PRESENCE_STEP3'] == 1) {
                            echo 'X';
                        } ?></td>
                    <td><?php if ($participant['PRESENCE_STEP4'] == 1) {
                            echo 'X';
                        } ?></td>

                </tr>
            <?php }
        }

        ?>
    </table>
    <div style="page-break-inside: avoid">
        <table style="border: 1px black solid" class="container text-center" style="break-before: auto">
            <thead>
            <tr>
                <th colspan="6"><?= mb_strtoupper(lang['Risk rating']) ?></th>
            </tr>
            <tr>
                <th><?= lang['Ref'] ?></th>
                <th><?= 'Condition --à trad --' ?></th>
                <th><?= lang['Result'] ?></th>
                <th><?= lang['Score'] ?></th>
                <th><?= lang['Contamination'] ?></th>
                <th><?= lang['Auditor comment'] ?></th>
            </tr>
            </thead>
            <?php
            $total = 0;
            for ($i = 0; $i < count($content['risks']['info']); $i++) {
                ?>
                <tr>
                    <td>1.<?= $content['risks']['info'][$i]['RISK_ID'] ?></td>
                    <td style="text-align: justify"
                        ;><?= $content['risks']['info'][$i]['PRODUCTION_CONDITION'] ?></td>
                    <td><?php if ($content['risks']['infoEvaluate'][$i]['RESULT'] === 'checked') {
                            echo lang['Yes'];
                        } else {
                            lang['No'];
                        } ?></td>
                    <td><?php if (!empty($content['risks']['infoEvaluate'][$i]['RESULT'])) {
                            echo $content['risks']['info'][$i]['VALUE'];
                            $total += $content['risks']['info'][$i]['VALUE'];
                        } else {
                            echo 0;
                        } ?></td>
                    <td style="text-align: justify"
                        ;><?= $content['risks']['infoEvaluate'][$i]['CONTAMINATION']; ?></td>
                    <td style="text-align: justify"
                        ;><?= $content['risks']['infoEvaluate'][$i]['AUDITOR_COMMENT']; ?></td>
                </tr>
            <?php }; ?>
            <tr>
                <th><?= lang['Total'] ?> </th>
                <th></th>
                <th></th>
                <th><?= $total ?> </th>
                <th style="text-align: left" colspan="2"> / <?= $content['MaxRisk'] ?></th>
            </tr>
        </table>
    </div>
    <br>
    <table class="container" style="page-break-after: always;page-break-inside: avoid; border: 1px black solid">
        <thead>
        <tr>
            <th colspan="5">Notation des risques</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($content['riskNotation'] as $notation) { ?>
            <tr>
            <td class="col-1"><?= $notation['RISKNOTATION_ID'] ?></td>
            <td class="col-2"><?= $notation['NAME'] ?></td>
            <td class="col-1"><?php
                switch ($notation['RISKNOTATION_ID']) {
                    case '1':
                        echo '&lt; ' . $notation['VALUE_END'];
                        break;
                    default:
                        echo '> ' . $notation['VALUE_START'];
                        break;
                }
                ?>
            </td>
            <?php if ($total > $notation['VALUE_START'] && $total < $notation['VALUE_END']) { ?>
                <td colspan="2" style="background-color: #fff200;" class="text-center"> X</td>
                </tr>
            <?php } else { ?>
                <td colspan="2" class="text-center"></td>
            <?php }
        } ?>
        <tr>
            <th colspan="5"><?= lang['Risk info'] ?> </th>
        </tr>
        </tbody>
    </table>
    <table style="border: 1px solid black" class="container">
        <thead>
        <tr>
            <th class="center-text" colspan="8"><?= mb_strtoupper(lang['Audit grid']) ?></th>
        </tr>
        <tr>
            <th><?= lang['Ref'] ?></th>
            <th class="col"><?= lang['Requirements'] ?></th>
            <th><?= lang['Score'] ?></th>
            <th><?= lang['Pts'] ?></th>
            <th class="col"><?= lang['Situation'] ?></th>
            <th class="col"><?= lang['Auditor comment'] ?></th>
            <th class="col"><?= lang['Corrective action'] ?></th>
            <th class="col"><?= lang['Additional comment'] ?></th>
        </tr>
        </thead>
        <tbody class="col-12" style="text-align: justify" ;>

        <?php
        $cCount = 0;
        $dCount = 0;
        foreach ($content['grid'] as $row) {
            if (!empty($row['title'])) {
                ?>
                <tr>
                    <th colspan="8"
                        style="text-align: left"><?= $row['idRequireType'] . ". " . $row['title'] ?></th>
                </tr>

                <?php foreach ($row['RequirementList'] as $requirement) {
                    if ($requirement['DataList']['ID_CRITERION'] == 3) {
                        $cCount++;
                    } elseif ($requirement['DataList']['ID_CRITERION'] == 4) {
                        $dCount++;
                    }
                    ?>
                    <?php if (!($requirement['DataList']['ID_CRITERION'] == 5)) { ?>
                        <tr style="font-size : 0.7em;">
                            <td><?= $requirement['RequirementId'] ?></td>
                            <td><?= $requirement['Requirement'] ?></td>

                            <td><?= $requirement['Critere'][$requirement['DataList']['ID_CRITERION'] - 1]['Letter'] ?? '<span style="color:red">Non noté</span>' ?></td>
                            <td><?= $requirement['Critere'][$requirement['DataList']['ID_CRITERION'] - 1]['Points'] ?? '' ?></td>
                            <td><?= $requirement['Critere'][$requirement['DataList']['ID_CRITERION'] - 1]['Description'] ?? '' ?></td>
                            <td style="word-wrap: anywhere"><?= $requirement['DataList']['AUDITOR_COMMENT'] ?? '' ?></td>
                            <td><?= $requirement['Critere'][$requirement['DataList']['ID_CRITERION'] - 1]['Correction'] ?? '' ?></td>
                            <td style="word-wrap: anywhere"><?= $requirement['DataList']['CORRECTION_COMMENT'] ?? '' ?></td>
                        </tr>
                    <?php } else { ?>
                        <tr style="font-size : 0.7em;">
                            <td><?= $requirement['RequirementId'] ?></td>
                            <td><?= $requirement['Requirement'] ?></td>
                            <td><?= 'NA' ?></td>
                            <td><?= '0' ?></td>
                            <td><?= '' ?></td>
                            <td style="word-wrap: anywhere"><?= $requirement['DataList']['AUDITOR_COMMENT'] ?? '' ?></td>
                            <td><?= '' ?></td>
                            <td style="word-wrap: anywhere"><?= $requirement['DataList']['CORRECTION_COMMENT'] ?? '' ?></td>
                        </tr>
                    <?php }
                }
            }
        }
        ?>
        </tbody>
    </table>
    <div style="page-break-inside: avoid">
        <table style="border: 1px solid black" class="container">
            <thead>
            <tr>
                <th class="center-text" colspan="2"><?= mb_strtoupper(lang['Conclusion']) ?></th>
            </tr>
            <tr>
                <th colspan="2"><?= mb_strtoupper(lang['Result']) ?></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?= lang['Audit total'] ?></td>
                <td><?= $content['grid']['TOTAL'] . ' / ' . $content['grid']['MAX'] . " " . lang['Pts'] ?></td>
            </tr>
            <tr>
                <td><?= lang['Scoring rate'] ?></td>
                <td><?= round((($content['grid']['TOTAL'] / $content['grid']['MAX']) * 100), 2) . ' %' ?></td>
            </tr>
            <tr>
                <th colspan="2">1. <?= mb_strtoupper(lang['Auditor conclusion']) ?></th>
            </tr>
            <tr>
                <td><?= lang['Minor non-conformity'] ?> (C)</td>
                <td><?= $cCount ?></td>
            </tr>
            <tr>
                <td><?= lang['Major non-conformity'] ?> (D)</td>
                <td><?= $dCount ?></td>
            </tr>
            <tr>
                <td colspan="2"><?= $content['audit']['AUDITOR_CONCLUSION'] ?? '' ?></td>
            </tr>
            <tr>
                <th colspan="2">2. <?= mb_strtoupper(lang['Vigilance']) ?></th>
            </tr>
            <tr>
                <td colspan="2"><?= $content['audit']['VIGILANCE'] ?? lang['No comment'] ?></td>
            </tr>
            <tr>
                <th colspan="2">3. <?= mb_strtoupper(lang['Recommendations']) ?></th>
            </tr>
            <tr>
                <td><?= lang['Complementary audit'] ?></td>
                <td> <?= $content['audit']['COMPLEMENTARY_AUDIT'] ? lang['Recommended'] : lang['Not recommended'] ?></td>
            </tr>
            <tr>
                <td><?= lang['Unannounced check'] ?> </td>
                <td><?= $content['audit']['UNANNOUNCED_CONTROL'] ? lang['Recommended'] : lang['Not recommended'] ?></td>
            </tr>
            <tr>
                <td colspan="2"><?= $content['audit']['RECOMMENDATION'] ?? '' ?></td>
            </tr>
            <tr>
                <th colspan="2">4.1 <?= mb_strtoupper(lang['Auditor opinion']) ?></th>
            </tr>
            <tr>
                <td colspan="2"><?= $content['audit']['AUDITOR_OPINION']['LABEL'] ?? '' ?></td>
            </tr>
            <tr>
                <th colspan="2">4.2 <?= mb_strtoupper(lang['Officer opinion']) ?></th>
            </tr>
            <tr>
                <td colspan="2"><?= $content['audit']['ADMIN_OPINION']['LABEL'] ?? '' ?></td>
            </tr>
            <tr>
                <td><?= lang['Attachment'] ?></td>
                <td><?php if ($content['audit']['ATTACHMENT'] == 0) {
                        echo lang['No'];
                    } else {
                        echo lang['Yes'];
                    } ?>
                </td>
            </tr>
            <tr>
                <td colspan="2"><?= $content['audit']['ATTACHMENT_DETAILS'] ?? '' ?></td>
            </tr>
            </tbody>
        </table>

    </div>
</div>
<!-- End Page Content -->

<!-- End of Page Wrapper -->

</body>
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
    function ExportPdf() {
        kendo.drawing
            .drawDOM("#pdf",
                {
                    allPages: true,
                    paperSize: "A4",
                    margin: {top: "1cm", bottom: "1cm", right: "1cm", left: "1cm"},
                    scale: 0.8,
                    height: 500,
                    landscape: true
                })
            .then(function (group) {
                kendo.drawing.pdf.saveAs(group, "Exported.pdf")
            });
    }
</script>
</html>