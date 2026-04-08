<?php
include 'auth.php';
$active = 'komen';
include 'layout/header.php';
include 'layout/sidebar.php';
include '../config/koneksi.php';

/* tandai komentar sudah dibaca */
mysqli_query($koneksi,"
UPDATE tb_komen 
SET status_baca='sudah' 
WHERE status_baca='belum'
");


$data = mysqli_query($koneksi, "SELECT * FROM tb_komen ORDER BY id_komen DESC");
?>

<div class="title-wrapper">
    <h3 class="page-title">Data Komentar</h3>
</div>

<div class="card-custom">
    <div class="table-wrapper">
    <table class="table-custom">
        <thead>
            <tr>
                <th width="50">No</th>
                <th>Nama Penulis</th>
                <th>Komentar</th>
                <th width="140">Tanggal</th>
                <th width="120">Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php $no=1; while($k = mysqli_fetch_assoc($data)): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($k['nama_penulis']) ?></td>
                <td><?= htmlspecialchars($k['detail_komen']) ?></td>
                <td><?= $k['tanggal_komen'] ?></td>
                <td>
                    <a href="#"
                       onclick="hapusKomen(<?= $k['id_komen'] ?>)"
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
