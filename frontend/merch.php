<?php
include 'layout/header.php';
include '../config/koneksi.php';
?>

<!-- WRAPPER HALAMAN MERCH -->
<div class="merch-page">

    <div class="merch-wrapper">

        <!-- JUDUL HALAMAN -->
        <h2 class="merch-title">Merchandise</h2>

        <div class="merch-grid">

        <?php
        $query = mysqli_query($koneksi, "SELECT * FROM tb_merch ORDER BY id_merch DESC");

        if (mysqli_num_rows($query) > 0):
            while ($m = mysqli_fetch_assoc($query)):
        ?>
            <!-- CARD MERCH -->
            <div class="merch-card">

                <div class="merch-image">
                    <img src="../uploads/<?= $m['foto_merch']; ?>" 
     alt="<?= $m['judul_merch']; ?>" 
     class="zoom-img">
                </div>

                <div class="merch-body">

                    <!-- JUDUL PRODUK -->
                    <h3 class="merch-product-title">
                        <?= $m['judul_merch']; ?>
                    </h3>

                    <div class="merch-price">
                        Rp <?= number_format($m['harga_merch'], 0, ',', '.'); ?>
                    </div>

                    <?php if ($m['stok_merch'] > 0): ?>
                    <div class="merch-stock available">
                        Stok: <?= $m['stok_merch']; ?>
                    </div>
                    <?php else: ?>
                        <div class="merch-stock out">
                            Stok Habis
                        </div>
                    <?php endif; ?>

                    <p class="merch-desc">
                        <?= nl2br($m['detail_merch']); ?>
                    </p>

                    <?php
                    $no_wa = "6283164982892"; // GANTI dengan nomor kamu (pakai 62 tanpa +)

                    $pesan = "Halo kak, saya ingin membeli produk " . $m['judul_merch'] . " dari Perebutan Takhta Galuh. Apakah stok masih tersedia?";
                    $link_wa = "https://wa.me/" . $no_wa . "?text=" . urlencode($pesan);
                    ?>

                  <?php if ($m['stok_merch'] > 0): ?>
                <a href="<?= $link_wa; ?>" target="_blank" class="merch-btn">
                    <img src="https://cdn-icons-png.flaticon.com/512/733/733585.png" class="wa-icon">
                    Beli via WhatsApp
                </a>
                <?php else: ?>
                    <div class="merch-btn disabled">
                        Stok Habis
                    </div>
                <?php endif; ?>


                </div>

            </div>
            <!-- END CARD -->
        <?php
            endwhile;
        else:
?>

<div class="merch-empty-box">
    
    <h3>Belum ada merchandise</h3>
    <p>Silakan cek kembali nanti ya 👀</p>
</div>

<?php endif; ?>
        </div>

    </div>

</div>
<!-- END MERCH PAGE -->

<div class="image-modal" id="imageModal">
    <img id="modalImg" src="">
</div>

<?php include 'layout/footer.php'; ?>

<script>
const images = document.querySelectorAll('.zoom-img');
const modal = document.getElementById('imageModal');
const modalImg = document.getElementById('modalImg');

images.forEach(img => {
    img.addEventListener('click', () => {
        modal.style.display = 'flex';
        modalImg.src = img.src;
    });
});

modal.addEventListener('click', () => {
    modal.style.display = 'none';
});
</script>