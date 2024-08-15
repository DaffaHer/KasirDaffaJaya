<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index.php" class="nav-link">Dashboard</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <!-- Tombol Logout dengan SweetAlert -->
            <button type="button" class="btn btn-danger" onclick="konfirmasiLogout()">Logout</button>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['user']['role'] ?></span>
                <i class="fas fa-user"></i>
            </a>
        </li>
    </ul>
</nav>


<script>
    function konfirmasiLogout() {
        Swal.fire({
            title: 'Apakah Anda yakin ingin logout?',
            text: "Anda akan keluar dari sesi saat ini.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, logout!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika user mengonfirmasi logout, kirimkan form logout secara otomatis
                window.location.href = 'index.php?page=logout';
            }
        });
    }
</script>
