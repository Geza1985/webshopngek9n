<?php
session_start();
include_once("core/config.php");

$page = $_GET['page'] ?? 'home';
$contentFile = $pages[$page] ?? $pages['home'];

include("templates/header.php");
include($contentFile);
include("templates/footer.php");
?>
