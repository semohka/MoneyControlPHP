<?php
include 'connectBD.php';
if (!empty($_POST['id_delete'])) {
    $q = "DELETE FROM receipts WHERE id = " . $_POST['id_delete'];
    /** @var mysqli $openBD */
    $res = mysqli_query($openBD, $q) or die("ERROR DELETE");
    $query_delete_products = "DELETE FROM products WHERE receipt_id = " . $_POST['id_delete'];
    $res_del_prod = mysqli_query($openBD, $query_delete_products) or die("ERROR DELETE");
    mysqli_close($openBD);
    header("Location: table_receipts.php");
    exit();
}


