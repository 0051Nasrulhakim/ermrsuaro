const express = require('express');
const router = express.Router();
const aroController = require('../controllers/pasien');
const rawatJalan = require('../controllers/rajal');

router.get('/getdata/byNorm', aroController.getByNorm);
router.get('/getdata/findRegistrasi', aroController.getRegistrasi);

module.exports = router;