<!DOCTYPE html>
<html lang="es">

<!--begin::Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title><?= env('app_name', 'Inicio') ?></title>

    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="AdminLTE 4 | Sidebar Mini">
    <meta name="author" content="ColorlibHQ">
    <meta name="description"
          content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS.">
    <meta name="keywords"
          content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard">
    <!--end::Primary Meta Tags-->

    <!--begin::Fonts-->
    <link rel="stylesheet" href="<?php asset('vendor/adminlte/plugins/source-sans/index.css'); ?>">
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="<?php asset('vendor/adminlte/plugins/overlayscrollbars/styles/overlayscrollbars.min.css'); ?>">
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="<?php asset('vendor/bootstrap-icons/font/bootstrap-icons.min.css'); ?>">
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="<?php asset('vendor/adminlte/css/adminlte.css'); ?>">
    <!--end::Required Plugin(AdminLTE)-->


    <!--Switch Theme -->
    <script src="<?php getAssetDominio('resources/js/color-modes.js'); ?>"></script>
    <link rel="stylesheet" href="<?php getAssetDominio('resources/css/color-modes.css'); ?>">

</head>
<!--end::Head-->

<!--begin::Body-->
<body class="layout-fixed sidebar-expand-lg sidebar-mini sidebar-collapse bg-body-tertiary">

<!--Icons Switch Theme-->
<?php include view_path('layouts.switch'); ?>

<!--begin::App Wrapper-->
<div class="app-wrapper">

    <!--begin::Header-->
    <nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">

            <!--begin::Start Navbar Links-->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                        <i class="bi bi-list"></i>
                    </a>
                </li>

                <?php include view_path('layouts.adminlte._blank.components.navbar_links'); ?>
                <!--
                <li class="nav-item d-none d-md-block"> <a href="#" class="nav-link">Home</a> </li>
                <li class="nav-item d-none d-md-block"> <a href="#" class="nav-link">Contact</a> </li>
                -->
            </ul>
            <!--end::Start Navbar Links-->

            <!--begin::End Navbar Links-->
            <ul class="navbar-nav ms-auto">

                <!--begin::Navbar Search-->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="bi bi-search"></i>
                    </a>
                </li>
                <!--end::Navbar Search-->

                <!--begin::Messages Dropdown Menu-->
                <li class="nav-item dropdown">
                    <?php include view_path('layouts.adminlte.messages_menu'); ?>
                    <!--
                    <a class="nav-link" data-bs-toggle="dropdown" href="#">
                        <i class="bi bi-chat-text"></i>
                        <span class="navbar-badge badge text-bg-danger">3</span>
                    </a>
                    -->
                    <!--
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">

                        <a href="#" class="dropdown-item">
                        -->
                    <!--begin::Message-->
                    <!--<div class="d-flex">
                                <div class="flex-shrink-0">
                                    <img src="<?php /*asset('vendor/adminlte/assets/img/user1-128x128.jpg'); */ ?>" alt="User Avatar" class="img-size-50 rounded-circle me-3">
                                </div>
                                <div class="flex-grow-1">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-end fs-7 text-danger">
                                            <i class="bi bi-star-fill"></i>
                                        </span>
                                    </h3>
                                    <p class="fs-7">
                                        Call me whenever you can...
                                    </p>
                                    <p class="fs-7 text-secondary">
                                        <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                                    </p>
                                </div>
                            </div>-->
                    <!--end::Message-->
                    <!--</a>

                    <div class="dropdown-divider"></div>

                    <a href="#" class="dropdown-item">-->
                    <!--begin::Message-->
                    <!--<div class="d-flex">
                                <div class="flex-shrink-0">
                                    <img src="<?php /*asset('vendor/adminlte/assets/img/user8-128x128.jpg'); */ ?>" alt="User Avatar" class="img-size-50 rounded-circle me-3">
                                </div>
                                <div class="flex-grow-1">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-end fs-7 text-secondary">
                                            <i class="bi bi-star-fill"></i>
                                        </span>
                                    </h3>
                                    <p class="fs-7">
                                        I got your message bro
                                    </p>
                                    <p class="fs-7 text-secondary">
                                        <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                                    </p>
                                </div>
                            </div>-->
                    <!--end::Message-->
                    <!--
                    </a>

                     <div class="dropdown-divider"></div>

                     <a href="#" class="dropdown-item">
                     -->
                    <!--begin::Message-->
                    <!--<div class="d-flex">
                                <div class="flex-shrink-0">
                                    <img src="<?php /*asset('vendor/adminlte/assets/img/user3-128x128.jpg'); */ ?>" alt="User Avatar" class="img-size-50 rounded-circle me-3">
                                </div>
                                <div class="flex-grow-1">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-end fs-7 text-warning">
                                            <i class="bi bi-star-fill"></i>
                                        </span>
                                    </h3>
                                    <p class="fs-7">
                                        The subject goes here
                                    </p>
                                    <p class="fs-7 text-secondary">
                                        <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                                    </p>
                                </div>
                            </div>-->
                    <!--end::Message-->
                    <!--</a>

                    <div class="dropdown-divider"></div>

                    <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>

                </div>-->

                </li>
                <!--end::Messages Dropdown Menu-->

                <!--begin::Notifications Dropdown Menu-->
                <li class="nav-item dropdown">
                    <?php include view_path('layouts.adminlte.notifications_menu'); ?>
                    <!--
                    <a class="nav-link" data-bs-toggle="dropdown" href="#">
                        <i class="bi bi-bell-fill"></i>
                        <span class="navbar-badge badge text-bg-warning">15</span>
                    </a>
                    -->
                    <!--
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">

                        <span class="dropdown-item dropdown-header">15 Notifications</span>

                        <div class="dropdown-divider"></div>

                        <a href="#" class="dropdown-item">
                            <i class="bi bi-envelope me-2"></i>
                            4 new messages
                            <span class="float-end text-secondary fs-7">3 mins</span>
                        </a>

                        <div class="dropdown-divider"></div>

                        <a href="#" class="dropdown-item">
                            <i class="bi bi-people-fill me-2"></i>
                            8 friend requests
                            <span class="float-end text-secondary fs-7">12 hours</span>
                        </a>

                        <div class="dropdown-divider"></div>

                        <a href="#" class="dropdown-item">
                            <i class="bi bi-file-earmark-fill me-2"></i>
                            3 new reports
                            <span class="float-end text-secondary fs-7">2 days</span>
                        </a>

                        <div class="dropdown-divider"></div>

                        <a href="#" class="dropdown-item dropdown-footer">
                            See All Notifications
                        </a>

                    </div>-->
                </li>
                <!--end::Notifications Dropdown Menu-->

                <!--begin::Fullscreen Toggle-->
                <li class="nav-item">
                    <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                        <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                        <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i>
                    </a>
                </li>
                <!--end::Fullscreen Toggle-->

                <!--begin::User Menu Dropdown-->
                <li class="nav-item dropdown user-menu">
                    <?php include view_path('layouts.adminlte.user_menu'); ?>

                    <!--<a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <img src="<?php /*asset('vendor/adminlte/assets/img/user2-160x160.jpg'); */ ?>" class="user-image rounded-circle shadow" alt="User Image">
                        <span class="d-none d-md-inline">Alexander Pierce</span>
                    </a>-->
                    <!--<ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">-->

                    <!--begin::User Image-->
                    <!--<li class="user-header text-bg-primary">
                            <img src="<?php /*asset('vendor/adminlte/assets/img/user2-160x160.jpg'); */ ?>" class="rounded-circle shadow" alt="User Image">
                            <p>
                                Alexander Pierce - Web Developer
                                <small>Member since Nov. 2023</small>
                            </p>
                        </li>-->
                    <!--end::User Image-->

                    <!--begin::Menu Body-->
                    <!--<li class="user-body">-->
                    <!--begin::Row-->
                    <!--<div class="row">
                        <div class="col-4 text-center"> <a href="#">Followers</a> </div>
                        <div class="col-4 text-center"> <a href="#">Sales</a> </div>
                        <div class="col-4 text-center"> <a href="#">Friends</a> </div>
                    </div>-->
                    <!--end::Row-->
                    <!--</li>-->
                    <!--end::Menu Body-->

                    <!--begin::Menu Footer-->
                    <!--<li class="user-footer">
                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                        <a href="#" class="btn btn-default btn-flat float-end">Sign out</a>
                    </li>-->
                    <!--end::Menu Footer-->
                </li>
                <!--end::User Menu Dropdown-->
            </ul>
            <!--end::End Navbar Links-->

        </div>
        <!--end::Container-->
    </nav>
    <!--end::Header-->


    <!--begin::Sidebar-->
    <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">

        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
            <!--begin::Brand Link-->
            <?php include view_path('layouts.adminlte.sidebar_brand')?>
            <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->

        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
            <nav class="mt-2">
                <!--begin::Sidebar Menu-->
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                    <?php include view_path('layouts.adminlte.sidebar_menu'); ?>
                    <!--
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-palette"></i>
                            <p>Level 1</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-speedometer"></i>
                            <p>
                                Level 1
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Level 2</p>
                                </a> </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Level 2</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Level 2</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    -->
                </ul>
                <!--end::Sidebar Menu-->
            </nav>
        </div>
        <!--end::Sidebar Wrapper-->
    </aside>
    <!--end::Sidebar-->


    <!--begin::App Main-->
    <main class="app-main">


        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">

                <!--begin::Row-->
                <?php include view_path('layouts.adminlte._blank.components.content_header'); ?>
                <!--<div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Content Header</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Content Header
                            </li>
                        </ol>
                    </div>
                </div>-->
                <!--end::Row-->

            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content Header-->


        <!--begin::App Content-->
        <div class="app-content">
            <!--begin::Container-->
            <div class="container-fluid">


                <!--begin::Row-->
                <?php include view_path('layouts.adminlte._blank.components.content'); ?>
                <!--<div class="row">
                    <div class="col-12">-->
                <!-- Default box -->
                <!--<div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Title</h3>
                        <div class="card-tools"> <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse" title="Collapse"> <i data-lte-icon="expand" class="bi bi-plus-lg"></i> <i data-lte-icon="collapse" class="bi bi-dash-lg"></i> </button> <button type="button" class="btn btn-tool" data-lte-toggle="card-remove" title="Remove"> <i class="bi bi-x-lg"></i> </button> </div>
                    </div>
                    <div class="card-body">
                        Start creating your amazing application!
                    </div>-->
                <!-- /.card-body -->
                <!--<div class="card-footer">Footer</div>-->
                <!-- /.card-footer-->
                <!--</div>-->
                <!-- /.card -->
                <!-- </div>-->
            </div>
            <!--end::Row-->


        </div>
        <!--end::Container-->

</main>
<!--end::App Main-->


<!--begin::Footer-->
<footer class="app-footer">
    <?php include view_path('layouts.adminlte.footer'); ?>
    <!--begin::To the end-->
<!--    <div class="float-end d-none d-sm-inline">Anything you want</div>-->
    <!--end::To the end-->

    <!--begin::Copyright-->
<!--    <strong>-->
<!--        Copyright &copy; 2014-2024&nbsp;-->
<!--        <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>.-->
<!--    </strong>-->
<!--    All rights reserved.-->
    <!--end::Copyright-->

</footer>
<!--end::Footer-->
</div>
<!--end::App Wrapper-->


<!--begin::Script-->

<!--begin::Third Party Plugin(OverlayScrollbars)-->
<script src="<?php asset('vendor/adminlte/plugins/overlayscrollbars/browser/overlayscrollbars.browser.es6.min.js'); ?>"></script>
<!--end::Third Party Plugin(OverlayScrollbars)-->
<!--begin::Required Plugin(popperjs for Bootstrap 5)-->
<script src="<?php asset('vendor/adminlte/plugins/core/dist/umd/popper.min.js'); ?>"></script>
<!--end::Required Plugin(popperjs for Bootstrap 5)-->
<!--begin::Required Plugin(Bootstrap 5)-->
<script src="<?php getAssetDominio('bootstrap/js/bootstrap.min.js'); ?>"></script>
<!--end::Required Plugin(Bootstrap 5)-->
<!--begin::Required Plugin(AdminLTE)-->
<script src="<?php asset('vendor/adminlte/js/adminlte.js'); ?>"></script>
<!--end::Required Plugin(AdminLTE)-->

<!--begin::OverlayScrollbars Configure-->
<script src="<?php asset('vendor/adminlte/js/config-overlayscrollbars.js'); ?>"></script>
<!--end::OverlayScrollbars Configure-->

<!--end::Script-->
</body>
<!--end::Body-->
</html>