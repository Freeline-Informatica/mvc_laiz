<?php 
require 'environment.php';

global $config;
global $db;

$config = array();
if (ENVIRONMENT == 'development'){
    define('BASE_URL', "http://localhost/php7/estoque_laiz/");
    $config['dbname'] = 'estoque_laiz';
    $config['host'] = '192.168.1.200';
    $config['dbuser'] = 'root';
    $config['dbpass'] = '';
} else {
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $config['dbname'] = 'nova_loja';
    $config['host'] = '192.168.1.200';
    $config['dbuser'] = 'root';
    $config['dbpass'] = '';
}

$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);