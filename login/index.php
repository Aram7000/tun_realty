<?php 
$root_dir = "../";
include "../assets/code/codes.php";
includeAll();
$messages = getMessages();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="<?php echo $root_dir ?>assets/css/sign.css">
</head>
<body>
    <?php
        login_part($root_dir);
    ?>
    
</body>
</html>