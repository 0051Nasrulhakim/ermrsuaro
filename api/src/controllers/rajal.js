const berkas = require('../models/rajalModel');

const awalMedisRajal = (req, res) => {
    const { noRawat } = req.query;

    if(!noRawat){
        return res.status(400).json({ status: false, message: 'noRawat is required' });
    }
    
    berkas.awalMedisRajal(noRawat, (err, results) => {
        if (err) {
            console.error('Error fetching data:', err);
            return res.status(500).json({ message: 'Error fetching data', error: err });
        }

        if (results.length === 0) {
            return res.status(404).json({ 
                status: false,
                message: 'DATA AWAL MEDIS RAJAL TIDAK DITEMUKAN' 
            });
        }
        res.json({
            status: true,
            message: "Berkas Awal Medis Rawat Jalan ditemukan",
            data: results[0]
        });
    });
  
};

const pemeriksaanRalan = (req, res) => {
    const { noRawat } = req.query;

    if(!noRawat){
        return res.status(400).json({ status: false, message: 'noRawat is required' });
    }
    
    berkas.pemeriksaanRalan(noRawat, (err, results) => {
        if (err) {
            console.error('Error fetching data:', err);
            return res.status(500).json({ message: 'Error fetching data', error: err });
        }

        if (results.length === 0) {
            return res.status(404).json({ 
                status: false,
                message: 'DATA PEMERIKSAAN RALAN TIDAK DITEMUKAN' 
            });
        }
        res.json({
            status: true,
            message: "Berkas Awal Medis Rawat Jalan ditemukan",
            data: results
        });
    });
  
};

const cekJumlahBerkas = (req, res) => {
    const { noRawat } = req.query;

    if (!noRawat) {
        return res.status(400).json({ status: false, message: 'noRawat is required' });
    }

    // List tabel 
    const tabelList = [
        // IGD
        'penilaian_medis_igd',
        'penilaian_medis_ralan_gawat_darurat_psikiatri',
        'data_triase_igd',
        'penilaian_awal_keperawatan_igd',
        'pengkajian_restrain',

        // Rawat Jalan
        'penilaian_medis_ralan',
        'penilaian_medis_ralan_kandungan',
        'penilaian_awal_keperawatan_ralan',
        'penilaian_awal_keperawatan_kebidanan',
        'pemeriksaan_ralan',
        'resume_pasien',
        
        // rawat inap
        'penilaian_awal_keperawatan_ranap',
        'pemeriksaan_ranap',
        'penilaian_medis_ranap',
        'penilaian_medis_ranap_kandungan',

        //IBS
        'laporan_operasi',
        'asuhan_medis_pasca_bedah',
        'timeout_sebelum_insisi',
        'signout_sebelum_menutup_luka',
        'signin_sebelum_anastesi'
        // tambahkan tabel lain di sini
    ];

    let hasil = {};
    let completed = 0;

    // Loop setiap tabel dan cek jumlah
    tabelList.forEach(tabel => {
        berkas.cekBerkasRalan(noRawat, tabel, (err, count) => {
            completed++;

            if (err) {
                hasil[tabel] = { status: false, error: err.message };
            } else {
                hasil[tabel] = { status: true, jumlah: count };
            }

            if (completed === tabelList.length) {
                const semuaKosong = tabelList.every(t => hasil[t].status && hasil[t].jumlah === 0);

                if (semuaKosong) {
                    return res.status(404).json({ status: false, message: 'Data pemeriksaan tidak ditemukan', data: hasil });
                }

                res.json({
                    status: true,
                    message: 'Berkas ditemukan',
                    data: hasil
                });
            }
        });
    });
};





module.exports = {
    awalMedisRajal,
    pemeriksaanRalan,
    cekJumlahBerkas
};
