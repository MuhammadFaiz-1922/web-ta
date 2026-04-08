<?php
include 'auth.php';
$active = 'game';
include 'layout/header.php';
include 'layout/sidebar.php';
include '../config/koneksi.php';

$data = mysqli_query($koneksi, "SELECT * FROM tb_game ORDER BY id_game DESC");
?>

<h3 class="page-title">Data Game</h3>
<div class="fullscreen-line"></div>

<a href="game_input.php" class="btn btn-success mb-3">+ Tambah Game</a>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-striped table-hover mb-0">
            <thead class="table-primary">
                <tr>
                    <th width="50">No</th>
                    <th>Judul</th>
                    <th>Detail Game</th>
                    <th width="120">Foto</th>
                    <th width="140">Tanggal</th>
                    <th width="160">Aksi</th>
                </tr>
            </thead>

            <tbody>
            <?php $no=1; while($g = mysqli_fetch_assoc($data)): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $g['judul_game'] ?></td>

                    <!-- KOLOM DETAIL -->
                    <td>
                        <?= nl2br($g['detail_game']) ?>
                    </td>

                    <td>
                        <?php if ($g['foto_game']): ?>
                            <img src="../uploads/<?= $g['foto_game'] ?>"
                                 width="80"
                                 class="rounded">
                        <?php endif; ?>
                    </td>

                    <td><?= $g['tanggal_game'] ?></td>

                    <td>
                        <a href="game_input.php?id=<?= $g['id_game'] ?>"
                           class="btn btn-warning btn-sm">
                           Edit
                        </a>

                        <a href="#"
                           onclick="hapusGame(<?= $g['id_game'] ?>)"
                           class="btn btn-danger btn-sm">
                           Hapus
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'layout/footer.php'; ?>
