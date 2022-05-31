<style>
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

    #Order_pdf {
        padding: 0px;
    }

    .row {
        margin: 0px !important;
        padding: 0px !important;
    }

    .pbt {
        padding-top: 2px;
        padding-bottom: 2px;
    }

    .pbt2 {
        padding-top: 4px;
        padding-bottom: 4px;
    }

    .td {
        font-size: 0.9em;
    }

</style>
<div class="container">
    <div class="row justify-content-between">
        <div class="col-2">
            <button id="cmd" class="btn btn-secondary " onclick="ExportPdf();"><?= lang["Download"] ?> (PDF)</button>
        </div>
        <div class="col-3">
            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#validModal">Valider le bon de commande</a>
        </div>
    </div>
</div>

<br>
<div id="Order_pdf" class="container border-bottom border-top border-right border-left" style="color: black; font-size: 1em">
    <div class="row border-bottom">
        <div style="font-weight: bold" class="col-4 row pbt2 justify-content-center th border-right text-center">
            <span class="my-auto"><?= lang['Command date'] ?></span>
        </div>
        <div class="col-8 pbt td">
            <span class="my-auto"><?= $content['CREATION_DATE'] ?></span>
        </div>
    </div>
    <div class="row border-bottom">
        <div style="font-weight: bold" class="col-4 row pbt2 justify-content-center row justify-content-center th border-right text-center">
            <span class="my-auto"><?= lang['Auditor'] ?></span>
        </div>
        <div class="col-8 pbt td">
            <span class="my-auto"><?= $content['AUDITOR']['NAME'] . " " . $content['AUDITOR']['FIRSTNAME']?></span>
        </div>
    </div>
    <div class="row border-bottom">
        <div style="font-weight: bold" class="col-4 row pbt2 justify-content-center th border-right text-center">
            <span class="my-auto"><?= lang['Client number'] ?></span>
        </div>
        <div class="col-8 pbt td">
            <span class="my-auto"><?= $content['CLIENT_NB'] ?></span>
        </div>
    </div>
    <div class="row border-bottom">
        <div style="font-weight: bold" class="col-4 row pbt2 justify-content-center th border-right text-center">
            <span class="my-auto"><?= lang['Client name'] ?></span>
        </div>
        <div class="col-8 pbt td">
            <span class="my-auto"><?= $content['COMPANY_NAME'] ?></span>
        </div>
    </div>
    <div class="row border-bottom">
        <div style="font-weight: bold" class="col-4 row pbt2 justify-content-center th border-right text-center">
            <span class="my-auto"><?= lang['Prestation type'] ?></span>
        </div>
        <div class="col-8 pbt td">
            <span class="my-auto"><?= $content['PRESTATION_TYPE'] ?></span>
        </div>
    </div>
    <div class="row border-bottom">
        <div style="font-weight: bold" class="col-4 row pbt2 justify-content-center th border-right text-center">
            <span class="my-auto"><?= lang['Certification type'] ?></span>
        </div>
        <div class="col-8 pbt td">
            <span class="my-auto"><?= $content['TYPE_CERTIF'] ?></span>
        </div>
    </div>
    <div class="row border-bottom">
        <div style="font-weight: bold" class="col-4 row pbt2 justify-content-center th border-right text-center">
            <span class="my-auto"><?= lang['Audit type'] ?></span>
        </div>
        <div class="col-8 pbt td">
            <span class="my-auto"><?= $content['TYPE_AUDIT'] ?></span>
        </div>
    </div>
    <div class="row border-bottom">
        <div style="font-weight: bold" class="col-4 row pbt2 justify-content-center th border-right text-center">
            <span class="my-auto"><?= lang['Head office address'] ?></span>
        </div>
        <div class="col-8 pbt td">
            <span><?= $content['OFFICE_NAME'] ?></span><br>
            <span><?= implode(', ', [$content['OFFICE_ADDRESS'],$content['OFFICE_POSTAL'],$content['OFFICE_CITY'], strtoupper($content['OFFICE_COUNTRY'])]) ?: '' ?></span><br><br>
            <span><?= lang['Contact'] ?> : <?= $content['OFFICE_CONTACT_NAME'] ?> <?= $content['OFFICE_CONTACT_FIRSTNAME'] ?></span>        <br>
            <span><?= lang['Function'] ?> : <?= $content['OFFICE_CONTACT_FUNCTION'] ?></span>        <br>
            <br>
            <div class="row">
                <div class="col-8" style="padding: 0px;">e-mail : <br><?= $content['OFFICE_CONTACT_MAIL'] ?></div>
                <div class="col-4" style="padding: 0px;">phone : <br><?= $content['OFFICE_CONTACT_PHONE'] ?></div>
            </div>
        </div>
    </div>
    <div class="row border-bottom">
        <div style="font-weight: bold" class="col-4 row pbt2 justify-content-center th border-right text-center">
            <span class="my-auto"><?= lang['Site to audit'] ?></span>
        </div>
        <div class="col-8 pbt td">
            <?= $content['FABRICATION_NAME'] ?><br>
            <span><?= implode(', ', [$content['FABRICATION_ADDRESS'],$content['FABRICATION_POSTAL'],$content['FABRICATION_CITY'], strtoupper($content['FABRICATION_COUNTRY'])]) ?: '' ?></span><br><br>
            <span><?= lang['Contact'] ?> : <?= $content['FABRICATION_CONTACT_NAME'] ?> <?= $content['FABRICATION_CONTACT_FIRSTNAME'] ?></span>        <br>
            <span><?= lang['Function'] ?> : <?= $content['FABRICATION_CONTACT_FUNCTION'] ?></span>        <br>
            <br>
            <div class="row">
                <div class="col-8" style="padding: 0px;">e-mail : <br><?= $content['FABRICATION_CONTACT_MAIL'] ?></div>
                <div class="col-4" style="padding: 0px;">phone : <br><?= $content['FABRICATION_CONTACT_PHONE'] ?></div>
            </div>
        </div>
    </div>
    <div class="row border-bottom">
        <div style="font-weight: bold" class="col-4 row pbt2 justify-content-center th border-right text-center">
            <span class="my-auto"><?= lang['Scope'] ?></span>
        </div>
        <div class="col-8 pbt td">
            <span class="my-auto"><?= $content['TYPE_CERTIF'] ?></span>
        </div>
    </div>
    <div class="row border-bottom">
        <div style="font-weight: bold" class="col-4 row pbt2 justify-content-center th border-right text-center">
            <span class="my-auto"><?= lang['Audit duration'] ?></span>
        </div>
        <div class="col-8 pbt td">
            <span class="my-auto"><?= $content['PERIOD'] ?></span>
        </div>
    </div>
    <div class="row border-bottom">
        <div style="font-weight: bold" class="col-4 row pbt2 justify-content-center th border-right text-center">
            <span class="my-auto"><?= lang['Expected report'] ?></span>
        </div>
        <div class="col-8 pbt td">
            <span class="my-auto"><?= $content['NB_REPORT'] ?> rapport(s) d'audit</span>
        </div>
    </div>
    <div class="row border-bottom">
        <div style="font-weight: bold" class="col-4 row pbt2 justify-content-center th border-right text-center">
            <span class="my-auto"><?= lang['Requested period'] ?></span>
        </div>
        <div class="col-8 pbt td">
            <span class="my-auto"><?= $content['PERIOD'] ?></span>
        </div>
    </div>
    <div class="row border-bottom">
        <div style="font-weight: bold" class="col-4 row pbt2 justify-content-center th border-right text-center">
            <span class="my-auto"><?= lang['Certification officer'] ?> EVE</span>
        </div>
        <div class="col-8 pbt td">
            <span class="my-auto"><?= $content['ADMIN']['NAME'] . " " . $content['ADMIN']['FIRSTNAME']?></span>
        </div>
    </div>
</div>
<script type="x/kendo-template" id="page-template">
    <div class="page-template" style="position:absolute; top:0; left:0; width:100%; height:100%">
        <div class="header" style="position: absolute;top: 20px; left: 35px;right: 35px;font-size: 90%; color: black">
            <div class="container justify-content-between row">
                <div class="col-4 border-right border-bottom border-left border-top" style="font-size: 0.7em; padding-top: 0.1cm !important;padding-bottom: 0.1cm !important;">
                    <div>Ref: <b>5-ENR-<?= lang["Audit order ref"] ?>-<?= $content['CLIENT_NB'] . '-' . str_replace( ' ', '-', $content['COMPANY_NAME'])?></b></div>
                    <div>Sté: <b>EXPERTISE VEGANE EUROPE</b></div>
                    <div>Date:<b> 15/03/2021 - Version: V1</b></div>
                </div>
                <div class="col-4 row pbt2 justify-content-center border-bottom border-top" style="font-size: 1.4em; padding-top: 0.1cm !important;padding-bottom: 0.1cm !important;">
                    <span class="my-auto text-center"><b><?= lang['Audit order'] ?></b></span>
                </div>
                <div class="col-4  row justify-content-center border-right border-bottom border-left border-top" style="padding-top: 0.1cm !important;padding-bottom: 0.1cm !important;">
                    <img width="200px" src="<?= URL ?>public/img/logo-vegan.png">
                </div>
            </div>
        </div>
        <br>
        <div class="footer" style="position: absolute;bottom: 20px; left: 35px;right: 35px;font-size: 90%;">
            <div class="col-10" style="font-size: 0.9em; float: left; color: black">
                <span><b>EXPERTISE VEGANE EUROPE S.A.S</b></span><br>
                <span style="font-size: 0.8em">CM101 - Bât.23 - 3 rue Auguste Rodin, 28630 Le Coudray, France</span><br>
                <span style="font-size: 0.8em">https://www.certification-vegan.org/</span><br>
                <span style="font-size: 0.7em">Ce document est la propriété d'EVE et ne peut être reproduit sans son accord écrit</span>
            </div>
            <div style="float: right; bottom: 0px"><?= lang['Page'] ?> #: pageNum # / #: totalPages #</div>
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

    function ExportPdf() {
        kendo.drawing
            .drawDOM("#Order_pdf",
                {
                    allPages: true,
                    paperSize: "A4",
                    margin: {top: "3cm", bottom: "2.5cm", right: "1cm", left: "1cm"},
                    scale: 0.8,
                    height: 500,
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
