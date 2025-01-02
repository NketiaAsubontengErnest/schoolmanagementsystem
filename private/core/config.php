<?php
$server = $_SERVER['SERVER_NAME'];
$scheme = $_SERVER['REQUEST_SCHEME'];

define('ROOT', "$scheme://$server/schoolmanagementsystem/public");
define('ASSETS', "$scheme://$server/schoolmanagementsystem/public/assets");
define('HOME', "$scheme://$server/schoolmanagementsystem");
define('HOMEASSET', "$scheme://$server/schoolmanagementsystem/public/homeasset");

/*

define('ROOT', "$scheme://$server/public");
define('ASSETS', "$scheme://$server/public/assets");
define('HOME', "$scheme://$server");
define('HOMEASSET', "$scheme://$server/public/homeasset");

//database variables

define('DBHOST','localhost');
define('DBNAME','emmanzag_schoolmanagement');
define('DBUSER','emmanzag_root');
define('DBPASS','0554013980Aa@');
define('DBDRIVER','mysql');
 */

define('DBHOST','localhost');
define('DBNAME','schmanagement');
define('DBUSER','root');
define('DBPASS','0554013980A@');
define('DBDRIVER','mysql');
define('COMPANY','EMMANUEL ACADEMY');