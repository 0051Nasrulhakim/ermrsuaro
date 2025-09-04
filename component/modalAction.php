<script>
    $(document).ready(function() {
        // Tombol manual buka Modal 1
        $('#btnBukaBerkas').on('click', function() {
            let kode = $(this).data('kode');
            let nama = $(this).data('nama');
            let tanggal = $(this).data('tanggal');

            // Set data di modal 1
            $('#modal1Label').text(kode);
           

            // Buka modal 1 manual
            var modal1 = new bootstrap.Modal(document.getElementById('modalUtama'));
            modal1.show();
        });

        // Tombol IGD → buka Modal 2 manual tanpa AJAX
        $('#btnIGD').on('click', function() {
            // Set konten manual di Modal 2
            let kode = $('#modal1Label').text();
            $('#modal2Body').html('<p>Detail IGD untuk kode: <strong>' + kode + '</strong></p><p>Isi lainnya bisa ditambahkan di sini.</p>');

            // Tutup modal 1
            var modal1El = document.getElementById('modalUtama');
            var modal1 = bootstrap.Modal.getInstance(modal1El);
            modal1.hide();

            // Buka modal 2
            var modal2 = new bootstrap.Modal(document.getElementById('modalDua'));
            modal2.show();
        });

        // Setelah modal 2 ditutup → buka lagi modal 1
        $('#modalDua').on('hidden.bs.modal', function() {
            // Reset modal 2
            $(this).find('form').trigger('reset');
            $(this).find('input, textarea, select').val('').prop('checked', false);

            // Buka modal 1 lagi
            var modal1 = new bootstrap.Modal(document.getElementById('modalUtama'));
            modal1.show();
        });
    });
</script>