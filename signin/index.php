<?php 
$root_dir = "../";
include "../assets/code/codes.php";
session_start();
if (isset($_SESSION["logged"]) && $_SESSION["logged"]) {
    header("Location: ../");
}
includeAll();
$messages = getMessages();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../Neon(c)/require.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/sign.css">
</head>
<body>
    <main>
        <?php
        signin_part($root_dir);
        ?> 
    </main>
</body>
</html>