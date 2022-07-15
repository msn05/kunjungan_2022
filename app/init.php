<?php
error_reporting(0);

if (!session_id()) session_start();
require_once __DIR__ . '/../vendor/autoload.php';
// require_once __DIR__ . '/../app/init.php';
define('Controller', 'http://localhost/kunjungan_inspektorat_prov/');
define('DOC_ROOT', 'http://localhost/kunjungan_inspektorat_prov/public');
define('Vendor', 'http://localhost/kunjungan_inspektorat_prov/vendor/');

use Core\Core;

$app = new Core;
// $app::parseUrl();
