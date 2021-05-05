<?php

require('environment.php');

define('DIRPAGE',"http://{$_SERVER['HTTP_HOST']}/humbleprice/");

// Global folders
define('DIRIMG', DIRPAGE."public/img/");
define('DIRCSS', DIRPAGE."public/css/");
define('DIRJS', DIRPAGE."public/js/");
define('DIRVID', DIRPAGE."public/video/");
define('DIRAUD', DIRPAGE."public/audio/");
define('DIRFONT', DIRPAGE."public/font/");
define('DIRDESIGN', DIRPAGE."public/design/");

// Database connection
$config = [];

if (ENVIRONMENT == 'development') {
    global $config;
    $config['dbname'] = 'Humbleprice';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'root';
    $config['dbpass'] = '';
} else {
    $config['dbname'] = 'Humbleprice';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'root';
    $config['dbpass'] = '';
}
