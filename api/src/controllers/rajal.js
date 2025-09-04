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




module.exports = {
    awalMedisRajal,
    pemeriksaanRalan
};
