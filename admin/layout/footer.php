    </div> <!-- penutup p-4 -->
</div> <!-- penutup content-area -->


<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

/* ==========================
   KONFIRMASI HAPUS KOMENTAR
========================== */
function hapusKomen(id) {
    Swal.fire({
        title: 'Hapus Komentar',
        text: 'Apakah anda yakin ingin menghapus komentar ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6E5709',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'komen_proses.php?hapus=' + id;
        }
    });
}

/* ==========================
   KONFIRMASI HAPUS MERCH
========================== */
function hapusMerch(id) {
    Swal.fire({
        title: 'Hapus Merchandise',
        text: 'Apakah anda yakin ingin menghapus data ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6E5709',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'merch_proses.php?hapus=' + id;
        }
    });
}
</script>

</body>
</html>
