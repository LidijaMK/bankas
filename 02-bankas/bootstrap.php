<?php
// pagrindiniai settingai, nustatymai, bendri kintamieji visam kodui
defined('ENTER') || die;
require __DIR__ .'/vendor/autoload.php';
session_start();
define('DIR', __DIR__ . '/');
// define('URL', 'http://localhost/bankas/02-bankas/public/');
define('URL', 'http://bankas.com/');
// define('INSTALL_DIR', '/bankas/02-bankas/public/');
define('INSTALL_DIR', '/');