<?php

$cache = new Memcached();
$cache->addServer('host.docker.internal', 11311);
$cache->set('string', "Some string");

var_dump($cache->get('string'));

session_start();

if (isset($_GET['name'])) {
    $_SESSION['myName'] = $_GET['name'];
}

If (isset($_SESSION['myName'])) {
    echo "Привет ".$_SESSION['myName']."<br>";
    echo "Session save path = ".session_save_path()."<br>";
    echo "Session save handler = ".ini_get("session.save_handler");
}