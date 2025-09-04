<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?php include __DIR__ . '/../component/modal_utama.php'; ?>
<?php include __DIR__ . '/../component/modal_rajal.php'; ?>
<?php include __DIR__ . '/../component/modal_ranap.php'; ?>
<?php include __DIR__ . '/../component/modalAction.php'; ?>


<div class="judul" style="text-align: center; font-weight: 600;">
    RIWAYAT BERKAS REKAM MEDIK
</div>

<div class="list-registrasi" style="font-size: 10pt;">

    <div id="riwayat-container" style="font-size: 10pt;">
        <!-- hasil Ajax -->
    </div>

</div>

<script>
    $(document).ready(function() {
        function riwayatKunjungan() {
            let norm = "045904";

            $.ajax({
                url: "http://192.168.2.6:3005/api/pasien/getData/findRegistrasi?noRM=" + norm,
                type: "GET",
                dataType: "json",

                success: function(response) {

                    // console.log("Data berhasil diambil:", response);

                    if (response.status && response.data.length > 0) {
                        let html = "";

                        response.data.forEach(function(item) {
                            html += `
                            <div class="list" style="border: 1px solid; margin-bottom: 1%; border-radius: 8px; padding-left: 1%; padding-right: 1%; padding-bottom: 1%;">
                                <div style="text-align: center; padding: 0.5%;">
                                    <div class="btn btn-success btnBukaBerkas"
                                        data-kode="${item.no_rawat}"
                                        data-nama_pasien="${item.nama_pasien}"
                                        data-nama="Berkas RM"
                                        data-tanggal="${item.tgl_registrasi}"
                                        data-norm="${item.no_rkm_medis}"
                                        data-jenis_kunjungan="${item.status_lanjut}"
                                        id="btnBukaBerkas"
                                        >
                                        BUKA BERKAS : ${item.no_rawat}
                                    </div>
                                </div>

                                <div class="tr" style="display: flex; width: 100%;">

                                <div class="left" style="width: 25%;">
                                    <div class="tr" style=" display: flex;">
                                        <div style="width:38%;">Tanggal Registrasi</div>
                                        <div style="width:2%">:</div>
                                        <div>${item.tgl_registrasi} ${item.jam_reg}</div>
                                    </div>
                                    <div class="tr" style=" display: flex;">
                                        <div style="width:38%">Umur Saat Daftar</div>
                                        <div style="width:2%">:</div>
                                        <div>${item.umurdaftar} ${item.sttsumur}</div>
                                    </div>
                                    <div class="tr" style=" display: flex;">
                                        <div style="width:38%">Unit / Poli</div>
                                        <div style="width:2%">:</div>
                                        <div>${item.nama_poli}</div>
                                    </div>
                                    <div class="tr" style=" display: flex;">
                                        <div style="width:38%">Cara Bayar</div>
                                        <div style="width:2%">:</div>
                                        <div>${item.jenis_bayar}</div>
                                    </div>
                                </div>

                                <div class="mid" style="width: 40%;">
                                    <div class="tr" style=" display: flex;">
                                        <div style="width:38%">Status Rawat</div>
                                        <div style="width:2%">:</div>
                                        <div>${item.status_lanjut}</div>
                                    </div>
                                    <div class="tr" style=" display: flex;">
                                        <div style="width:38%">Dokter</div>
                                        <div style="width:2%">:</div>
                                        <div>${item.nama_dokter}</div>
                                    </div>
                                    <div class="tr" style=" display: flex;">
                                        <div style="width:38%">Status Bayar</div>
                                        <div style="width:2%">:</div>
                                        <div>${item.status_bayar}</div>
                                    </div>
                                </div>

                                <div class="right" style="width: 40%;">
                                    <div class="tr" style=" display: flex;">
                                        <div style="width:38%">Penanggung Jawab</div>
                                        <div style="width:2%">:</div>
                                        <div>${item.p_jawab}</div>
                                    </div>
                                    <div class="tr" style=" display: flex;">
                                        <div style="min-width:38%; max-width:38%">Alamat PJ</div>
                                        <div style="width:2%">:</div>
                                        <div>${item.almt_pj}</div>
                                    </div>
                                    <div class="tr" style=" display: flex;">
                                        <div style="width:38%">Hubungan Dengan PJ</div>
                                        <div style="width:2%">:</div>
                                        <div>${item.hubunganpj}</div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            `;
                        });

                        $("#riwayat-container").html(html);
                    } else {
                        $("#riwayat-container").html("<div style='text-align:center; padding:1rem;'>Data tidak ditemukan</div>");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Gagal ambil data:", error);
                    $("#riwayat-container").html("<div style='text-align:center; padding:1rem; color:red;'>Gagal ambil data</div>");
                }
            });
        }

        // Panggil otomatis
        riwayatKunjungan();
    });

    // Event buka modal
    $(document).on("click", ".btnBukaBerkas", function() {
        let kode = $(this).data("kode");
        let nama = $(this).data("nama");
        let tanggal = $(this).data("tanggal");
        let norm = $(this).data("norm");
        let nama_pasien = $(this).data("nama_pasien");
        let jenis_kunjungan = $(this).data("jenis_kunjungan");

        // Set judul modal
        $("#modal1Label").text(nama+" ( "+ norm + " ) - " + kode + " | " + jenis_kunjungan);

        // Tambah alert di atas body
        $("#modalUtama .modal-body").prepend(`
            <div class="alert alert-info temp-alert">
                Nama Pasien: ${nama_pasien}<br>
                Tanggal Kunjungan: ${tanggal}
            </div>
        `);

        // Buka modal
        let modal = new bootstrap.Modal(document.getElementById("modalUtama"));
        modal.show();
    });

    // Reset modal saat ditutup
    $("#modalUtama").on("hidden.bs.modal", function () {
        // Hapus hanya alert yang ditambahkan (class .temp-alert)
        $(this).find(".temp-alert").remove();

        // Reset judul ke default
        $("#modal1Label").text("Modal 1");
    });

</script>