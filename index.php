<?php
require __DIR__.'/bootstrap.php';
// Some development servers route unknown paths to index.php; do not disguise missing endpoints.
if (!empty($_SERVER['PATH_INFO'])) { http_response_code(404); exit; }
$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
if (!str_ends_with($path, '/') && basename($path) !== 'index.php') { http_response_code(404); exit; }
header('Location: pm_landing_pg.php');
exit;
