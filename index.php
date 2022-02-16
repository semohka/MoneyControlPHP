<?php
const MC_UPLOAD_PATH = 'images/';
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Control</title>
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
<a href="shop.php" title="Создать магазин">Новый магазин</a>
<a href="table.php" title="Просмотр таблицы">Таблица чеков</a>

<h1>Контроль денег</h1>
<img src="images/gold-coin.png" width="100" height="100" alt="тут долждна быть картинка">
<form enctype="multipart/form-data" action="index.php" method="post">
    <input type="hidden" name="MAX_FILE_SIZE" value="32768">
    <p><b>Введите данные</b></p>
    <table>
        <tr>
            <td><label for="product">Товар</label></td>
            <td><input type="text" id="product" name="product"></td>
        </tr>

        <tr>
            <td><label for="shop">Магазин</label></td>
            <td><input type="text" id="shop" name="shop"></td>
        </tr>

        <tr>
            <td><label for="count">Количество</label></td>
            <td><input type="text" id="count" name="count" value="1"></td>
        </tr>

        <tr>
            <td><label for="price">Цена</label></td>
            <td><input type="text" id="price" name="price"/></td>
        </tr>

        <tr>
            <td><label for="grade">Оценка</label></td>
            <td><input type="radio" id="grade" name="grade" value="good">Отлично
                <input type="radio" id="grade" name="grade" value="normal">Нормально
                <input type="radio" id="grade" name="grade" value="bad">Плохо
            </td>
        </tr>

        <tr>
            <td><label for="comment">Комментарий</label></td>
            <td><textarea id="comment" name="comment"></textarea></td>
        </tr>

        <tr>
            <td>Фото чека</td>
            <td><input type="file" id="screenshot" name="screenshot"></td>
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
<?php

if (!empty($_POST['product']) &&
    !empty($_POST['shop']) &&
    !empty($_POST['count']) &&
    !empty($_POST['grade']) &&
    !empty($_POST['comment'])) {

    $productName = $_POST['product'];
    $shopName = $_POST['shop'];
    $countName = $_POST['count'];
    $priceName = $_POST['price'];
    $gradeName = $_POST['grade'];
    $commentName = trim($_POST['comment']);

    if ($_FILES['screenshot']['error'] == 4) {
        $target = null;
    } else {
        $screenshotName = $_FILES['screenshot']['name'];
        $target = MC_UPLOAD_PATH . $screenshotName;
        //    $target = 'images/' . $screenshotName; использование без константы
        move_uploaded_file($_FILES['screenshot']['tmp_name'], $target);
    }

    $openBD = mysqli_connect('localhost', 'root', '', 'money_control_php')
    or die('ERROR CONNECTION TO DB');

    $query = "INSERT INTO receipt(product, shop, count, price, grade, comment, date, screenshot)" .
        "VALUES ('$productName', '$shopName', '$countName', '$priceName', '$gradeName', '$commentName', now(), '$target')";
    var_dump($query);
    $result = mysqli_query($openBD, $query) or die("ERROR QUERY");

    header("Location: " . $_SERVER['PHP_SELF']); //отобрази эти страницу еще раз методом гет
    exit;
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {//если форма ушла пустая методом пост
    echo "Error";
}
?>
</body>
</html>
