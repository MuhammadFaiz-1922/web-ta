<?php
include '../config/koneksi.php';
date_default_timezone_set('Asia/Jakarta');

$q = mysqli_query($koneksi,"
SELECT * FROM tb_komen
WHERE status_baca='belum'
ORDER BY tanggal_komen ASC
");

$data = [];

while($row = mysqli_fetch_assoc($q)){

    $waktu = strtotime($row['tanggal_komen']);
    $sekarang = time();
    $selisih = $sekarang - $waktu;

    if($selisih < 60){
        $timeAgo = $selisih." detik yang lalu";
    }elseif($selisih < 3600){
        $timeAgo = floor($selisih/60)." menit yang lalu";
    }elseif($selisih < 86400){
        $timeAgo = floor($selisih/3600)." jam yang lalu";
    }else{
        $timeAgo = floor($selisih/86400)." hari yang lalu";
    }

    $data[] = [
        "nama"=>$row['nama_penulis'],
        "komentar"=>$row['detail_komen'],
        "waktu"=>$timeAgo
    ];
}

echo json_encode($data);