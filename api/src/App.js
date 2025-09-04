require('dotenv').config();
const cors = require("cors");
const express = require('express');
const pasien = require('./routes/pasien');
const berkasRajal = require('./routes/rajal');

const app = express();
// const PORT = process.env.PORT || 3005;
const PORT = 3005;

app.use(cors());
app.use(express.json());

// Routes
app.use('/api/pasien', pasien);
app.use('/api/berkas', berkasRajal);

app.listen(PORT, () => {
    console.log(`Server berjalan di http://localhost:${PORT}`);
});