<?php
include '../config/koneksi.php';

$error = '';
$success = '';

if (isset($_POST['register'])) {

    $nama_admin = mysqli_real_escape_string($koneksi, $_POST['nama_admin']);
    $username   = mysqli_real_escape_string($koneksi, $_POST['user_name']);
    $password   = $_POST['password'];

    if (empty($nama_admin) || empty($username) || empty($password)) {
        $error = "Semua field wajib diisi!";
    } else {

        // cek username
        $cek = mysqli_query($koneksi, "SELECT * FROM tb_admin WHERE user_name='$username'");
        
        if (mysqli_num_rows($cek) > 0) {
            $error = "Username sudah digunakan!";
        } else {

            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            mysqli_query($koneksi, "INSERT INTO tb_admin (user_name, password, nama_admin)
                VALUES ('$username', '$password_hash', '$nama_admin')
            ");

            $success = "Registrasi berhasil! Silakan login.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register Admin</title>

    <link rel="stylesheet" href="/backend_gamefaiz/admin/assets/css/style.css?v=10">
</head>

<body class="login-page">

<div class="login-card">

    <div class="login-header">
        <h2>Register Admin</h2>
        <small>Buat akun admin baru</small>
    </div>

    <?php if (!empty($error)): ?>
        <div class="alert"><?= $error ?></div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div class="alert" style="background:#d1e7dd;color:#0f5132;">
            <?= $success ?>
        </div>
    <?php endif; ?>

    <form method="post" action="">

        <div class="form-group">
            <label>Nama Admin</label>
            <input type="text" name="nama_admin"
                   placeholder="Nama lengkap" required>
        </div>

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="user_name"
                   placeholder="Username" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password"
                   placeholder="Password" required>
        </div>

        <button type="submit" name="register" class="login-btn">
            Register
        </button>

    </form>

    <div class="login-footer">
        Sudah punya akun?
        <a href="login.php">Login</a>
    </div>

</div>

</body>
</html>
