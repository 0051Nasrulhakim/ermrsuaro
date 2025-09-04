const express = require('express');
const router = express.Router();
const rawatJalan = require('../controllers/rajal');

router.get('/awalMedisRajal', rawatJalan.awalMedisRajal);
router.get('/pemeriksaanRalan', rawatJalan.pemeriksaanRalan);

module.exports = router;