<?php
session_start();
include '../config/koneksi.php';

$body_class = 'page-admin center-mode';

// 🔒 CEK LOGIN
if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit;
}

$active = 'admin';
$body_class = 'page-admin';

// =======================
// EDIT ADMIN SAJA
// =======================
if (isset($_POST['edit'])) {

    $id   = $_SESSION['id_admin'];
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_admin']);
    $user = mysqli_real_escape_string($koneksi, $_POST['user_name']);
    $pass = $_POST['password'];

    if (empty($nama) || empty($user)) {
        $error = "Nama & Username wajib diisi!";
    } else {

        $cek = mysqli_query($koneksi, "SELECT * FROM tb_admin 
            WHERE user_name='$user' AND id_admin != '$id'");

        if (mysqli_num_rows($cek) > 0) {
            $error = "Username sudah digunakan!";
        } else {

            if (!empty($pass)) {
                $hash = password_hash($pass, PASSWORD_DEFAULT);

                mysqli_query($koneksi, "UPDATE tb_admin SET
                    nama_admin='$nama',
                    user_name='$user',
                    password='$hash'
                    WHERE id_admin='$id'
                ");
            } else {
                mysqli_query($koneksi, "UPDATE tb_admin SET
                    nama_admin='$nama',
                    user_name='$user'
                    WHERE id_admin='$id'
                ");
            }

            $success = "Data berhasil diperbarui!";
        }
    }
}

// =======================
// AMBIL DATA ADMIN LOGIN
// =======================
$id = $_SESSION['id_admin'];
$data = mysqli_query($koneksi, "SELECT * FROM tb_admin WHERE id_admin='$id'");
$d = mysqli_fetch_assoc($data);
?>

<!-- HEADER + SIDEBAR -->
<?php include __DIR__ . '/layout/header.php'; ?>
<?php include __DIR__ . '/layout/sidebar.php'; ?>

<!-- 🔥 NAVBAR (DI LUAR CONTENT) -->
<div class="title-wrapper">
    <h1 class="page-title">Profil Admin</h1>
</div>

<div class="content-area">

    <!-- ALERT -->
    <?php if (!empty($error)): ?>
    <script>
    Swal.fire({icon:'error', title:'Gagal', text:'<?= $error ?>'});
    </script>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
    <script>
    Swal.fire({icon:'success', title:'Berhasil', text:'<?= $success ?>'});
    </script>
    <?php endif; ?>

    <!-- 🔥 WRAPPER CENTER -->
    <div class="form-wrapper">

        <div class="form-card">
            <h3>Edit Profil</h3>

            <form method="post">

                <div class="form-group">
                    <label>Nama Admin</label>
                    <input type="text" name="nama_admin" value="<?= $d['nama_admin'] ?>" required>
                </div>

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="user_name" value="<?= $d['user_name'] ?>" required>
                </div>

                <div class="form-group">
                    <label>Password Baru</label>
                    <input type="password" name="password" placeholder="Kosongkan jika tidak diubah">
                </div>

                <div class="form-buttons">
                    <button type="submit" name="edit" class="btn-primary-custom">
                        Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>

    </div>

</div>

<!-- FOOTER -->
<?php include __DIR__ . '/layout/footer.php'; ?>