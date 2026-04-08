<?php
$halaman = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="assets/img/logo 1.jpg">
    <meta charset="UTF-8">
        <!-- responsive mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Perebutan Takhta Galuh</title>

    <!-- panggil CSS utama -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <!--NAVBAR -->
<nav class="navbar">

    <!-- LOGO DI KIRI -->
    <div class="logo">
        <img src="assets/img/logo.png" alt="Logo">
        
    </div>
    
    <!-- TOMBOL HAMBURGER -->
    <div class="hamburger" onclick="toggleMenu()">
        ☰
    </div>

    <!-- MENU DI KANAN -->
<ul class="nav-menu" id="navMenu">

    <li>
        <a href="index.php" class="<?= ($halaman == 'index.php') ? 'active' : '' ?>">
            Home
        </a>
    </li>
    <li>
        <a href="about.php" class="<?= ($halaman == 'about.php') ? 'active' : '' ?>">
            About
        </a>
    </li>
    <li>
        <a href="game.php" class="<?= ($halaman == 'game.php') ? 'active' : '' ?>">
            Game
        </a>
    </li>
    <li>
        <a href="merch.php" class="<?= ($halaman == 'merch.php') ? 'active' : '' ?>">
            Merchandise
        </a>
    </li>
</ul>


</nav>

<!-- GARIS PEMBATAS BAWAH NAVBAR -->
<div class="header-divider"></div>
