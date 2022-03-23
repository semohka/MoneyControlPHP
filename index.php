<?php
const MC_UPLOAD_PATH = 'images/';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Control</title>
    <link type="text/css" rel="stylesheet" href="index.css">
</head>
<body>
<div class="container">
    <a href="shop.php" title="Создать магазин">Новый магазин</a>
    <a href="table.php" title="Просмотр таблицы">Таблица чеков</a>
    <div class="title">Контроль денег</div>
    <!--<img src="images/gold-coin.png" width="100" height="100" alt="тут долждна быть картинка">-->
    <form enctype="multipart/form-data" action="index.php" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="32768">
        <p><b>Введите данные</b></p>
        <?php
        $openBD = mysqli_connect('localhost', 'root', '', 'money_control_php')
        or die('ERROR CONNECTION TO DB');
        $shops_query = 'SELECT * FROM shops';
        $res = mysqli_query($openBD, $shops_query) or die();

        ?>
        <div class="user-details">
            <div class="input-box">
                <span class="product">Товар</span>
                <input type="text" placeholder="Введите наименование товара" required id="product" name="product">
            </div>
            <div class="input-box">
                <span class="shop">Магазин</span>
                <select name="shop" id="shop">
                    <?php while ($row = mysqli_fetch_array($res)) {
                        echo "<option value='" . $row['id'] . "'>" . $row['title'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="input-box">
                <span class="count">Количество</span>
                <input type="text" placeholder="Введите количество" required id="count" name="count">
            </div>
            <div class="input-box">
                <span class="price">Цена</span>
                <input type="text" placeholder="Введите цену" required id="price" name="price">
            </div>
            <div class="input-box">
                <span class="comment">Комментарий</span>
                <textarea id="comment" name="comment"></textarea>
            </div>
            <div class="input-box">
                <span class="screenshot">Фото</span>
                <input type="file" id="screenshot" name="screenshot">
            </div>
        </div>
        <div class="gender-details">
            <input type="radio" id="grade-good" name="grade" value="good">
            <input type="radio" id="grade-normal" name="grade" value="normal">
            <input type="radio" id="grade-bad" name="grade" value="bad">
            <span class="gender-title">Оценка</span>
            <div class="category">
                <label for="grade-good">
                    <span class="good"></span>
                    <span class="grade">Хорошо</span>
                </label>
                <label for="grade-normal">
                    <span class="normal"></span>
                    <span class="grade">Нормально</span>
                </label>
                <label for="grade-bad">
                    <span class="bad"></span>
                    <span class="grade">Плохо</span>
                </label>
            </div>
            <div class="button">
                <input type="submit" value="Сохранить" name="submit">
            </div>
    </form>

    <?php

    if (!empty($_POST['product']) &&
        !empty($_POST['shop']) &&
        !empty($_POST['count']) &&
//        !empty($_POST['grade']) &&
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


        $query = "INSERT INTO receipt(product, shop_id, count, price, grade, comment, date, screenshot)" .
            "VALUES ('$productName', '$shopName', '$countName', '$priceName', '$gradeName', '$commentName', now(), '$target')";
        var_dump($query);
        $result = mysqli_query($openBD, $query) or die("ERROR QUERY");

        header("Location: " . $_SERVER['PHP_SELF']); //отобрази эти страницу еще раз методом гет
        exit;
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {//если форма ушла пустая методом пост
        echo "Error";
}
?>
</div>
</body>
</html>
