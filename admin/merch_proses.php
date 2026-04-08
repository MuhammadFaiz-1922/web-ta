<?php
include 'auth.php';
include '../config/koneksi.php';

$admin = $_SESSION['nama'] ?? 'Admin';

/* ===== DELETE ===== */
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    // Ambil data merch dulu
    $q = mysqli_query($koneksi, "SELECT judul_merch, foto_merch FROM tb_merch WHERE id_merch='$id'");
    $data = mysqli_fetch_assoc($q);

    // Hapus foto
    if (!empty($data['foto_merch'])) {
        unlink("../uploads/" . $data['foto_merch']);
    }

    // Simpan riwayat
    mysqli_query($koneksi, "
        INSERT INTO tb_riwayat_admin (nama_admin, aktivitas)
        VALUES ('$admin', 'Menghapus merchandise: {$data['judul_merch']}')
    ");

    // Hapus data
    mysqli_query($koneksi, "DELETE FROM tb_merch WHERE id_merch='$id'");

    header("Location: merch_tampil.php");
    exit;
}

/* ===== INSERT / UPDATE ===== */
$id     = $_POST['id_merch'] ?? '';
$judul  = $_POST['judul_merch'] ?? '';
$harga  = $_POST['harga_merch'] ?? 0;
$stok   = $_POST['stok_merch'] ?? 0;
$detail = $_POST['detail_merch'] ?? '';
$tanggal = $_POST['tanggal_merch'];
$foto = $_FILES['foto_merch']['name'] ?? '';
$tmp  = $_FILES['foto_merch']['tmp_name'] ?? '';

if ($foto) {
    $nama_foto = time() . '_' . $foto;
    move_uploaded_file($tmp, "../uploads/$nama_foto");
} else {
    $nama_foto = $_POST['foto_lama'] ?? '';
}

if ($id) {
    /* ===== UPDATE ===== */
    mysqli_query($koneksi, "UPDATE tb_merch SET
        judul_merch='$judul',
        foto_merch='$nama_foto',
        harga_merch='$harga',
        stok_merch='$stok',
        detail_merch='$detail',
        tanggal_merch='$tanggal'
        WHERE id_merch='$id'
    ");

    // Riwayat update
    mysqli_query($koneksi, "
        INSERT INTO tb_riwayat_admin (nama_admin, aktivitas)
        VALUES ('$admin', 'Mengubah merchandise: $judul (stok: $stok)')
    ");

} else {
    /* ===== INSERT ===== */
    mysqli_query($koneksi, "INSERT INTO tb_merch (
        judul_merch,
        foto_merch,
        harga_merch,
        stok_merch,
        detail_merch,
        tanggal_merch
    ) VALUES (
        '$judul',
        '$nama_foto',
        '$harga',
        '$stok',
        '$detail',
        '$tanggal'
    )");

    // Riwayat tambah
    mysqli_query($koneksi, "
        INSERT INTO tb_riwayat_admin (nama_admin, aktivitas)
        VALUES ('$admin', 'Menambahkan merchandise baru: $judul (stok: $stok)')
    ");
}

header("Location: merch_tampil.php");
exit;
