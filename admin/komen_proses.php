<?php
include 'auth.php';
include '../config/koneksi.php';

/* =========================
   HAPUS KOMENTAR
========================= */

if (isset($_GET['hapus'])) {

    $id = $_GET['hapus'];

    // cek komentar ada atau tidak
    $cek = mysqli_query($koneksi,"SELECT * FROM tb_komen WHERE id_komen='$id'");

    if(mysqli_num_rows($cek) > 0){

        mysqli_query($koneksi,"DELETE FROM tb_komen WHERE id_komen='$id'");

    }

    header("Location: komen_tampil.php");
    exit;
}
?>