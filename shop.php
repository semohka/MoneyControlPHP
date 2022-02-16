<html>
<head>
    <style>
        body {
            background-color: gainsboro;
            margin-left: 10%;
            /*margin-top: 10%;*/
            font-family: sans-serif;
        }
    </style>
</head>
<body>
<h1>Таблица магазинов</h1>
<form action="shop.php" method="post">
    <p><b>Введите данные</b></p>
    <table>
        <tr>
            <td><label for="shop">Магазин</label></td>
            <td><input type="text" id="shop" name="shop"></td>
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
<a href="index.php">Вернуться обратно</a>

<?php
if (!empty($_POST['shop'])) {
    $shopName = $_POST['shop'];
    $openBD = mysqli_connect('localhost', 'root', '', 'money_control_php')
    or die('ERROR CONNECTION TO DB');
    $query = "INSERT INTO shops(title)" .
        "VALUES ('$shopName')";

    $result = mysqli_query($openBD, $query) or die("ERROR QUERY");

    header("Location: " . $_SERVER['PHP_SELF']); //отобрази эту же страницу еще раз только методом гет
    exit;
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {//если форма ушла пустая методом пост
    echo "Error";
}


?>
</body>
</html>
