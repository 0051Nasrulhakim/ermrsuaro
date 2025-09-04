const mysql = require('mysql2');

const db = mysql.createPool({
    host: '192.168.2.91',
    user: 'root',
    password: 'root137',
    database: 'sik24',
    waitForConnections: true,
    connectionLimit: 6,
    queueLimit: 0,
    // dateStrings: true,
    typeCast: function (field, next) {
        if (field.type === "DATE" || field.type === "DATETIME" || field.type === "TIMESTAMP") {
            const val = field.string();
            if (!val) return null;

            const d = new Date(val);
            const pad = n => n.toString().padStart(2, "0");

            const tgl = pad(d.getDate());
            const bln = pad(d.getMonth() + 1);
            const thn = d.getFullYear();

            // kalau ada jam
            const jam = pad(d.getHours());
            const menit = pad(d.getMinutes());
            const detik = pad(d.getSeconds());

            if (field.type === "DATE") {
                return `${tgl}-${bln}-${thn}`; // contoh: 14-01-1990
            } else {
                return `${tgl}-${bln}-${thn} ${jam}:${menit}:${detik}`; // contoh: 01-09-2025 08:30:00
            }
        }
        return next();
    }
});

db.getConnection((err, connection) => {
    if (err) {
        console.error('Database connection failed:', err);
    } else {
        console.log('Connected to MySQL database');
        connection.release();
    }
});

module.exports = db;
