<?php
session_start();
include '../config/koneksi.php';

$error = '';

if (isset($_POST['login'])) {

    $username = mysqli_real_escape_string($koneksi, $_POST['user_name']);
    $password = $_POST['password'];

    // ambil data dari database
    $query = mysqli_query($koneksi, "SELECT * FROM tb_admin WHERE user_name='$username'");
    $data  = mysqli_fetch_assoc($query);

    // cek login
    if ($data && password_verify($password, $data['password'])) {

        // simpan ke session
        $_SESSION['id_admin'] = $data['id_admin'];
        $_SESSION['admin']    = $data['user_name'];
        $_SESSION['nama']     = $data['nama_admin'];
        $_SESSION['role']     = $data['role']; 

        header("Location: dashboard.php");
        exit;

    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>

    <link rel="stylesheet" href="assets/css/style.css?v=10">
</head>

<body class="login-page">

<div class="login-card">

    <div class="login-header">
        <h2>Admin Login</h2>
        <small>Silakan masuk untuk melanjutkan</small>
    </div>

    <?php if (!empty($error)): ?>
        <div class="alert">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <form method="post" action="">
        
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="user_name" 
                   placeholder="Masukkan username" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" 
                   placeholder="Masukkan password" required>
        </div>

        <button type="submit" name="login" class="login-btn">
            Login
        </button>

    </form>

</div>

</body>
</html>