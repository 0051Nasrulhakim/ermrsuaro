const pasienRajal = require('../models/pasienModel');

const getByNorm = (req, res) => {
    const { noRM } = req.query;

    if(!noRM){
        return res.status(400).json({ status: false, message: 'noRM is required' });
    }
    
    pasienRajal.byNoRM(noRM, (err, results) => {
        if (err) {
            console.error('Error fetching data:', err);
            return res.status(500).json({ message: 'Error fetching data', error: err });
        }

        if (results.length === 0) {
            return res.status(404).json({ 
                status: false,
                message: 'DATA PASIEN TIDAK DITEMUKAN' 
            });
        }
        res.json({
            status: true,
            message: "Data Pasien ditemukan",
            data: results[0]
        });
    });
  
};


const getRegistrasi = (req, res) => {
    const { noRM } = req.query;
    // console.log(noRW)

    if(!noRM){
        return res.status(400).json({ status: false, message: 'No REKAM MEDIS is required' });
    }
    
    pasienRajal.findRegistrasi(noRM, (err, results) => {
        if (err) {
            console.error('Error fetching data:', err);
            return res.status(500).json({ message: 'Error fetching data', error: err });
        }

        if (results.length === 0) {
            return res.status(404).json({ 
                status: false,
                message: 'DATA PASIEN TIDAK DITEMUKAN' 
            });
        }
        res.json({
            status: true,
            message: 'DATA PASIEN DITEMUKAN',
            data: results 
        });
    });

};


module.exports = {
    getByNorm,
    getRegistrasi
};
