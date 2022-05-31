<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion sticky-top" id="accordionSidebar"
    style="height: 100%">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= URL; ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Audit Appli</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?= URL ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span><?= lang['Home'] ?></span>
        </a>
    </li>

    <?php if ($_SESSION['role'] == 'admin') { ?>
        <li class="nav-item active">
            <a class="nav-link" href="<?= URL; ?>admin/manage">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span><?= lang['Manage auditors']; ?></span>
            </a>
        </li>
    <?php } ?>

    <hr class="sidebar-divider">

    <?php
    if($_SESSION['Disable_creation'] == 0 && $_SESSION['role'] == 'auditor'){
        ?>
        <li class="nav-item active">
            <a class="nav-link" href="<?= URL . 'auditor/create'; ?>">
                <i class="fas fa-edit"></i>
                <span>
                <?= lang['Create report']; ?>
            </span>
            </a>
        </li>

    <?php } ?>

    <?php if($_SESSION['role'] == 'admin'){ ?>
        <li class="nav-item active">
            <a class="nav-link" href="<?= URL . 'admin/order_form/create'; ?>">
                <i class="fas fa-edit"></i>
                <span>
                <?= 'Créer un bon de commande' ?>
            </span>
            </a>
        </li>

    <?php } ?>

    <?php if ($_SESSION['role'] == 'admin'){ ?>
        <li class="nav-item active">
            <a class="nav-link" href="<?= URL; ?>admin/order_form">
                <i class="fas fa-edit"></i>
                <span>
                Voir les bons de commandes
            </span>
            </a>
        </li>
    <?php } ?>

    <?php if ($_SESSION['role'] == 'admin') { ?>
        <li class='nav-item active'>
            <a class='nav-link' href=' <?= URL ?> admin/create_auditor'>
                <i class='fas fa-user'></i>
                <span> <?= lang['Create auditor']; ?> </span></a>
        </li>
    <?php } ?>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        <?= $heading ?? ''; ?>
    </div>

    <?php
    $i = 1;
    if (!empty($sidebarItems)) {
        foreach ($sidebarItems as $item) { ?>
            <li class="nav-item"> <?php if ($item['action'] == 'finalize') {
                    if ($_SESSION['role'] == 'auditor') { ?>
                        <div style="padding-left: 10px; padding-right: 10px;">
                            <input type="submit" form="<?= $item['formId'] ?>" name="submit"
                                   class="btn btn-light form-control" value="<?= lang['Finalize'] ?>"></div>
                    <?php }
                } else { ?>
                    <a class="nav-link <?= $item['active']; ?>" href="<?= $item['href']; ?>">
                        <i<?= $item['active']; ?>><?php echo $i;
                            $i++ ?></i>
                        <span><?= $item['span']; ?></span></a> <?php } ?>
            </li>
            <?php
        } ?>
        <hr class="sidebar-divider d-none d-md-block"> <?php
    } ?>


    <!--    <li class="nav-item">
            <a class="nav-link" href="/auditor/intro">
                <i class="">1</i>
                <span>Introduction</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/auditor/risks">
                <i class="">2</i>
                <span>Cotation des risques</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/auditor/grid">
                <i class="">3</i>
                <span>Grille d'audit</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/auditor/conclusion">
                <i class="">4</i>
                <span>Conclusion</span></a>
        </li>-->

    <!-- Divider -->
    <!--    <hr class="sidebar-divider">


        <div class="sidebar-heading">
            Interface
        </div>

        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="">1</i>
                <span>Etape</span></a>
        </li>
    -->

    <!-- Nav Item - Pages Collapse Menu -->
    <!--<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="../../../startbootstrap-sb-admin-2-gh-pages/buttons.html">Buttons</a>
                <a class="collapse-item" href="../../../startbootstrap-sb-admin-2-gh-pages/cards.html">Cards</a>
            </div>
        </div>
    </li>-->

    <!-- Nav Item - Utilities Collapse Menu -->
    <!--<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
           aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="../../../startbootstrap-sb-admin-2-gh-pages/utilities-color.html">Colors</a>
                <a class="collapse-item" href="../../../startbootstrap-sb-admin-2-gh-pages/utilities-border.html">Borders</a>
                <a class="collapse-item" href="../../../startbootstrap-sb-admin-2-gh-pages/utilities-animation.html">Animations</a>
                <a class="collapse-item" href="../../../startbootstrap-sb-admin-2-gh-pages/utilities-other.html">Other</a>
            </div>
        </div>
    </li>-->

    <!-- Divider -->
    <!--<hr class="sidebar-divider">-->

    <!-- Heading -->
    <!--    <div class="sidebar-heading">
            Addons
        </div>

        <li class="nav-item">
            <a class="nav-link" href="../../../startbootstrap-sb-admin-2-gh-pages/charts.html">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Charts</span></a>
        </li>-->

    <!-- Divider -->


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>