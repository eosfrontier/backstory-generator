<?php

require getcwd() . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

if ($_ENV['dev'] == 'true') {
    $jid = "747";
    $jgroups = ["32"];
} else {
    require_once 'SSO.php';
}