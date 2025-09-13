const express = require('express');
const router = express.Router();
const rawatJalan = require('../controllers/rajal');

router.get('/awalMedisRajal', rawatJalan.awalMedisRajal);
router.get('/pemeriksaanRalan', rawatJalan.pemeriksaanRalan);
router.get('/cekBerkas', rawatJalan.cekJumlahBerkas);

module.exports = router;