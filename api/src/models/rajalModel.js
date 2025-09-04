const db = require('../config/db');
const moment = require('moment-timezone');

const rajal = {
    awalMedisRajal: (noRawat, callback) => {
        const query = `
            SELECT 
                penilaian_medis_ralan.*, 
                    dokter.nm_dokter 
                FROM penilaian_medis_ralan 
                JOIN dokter ON penilaian_medis_ralan.kd_dokter = dokter.kd_dokter 
                WHERE no_rawat = ?  
        `

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
        `

        db.query(query, [noRawat], callback);
    },
}

module.exports = rajal;