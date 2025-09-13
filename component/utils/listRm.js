function pemeriksaan_ralan(noRawat) {
    Swal.fire({
        title: "Memuat...",
        text: "Sedang mengambil data berkas pemeriksaan rawat jalan",
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    $.ajax({
        url: 'http://192.168.2.6:3005/api/berkas/pemeriksaanRalan?noRawat=' + noRawat,
        type: 'GET',
        success: function (res) {
            let modal = new bootstrap.Modal(document.getElementById("modalUtama"));
            modal.show();

            if (res.status && res.data.length > 0) {
                let html = "";

                res.data.forEach((item, index) => {
                    html += `
                        <div class="card mb-3 shadow-sm border-0">
                            <div class="card-header bg-primary text-white fw-bold">
                                Pemeriksaan ${index + 1} - ${item.tgl_perawatan} ${item.jam_rawat}
                            </div>
                            <div class="card-body">
                                <table class="table table-sm table-bordered align-middle text-center">
                                    <thead class="table-light">
                                        <tr>
                                            <th>TB</th>
                                            <th>BB</th>
                                            <th>Tensi</th>
                                            <th>Nadi</th>
                                            <th>Respirasi</th>
                                            <th>Suhu</th>
                                            <th>SpO₂</th>
                                            <th>GCS</th>
                                            <th>Kesadaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>${item.tinggi || "-"}</td>
                                            <td>${item.berat || "-"}</td>
                                            <td>${item.tensi || "-"}</td>
                                            <td>${item.nadi || "-"}</td>
                                            <td>${item.respirasi || "-"}</td>
                                            <td>${item.suhu_tubuh || "-"}</td>
                                            <td>${item.spo2 || "-"}</td>
                                            <td>${item.gcs || "-"}</td>
                                            <td>${item.kesadaran || "-"}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table class="table table-sm table-bordered">
                                    <tr>
                                        <th style="width: 25%">Dokter/Perawat</th>
                                        <td>${item.nama} (${item.nip})</td>
                                    </tr>
                                    <tr>
                                        <th>Keluhan</th>
                                        <td>${item.keluhan || "-"}</td>
                                    </tr>
                                    <tr>
                                        <th>Pemeriksaan</th>
                                        <td>${item.pemeriksaan || "-"}</td>
                                    </tr>
                                    <tr>
                                        <th>Alergi</th>
                                        <td>${item.alergi || "-"}</td>
                                    </tr>
                                    <tr>
                                        <th>Plan</th>
                                        <td>${item.rtl || "-"}</td>
                                    </tr>
                                    <tr>
                                        <th>Penilaian</th>
                                        <td>${item.penilaian || "-"}</td>
                                    </tr>
                                    <tr>
                                        <th>Instruksi</th>
                                        <td>${item.instruksi || "-"}</td>
                                    </tr>
                                    <tr>
                                        <th>Evaluasi</th>
                                        <td>${item.evaluasi || "-"}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    `;
                });


                $("#modalUtama .modal-body").html(html);
            } else {
                $("#modalUtama .modal-body").html(`
                    <div class="alert alert-warning">Tidak ada data berkas untuk pasien ini.</div>
                `);
            }
        },
        error: function () {
            $("#modalUtama .modal-body").html(`
                <div class="alert alert-danger">Gagal memuat data pemeriksaan rawat jalan.</div>
            `);
        },
        complete: function () {
            Swal.close(); // Tutup swal loading setelah selesai
        }
    });
}


function penilaian_medis_ralan(noRawat) {
    $.ajax({
        url: 'http://192.168.2.6:3005/api/berkas/awalMedisRajal?noRawat=' + noRawat, 
        type: 'GET',
        success: function (res) {
            if (res.status && res.data) {
                let item = res.data;

                let html = `
                <div class="card mb-3 shadow-sm border-0">
                    <div class="card-header bg-success text-white fw-bold">
                        Awal Medis Rawat Jalan - ${item.tanggal}
                    </div>
                    <div class="card-body">

                        <!-- Identitas -->
                        <h6 class="fw-bold text-primary">Identitas</h6>
                        <table class="table table-sm table-bordered mb-3">
                            <tr><th style="width: 25%">No. Rawat</th><td>${item.no_rawat}</td></tr>
                            <tr><th>Dokter</th><td>${item.nm_dokter} (${item.kd_dokter})</td></tr>
                        </table>

                        <!-- Anamnesis -->
                        <h6 class="fw-bold text-primary">Anamnesis</h6>
                        <table class="table table-sm table-bordered mb-3">
                            <tr><th style="width: 25%">Metode</th><td>${item.anamnesis || "-"}</td></tr>
                            <tr><th>Hubungan</th><td>${item.hubungan || "-"}</td></tr>
                            <tr><th>Keluhan Utama</th><td>${item.keluhan_utama || "-"}</td></tr>
                            <tr><th>RPS</th><td>${item.rps || "-"}</td></tr>
                            <tr><th>RPD</th><td>${item.rpd || "-"}</td></tr>
                            <tr><th>RPK</th><td>${item.rpk || "-"}</td></tr>
                            <tr><th>RPO</th><td>${item.rpo || "-"}</td></tr>
                            <tr><th>Alergi</th><td>${item.alergi || "-"}</td></tr>
                        </table>

                        <!-- Pemeriksaan Fisik -->
                        <h6 class="fw-bold text-primary">Pemeriksaan Fisik</h6>
                        <table class="table table-sm table-bordered text-center mb-3">
                            <thead class="table-light">
                                <tr>
                                    <th>Tensi</th>
                                    <th>Nadi</th>
                                    <th>RR</th>
                                    <th>Suhu</th>
                                    <th>SpO₂</th>
                                    <th>GCS</th>
                                    <th>Kesadaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>${item.td || "-"}</td>
                                    <td>${item.nadi || "-"}</td>
                                    <td>${item.rr || "-"}</td>
                                    <td>${item.suhu || "-"}</td>
                                    <td>${item.spo || "-"}</td>
                                    <td>${item.gcs || "-"}</td>
                                    <td>${item.kesadaran || "-"}</td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-sm table-bordered text-center mb-3">
                            <thead class="table-light">
                                <tr>
                                    <th>Keadaan</th>
                                    <th>Kepala</th>
                                    <th>Gigi</th>
                                    <th>THT</th>
                                    <th>Thoraks</th>
                                    <th>Abdomen</th>
                                    <th>Genital</th>
                                    <th>Ekstremitas</th>
                                    <th>Kulit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>${item.keadaan || "-"}</td>
                                    <td>${item.kepala || "-"}</td>
                                    <td>${item.gigi || "-"}</td>
                                    <td>${item.tht || "-"}</td>
                                    <td>${item.thoraks || "-"}</td>
                                    <td>${item.abdomen || "-"}</td>
                                    <td>${item.genital || "-"}</td>
                                    <td>${item.ekstremitas || "-"}</td>
                                    <td>${item.kulit || "-"}</td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- Keterangan fisik -->
                        <h6 class="fw-bold text-primary">Keterangan Fisik</h6>
                        <table class="table table-sm table-bordered mb-3">
                            <tr><th style="width: 25%">Keterangan Fisik</th><td>${item.ket_fisik || "-"}</td></tr>
                        </table>

                        <!-- Penunjang & Diagnosis -->
                        <h6 class="fw-bold text-primary">Penunjang & Diagnosis</h6>
                        <table class="table table-sm table-bordered mb-3">
                            <tr><th style="width: 25%">Penunjang</th><td>${item.penunjang || "-"}</td></tr>
                            <tr><th>Diagnosis</th><td>${item.diagnosis || "-"}</td></tr>
                        </table>

                        <!-- Tata Laksana -->
                        <h6 class="fw-bold text-primary">Tata Laksana</h6>
                        <table class="table table-sm table-bordered">
                            <tr><th style="width: 25%">Tindakan / Terapi</th><td>${item.tata || "-"}</td></tr>
                            <tr><th>Konsul / Rujuk</th><td>${item.konsulrujuk || "-"}</td></tr>
                            <tr><th>Evaluasi</th><td>${item.evaluasi || "-"}</td></tr>
                        </table>
                    </div>
                </div>
                `;

                let modal = new bootstrap.Modal(document.getElementById("modalUtama"));
                modal.show();
                $("#modalUtama .modal-body").html(html);

            } else {
                $("#modalUtama .modal-body").html("Data tidak ditemukan.");
            }
        },
        error: function () {
            $("#modalUtama .modal-body").html("Gagal memuat konten tabel.");
        },
        complete: function () {
            Swal.close(); // Tutup swal loading
        }
    });
}
