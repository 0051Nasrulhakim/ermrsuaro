<?php
// Tentukan halaman default
$page = $_GET['page'] ?? 'dashboard';

// File target berdasarkan folder page/
$file = __DIR__ . "/page/" . $page . ".php";

// Header
include __DIR__ . "/template/header.php";

// Routing
if (file_exists($file)) {
    include $file;
} else {
    include __DIR__ . "/page/404.php";
}

// Footer
include __DIR__ . "/template/footer.php";
