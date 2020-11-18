<?php

require('environment.php');

define('DIRPAGE',"http://{$_SERVER['HTTP_HOST']}/");

// Global folders
define('DIRIMG', DIRPAGE."img/");
define('DIRCSS', DIRPAGE."css/");
define('DIRJS', DIRPAGE."js/");
define('DIRVID', DIRPAGE."video/");
define('DIRAUD', DIRPAGE."audio/");
define('DIRFONT', DIRPAGE."font/");
define('DIRDESIGN', DIRPAGE."design/");

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