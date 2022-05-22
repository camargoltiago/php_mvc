<?php

require 'env.php';

$config = [];

if (LOCAL == 'development') {
    define("BASE_URL", "https://mvc.laragon/");
    $config['dbname'] = 'mvc';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'root';
    $config['dbpass'] = '';
} else {
    define("BASE_URL", "");
    $config['dbname'] = '';
    $config['host']  = '';
    $config['dbuser']  = '';
    $config['dbpass']  = '';
}

global $db;
try {
    $db = new PDO("mysql:dbname=" . $config['dbname'] . ";host=" . $config['host'], $config['dbuser'], $config['dbpass']);
} catch (\PDOException $e) {
    echo $e->getMessage();
    exit;
}
