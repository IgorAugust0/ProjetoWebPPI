<?php
session_start();
require "conexaoMysql.php";

if (!isset($_SESSION['loggedIn'])) {
    header("location: ../pages/conta.html");
    exit();
}

$email = $_SESSION['user'];

?>
