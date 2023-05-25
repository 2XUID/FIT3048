<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?= $this->fetch('title') ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <?= $this->Html->meta('icon') ?>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <?= $this->Html->css([
        '//cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css',
        '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css',
        'cake', 'styles',
        '//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css',
    ]) ?>
    <?= $this->Html->script([
        '//cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js',
        '//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js',
        '//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js',
        '//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.js',
        '//code.jquery.com/jquery-3.5.1.js',
        'scripts', 'litepicker', 'markdown', 'toasts',
        '//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js'
    ]) ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body class="nav-fixed">
    <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
        <!-- Sidenav Toggle Button-->
        <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle"><i data-feather="menu"></i></button>
        <!-- Navbar Brand-->
        <!-- * * Tip * * You can use text or an image for your navbar brand.-->
        <!-- * * * * * * When using an image, we recommend the SVG format.-->
        <!-- * * * * * * Dimensions: Maximum height: 32px, maximum width: 240px-->
        <a class="navbar-brand pe-3 ps-4 ps-lg-2">MONO Contractor</a>
        <!-- Navbar Search Input-->
        <!-- * * Note: * * Visible only on and above the lg breakpoint-->
        <!-- Navbar Items-->
        <ul class="navbar-nav align-items-center ms-auto">
            <!-- * * Note: * * Visible only below the lg breakpoint-->
            <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="https://production.u22s2110.monash-ie.me/webroot/img/profile-1.png" /></a>
                <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                    <h6 class="dropdown-header d-flex align-items-center">
                        <img class="dropdown-user-img" src="https://production.u22s2110.monash-ie.me/webroot/img/profile-1.png" />
                        <div class="dropdown-user-details">
                            <div class="dropdown-user-details-name">
                                <div> <?= $this->Identity->get('user_prefername', ['class' => "sidenav-footer-title"]) ?></div>
                            </div>
                            <div class="dropdown-user-details-email">
                                <div> <?= $this->Identity->get('email', ['class' => "sidenav-footer-title"]) ?></div>
                            </div>
                        </div>
                    </h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= $this->Url->build('/users/view/' . intval($this->Identity->get('user_id')), ['class' => "dropdown-item"]) ?>">
                        <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
                        Edit your profile
                    </a>
                    <a class="dropdown-item" href="<?= $this->Url->build('/users/logout', ['class' => "dropdown-item"]) ?>">
                        <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sidenav shadow-right sidenav-light">
                <div class="sidenav-menu">
                    <div class="nav accordion" id="accordionSidenav">
                        <!-- Sidenav Menu Heading (Core)-->
                        <!-- Sidenav Accordion (Dashboard)-->
                        <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseDashboards" aria-expanded="false" aria-controls="collapseDashboards">
                            <!-- Sidenav Accordion (Applications)-->
                            <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseApps" aria-expanded="false" aria-controls="collapseApps">
                                <div class="nav-link-icon"><i data-feather="globe"></i></div>
                                Inspection
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseApps" data-bs-parent="#accordionSidenav">
                                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavAppsMenu">
                                    <a class="nav-link" href="<?= $this->Url->build('/inspections') ?>">Inspection List</a>
                                    <a class="nav-link" href="<?= $this->Url->build('/emails/add') ?>">Send email to admin</a>
                                    <!-- <a class="nav-link" href="<?= $this->Url->build('/images/add') ?>">Add Inspection Images and Descriptions</a> -->
                                </nav>
                            </div>
                            <!-- <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseUtilities" aria-expanded="false" aria-controls="collapseUtilities">
                                <div class="nav-link-icon"><i data-feather="tool"></i></div>
                                Images
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseUtilities" data-bs-parent="#accordionSidenav">
                                <nav class="sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?= $this->Url->build('/images') ?>">Images List</a>
                                </nav>
                            </div> -->
                            <!-- Sidenav Footer <a class="nav-link" href="<?= $this->Url->build('/emails/sendemailtoallcontractor') ?>">Send Inspection emails to all contractor</a>-->
                            <!-- Sidenav Footer-->
                    </div>
                </div>
                <div class="sidenav-footer">
                    <div class="sidenav-footer-content">
                        <div class="sidenav-footer-title">Logged in as: <?= $this->Identity->get('user_type', ['class' => "sidenav-footer-subtitle"]) ?></div>
                        <div class="sidenav-footer-title">Your user ID is <?= $this->Identity->get('user_id', ['class' => "sidenav-footer-subtitle"]) ?></div>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </main>
            <footer class="footer-admin mt-auto footer-light">
                <div class="container-xl px-4">
                    <div class="row">
                        <div class="col-md-6 small">Copyright &copy; Mono Apartment 2023</div>
                        <div class="col-md-6 text-md-end small">
                            <a href="https://www.monoapartments.com/privacy-policy/">Privacy Policy</a>
                            &middot;
                            <a href="https://www.monoapartments.com/terms-of-use/">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>

</html>