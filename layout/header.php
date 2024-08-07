<!DOCTYPE html>
<html>
<head>
    <!-- link -->
    <link rel="stylesheet" href="asset/dist/css/adminlte.min.css">
    <!-- icon -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="asset/plugins/fontawesome-free/css/all.min.css">

</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Header -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href=""><i class="fas fa-bars"></i></a>
                </li>
                                        <!-- <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['user']['username'] ?></span>
                                <img class="img-profile rounded-circle" src="assets/img/undraw_profile.svg">
                            </a> -->
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index.php" class="nav-link">Dashboard</a>
                    <li class="nav-item d-none d-sm-inline-block">
                    <a href="index.php?page=logout" class="nav-link">| Logout</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="index.php">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['user']['role'] ?></span>
                    <i class="fas fa-user"></i></a>

                </li>
            </ul>
        </nav>

        <!-- Bagian Sidebar -->
        <?php include 'layout/sidebar.php'; ?>
        <?php include 'database/koneksi.php'; ?>
