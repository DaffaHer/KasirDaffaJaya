
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
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index.php" class="nav-link">Dashboard</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i class="fas fa-user"></i></a>
                </li>
            </ul>
        </nav>
        
        <!-- Bagian Sidebar -->
        <?php include 'layout/sidebar.php'; ?>
        
        <?php include 'database/koneksi.php'; ?>
        <!-- Header End -->
