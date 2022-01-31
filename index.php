<html>
<head>
    <meta charset="utf-8">
    <title>Control</title>
    <h2>Money Control</h2>
</head>

<body>
<form action="index.php" method="post">
    <p><b>Введите данные</b></p>
    <label for="product">Товар</label>
    <input type="text" id="product" name="product"><br>

    <label for="shop">Магазин</label>
    <input type="text" id="shop" name="shop"><br>

    <label for="count">Количество</label>
    <input type="text" id="count" name="count" value="1"><br>

    <label for="price">Цена</label>
    <input type="text" id="price" name="price"/><br>

    <label for="grade">Оценка</label><br>
    <input type="radio" id="grade" name="grade" value="good">Отлично
    <input type="radio" id="grade" name="grade" value="normal">Нормально
    <input type="radio" id="grade" name="grade" value="bad">Плохо<br>

    <label for="comment">Комментарий</label>
    <textarea id="comment" name="comment"></textarea><br>

    <input type="submit" value="Сохранить" name="submit"/>
</form>
<?php

//var_dump($_POST);
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
    $commentName = $_POST['comment'];

    $openBD = mysqli_connect('localhost', 'root', '', 'money_control_php')
    or die('ERROR CONNECTION TO DB');

    $query = "INSERT INTO reseipt(product, shop, count, price, grade, comment, date)" .
        "VALUES ('$productName', '$shopName', '$countName', '$priceName', '$gradeName', '$commentName', now())";

    $result = mysqli_query($openBD, $query)
    or die("ERROR QUERY");
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    echo "Error";
}


?>
</body>
</html>
