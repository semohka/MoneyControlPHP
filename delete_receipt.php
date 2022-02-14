<?php
if (!empty($_POST['id'])) {
    $openBD = mysqli_connect('localhost', 'root', '', 'money_control_php')
    or die('ERROR CONNECTION TO DB');
    $q = "DELETE FROM receipt WHERE productId = " . $_POST['id'];
    $res = mysqli_query($openBD, $q) or die("ERROR DELETE");
    mysqli_close($openBD);
    header("Location: table.php");
    exit();
}


