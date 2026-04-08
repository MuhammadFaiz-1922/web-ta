<?php
include 'auth.php';  
$active = 'merch';    
include 'layout/header.php';
include 'layout/sidebar.php';
include '../config/koneksi.php';

$data = mysqli_query($koneksi, "SELECT * FROM tb_merch ORDER BY id_merch DESC");
?>

<div class="title-wrapper">
    <h3 class="page-title">Data Marchendise</h3>
</div>

<a href="merch_input.php" class="btn-primary-custom">+ Tambah Merchandise</a>

<div class="card shadow-sm">
<div class="card-body">
<div class="table-wrapper">

<table class="table-custom">

<thead>
<tr>
    <th>No</th>
    <th>Judul</th>
    <th>Foto</th>
    <th>Harga</th>
    <th>Stok</th>
    <th>Tanggal</th> <!-- TAMBAHAN -->
    <th>Aksi</th>
</tr>
</thead>

<tbody>

<?php $no=1; while($m = mysqli_fetch_assoc($data)): ?>
<tr>

<td><?= $no++ ?></td>

<td><?= $m['judul_merch'] ?></td>

<td>
<?php if ($m['foto_merch']): ?>
<img src="../uploads/<?= $m['foto_merch'] ?>" width="80" class="rounded">
<?php endif; ?>
</td>

<td>Rp <?= number_format($m['harga_merch'], 0, ',', '.') ?></td>

<td class="text-center">
<?php if ($m['stok_merch'] == 0): ?>
<span class="badge bg-danger">Habis</span>
<?php else: ?>
<?= $m['stok_merch'] ?>
<?php endif; ?>
</td>

<td><?= date('Y-m-d', strtotime($m['tanggal_merch'])) ?></td>

<td>

<a href="merch_input.php?id=<?= $m['id_merch'] ?>" class="btn-primary-custom">
Edit
</a>

<a href="#"
onclick="hapusMerch(<?= $m['id_merch'] ?>)"
class="btn-danger-custom">
Hapus
</a>

</td>

</tr>
<?php endwhile; ?>

</tbody>
</table>

</div>
</div>
</div>

<?php include 'layout/footer.php'; ?>