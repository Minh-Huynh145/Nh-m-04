<?php
// logout.php - thoát đăng nhập
require_once 'functions.php';
session_unset();
session_destroy();
redirect('index.php');
?>