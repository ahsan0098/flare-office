<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/fontawesome-free/css/all.min.css')); ?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/dist/css/adminlte.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/icons-1.9.1/font/bootstrap-icons.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/style.css')); ?>">
    <?php echo \Livewire\Livewire::styles(); ?>

</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

    <div class="wrapper">
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.mark-attendance')->html();
} elseif ($_instance->childHasBeenRendered('hTjYZ1Z')) {
    $componentId = $_instance->getRenderedChildComponentId('hTjYZ1Z');
    $componentTag = $_instance->getRenderedChildComponentTagName('hTjYZ1Z');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('hTjYZ1Z');
} else {
    $response = \Livewire\Livewire::mount('admin.mark-attendance');
    $html = $response->html();
    $_instance->logRenderedChild('hTjYZ1Z', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60"
                width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="" class="nav-link">Home</a>
                </li>
                
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="btn btn-warning nav-link fade" data-toggle="modal"
                        data-target="#attendace_modal" id="att_btn">Mark your Attendance</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">Admin</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="mt-3 pb-3 mb-3 d-flex ">
                    <div class="image mr-3">
                        <img src="<?php echo e(asset('storage/employe_' . session('u_id'))); ?>/<?php echo e(session('user')['image']); ?>"
                            class="img-circle elevation-2" alt="User Image" width="70" height="70">
                    </div>
                    <div class="info mt-3">
                        <a href="#" class="d-block">
                            <h4><?php echo e(Str::ucfirst(session('user')['name'])); ?></h4>
                        </a>
                    </div>
                </div>



                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item menu-open">
                            <a href="<?php echo e(route('adminDashboard')); ?>" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('department')); ?>" class="nav-link">
                                <i class="nav-icon fas fa-university"></i>
                                <p>
                                    Departments
                                </p>
                            </a>

                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('employe')); ?>" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Employes
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-credit-card"></i>
                                <p>
                                    Salary
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin-expense')); ?>" class="nav-link">
                                <i class="nav-icon bi bi-bar-chart-fill"></i>
                                <p>
                                    Expenses
                                </p>
                            </a>
                        </li>

                        <li class="nav-item menu-open">
                            <a href="" class="nav-link">
                                <i class="nav-icon bi bi-chat-dots-fill"></i>
                                <p>
                                    Chat Rooms
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ml-5">
                                <li class="nav-item">
                                    <a href="<?php echo e(route('admin-chatroom')); ?>" class="nav-link">
                                        <i class="bi bi-shield-lock-fill nav-icon"></i>
                                        <p>Pivate chat</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('admin-public-chatroom')); ?>" class="nav-link">
                                        <i class="bi bi-unlock-fill nav-icon"></i>
                                        <p>Public chat</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin-attendance')); ?>" class="nav-link">
                                <i class="nav-icon fas fa-check-circle"></i>
                                <p>
                                    Attendance
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin-profile')); ?>" class="nav-link">
                                <i class="nav-icon bi bi-person-badge"></i>
                                <p>
                                    Profile

                                </p>
                            </a>
                        </li>
                        <li class="nav-item menu-open">
                            <a href="<?php echo e(route('admin-roles-and-permissions')); ?>" class="nav-link active">
                                <i class="nav-icon bi bi-shield-exclamation"></i>
                                <p>
                                    Roles and Permissions
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('index')); ?>" class="nav-link">
                                <i class="nav-icon bi bi-box-arrow-left"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div>
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">Departments</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Departments</li>
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <?php echo e($slot); ?>

            </div>
        </div>
        <!-- /.content-wrapper -->
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">software flare</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->
    </div>
    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="<?php echo e(asset('assets/plugins/jquery/jquery.min.js')); ?>"></script>
    <!-- Bootstrap -->
    <script src="<?php echo e(asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <!-- overlayScrollbars -->
    <script src="<?php echo e(asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo e(asset('assets/dist/js/adminlte.js')); ?>"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="<?php echo e(asset('assets/plugins/jquery-mousewheel/jquery.mousewheel.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/raphael/raphael.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/jquery-mapael/jquery.mapael.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/jquery-mapael/maps/usa_states.min.js')); ?>"></script>
    <!-- ChartJS -->
    <script src="<?php echo e(asset('assets/plugins/chart.js/Chart.min.js')); ?>"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo e(asset('assets/dist/js/demo.js')); ?>"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo e(asset('assets/dist/js/pages/dashboard2.js')); ?>"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?php echo e(asset('assets/functions.js')); ?>"></script>
    <?php echo \Livewire\Livewire::scripts(); ?>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\flare-office\resources\views/layouts/admin-base.blade.php ENDPATH**/ ?>