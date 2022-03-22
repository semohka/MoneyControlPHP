<?php
const MC_UPLOAD_PATH = 'images/';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Control</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
            padding: 10px;
            background: linear-gradient(135deg, #128342, #baae1e);
            /*background-color: gainsboro;*/
            /*margin-left: 10%;*/
            /*!*margin-top: 10%;*!*/
            /*font-family: sans-serif;*/
        }

        .container {
            max-width: 700px;
            width: 100%;
            background: #fff;
            padding: 25px 30px;
            border-radius: 5px;
        }

        .container .title {
            font-size: 25px;
            font-weight: 500;
            position: relative;
        }

        .container .title::before {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            height: 3px;
            width: 30px;
            background: linear-gradient(135deg, #128342, #baae1e);
        }

        .container form .user-details {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin: 20px 0 12px 0;
        }

        form .user-details .input-box {
            margin-bottom: 15px;
            width: calc(100% / 2 - 20px);
        }

        /*.user-details .input-box .details {*/
        /*    display: block;*/
        /*    font-weight: 500;*/
        /*    margin-bottom: 5px;*/
        /*}*/
        .user-details .input-box .product,
        .user-details .input-box .shop,
        .user-details .input-box .count,
        .user-details .input-box .price,
        .user-details .input-box .comment,
        .user-details .input-box .screenshot {
            display: block;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .user-details .input-box input {
            height: 25px;
            width: 100%;
            outline: none;
            border-radius: 5px;
            border: 1px solid #ccc;
            padding-left: 15px;
            font-size: 16px;
            border-bottom-width: 2px;
            transition: all 0.3s ease;
        }

        .user-details .input-box input:focus,
        .user-details .input-box input:valid {
            border-color: #baae1e;
        }

        form .gender-details .gender-title {
            font-size: 20px;
            font-weight: 500;
        }

        form .gender-details .category {
            display: flex;
            width: 80%;
            margin: 14px 0;
            /*background: burlywood;*/
            justify-content: space-between;
        }

        .gender-details .category label {
            display: flex;
            align-items: center;
        }

        /*.gender-details .category .dot {*/
        /*    height: 18px;*/
        /*    width: 18px;*/
        /*    background: gray;*/
        /*    border-radius: 50%;*/
        /*    margin-right: 10px;*/
        /*    border: 5px solid transparent;*/
        /*    transition: all 0.3s ease;*/
        /*}*/
        .gender-details .category .grade {
            height: 18px;
            width: 18px;
            background: gray;
            border-radius: 50%;
            margin-right: 10px;
            border: 5px solid transparent;
            transition: all 0.3s ease;
        }

        /*#dot-1:checked ~ .category label .one,*/
        /*#dot-2:checked ~ .category label .two,*/
        /*#dot-3:checked ~ .category label .three {*/
        /*    border-color: #128342;*/
        /*    background: #baae1e;*/
        /*}*/
        #grade-good:checked ~ .category label .good,
        #grade-normal:checked ~ .category label .normal,
        #grade-bad:checked ~ .category label .bad {
            border-color: #128342;
            background: #baae1e;
        }

        form input[type="radio"] {
            display: none;
        }

        form .button {
            height: 45px;
            margin: 45px 0;
        }

        form .button input {
            height: 100%;
            width: 100%;
            outline: none;
            color: #fff;
            border: none;
            font-size: 18px;
            font-weight: 500;
            border-radius: 5px;
            letter-spacing: 1px;
            background: linear-gradient(135deg, #128342, #baae1e);
        }

        form .button input:hover {
            background: linear-gradient(-135deg, #128342, #baae1e);
        }

        @media (max-width: 584px) {
            .container {
                max-width: 100%;
            }

            form .user-details .input-box {
                margin-bottom: 15px;
                width: 100%;
            }

            form .gender-details .category {
                width: 100%;
            }

            .container form .user-details {
                max-width: 300px;
                overflow-y: scroll;
            }
        }
    </style>
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
                <input type="text" placeholder="Введите количество" required id="count" name="count" value="1">
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
