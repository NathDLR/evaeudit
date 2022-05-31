<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= $title;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= URL ?>public/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= URL ?>public/css/audit.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= URL ?>public/css/sb-admin-2.min.css" rel="stylesheet">

    <?=$css;?>

</head>
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?= $sidebar;?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <?= $topbar;?>

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <?= $content;?>

            </div>
            <!-- End Page Content -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span><?= lang['EVE'] ?> &copy; 2016 -
                        <script>
                            ThisYear = new Date().getUTCFullYear();
                            document.write(ThisYear);
                        </script>
                        <?= lang['Legals'] ?>
                    </span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<script>
    const SERVER_URL = '<?= URL ?>';

    const lang = <?= json_encode(lang); ?>;
</script>
<!-- Bootstrap core JavaScript-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= URL ?>public/js/sb-admin-2.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script>

    $(document).ready(function () {
        $('#audit_list').DataTable({
            "columns": [
                { "title": "N°" },
                { "title": "<?= lang['Company name'] ?>" },
                { "title": "<?= lang['Auditor'] ?>" },
                { "title": "<?= lang['Status'] ?>" },
                { "title": "<?= lang['Change status'] ?>" },
                null,
                null,
                null
            ],
            "order": [],
            'aoColumnDefs': [{
                'bSortable': false,
                'aTargets': [4,5,6,7]
            },{"searchable": false, "targets": [4,5,6,7]}],
            "language": {
                'url' : lang['cdn']
            }
        });
    });

    $(document).ready(function () {
        $('#archived_audit_list').DataTable({
            "columns": [
                { "title": "N°" },
                { "title": "<?= lang['Company name'] ?>" },
                { "title": "<?= lang['Auditor'] ?>" },
                { "title": "<?= lang['Status'] ?>" },
                { "title": "<?= lang['Change status'] ?>" },
                null,
                null,
                null
            ],
            "order": [],
            'aoColumnDefs': [{
                'bSortable': false,
                'aTargets': [4,5,6,7]
            },{"searchable": false, "targets": [4,5,6,7]}],
            "language": {
                'url' : lang['cdn']
            }
        });
    });

    $(document).ready(function () {
        $('#auditor_ongoing_reports').DataTable({
            "dom": '<"toolbar">frtip',
            "info":     false,
            "paging": false,
            "order": [[ 0, "desc" ]],
            'aoColumnDefs': [{
                'bSortable': false,
                'aTargets': [2,3]
            },{"searchable": false, "targets": [2,3]}],
            "language": {
                'url' : lang['cdn']
            },
            "fnInitComplete": function(){
                $('#auditor_ongoing_reports_wrapper > .toolbar').html('<h3>' + lang['Ongoing reports'] + '</h3>');
            }
        });
    });
    $(document).ready(function () {
        $('#auditor_sent_reports').DataTable({
            "dom": '<"toolbar">frtip',
            "info":     false,
            "paging": false,
            "order": [[ 0, "desc" ]],
            'aoColumnDefs': [{
                'bSortable': false,
                'aTargets': [2,3]
            },{"searchable": false, "targets": [2,3]}],
            "language": {
                'url' : lang['cdn']
            },
            "fnInitComplete": function(){
                $('#auditor_sent_reports_wrapper > .toolbar').html('<h3>' + lang['Sent reports'] + '</h3>');
            }
        });
    });
    $(document).ready(function () {
        $('#order_form').DataTable({
            "order": [],
            "language": {
                'url' : lang['cdn']
            }
        });
    });



</script>
<?= $modals ?? '';?>
</body>
</html>