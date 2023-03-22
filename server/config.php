<?php
session_start();
define('DBHOST', 'localhost');
//define('DBHOST', 'ourownserver.com:3306');

// The database name given by your Database Administrator
define('DBNAME', 'NAZIV_BAZE');

// update with your own Database user account
define('DBUSERNAME', 'KORISNICKO_IME');
define('DBPASSWORD', 'LOZINKA');
//
$con = mysqli_connect(DBHOST, DBUSERNAME, DBPASSWORD, DBNAME);
$con->set_charset('utf8');
// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
define('ADMINPASSWORD', 'LOZINKA_ZA_UI');