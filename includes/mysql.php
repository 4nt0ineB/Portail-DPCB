<?php

define('HOST', '51.210.15.73');
define('DB_NAME', 'portail_dpcb');
define('USER', 'uge4');
define('PASS', 'scrum77');


try {
    $db = new PDO("mysql:host=" . HOST . ";dbname=" . DB_NAME, USER, PASS);
    $db->exec("set names utf8");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e;
}
