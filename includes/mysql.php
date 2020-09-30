<?php

define('HOST', '***REMOVED***');
define('DB_NAME', 'portail_dpcb');
define('USER', '***REMOVED***');
define('PASS', '***REMOVED***');


try {
    $db = new PDO("mysql:host=" . HOST . ";dbname=" . DB_NAME, USER, PASS);
    $db->exec("set names utf8");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e;
}
