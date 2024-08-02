<?php
$pdo = koneksi::connect();
$crudUser = User::getInstance($pdo);

$id_user = $_GET["id_user"];

if (isset($_POST["confirm"])) {
    $password = htmlspecialchars($_POST["password"]);

    if ($crudUser->confirmPassword($id_user, $password)) {
        ?>
        <script>
            window.location.href = "index.php?page=user&act=change-password&id_user=<?= $id_user ?>";
        </script>
        <?php
    } else {
        $error = "Password lama salah!";
    }
}
?>

<div class="content-wrapper">
<div class="content-header">
<div class="section-header">
    <h1>Change Password</h1>
</div>

<?php
if (isset($error)) {
    echo "<div class='alert alert-danger'>$error</div>";
}
?>

<div class="row">
    <div class="card">
        <form method="POST">
            <div class="card-body">
                <div class="">
                    <p>Confirm Your Old Password, Before Change Your Password</p>
                </div>
                <div class="col-20 col-md-16 col-lg-18">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="password">Password</label>
                            <input id="password" type="password" class="form-control" name="password" autocomplete="off" placeholder="Confirm Password" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" name="confirm">
                        Confirm Password
                    </button>
                </div>
            </div>
        </form>
    </div>
</div></div>
</div>
