<?php
include '../config/koneksi.php';

$limit = 3;
$halaman = isset($_GET['hal']) ? (int)$_GET['hal'] : 1;
$halaman_awal = ($halaman - 1) * $limit;

$komen = mysqli_query($koneksi, "
    SELECT * FROM tb_komen 
    ORDER BY tanggal_komen DESC 
    LIMIT $halaman_awal, $limit
");

while($k = mysqli_fetch_assoc($komen)){

$waktu = strtotime($k['tanggal_komen']);
$sekarang = time();
$selisih = $sekarang - $waktu;

if($selisih < 60){
$tampil_waktu = "Baru saja";
}elseif($selisih < 3600){
$tampil_waktu = floor($selisih/60)." menit lalu";
}elseif($selisih < 86400){
$tampil_waktu = floor($selisih/3600)." jam lalu";
}else{
$tampil_waktu = floor($selisih/86400)." hari lalu";
}
?>

<div class="card-komentar">
<div class="komentar-header">
<strong><?php echo $k['nama_penulis']; ?></strong>
<span><?php echo $tampil_waktu; ?></span>
</div>

<p><?php echo $k['detail_komen']; ?></p>
</div>

<?php } ?>