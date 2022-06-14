<?php
session_start();
$_SESSION["logged"] = false;
$_SESSION["password"] = "";
header("Location: ../");
?>
