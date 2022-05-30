<?php
include 'nav_menu.php';
include 'connectBD.php';
$shops_query = 'SELECT * FROM shops';
/** @var mysqli $openBD */
$res_shops_query = mysqli_query($openBD, $shops_query) or die();
?>
<html>
<head>
    <style>
        body {
            font-family: Verdana, Geneva, Arial, sans-serif;
            font-size: small;
            text-align: center;
        }

        h1 {
            color: #cc6600;
            border-bottom: thin dotted #888888;
            font-family: "Emblema One", sans-serif;
            font-size: 220%;
        }

        .form-center {
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
<h1>Создать новый чек</h1>
<div class="form-center">
    <form action="receipt.php" method="post">
        <table>
            <tr>
                <td><label for="shop">Магазин</label></td>
                <td><select name="shop" id="shop">
                    <?php while ($row = mysqli_fetch_array($res_shops_query)) {
                    echo "<option value='" . $row['id'] . "'>" . $row['title'] . "</option>";
                }
                ?></td>
        </tr>
        <tr>
            <td><label for="date">Дата</label></td>
            <td><input type="datetime-local" id="date" name="date"></td>
        </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="submit" value="Сохранить" name="submit"/></td>
            </tr>
        </table>
    </form>
</div>
<?php
if (!empty($_POST['shop']) &&
    !empty($_POST['date'])) {

    $shopName = $_POST['shop'];
    $dateName = $_POST['date'];
    $openBD = mysqli_connect('localhost', 'root', '', 'money_control_php')
    or die('ERROR CONNECTION TO DB');
    $query = "INSERT INTO receipts(shop_id, date)" .
        "VALUES ('$shopName', '$dateName')";

    $result = mysqli_query($openBD, $query) or die("ERROR QUERY");

    header("Location: " . $_SERVER['PHP_SELF']); //отобрази эту же страницу еще раз только методом гет
    exit;
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {//если форма ушла пустая методом пост
    echo "Error";
}
?>
</body>
</html>
