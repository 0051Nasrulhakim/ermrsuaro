<?php
if (isset($_GET['tabel'])) {
    $tabel = basename($_GET['tabel']); // sanitasi biar aman
    $path_file = __DIR__ . '/../component/section/' . $tabel . '.php';

    if (file_exists($path_file)) {
        include $path_file; // hanya load isi
    } else {
        echo "<p>File section <b>{$tabel}.php</b> tidak ditemukan.</p>";
    }
} else {
    echo "<p>Parameter 'tabel' tidak ada.</p>";
}
