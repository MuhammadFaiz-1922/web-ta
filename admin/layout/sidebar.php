<?php
include '../config/koneksi.php';

$notif_komen = mysqli_fetch_assoc(mysqli_query($koneksi,
"SELECT COUNT(*) AS total FROM tb_komen WHERE status_baca='belum'"
))['total'];
?>

<div class="admin-layout">

    <!-- SIDEBAR -->
    <div class="sidebar">

        <!-- ADMIN INFO -->
        <div class="sidebar-header">
            <div class="admin-avatar">👤</div>
            <div class="admin-name">
                <?= $_SESSION['nama'] ?? 'Administrator' ?>
            </div>
            <div class="admin-role">Administrator</div>
        </div>

        <!-- MENU -->
        <div class="sidebar-menu">
           
        <a href="dashboard.php" class="<?= ($active == 'dashboard') ? 'active' : '' ?>">
            <i class="fa-solid fa-gauge"></i>
            Dashboard
        </a>
        
        <a href="merch_tampil.php" class="<?= ($active == 'merch') ? 'active' : '' ?>">
            <i class="fa-solid fa-bag-shopping"></i>
            Merchandise
        </a>

    <?php if ($_SESSION['role'] == 'super_admin'): ?>

        <a href="admin_tampil.php" class="<?= ($active == 'admin') ? 'active' : '' ?>">
            <i class="fa-solid fa-user-gear"></i>
            Setting Profile
        </a>

        <?php else: ?>

        <a href="#" class="menu-disabled">
            <i class="fa-solid fa-user-lock"></i>
            Settings Profile
        </a>

        <?php endif; ?>
        <a href="komen_tampil.php" class="<?= $active=='komen'?'active':'' ?>">
            <i class="fa-solid fa-comments"></i>
            Komentar

            <?php if($notif_komen > 0): ?>
            <span class="notif-badge"><?= $notif_komen ?></span>
            <?php endif; ?>
            </a>
        </div>

        <!-- LOGOUT -->
        <div class="sidebar-footer">
            <a href="logout.php" onclick="return confirmLogout()" class="logout-btn">
                Logout
            </a>
        </div>

    </div>

    <!-- CONTENT -->
    <div class="content-area">
        <div class="content-padding">


        <!-- sweetalert -->
<script>
function confirmLogout() {
    Swal.fire({
        title: 'Logout',
        text: 'Apakah anda ingin logout?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6E5709',
        confirmButtonText: 'Ya, Logout',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'logout.php';
        }
    });

    return false; // cegah link langsung jalan
}
</script>
