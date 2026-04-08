<?php
$active = 'merch';
include 'layout/header.php';
include 'layout/sidebar.php';
include '../config/koneksi.php';

$id = $_GET['id'] ?? '';
$data = [];

if ($id) {
    $q = mysqli_query($koneksi, "SELECT * FROM tb_merch WHERE id_merch='$id'");
    $data = mysqli_fetch_assoc($q);
}
?>

<h2 class="page-title">
    <?= $id ? 'Edit Merchandise' : 'Tambah Merchandise' ?>
</h2>

<div class="form-card">

<form action="merch_proses.php" method="post" enctype="multipart/form-data">

    <input type="hidden" name="id_merch" value="<?= $data['id_merch'] ?? '' ?>">
    <input type="hidden" name="foto_lama" value="<?= $data['foto_merch'] ?? '' ?>">

    <div class="form-group">
        <label>Judul Merchandise</label>
        <input type="text" name="judul_merch"
               value="<?= $data['judul_merch'] ?? '' ?>" required>
    </div>

    <div class="form-group">
        <label>Harga</label>
        <input type="number" step="0.01" name="harga_merch"
               value="<?= $data['harga_merch'] ?? '' ?>" required>
    </div>

    <div class="form-group">
        <label>Stok Merchandise</label>
        <input type="number" name="stok_merch"
               min="0"
               value="<?= $data['stok_merch'] ?? 0 ?>" required>
    </div>

    <!-- TAMBAHAN TANGGAL -->
    <div class="form-group">
        <label>Tanggal Merchandise</label>
        <input type="date" name="tanggal_merch"
               value="<?= $data['tanggal_merch'] ?? date('Y-m-d') ?>" required>
    </div>

    <div class="form-group">
        <label>Detail Merchandise</label>
        <textarea name="detail_merch" rows="4" required><?= $data['detail_merch'] ?? '' ?></textarea>
    </div>

    <div class="form-group">
        <label>Foto Merchandise</label>
        <input type="file" name="foto_merch">
        <?php if (!empty($data['foto_merch'])): ?>
            <small>Foto lama: <?= $data['foto_merch'] ?></small>
        <?php endif; ?>
    </div>

    <div class="form-buttons">
        <button type="submit" class="btn-primary-custom">Simpan</button>
        <a href="merch_tampil.php" class="btn-danger-custom">Kembali</a>
    </div>

</form>

</div>

<?php include 'layout/footer.php'; ?>