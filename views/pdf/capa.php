<style>

    .navbar {
        margin-bottom: 0 !important;
    }

    h1 {
        font-size: 1em;
        font-weight: bold;
        margin: 0;
    }

    #content {
        background-color: rgb(82, 86, 89);
    }

    #contentFormMoi {
        color: black;
        background-color: white;
    }

    h1{
        color: black;
    }

    .hrCapa {
        background-color: #C8C8C8;
        margin-bottom: 3px;
        margin-top: -10px;
    }

    .th {
        margin-left: 3px;
        text-align: start;
    }

    .td {
        margin-left: -4px;
        text-align: start;
    }

    .topCat {
        background-color: #DCDCDC
    }

    label{
        color: black;
    }
    .bas {
        position: fixed;
        padding: 10px 10px 10px 10px;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 40px;
        /*background: lightgrey;*/
    }

</style>

<div style="background-color: #323639; padding: 20px; width: 104%; color: whitesmoke; margin-left: -2%; box-shadow: 0 4px 6px -1px #2d2e33;">
    <h1 style="color: white">CAPA[n°<?= substr($_GET['action'], 9);?>].pdf</h1>
</div>

<div style="background-color: white; padding-bottom: 2%; padding-top: 2%; margin-top: 5px" class="container ">

    <div id="contentFormMoi">
        <div class="form-group">

        <div style="border: black solid 1px" id="IdentificationForm">
            <div id="IdentificationTitle" style="background-color: rgba(59, 159, 59, 0.56);">
                <div style="text-align: start; font-size: 1em; padding-top: 3px"
                     class="row justify-content-center principalHead">
                    <div class="col-2">
                        <label style="font-weight: bold">IDENTIFICATION</label>
                    </div>
                </div>
                <hr class="hrCapa">
            </div>
            <div class="row justify-content-start">
                <div class="col-6 th">
                    <label>N° de client :</label>
                </div>
                <div class="col-6 td">
                    <label><?=$infoCapas[0]['CLIENT_NB'];?>. </label>
                </div>
            </div>
            <hr class="hrCapa">
            <div class="row justify-content-start" style="padding: -10px">
                <div class="col-6 th">
                    <label>Nom de la société :</label>
                </div>
                <div class="col-6 td">
                    <label><?=$infoCapas[0]['COMPANY_NAME'];?>.</label>
                </div>
            </div>
            <hr class="hrCapa">
            <div class="row justify-content-start">
                <div class="col-6 th">
                    <label>Date(s) d'évaluation :</label>
                </div>
                <div class="col-6 td">
                    <label>
                        <?php foreach ($infoDates as $Date){
                            echo $Date['DATE']. ' ';
                        } ?>.
                    </label>
                </div>
            </div>
            <hr class="hrCapa">
            <div class="row">
                <div class="col-6 th">
                    <label>Auditeur :</label>
                </div>
                <div class="col-6 td">
                    <label><?=$infoUsers[1]['NAME']?></label>
                </div>
            </div>
            <hr class="hrCapa">
            <div class="row">
                <div class="col-6 th">
                    <label>Chargé de Certification :</label>
                </div>
                <div class="col-6 td">
                    <label><?=$infoUsers[0]['NAME']?></label>
                </div>
            </div>
        </div>

        <?php $count = 1; foreach ($infoCapas as $anCapa) { ?>
            <?php if($count != 1){ ?>
                <div class="page-break"></div>
            <?php } ?>
            <br>
                <div style="border: solid black 1px; background-color: #DCDCDC;"
                     id="TitleListeConform">
                    <div style="padding-top: 2px;" class="row text-center">
                        <div class="col">
                            <h1 class="topCat">Liste des non-conformités majeures nécessitant une action corrective obligatoire.</h1>
                        </div>
                    </div>
                </div>
                <div style="border: black solid 1px; border-top: none; " id="RestCapaForm">
                    <div style="width: 100%; margin: 0; text-align: start; font-size: 1em; padding-top: 3px; padding-bottom: 0; background-color: rgba(59, 159, 59, 0.56);"
                         class="row justify-content-center">
                        <div class="col-6">
                            <label style="font-weight: bold; margin-left: 3px">NC n°:</label>
                        </div>
                        <div class="col-6">
                            <label style="font-weight: bold"><?=$count?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 th">
                            <label>Type :</label>
                        </div>
                        <div class="col-6 td">
                            <label><?=$anCapa['LETTER']?></label>
                        </div>
                    </div>
                    <hr class="hrCapa">
                    <div class="row">
                        <div class="col-6 th">
                            <label>Historique :</label>
                        </div>
                        <div class="col-6 td">
                            <label><?=$anCapa['HISTORY']?>.</label>
                        </div>
                    </div>
                    <hr class="hrCapa">
                    <div class="row">
                        <div class="col-6 th">
                            <label>Référence grille :</label>
                        </div>
                        <div class="col-6 td">
                            <label><?=$anCapa['REF']?>.</label>
                        </div>
                    </div>
                    <hr class="hrCapa">
                    <div class="row">
                        <div class="col-6 th">
                            <label>Critère :</label>
                        </div>
                        <div class="col-6 td">
                            <label><?=$anCapa['REQUIREMENT']?>.</label>
                        </div>
                    </div>
                    <hr class="hrCapa">
                    <div class="row">
                        <div class="col-6 th">
                            <label>Résultat obtenu :</label>
                        </div>
                        <div class="col-6 td">
                            <label><?=$anCapa['AUDITOR_COMMENT']?>.</label>
                        </div>
                    </div>
                    <hr class="hrCapa">
                    <div class="row">
                        <div class="col-6 th">
                            <label>Correction(s) :</label>
                        </div>
                        <div class="col-6 td">
                            <label><?=$anCapa['CORRECTION']?>.</label>
                        </div>
                    </div>
                    <hr class="hrCapa">
                    <div class="row">
                        <div class="col-6 th">
                            <label>Date butoir prévue :</label>
                        </div>
                        <div class="col-6 td">
                            <label><?=$anCapa['LIMIT_DATE']?>.</label>
                        </div>
                    </div>
                    <div style="border: solid black 1px; background-color: #DCDCDC;" id="TitleListeConform">
                        <div style="padding-top: 2px;" class="row text-center">
                            <div class="col">
                                <h1 class="topCat">Retour de l'opérateur.</h1>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 th">
                            <label>Date de retour :</label>
                        </div>
                        <div class="col-6 td">
                            <label><?=$anCapa['RETURN_DATE']?>.</label>
                        </div>
                    </div>
                    <hr class="hrCapa">
                    <div class="row">
                        <div class="col-6 th">
                            <label>Responsable :</label>
                        </div>
                        <div class="col-6 td">
                            <label><?=$anCapa['OPERATOR_IN_CHARGE']?>.</label>
                        </div>
                    </div>
                    <hr class="hrCapa">
                    <div class="row">
                        <div class="col-6 th">
                            <label>Commentaire(s) :</label>
                        </div>
                        <div class="col-6 td">
                            <label><?=$anCapa['OPERATOR_COMMENT']?>.</label>
                        </div>
                    </div>
                    <hr class="hrCapa">
                    <div class="row">
                        <div class="col-6 th">
                            <label>Pièces jointes :</label>
                        </div>
                        <div class="col-6 td">
                            <label><?=$anCapa['ATTACHMENT']?>.</label>
                        </div>
                    </div>
                    <div style="border: solid black 1px; background-color: #DCDCDC;" id="TitleListeConform">
                        <div style="padding-top: 2px;" class="row text-center">
                            <div class="col">
                                <h1 class="topCat">Libération par EVE .</h1>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 th">
                            <label>Examen par EVE :</label>
                        </div>
                        <div class="col-6 td">
                            <label><?=$anCapa['EXAMEN']?>.</label>
                        </div>
                    </div>
                    <hr class="hrCapa">
                    <div class="row">
                        <div class="col-6 th">
                            <label>Nom du responsable :</label>
                        </div>
                        <div class="col-6 td">
                            <label><?=$infoUsers[1]['NAME']?></label>
                        </div>
                    </div>
                    <hr class="hrCapa">
                    <div class="row">
                        <div class="col-6 th">
                            <label>Date :</label>
                        </div>
                        <div class="col-6 td">
                            <label><?=$anCapa['LIBERATION_DATE']?>.</label>
                        </div>
                    </div>
                    <hr class="hrCapa">
                    <div class="row">
                        <div class="col-6 th">
                            <label>Commentaire(s) :</label>
                        </div>
                        <div class="col-6 td">
                            <label><?=$anCapa['LIBERATION_COMMENT']?>.</label>
                        </div>
                    </div>
<!--                    <hr class=hrCapa>
                    <div class="row">
                        <div class="col-6 th">
                            <label>Nom du responsable d'approbation :</label>
                        </div>
                        <div class="col-6 td">
                            <label><?/*=$anCapa['HISTORY']*/?>.</label>
                        </div>
                    </div>-->
                </div>


        <?php $count++; } ?>

            <script type="x/kendo-template" id="page-template">
                <div class="page-template" style="position:absolute; top:0; left:0; width:100%; height:100%">
                    <div class="header" style="position: absolute;top: 20px; left: 35px;right: 35px;font-size: 90%;">
                        <div class="row justify-content-between">
                            <div class="col-4">
                                <h1 style="margin: 0">RAPPORT CAPA <br> (Actions Correctives et Préventives)</h1>
                                <label style="margin: 0">Version V1-01.09.2021</label>
                                <label>Document confidentiel au :

                                </label>
                            </div>
                            <div class="col-3 align-self-center">
                                <h1 style="margin: 0">EXPERTISE VEGANE EUROPE</h1>
                            </div>
                            <div class="col-4">
                                <img src="../../public/img/logo-vegan.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="footer" style="position: absolute;bottom: 20px; left: 35px;right: 35px;font-size: 90%;">
                        <label>Expertise Vegane Europe, 3 rue Auguste Rodin, 28630 Le Coudray, France</label>
                        <div style="float: right"><label> #: pageNum # / #: totalPages #</label></div>
                    </div>
                </div>
            </script>
        </div>
    </div>


</div>

<button onclick="ExportPdf()">Générer le pdf</button>


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
            .drawDOM("#contentFormMoi",
                {
                    forcePageBreak: ".page-break",
                    paperSize: "A4",
                    margin: {top: "2.5cm", bottom: "1cm", right: "1cm", left: "1cm"},
                    scale: 0.6,
                    height: 500,
                    template: $("#page-template").html()
                })
            .then(function (group) {
                kendo.drawing.pdf.saveAs(group, "CAPA[n°].pdf");
            });
    }
</script>