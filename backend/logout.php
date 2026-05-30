<?php
session_start();
$_SESSION = array();
session_destroy();

// Redirect ke halaman login.php
header("Location: login.php");
exit();
