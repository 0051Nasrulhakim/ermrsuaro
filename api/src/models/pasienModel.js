const db = require('../config/db');
const moment = require('moment-timezone');

const pasienRajalModel = {
    byNoRM: (noRm, callback) => {
        const query = `
            SELECT
                pasien.*,cacat_fisik.nama_cacat AS cacat,
                bahasa_pasien.nama_bahasa AS bahasa
            FROM
                pasien
            JOIN
                cacat_fisik ON pasien.cacat_fisik = cacat_fisik.id
            JOIN
                bahasa_pasien ON pasien.bahasa_pasien = bahasa_pasien.id
            WHERE no_rkm_medis = ?
        `

        db.query(query, [noRm], callback);
    },

    findRegistrasi: (noRm, callback) => {
        const query = `
            SELECT 
                reg_periksa.*, 
                pasien.nm_pasien AS nama_pasien, 
                poliklinik.nm_poli AS nama_poli, 
                penjab.png_jawab AS jenis_bayar, 
                dokter.nm_dokter AS nama_dokter
            FROM 
                reg_periksa
            JOIN
                pasien ON reg_periksa.no_rkm_medis = pasien.no_rkm_medis 
            JOIN 
                poliklinik ON reg_periksa.kd_poli = poliklinik.kd_poli
            JOIN
                penjab ON reg_periksa.kd_pj = penjab.kd_pj
            JOIN 
                dokter ON reg_periksa.kd_dokter = dokter.kd_dokter
            WHERE 
                reg_periksa.no_rkm_medis = ? 
                AND reg_periksa.stts != 'Batal'
                AND reg_periksa.tgl_registrasi <= CURDATE()
            ORDER BY reg_periksa.tgl_registrasi DESC
        `;

        db.query(query, [noRm], callback);
    }

    
    
}

module.exports = pasienRajalModel;