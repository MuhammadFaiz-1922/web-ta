<?php
include 'auth.php';
$active = 'dashboard';
include 'layout/header.php';
include 'layout/sidebar.php';
include '../config/koneksi.php';

/* ========================
COUNT DATA
======================== */
$merch = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM tb_merch"))['total'];
$komen = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM tb_komen"))['total'];

/* ========================
KOMENTAR TERBARU
======================== */
$komentar_terbaru = mysqli_query($koneksi, "
    SELECT * FROM tb_komen
    ORDER BY id_komen DESC
    LIMIT 5
");

/* ========================
MERCH TERBARU
======================== */
$merch_terbaru = mysqli_query($koneksi, "
    SELECT * FROM tb_merch
    ORDER BY id_merch DESC
    LIMIT 5
");

/* ========================
RIWAYAT ADMIN
======================== */
$riwayat = mysqli_query($koneksi, "
    SELECT * FROM tb_riwayat_admin
    ORDER BY waktu DESC
    LIMIT 10
");

/* ========================
ADMIN
======================== */
$admin = mysqli_query($koneksi, "
    SELECT * FROM tb_admin
    ORDER BY id_admin DESC
    LIMIT 5
");
?>

<div class="title-wrapper">
    <h3 class="page-title">Dashboard</h3>
</div>

<!-- ========================
DASHBOARD CARDS
======================== -->
<div class="dashboard-cards">

    <div class="dashboard-card merch-card">
        <h6>Merch</h6>
        <h3><?= $merch ?></h3>
    </div>

    <div class="dashboard-card komen-card">
        <h6>Komentar</h6>
        <h3><?= $komen ?></h3>
    </div>

</div>

    <!-- ========================
    KOMENTAR & MERCH TERBARU
    ======================== -->
    <div class="dashboard-bottom-column">

<!-- KOMENTAR TERBARU -->
<div class="dashboard-box">

<h5>Komentar Terbaru</h5>

<div class="scroll-box">

<table class="table-custom">

<thead>
<tr>
<th>No</th>
<th>Nama Penulis</th>
<th>Komentar</th>
<th>Tanggal</th>
</tr>
</thead>

<tbody>

<?php if(mysqli_num_rows($komentar_terbaru) > 0): ?>

<?php $no=1; while ($k = mysqli_fetch_assoc($komentar_terbaru)): ?>
<tr>
<td><?= $no++ ?></td>
<td><?= $k['nama_penulis'] ?></td>
<td><?= $k['detail_komen'] ?></td>
<td><?= date('Y-m-d', strtotime($k['tanggal_komen'])) ?></td>
</tr>
<?php endwhile; ?>

<?php else: ?>

<tr>
<td colspan="4" style="text-align:center; padding:20px;">
Tidak ada komentar masuk
</td>
</tr>

<?php endif; ?>

</tbody>
</table>

</div>
</div>


<!-- MERCH TERBARU -->
<div class="dashboard-box">

<h5>Merch Terbaru</h5>

<div class="scroll-box">

<table class="table-custom">

<thead>
<tr>
<th>No</th>
<th>Judul</th>
<th>Stok</th>
<th>Tanggal</th>
</tr>
</thead>

<tbody>

<?php if(mysqli_num_rows($merch_terbaru) > 0): ?>

<?php $no=1; while ($m = mysqli_fetch_assoc($merch_terbaru)): ?>
<tr>
<td><?= $no++ ?></td>
<td><?= $m['judul_merch'] ?></td>
<td><?= $m['stok_merch'] ?></td>
<td><?= date('Y-m-d', strtotime($m['tanggal_merch'])) ?></td>
</tr>
<?php endwhile; ?>

<?php else: ?>

<tr>
<td colspan="4" style="text-align:center; padding:20px;">
Tidak ada merchandise
</td>
</tr>

<?php endif; ?>

</tbody>

</table>

</div>
</div>

</div>

<!-- ========================
RIWAYAT ADMIN
======================== -->
<div class="dashboard-box">

<h5>Riwayat Aktivitas Admin</h5>

<div class="scroll-box">

<table class="table-custom">

<thead>
<tr>
<th>No</th>
<th>Admin</th>
<th>Aktivitas</th>
<th>Waktu</th>
</tr>
</thead>

<tbody>

<?php if(mysqli_num_rows($riwayat) > 0): ?>

<?php $no=1; while ($r = mysqli_fetch_assoc($riwayat)): ?>
<tr>
<td><?= $no++ ?></td>
<td><?= $r['nama_admin'] ?></td>
<td><?= $r['aktivitas'] ?></td>
<td><?= date('Y-m-d', strtotime($r['waktu'])) ?></td>
</tr>
<?php endwhile; ?>

<?php else: ?>

<tr>
<td colspan="4" style="text-align:center; padding:25px;">
Admin belum mengubah apapun
</td>
</tr>

<?php endif; ?>

</tbody>

</table>

</div>

</div>

<!-- ========================
ADMIN
======================== -->
<div class="dashboard-box">

<h5>Data Admin</h5>

<div class="scroll-box">

<table class="table-custom">

<thead>
<tr>
<th>No</th>
<th>Nama</th>
<th>Username</th>
</tr>
</thead>

<tbody>

<?php if(mysqli_num_rows($admin) > 0): ?>

<?php $no=1; while ($a = mysqli_fetch_assoc($admin)): ?>
<tr>
<td><?= $no++ ?></td>
<td><?= $a['nama_admin'] ?></td>
<td><?= $a['user_name'] ?></td>
</tr>
<?php endwhile; ?>

<?php else: ?>

<tr>
<td colspan="3" style="text-align:center; padding:20px;">
Tidak ada data admin
</td>
</tr>

<?php endif; ?>

</tbody>

</table>

</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

let pertamaLogin = true;
let antrian = [];
let sedangTampil = false;

function tampilkanPopup(){

    if(antrian.length == 0){
        sedangTampil = false;
        return;
    }

    sedangTampil = true;

    let data = antrian.shift();

    var audio = new Audio('assets/sound/iphone.mp3');
    audio.play();

    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'info',
        title: "💬 Komentar Baru",
        html: "<b>"+data.nama+"</b><br>"+data.komentar+"<br><small>"+data.waktu+"</small>",
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true
    }).then(()=>{
        tampilkanPopup();
    });

}

setInterval(function(){

    $.ajax({
        url: "cek_komen_baru.php",
        method: "GET",
        dataType: "json",
        success:function(data){

            if(data.length > 0){

                if(pertamaLogin){

                    antrian = data;

                    if(!sedangTampil){
                        tampilkanPopup();
                    }

                    pertamaLogin = false;

                }

            }

        }
    });

},5000);

</script>

<?php
include 'layout/footer.php';
?>