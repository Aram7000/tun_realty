
<?php
$OPSENCONSOLE = true;
if ($OPSENCONSOLE) {
    if (isset($_POST["XXX"]) && $_POST["XXX"] == "CheLurj___" && isset($_POST["XXXX"]) && $_POST["XXXX"] == "") {
        include "./consoleCode.php";
    } else {
        ?>
            <form action="console.php" method="post">
                <input type="text" name="XXX">
                <input type="password" name="XXXX">
                <input type="submit" value="Enter">
            </form>
        <?php
    }
} else {
    header("Location: ../");
}
?>