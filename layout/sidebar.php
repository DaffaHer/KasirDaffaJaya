<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index.php" class="brand-link">
        <div class="badge bg-primary text-wrap" style="width: 10rem;">KasirDaffaJaya V1</div>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Dashboard Menu -->
                <li class="nav-item">
                    <a href="index.php" class="nav-link <?php echo (!isset($_GET['page']) || $_GET['page'] == '') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Barang Dropdown Menu -->
                <li class="nav-item <?php echo ($_GET['page'] == 'barang' || $_GET['page'] == 'jenisbarang') ? 'menu-open' : ''; ?>">
                    <a href="#" class="nav-link <?php echo ($_GET['page'] == 'barang' || $_GET['page'] == 'jenisbarang') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-shopping-bag"></i>
                        <p>
                            Barang
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="index.php?page=barang" class="nav-link <?php echo ($_GET['page'] == 'barang') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Barang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?page=jenisbarang" class="nav-link <?php echo ($_GET['page'] == 'jenisbarang') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jenis Barang</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Transaksi Menu -->
                <li class="nav-item">
                    <a href="index.php?page=transaksi" class="nav-link <?php echo ($_GET['page'] == 'transaksi') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-history"></i>
                        <p>Transaksi</p>
                    </a>
                </li>

                <!-- User & Member & Supplier Dropdown Menu -->
                <li class="nav-item <?php echo ($_GET['page'] == 'user' || $_GET['page'] == 'member' || $_GET['page'] == 'supplier') ? 'menu-open' : ''; ?>">
                    <a href="#" class="nav-link <?php echo ($_GET['page'] == 'user' || $_GET['page'] == 'member' || $_GET['page'] == 'supplier') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            User & Lainnya
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php if ($_SESSION['user']['role'] == "superadmin") { ?>
                            <li class="nav-item">
                                <a href="index.php?page=user" class="nav-link <?php echo ($_GET['page'] == 'user') ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>User</p>
                                </a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a href="index.php?page=member" class="nav-link <?php echo ($_GET['page'] == 'member') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Member</p>
                            </a>
                        </li>
                        <?php if ($_SESSION['user']['role'] == "superadmin" || $_SESSION['user']['role'] == "admin") { ?>
                            <li class="nav-item">
                                <a href="index.php?page=supplier" class="nav-link <?php echo ($_GET['page'] == 'supplier') ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Supplier</p>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>

            </ul>
        </nav>
    </div>
</aside>