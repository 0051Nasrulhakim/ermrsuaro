<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?php include __DIR__ . '/../component/modal_utama.php'; ?>


<div class="judul" style="text-align: center; font-weight: 600;">
    RIWAYAT BERKAS REKAM MEDIK
</div>

<div class="list-registrasi" style="font-size: 10pt;">

    <div id="riwayat-container" style="font-size: 10pt;">
        <!-- hasil Ajax -->
    </div>

</div>

<script src="http://192.168.2.6/ermrsuaro/component/utils/listRm.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        function riwayatKunjungan() {
            // let norm = "045904";
            let norm = "046025";

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
                                    <div class="btn btn-success"
                                        data-kode="${item.no_rawat}"
                                        data-nama_pasien="${item.nama_pasien}"
                                        data-nama="Berkas RM"
                                        data-tanggal="${item.tgl_registrasi}"
                                        data-norm="${item.no_rkm_medis}"
                                        data-jenis_kunjungan="${item.status_lanjut}"
                                        >
                                        ${item.no_rawat}
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
                                        <div class="tr" style=" display: flex;">
                                            <div style="width:38%">Status Kunjungan</div>
                                            <div style="width:2%">:</div>
                                            <div>${item.status_poli}</div>
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

                                <div class="section" style="margin-top: 1%">
                                    <div style="border: 1px solid; display: flex;">
                                        <div class="left" style="width: 25%; border-right: 1px solid #000000ff;">
                                            <div class="wrapper" style="text-align:center; border-bottom: 1px solid #000000ff; padding-left: 0.5%; padding-right: 0.5%;">
                                                BERKAS REKAM MEDIK IGD
                                            </div>

                                            <div class="wrapper" style="display: flex; border-bottom: 1px solid #c2c2c2ff; padding: 0.5%;">
                                                <div class="text" style="width: 70%;">TRIASE IGD</div>
                                                <div class="text" style="width: 10%; text-align: center;">
                                                    <input class="form-check-input" type="checkbox" value="" id="data_triase_igd_${item.no_rawat.replace(/\//g,'-')}" disabled>
                                                </div>
                                                <div class="text" style="width: 20%; text-align: center;">
                                                    <button
                                                        class="btn btn-sm btn-primary btnBukaBerkas"
                                                        data-norawat="${item.no_rawat}"
                                                        data-tabel="data_triase_igd"
                                                        data-namaberkas="Triase IGD"
                                                    >Buka</button>
                                                </div>
                                                
                                            </div>
                                            <div class="wrapper" style="display: flex; border-bottom: 1px solid #c2c2c2ff; padding: 0.5%;">
                                                <div class="text" style="width: 70%;">AWAL MEDIS IGD</div>
                                                <div class="text" style="width: 10%; text-align: center;">
                                                    <input class="form-check-input" type="checkbox" value="" id="penilaian_medis_igd_${item.no_rawat.replace(/\//g,'-')}" disabled>
                                                </div>
                                                <div class="text" style="width: 20%; text-align: center;">
                                                    <button 
                                                        class="btn btn-sm btn-primary btnBukaBerkas"
                                                        data-norawat="${item.no_rawat}"
                                                        data-tabel="penilaian_medis_igd"
                                                        data-namaberkas="Awal Medis IGD"
                                                    >Buka</button>
                                                </div>
                                                
                                            </div>
                                            <div class="wrapper" style="display: flex; border-bottom: 1px solid #c2c2c2ff; padding: 0.5%;">
                                                <div class="text" style="width: 70%;">AWAL MEDIS IGD PSIKIATRI</div>
                                                <div class="text" style="width: 10%; text-align: center;">
                                                    <input class="form-check-input" type="checkbox" value="" id="penilaian_medis_ralan_gawat_darurat_psikiatri_${item.no_rawat.replace(/\//g,'-')}" disabled>
                                                </div>
                                                <div class="text" style="width: 20%; text-align: center;">
                                                    <button
                                                        class="btn btn-sm btn-primary btnBukaBerkas"
                                                        data-norawat="${item.no_rawat}"
                                                        data-tabel="penilaian_medis_ralan_gawat_darurat_psikiatri"
                                                        data-namaberkas="Awal Medis IGD Psikiatri"
                                                    >Buka</button>
                                                </div>
                                                
                                            </div>
                                            <div class="wrapper" style="display: flex; border-bottom: 1px solid #c2c2c2ff; padding: 0.5%;">
                                                <div class="text" style="width: 70%;">AWAL KEPERAWATAN IGD</div>
                                                <div class="text" style="width: 10%; text-align: center;">
                                                    <input class="form-check-input" type="checkbox" value="" id="awal_keperawatan_igd_${item.no_rawat.replace(/\//g,'-')}" disabled>
                                                </div>
                                                <div class="text" style="width: 20%; text-align: center;">
                                                    <button
                                                        class="btn btn-sm btn-primary btnBukaBerkas"
                                                        data-norawat="${item.no_rawat}"
                                                        data-tabel="awal_keperawatan_igd"
                                                        data-namaberkas="Awal Keperawatan IGD"
                                                    >Buka</button>
                                                </div>
                                                
                                            </div>
                                            <div class="wrapper" style="display: flex; border-bottom: 1px solid #c2c2c2ff; padding: 0.5%;">
                                                <div class="text" style="width: 70%;">PENGKAJIAN RESTRAIN</div>
                                                <div class="text" style="width: 10%; text-align: center;">
                                                    <input class="form-check-input" type="checkbox" value="pengkajian_restrain_${item.no_rawat.replace(/\//g,'-')}" id="checkDefault" disabled>
                                                </div>
                                                <div class="text" style="width: 20%; text-align: center;">
                                                    <button
                                                        class="btn btn-sm btn-primary btnBukaBerkas"
                                                        data-norawat="${item.no_rawat}"
                                                        data-tabel="pengkajian_restrain"
                                                        data-namaberkas="Pengkajian Restrain"
                                                    >Buka</button>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="mid" style="width: 25%; border-right: 1px solid #000000ff;">
                                            <div class="wrapper" style="text-align:center; border-bottom: 1px solid #000000ff; padding-left: 0.5%; padding-right: 0.5%;">
                                                BERKAS RAWAT JALAN
                                            </div>

                                                <div class="wrapper" style="display: flex; border-bottom: 1px solid #c2c2c2ff; padding: 0.5%;">
                                                    <div class="text" style="width: 70%;">AWAL MEDIS RAWAT JALAN</div>
                                                    <div class="text" style="width: 10%; text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="penilaian_medis_ralan_${item.no_rawat.replace(/\//g,'-')}" disabled>
                                                    </div>
                                                    <div class="text" style="width: 20%; text-align: center;">
                                                        <button class="btn btn-sm btn-primary btnBukaBerkas"
                                                            data-norawat="${item.no_rawat}"
                                                            data-tabel="penilaian_medis_ralan"
                                                            data-namaberkas="Penilaian Medis Rawat Jalan"
                                                        >Buka</button>
                                                    </div>
                                                </div>
                                                <div class="wrapper" style="display: flex; border-bottom: 1px solid #c2c2c2ff; padding: 0.5%;">
                                                    <div class="text" style="width: 70%;">AWAL MEDIS KEBIDANAN</div>
                                                    <div class="text" style="width: 10%; text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="penilaian_medis_ralan_kandungan_${item.no_rawat.replace(/\//g,'-')}" disabled>
                                                    </div>
                                                    <div class="text" style="width: 20%; text-align: center;">
                                                        <button class="btn btn-sm btn-primary btnBukaBerkas"
                                                            data-norawat="${item.no_rawat}"
                                                            data-tabel="penilaian_medis_ralan_kandungan"
                                                            data-namaberkas="Penilaian Medis Ralan Kandungan"
                                                        >Buka</button>
                                                    </div>
                                                </div>
                                                <div class="wrapper" style="display: flex; border-bottom: 1px solid #c2c2c2ff; padding: 0.5%;">
                                                    <div class="text" style="width: 70%;">AWAL KEP. RAWAT JALAN</div>
                                                    <div class="text" style="width: 10%; text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="penilaian_awal_keperawatan_ralan_${item.no_rawat.replace(/\//g,'-')}" disabled>
                                                    </div>
                                                    <div class="text" style="width: 20%; text-align: center;">
                                                        <button class="btn btn-sm btn-primary btnBukaBerkas"
                                                            data-norawat="${item.no_rawat}"
                                                            data-tabel="penilaian_awal_keperawatan_ralan"
                                                            data-namaberkas="Penilaian Awal Keperawatan Ralan"
                                                        >Buka</button>
                                                    </div>
                                                </div>
                                                <div class="wrapper" style="display: flex; border-bottom: 1px solid #c2c2c2ff; padding: 0.5%;">
                                                    <div class="text" style="width: 70%;">AWAL KEP. RAJAL KEBIDANAN</div>
                                                    <div class="text" style="width: 10%; text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="penilaian_awal_keperawatan_kebidanan_${item.no_rawat.replace(/\//g,'-')}" disabled>
                                                    </div>
                                                    <div class="text" style="width: 20%; text-align: center;">
                                                        <button class="btn btn-sm btn-primary btnBukaBerkas"
                                                            data-norawat="${item.no_rawat}"
                                                            data-tabel="penilaian_awal_keperawatan_kebidanan"
                                                            data-namaberkas="Penilaian Awal Kebidanan"
                                                        >Buka</button>
                                                    </div>
                                                </div>
                                                <div class="wrapper" style="display: flex; border-bottom: 1px solid #c2c2c2ff; padding: 0.5%;">
                                                    <div class="text" style="width: 70%;">SOAP RAWAT JALAN</div>
                                                    <div class="text" style="width: 10%; text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="pemeriksaan_ralan_${item.no_rawat.replace(/\//g,'-')}" disabled>
                                                    </div>
                                                    <div class="text" style="width: 20%; text-align: center;">
                                                        <button class="btn btn-sm btn-primary btnBukaBerkas"
                                                            data-norawat="${item.no_rawat}"
                                                            data-tabel="pemeriksaan_ralan"
                                                            data-namaberkas="SOAP RAWAT JALAN"
                                                        >Buka</button>
                                                    </div>
                                                </div>
                                                <div class="wrapper" style="display: flex; border-bottom: 1px solid #c2c2c2ff; padding: 0.5%;">
                                                    <div class="text" style="width: 70%;">RESUME RAWAT JALAN</div>
                                                    <div class="text" style="width: 10%; text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="resume_pasien_${item.no_rawat.replace(/\//g,'-')}" disabled>
                                                    </div>
                                                    <div class="text" style="width: 20%; text-align: center;">
                                                        <button class="btn btn-sm btn-primary btnBukaBerkas"
                                                            data-norawat="${item.no_rawat}"
                                                            data-tabel="resume_pasien"
                                                            data-namaberkas="Resume Pasien"
                                                        >Buka</button>
                                                    </div>
                                                </div>
                                                
                                        </div>
                                        <div class="mid" style="width: 25%; border-right: 1px solid #000000ff;">
                                            <div class="wrapper" style="text-align:center; border-bottom: 1px solid #000000ff; padding-left: 0.5%; padding-right: 0.5%;">
                                                BERKAS RAWAT INAP
                                            </div>

                                            <div class="wrapper" style="display: flex; border-bottom: 1px solid #c2c2c2ff; padding: 0.5%;">
                                                <div class="text" style="width: 70%;">AWAL MEDIS RAWAT INAP</div>
                                                <div class="text" style="width: 10%; text-align: center;">
                                                    <input class="form-check-input" type="checkbox" value="" id="penilaian_medis_ranap_${item.no_rawat.replace(/\//g,'-')}" disabled>
                                                </div>
                                                <div class="text" style="width: 20%; text-align: center;">
                                                    <button 
                                                        class="btn btn-sm btn-primary btnBukaBerkas"
                                                        data-norawat="${item.no_rawat}"
                                                        data-tabel="penilaian_medis_ranap"
                                                        data-namaberkas="Awal Medis Rawat Inap"
                                                    >
                                                    Buka</button>
                                                </div>
                                                
                                            </div>
                                            <div class="wrapper" style="display: flex; border-bottom: 1px solid #c2c2c2ff; padding: 0.5%;">
                                                <div class="text" style="width: 70%;">AWAL MEDIS KEBIDANAN RANAP</div>
                                                <div class="text" style="width: 10%; text-align: center;">
                                                    <input class="form-check-input" type="checkbox" value="penilaian_medis_ranap_kandungan_${item.no_rawat.replace(/\//g,'-')}" id="checkDefault" disabled>
                                                </div>
                                                <div class="text" style="width: 20%; text-align: center;">
                                                    <button 
                                                        class="btn btn-sm btn-primary btnBukaBerkas"
                                                        data-norawat="${item.no_rawat}"
                                                        data-tabel="penilaian_medis_ranap_kandungan"
                                                        data-namaberkas="Awal Medis Rawat Inap Kandungan"
                                                    >Buka</button>
                                                </div>
                                                
                                            </div>
                                            <div class="wrapper" style="display: flex; border-bottom: 1px solid #c2c2c2ff; padding: 0.5%;">
                                                <div class="text" style="width: 70%;">AWAL KEP. RAWAT INAP</div>
                                                <div class="text" style="width: 10%; text-align: center;">
                                                    <input class="form-check-input" type="checkbox" value="" id="penilaian_awal_keperawatan_ranap_${item.no_rawat.replace(/\//g,'-')}" disabled>
                                                </div>
                                                <div class="text" style="width: 20%; text-align: center;">
                                                    <button class="btn btn-sm btn-primary btnBukaBerkas"
                                                        data-norawat="${item.no_rawat}"
                                                        data-tabel="penilaian_awal_keperawatan_ranap"
                                                        data-namaberkas="Penilaian Awal Keperawatan Ranap"
                                                    >Buka</button>
                                                </div>
                                                
                                            </div>
                                            <div class="wrapper" style="display: flex; border-bottom: 1px solid #c2c2c2ff; padding: 0.5%;">
                                                <div class="text" style="width: 70%;">AWAL KEP. RANAP KEBIDANAN</div>
                                                <div class="text" style="width: 10%; text-align: center;">
                                                    <input class="form-check-input" type="checkbox" value="" id="penilaian_awal_keperawatan_kebidanan_ranap${item.no_rawat.replace(/\//g,'-')}" disabled>
                                                </div>
                                                <div class="text" style="width: 20%; text-align: center;">
                                                    <button class="btn btn-sm btn-primary btnBukaBerkas"
                                                        data-norawat="${item.no_rawat}"
                                                        data-tabel="penilaian_awal_keperawatan_kebidanan_ranap"
                                                        data-namaberkas="Penilaian Awal Kebidanan Ranap"
                                                    >Buka</button>
                                                </div>
                                                
                                            </div>
                                            <div class="wrapper" style="display: flex; border-bottom: 1px solid #c2c2c2ff; padding: 0.5%;">
                                                <div class="text" style="width: 70%;">SOAP RAWAT INAP</div>
                                                <div class="text" style="width: 10%; text-align: center;">
                                                    <input class="form-check-input" type="checkbox" value="" id="pemeriksaan_ranap_${item.no_rawat.replace(/\//g,'-')}" disabled>
                                                </div>
                                                <div class="text" style="width: 20%; text-align: center;">
                                                    <button class="btn btn-sm btn-primary btnBukaBerkas"
                                                        data-norawat="${item.no_rawat}"
                                                        data-tabel="pemeriksaan_ranap"
                                                        data-namaberkas="SOAP RAWAT INAP"
                                                    >Buka</button>
                                                </div>
                                                
                                            </div>
                                            <div class="wrapper" style="display: flex; border-bottom: 1px solid #c2c2c2ff; padding: 0.5%;">
                                                <div class="text" style="width: 70%;">RESUME RAWAT INAP</div>
                                                <div class="text" style="width: 10%; text-align: center;">
                                                    <input class="form-check-input" type="checkbox" value="" id="resume_pasien_ranap_${item.no_rawat.replace(/\//g,'-')}" disabled>
                                                </div>
                                                <div class="text" style="width: 20%; text-align: center;">
                                                    <button class="btn btn-sm btn-primary btnBukaBerkas"
                                                        data-norawat="${item.no_rawat}"
                                                        data-tabel="resume_pasien_ranap_"
                                                        data-namaberkas="RESUME RAWAT INAP"
                                                    >Buka</button>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="mid" style="width: 25%; border-right: 1px solid #000000ff;">
                                            <div class="wrapper" style="text-align:center; border-bottom: 1px solid #000000ff; padding-left: 0.5%; padding-right: 0.5%;">
                                                BERKAS IBS
                                            </div>

                                                <div class="wrapper" style="display: flex; border-bottom: 1px solid #c2c2c2ff; padding: 0.5%;">
                                                    <div class="text" style="width: 70%;">ASSESMENT PRA BEDAH</div>
                                                    <div class="text" style="width: 10%; text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="checkDefault" disabled>
                                                    </div>
                                                    <div class="text" style="width: 20%; text-align: center;">
                                                        <button class="btn btn-sm btn-primary"
                                                        >Buka</button>
                                                    </div>
                                                </div>
                                                
                                                <div class="wrapper" style="display: flex; border-bottom: 1px solid #c2c2c2ff; padding: 0.5%;">
                                                    <div class="text" style="width: 70%;">LAPORAN OPERASI</div>
                                                    <div class="text" style="width: 10%; text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="laporan_operasi_${item.no_rawat.replace(/\//g,'-')}" disabled>
                                                    </div>
                                                    <div class="text" style="width: 20%; text-align: center;">
                                                        <button class="btn btn-sm btn-primary btnBukaBerkas"
                                                            data-norawat="${item.no_rawat}"
                                                            data-tabel="laporan_operasi"
                                                            data-namaberkas="LAPORAN OPERASI"
                                                        >Buka</button>
                                                    </div>
                                                </div>
                                                <div class="wrapper" style="display: flex; border-bottom: 1px solid #c2c2c2ff; padding: 0.5%;">
                                                    <div class="text" style="width: 70%;">ASUHAN MEDIS PASCA BEDAH</div>
                                                    <div class="text" style="width: 10%; text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="asuhan_medis_pasca_bedah_${item.no_rawat.replace(/\//g,'-')}" disabled>
                                                    </div>
                                                    <div class="text" style="width: 20%; text-align: center;">
                                                        <button class="btn btn-sm btn-primary btnBukaBerkas"
                                                            data-norawat="${item.no_rawat}"
                                                            data-tabel="asuhan_medis_pasca_bedah"
                                                            data-namaberkas="ASUHAN MEDIS PASCA BEDAH"
                                                        >Buka</button>
                                                    </div>
                                                </div>
                                                <div class="wrapper" style="display: flex; border-bottom: 1px solid #c2c2c2ff; padding: 0.5%;">
                                                    <div class="text" style="width: 70%;">SIGN IN</div>
                                                    <div class="text" style="width: 10%; text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="signin_sebelum_anastesi_${item.no_rawat.replace(/\//g,'-')}" disabled>
                                                    </div>
                                                    <div class="text" style="width: 20%; text-align: center;">
                                                        <button class="btn btn-sm btn-primary btnBukaBerkas"
                                                            data-norawat="${item.no_rawat}"
                                                            data-tabel="signin_sebelum_anastesi"
                                                            data-namaberkas="SIGN IN OPERASI"
                                                        >Buka</button>
                                                    </div>
                                                </div>
                                                <div class="wrapper" style="display: flex; border-bottom: 1px solid #c2c2c2ff; padding: 0.5%;">
                                                    <div class="text" style="width: 70%;">SIGN OUT</div>
                                                    <div class="text" style="width: 10%; text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="signout_sebelum_menutup_luka_${item.no_rawat.replace(/\//g,'-')}" disabled>
                                                    </div>
                                                    <div class="text" style="width: 20%; text-align: center;">
                                                        <button class="btn btn-sm btn-primary btnBukaBerkas"
                                                            data-norawat="${item.no_rawat}"
                                                            data-tabel="signout_sebelum_menutup_luka"
                                                            data-namaberkas="SIGN OUT OPERASI"
                                                        >Buka</button>
                                                    </div>
                                                </div>
                                                <div class="wrapper" style="display: flex; border-bottom: 1px solid #c2c2c2ff; padding: 0.5%;">
                                                    <div class="text" style="width: 70%;">TIME OUT</div>
                                                    <div class="text" style="width: 10%; text-align: center;">
                                                        <input class="form-check-input" type="checkbox" value="" id="timeout_sebelum_insisi_${item.no_rawat.replace(/\//g,'-')}" disabled>
                                                    </div>
                                                    <div class="text" style="width: 20%; text-align: center;">
                                                        <button class="btn btn-sm btn-primary btnBukaBerkas"
                                                            data-norawat="${item.no_rawat}"
                                                            data-tabel="timeout_sebelum_insisi"
                                                            data-namaberkas="TIME OUT OPERASI"
                                                        >Buka</button>
                                                    </div>
                                                </div>

                                        </div>
                                    
                                    </div>
                                    

                                </div>
                            </div>

                            
                            `;
                        });
                        //
                        $("#riwayat-container").html(html);

                        // setBerkas(item.no_rawat)

                        response.data.forEach(item => setBerkas(item.no_rawat));
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

        function setBerkas(noRawat) {
            $.ajax({
                url: 'http://192.168.2.6:3005/api/berkas/cekBerkas?noRawat=' + noRawat,
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    if (res.status && res.data) {
                        Object.keys(res.data).forEach(tabel => {
                            const info = res.data[tabel];
                            const safeId = tabel + '_' + noRawat.replace(/\//g, '-'); // ID aman
                            if (info.status && info.jumlah && info.jumlah[0].jumlah > 0) {
                                $('#' + safeId).prop('checked', true);
                            } else {
                                $('#' + safeId).prop('checked', false);
                            }
                        });
                    }
                },
                error: function(err) {
                    console.error('Error set berkas:', err);
                }
            });
        }

        // Panggil otomatis
        riwayatKunjungan();


        $(document).on("click", ".btnBukaBerkas", function() {

            let noRawat = $(this).data("norawat"); // Nomor rawat pasien
            let tabel = $(this).data("tabel"); // Nama tabel/file
            let namaBerkas = $(this).data("namaberkas"); // Nama berkas pasien

            // Set judul modal
            $("#modal1Label").text("BERKAS RM - " + namaBerkas + " | " + noRawat);

            // Buka modal

            loadBerkas(tabel, noRawat)

        });

    });

    function loadBerkas(tabel, noRawat) {
        switch (tabel) {
            case "laporan_operasi":
                laporan_operasi(noRawat);
                // alert('terhit');
                break;
            case "resume_medis":
                resume_medis(noRawat);
                break;
            case "penilaian_medis_ralan":
                penilaian_medis_ralan(noRawat);
                break;
            case "pemeriksaan_ralan":
                pemeriksaan_ralan(noRawat);
                break;
            default:
                
                let modal = new bootstrap.Modal(document.getElementById("modalUtama"));
                modal.show();
                $("#modalUtama .modal-body").html("Tabel belum dikenali.");

        }
        // Swal.close();
    }
</script>