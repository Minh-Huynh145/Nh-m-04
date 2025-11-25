<?php
// functions.php - shared utilities and DB connection
// Edit the DB credentials below to match your phpMyAdmin / MySQL settings.

$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = ''; // <-- set your MySQL root password if any
$DB_NAME = 'quanlyquan';

// create mysqli connection
function db_connect(){
    global $DB_HOST, $DB_USER, $DB_PASS, $DB_NAME;
    $mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
    if ($mysqli->connect_errno) {
        die('Connect Error: ' . $mysqli->connect_error);
    }
    // set utf8
    $mysqli->set_charset('utf8mb4');
    return $mysqli;
}

// start session if not started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// check if current user is admin
function is_admin() {
    return isset($_SESSION['username']) && $_SESSION['username'] === 'admin';
}

// redirect helper
function redirect($url){
    header('Location: ' . $url);
    exit;
}
?>