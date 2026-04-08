<?php
include 'layout/header.php';
?>

<!-- gambar full -->
<div id="imageModal" class="image-modal" onclick="closeImage()">
    <img id="modalImg">
</div>

<script>
function openImage(img) {
    const modal = document.getElementById("imageModal");
    const modalImg = document.getElementById("modalImg");

    modal.style.display = "flex";
    modalImg.src = img.src;
}

function closeImage() {
    document.getElementById("imageModal").style.display = "none";
}
</script>

<!-- WRAPPER HALAMAN GAME -->
<div class="game-page">

    <div class="game-wrapper">

        <!-- JUDUL HALAMAN -->
        <h2 class="game-title">Permainan</h2>

        <!-- HERO VISUAL GAME -->
        <section class="game-hero-visual">
        <figure class="board-figure">
                <img src="assets/img/papan boardgame F (1).png" 
                alt="Papan Permainan Perebutan Takhta Galuh"
                class="board-img"
                onclick="openImage(this)">
                <figcaption class="board-caption">
                    Papan Permainan <span>Perebutan Takhta Galuh</span>
                </figcaption>
            </figure>
        </section>

        <!-- KOMPONEN GAME -->
<section class="game-components">

    <div class="components-container">

        <h4 class="components-title">Komponen Permainan</h4>

        <div class="components-scroll">

            <div class="component-card">
                <img src="assets/img/papan.png">
                <p>Papan</p>
            </div>

            <div class="component-card">
                <img src="assets/img/pion 1.jpg">
                <p>Pion 1</p>
            </div>

            <div class="component-card">
                <img src="assets/img/pion 2.jpg">
                <p>Pion 2</p>
            </div>

            <div class="component-card">
                <img src="assets/img/pion 3.jpg">
                <p>Pion 3</p>
            </div>

            <div class="component-card">
                <img src="assets/img/pion 4.jpg">
                <p>Pion 4</p>
            </div>

            <div class="component-card">
                <img src="assets/img/1.jpg">
                <p>Penanda 1</p>
            </div>

            <div class="component-card">
                <img src="assets/img/2.jpg">
                <p>Penanda 2</p>
            </div>

            <div class="component-card">
                <img src="assets/img/3.jpg">
                <p>Penanda 3</p>
            </div>

            <div class="component-card">
                <img src="assets/img/4.jpg">
                <p>Penanda 4</p>
            </div>

            <div class="component-card">
                <img src="assets/img/strategi.jpg">
                <p>Kartu Strategi</p>
            </div>

            <div class="component-card">
                <img src="assets/img/legenda.jpg">
                <p>Kartu Legenda</p>
            </div>

            <div class="component-card">
                <img src="assets/img/dadu.jpg">
                <p>Dadu</p>
            </div>

        </div>

    </div>

</section>

        <!-- INFO GAME -->
        <div class="game-card">

            <div class="game-box game-info">
                <div class="game-content-center">

                    <h3>Perebutan Takhta Galuh</h3>

                    <p class="game-desc">
                       Perebutan Takhta Galuh adalah board game strategi bertema budaya Nusantara yang mengangkat konflik perebutan kekuasaan di Kerajaan Galuh, di mana setiap pemain berperan sebagai kubu bangsawan yang saling bersaing untuk memperoleh legitimasi, memperluas pengaruh, dan merebut takhta. Dalam permainan ini, pemain harus menyusun strategi yang matang, mengambil keputusan penting di setiap giliran, serta memanfaatkan sumber daya dan peluang yang ada untuk mengungguli lawan. Setiap langkah memiliki dampak besar terhadap jalannya permainan, sehingga dibutuhkan kecerdikan, perencanaan, dan kemampuan membaca situasi. Selain memberikan pengalaman bermain yang seru dan kompetitif, game ini juga menghadirkan nilai edukasi dengan memperkenalkan unsur sejarah serta budaya Indonesia, khususnya mengenai dinamika kekuasaan dan kehidupan kerajaan di masa lampau.
                    </p>

                </div>
            </div>

            <!-- CARA BERMAIN & ATURAN -->
            <div class="game-rules">

                <!-- CARA BERMAIN -->
                <div class="game-box">
                    <h4 class="game-box-title">Cara Bermain</h4>
                    <ol class="cara-bermain">
                        <li>Semua pemain memulai permainan di Kerajaan Galuh dan mengambil 1 Kartu Legenda.</li>
                        <li>Pemain menempatkan pion dan 3 penanda pengikut pada salah satu pos awal di kubunya.</li>
                        <li>Tentukan urutan pemain, permainan berjalan searah jarum jam.</li>
                        <li>Pada giliran pemain, pion dapat dipindahkan ke pos yang terhubung.</li>
                        <li>Pemain dapat memilih diam untuk menambah 1 penanda pengikut dari cadangan.</li>
                        <li>Pemain dapat menyerang wilayah lawan yang terhubung langsung.</li>
                        <li>Saat menyerang, semua penanda dari wilayah penyerang ikut berpindah ke wilayah yang diserang.</li>
                        <li>Jika jumlah penanda sama, kedua pemain melempar 1 dadu (1–6) dan angka terbesar menang.</li>
                        <li>Pemain yang berhasil menguasai dua kubu lawan dinyatakan sebagai pemenang.</li>
                    </ol>
                </div>

                <!-- ATURAN PERMAINAN -->
                <div class="game-box">
                    <h4 class="game-box-title">Aturan Permainan</h4>
                    <ol class="aturan-permainan">
                        <li>Permainan dapat dimainkan oleh 2–4 pemain, dan setiap pemain mengendalikan satu pion serta sejumlah penanda pengikut.Setiap pemain memulai permainan dengan 3 penanda pengikut pada pos awalnya.</li>
                        <li>Pada awal permainan semua pemain memulai dari Kerajaan Galuh dan masing-masing mengambil 1 kartu legenda.   </li>
                        <li>Setiap pemain menempatkan 3 penanda pengikut pada pos awal di kubunya.</li>
                        <li>Setiap pos hanya dapat menampung maksimal 3 penanda pengikut, kecuali ada efek kartu yang menyatakan sebaliknya</li>
                        <li>Jika pemain memilih diam di suatu pos, pemain dapat menambahkan 1 penanda pengikut dari cadangan ke pos tersebut.</li>
                        <li>Pemain dapat menyerang pos lawan yang terhubung langsung dengan pos miliknya.</li>
                        <li>Saat menyerang, semua penanda dari pos penyerang wajib ikut berpindah ke pos yang diserang.</li>
                        <li>Jika jumlah penanda penyerang dan bertahan sama, kedua pemain melempar 1 dadu enam sisi (D6) dan angka terbesar memenangkan pertempuran.</li>
                        <li>Penanda yang kalah dalam pertempuran dianggap gugur dan dikeluarkan dari permainan.</li>
                        <li>Pemain yang berhasil menguasai dua kubu milik pemain lain dinyatakan sebagai pemenang dan menjadi penguasa Takhta Galuh</li>
                    </ol>
                </div>

            </div>

        </div>

    </div>

</div>

<?php include 'layout/footer.php'; ?>

<script>
window.addEventListener("scroll", function() {
    document.querySelectorAll(".game-box").forEach(box => {
        const position = box.getBoundingClientRect().top;
        if(position < window.innerHeight - 100){
            box.classList.add("show");
        }
    });
});
</script>
