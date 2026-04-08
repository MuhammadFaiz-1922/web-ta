<?php
include 'auth.php';
include '../config/koneksi.php';

$admin = $_SESSION['nama'] ?? 'Admin';

/* ================= DELETE ================= */
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    // Ambil data game dulu
    $q = mysqli_query($koneksi, "SELECT judul_game, foto_game FROM tb_game WHERE id_game='$id'");
    $data = mysqli_fetch_assoc($q);

    // Hapus foto
    if (!empty($data['foto_game'])) {
        unlink("../uploads/" . $data['foto_game']);
    }

    // Simpan riwayat
    mysqli_query($koneksi, "
        INSERT INTO tb_riwayat_admin (nama_admin, aktivitas)
        VALUES ('$admin', 'Menghapus game: {$data['judul_game']}')
    ");

    // Hapus data
    mysqli_query($koneksi, "DELETE FROM tb_game WHERE id_game='$id'");

    header("Location: game_tampil.php");
    exit;
}
/* ========================================= */

$id     = $_POST['id_game'] ?? '';
$judul  = mysqli_real_escape_string($koneksi, $_POST['judul_game'] ?? '');
$detail = mysqli_real_escape_string($koneksi, $_POST['detail_game'] ?? '');
$tgl    = $_POST['tanggal_game'] ?? '';

$foto = $_FILES['foto_game']['name'] ?? '';
$tmp  = $_FILES['foto_game']['tmp_name'] ?? '';

if ($foto) {
    $nama_foto = time() . '_' . $foto;
    move_uploaded_file($tmp, "../uploads/$nama_foto");
} else {
    $nama_foto = $_POST['foto_lama'] ?? '';
}

if ($id) {
    /* ===== UPDATE ===== */
    mysqli_query($koneksi, "UPDATE tb_game SET
        judul_game='$judul',
        foto_game='$nama_foto',
        detail_game='$detail',
        tanggal_game='$tgl'
        WHERE id_game='$id'
    ");

    // Riwayat update
    mysqli_query($koneksi, "
        INSERT INTO tb_riwayat_admin (nama_admin, aktivitas)
        VALUES ('$admin', 'Mengubah game: $judul')
    ");

} else {
    /* ===== INSERT ===== */
    mysqli_query($koneksi, "INSERT INTO tb_game VALUES (
        NULL,
        '$judul',
        '$nama_foto',
        '$detail',
        '$tgl'
    )");

    // Riwayat tambah
    mysqli_query($koneksi, "
        INSERT INTO tb_riwayat_admin (nama_admin, aktivitas)
        VALUES ('$admin', 'Menambahkan game baru: $judul')
    ");
}

header("Location: game_tampil.php");
