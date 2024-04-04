<?php
require 'environment.php';

define("BASE_URL", "http://localhost/php7/mvc_laiz/");

global $config;
$config = array();
if(ENVIRONMENT == 'development') {
    $config['dbname'] = 'mvc_laiz';
    $config['host'] = '192.168.1.200';
    $config['dbuser'] = 'root';
    $config['dbpass'] = '';
} else {
    $config['dbname'] = 'mvc_laiz';
    $config['host'] = '192.168.1.200';
    $config['dbuser'] = 'root';
    $config['dbpass'] = '';
}

global $db;

$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'].';charset=latin1', $config['dbuser'], $config['dbpass'],array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES latin1"));

