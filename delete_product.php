<?php
include 'connectBD.php';
if (!empty($_POST['id_delete_prod'])) {
    $query_delete_products = "DELETE FROM products WHERE id = " . $_POST['id_delete_prod'];
    /** @var mysqli $openBD */
    $res_del_prod = mysqli_query($openBD, $query_delete_products) or die("ERROR DELETE");
    mysqli_close($openBD);
    header("Location: edit_form.php?receipt_id=" . $_POST['del_receipt_id']);
    exit();
}