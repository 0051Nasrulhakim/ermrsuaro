const db = require('../config/db');
const moment = require('moment-timezone');

const rajal = {
    awalMedisRajal: (noRawat, callback) => {
        const query = `
            SELECT 
                penilaian_medis_ralan.*, 
                dokter.nm_dokter, 
                pemeriksaan_ralan.evaluasi
            FROM penilaian_medis_ralan
            JOIN dokter 
                ON penilaian_medis_ralan.kd_dokter = dokter.kd_dokter
            LEFT JOIN pemeriksaan_ralan 
                ON penilaian_medis_ralan.no_rawat = pemeriksaan_ralan.no_rawat AND pemeriksaan_ralan.nip = penilaian_medis_ralan.kd_dokter
            WHERE penilaian_medis_ralan.no_rawat = ? 
        `;


        db.query(query, [noRawat], callback);
    },

    pemeriksaanRalan: (noRawat, callback) => {

        const query = `
            SELECT 
                pemeriksaan_ralan.*, 
                petugas.nama 
            FROM 
                pemeriksaan_ralan 
            JOIN 
                petugas ON pemeriksaan_ralan.nip = petugas.nip 
            WHERE 
                no_rawat = ?
            ORDER BY
                pemeriksaan_ralan.tgl_perawatan DESC, pemeriksaan_ralan.jam_rawat DESC
        `

        db.query(query, [noRawat], callback);

    },

    cekBerkasRalan: (noRawat, tabelSql, callback) => {

        const allowedTables = [
            'penilaian_medis_igd',
            'penilaian_medis_ralan_gawat_darurat_psikiatri',
            'data_triase_igd',
            'penilaian_awal_keperawatan_igd',
            'pengkajian_restrain',

            // rawat jalan
            'penilaian_awal_keperawatan_ralan',
            'penilaian_awal_keperawatan_ranap',
            'pemeriksaan_ralan',
            'penilaian_medis_ralan',
            'resume_pasien',
            'penilaian_medis_ralan_kandungan',
            'penilaian_awal_keperawatan_kebidanan',

            // RANAP
            'penilaian_awal_keperawatan_ranap',
            'pemeriksaan_ranap',
            'penilaian_medis_ranap',
            'penilaian_medis_ranap_kandungan',

            // IBS
            'laporan_operasi',
            'asuhan_medis_pasca_bedah',
            'timeout_sebelum_insisi',
            'signout_sebelum_menutup_luka',
            'signin_sebelum_anastesi'

            // tambahkan tabel lain sesuai kebutuhan
        ];

        if (!allowedTables.includes(tabelSql)) {
            return callback(new Error('Tabel tidak diperbolehkan'), null);
        }

        const query = `
                        SELECT COUNT(*) AS jumlah
                        FROM ${tabelSql}
                        WHERE no_rawat = ?;
                    `;

        db.query(query, [noRawat], (err, results) => {
            if (err) return callback(err, null);
            callback(null, results);
        });
    }
}

module.exports = rajal;