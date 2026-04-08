<?php include 'layout/header.php'; ?>
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700;800&display=swap" rel="stylesheet">

<?php
include '../config/koneksi.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
ob_start();
// ==========================
// SIMPAN KOMENTAR
// ==========================
if (isset($_POST['kirim_komentar'])) {
    $nama = $_POST['nama'];
    $komentar = $_POST['komentar'];

    mysqli_query($koneksi, "INSERT INTO tb_komen (
        nama_penulis,
        detail_komen,
        tanggal_komen,
        status_baca
    ) VALUES (
        '$nama',
        '$komentar',
        NOW(),
        'belum'
    )");

    header("Location: index.php?status=sukses");
    exit;
}

// ==========================
// PAGINATION (WAJIB DI ATAS)
// ==========================
$limit = 3;

$halaman = isset($_GET['hal']) ? (int)$_GET['hal'] : 1;

if($halaman < 1){
    $halaman = 1;
}

$halaman_awal = ($halaman - 1) * $limit;

// total data
$result_total = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_komen");
$data_total = mysqli_fetch_assoc($result_total);
$total_data = $data_total['total'];

$total_halaman = ceil($total_data / $limit);

// 🔥 FIX WAJIB
if ($total_halaman == 0) {
    $total_halaman = 1;
}

// ambil data
$komen = mysqli_query($koneksi, "
    SELECT * FROM tb_komen 
    ORDER BY tanggal_komen DESC 
    LIMIT $halaman_awal, $limit
");
?>

<!-- WRAPPER -->
<div class="home-wrapper">

<!-- HERO -->
<section class="hero-slider">
<div class="slide active" style="background-image: url('assets/img/kerajaan1.jpg');"></div>
<div class="slide" style="background-image: url('assets/img/kerajaan2.jpg');"></div>
<div class="slide" style="background-image: url('assets/img/kerajaan3.jpg');"></div>

<div class="hero-content">
    <div class="hero-text">
        <h1>PEREBUTAN<br>TAKHTA GALUH</h1>
        <p class="tagline">
            Board Game Strategi Perebutan Kekuasaan<br>
            Berlatar Nusantara
        </p>
        <a href="game.php" class="btn-hero">Lihat Permainan</a>
    </div>
</div>
</section>

<div class="hero-divider"></div>

<!-- DESKRIPSI -->
<section class="home-desc">
<div class="home-desc-content">
<div class="home-desc-text">
<h2>Tentang Permainan</h2>

<p>
Perebutan Takhta Galuh adalah board game strategi yang terinspirasi
dari kisah dan konflik kekuasaan di Nusantara. Pemain ditantang untuk
menyusun strategi, mengatur wilayah, dan mengambil keputusan penting
demi merebut takhta tertinggi.
</p>

<p>
Permainan ini dirancang untuk melatih pemikiran strategis, kerja sama,
serta pemahaman nilai budaya dalam bentuk permainan yang menarik.
</p>
</div>

<div class="home-desc-icons">
<img src="assets/img/pion5.png">
</div>
</div>
</section>

<div class="garis-lurus"></div>

<h2 class="section-title">Masukan & Komentar</h2>

<!-- FORM -->
<section class="komentar-section">

<h3>Komentar Pengunjung</h3>

<div class="komentar-desc">
Silakan tinggalkan komentar kamu
</div>

<form method="post">
<label>Nama</label>
<input type="text" name="nama" required>

<label>Komentar</label>
<textarea name="komentar" required></textarea>

<button type="submit" name="kirim_komentar">
Kirim Komentar
</button>
</form>

</section>

<!-- KOMENTAR PUBLIK -->
<section class="komentar-publik">
<div class="komentar-container">

<h3 class="judul-komentar">Komentar Terbaru</h3>



<div class="komentar-grid">
    <!-- komentar akan muncul di sini -->
</div>



<div class="pagination">

<a href="#" onclick="loadPage(currentPage - 1); return false;">« Prev</a>

<?php for($i = 1; $i <= $total_halaman; $i++): ?>
<a href="#"
   onclick="loadPage(<?php echo $i; ?>, this); return false;">
   <?php echo $i; ?>
</a>
<?php endfor; ?>

<a href="#" onclick="loadPage(currentPage + 1); return false;">Next »</a>

</div>

</div>
</section>

</div>

<?php include 'layout/footer.php'; ?>

<!-- SWEET ALERT -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if (isset($_GET['status']) && $_GET['status'] == 'sukses'): ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Komentar Terkirim',
    text: 'Terima kasih 🙏',
    confirmButtonColor: '#6E5709'
}).then(() => {
    // 🔥 hapus ?status=sukses dari URL
    window.history.replaceState(null, null, window.location.pathname);
});
</script>
<?php endif; ?>

<!-- SLIDER -->
<script>
const slides = document.querySelectorAll('.slide');
let index = 0;

setInterval(() => {
slides[index].classList.remove('active');
index = (index + 1) % slides.length;
slides[index].classList.add('active');
}, 4000);
</script>

<script>
function loadPage(page, el = null){

    if(page < 1 || page > <?php echo $total_halaman; ?>){
        return;
    }

    currentPage = page;

    const container = document.querySelector('.komentar-grid');

    // animasi keluar (geser kiri)
    container.classList.add('slide-out-left');

    setTimeout(() => {

        fetch('ambil_komentar.php?hal=' + page)
        .then(res => res.text())
        .then(data => {

            if (data.trim() === "") {

    container.innerHTML = `
        <div class="komentar-kosong">
            <h3>Belum ada komentar</h3>
            <p>Jadilah yang pertama memberikan masukan 😊</p>
        </div>
    `;

    // 🔥 sembunyikan pagination
    document.querySelector('.pagination').style.display = 'none';

} else {

    container.innerHTML = data;

    // tampilkan pagination
    document.querySelector('.pagination').style.display = 'block';
}

            // reset class
            container.classList.remove('slide-out-left');
            container.classList.add('slide-in-right');

            // update active
            document.querySelectorAll('.pagination a').forEach(a => {
                a.classList.remove('active');
            });

            if(el){
                el.classList.add('active');
            } else {
                document.querySelectorAll('.pagination a').forEach(btn => {
                    if(btn.textContent.trim() == page){
                        btn.classList.add('active');
                    }
                });
            }

        });

    }, 200);
}
</script>

<script>
window.addEventListener("DOMContentLoaded", function(){

    currentPage = 1;

    loadPage(1);

    // aktifkan tombol 1
    document.querySelectorAll('.pagination a').forEach(btn => {
        if(btn.textContent.trim() == "1"){
            btn.classList.add('active');
        }
    });

});
</script>