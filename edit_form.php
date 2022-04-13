<?php
$openBD = mysqli_connect('localhost', 'root', '', 'money_control_php')
or die('ERROR CONNECTION TO DB');
$category_query = 'SELECT * FROM product_categories';
$res_category_query = mysqli_query($openBD, $category_query) or die();
?>
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
<h1>ДОБАВЛЕНИЕ ПРОДУКТА В ЧЕК</h1>
<form action="edit_form.php" method="post">
    <p><b>Введите данные</b></p>
    <table>
        <tr>
            <?php
            $receipt_id = null;
            if (!empty($_GET['receipt_id'])) {
                $receipt_id = $_GET['receipt_id'];
            }
            var_dump($_GET);
            ?>
            <td>
                <input type="hidden" name="receipt_id" value="<?= $receipt_id ?>"/>
            </td>
        </tr>
        <tr>
            <td><label for="category">Категория</label></td>
            <td><select name="category" id="category">
                <?php while ($row = mysqli_fetch_array($res_category_query)) {
                    echo "<option value='" . $row['id'] . "'>" . $row['title'] . "</option>";
                }
                ?></td>
        </tr>
        <tr>
            <td><label for="product">Товар</label></td>
            <td><input type="text" id="product" name="product"></td>
        </tr>
        <tr>
            <td><label for="count">Количество</label></td>
            <td><input type="text" id="count" name="count"></td>
        </tr>
        <tr>
            <td><label for="price_of_one">Цена за штуку</label></td>
            <td><input type="text" id="price_of_one" name="price_of_one"></td>
        </tr>
        <tr>
            <td><label for="total_price">Цена за все количество</label></td>
            <td><input type="text" id="total_price" name="total_price"></td>
        </tr>
        <tr>
            <td><label for="comment">Комментарий</label></td>
            <td><input type="text" id="comment" name="comment"></td>
        </tr>
        <tr>
            <td><label for="grade">Оценка</label></td>
            <td><input type="radio" id="grade-good" name="grade" value="good">
                <input type="radio" id="grade-normal" name="grade" value="normal">
                <input type="radio" id="grade-bad" name="grade" value="bad"></td>
        </tr>
        <tr>
            <td><label for="screenshot">Фото</label></td>
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

    <?php
    if (!empty($_POST)) {
        $receipt_id = $_POST['receipt_id'];
        $category = $_POST['category'];
        $product = $_POST['product'];
        $count = $_POST['count'];
        $price_of_one = $_POST['price_of_one'];
        $total_price = $_POST['total_price'];
        $grade = $_POST['grade'];
        $comment = $_POST['comment'];
        $screenshot = $_POST['screenshot'];

        $query_save = "INSERT INTO products 
    (receipt_id, category_id, title, count, price_of_one, total_price, grade, comment, screenshot)
    VALUE ('$receipt_id', '$category', '$product','$count', '$price_of_one', '$total_price', '$grade', '$comment', '$screenshot')";
        $result_save = mysqli_query($openBD, $query_save) or die(mysqli_error($openBD));
        header("Location: edit_form.php?receipt_id=$receipt_id"); //отобрази эти страницу еще раз методом гет

        exit;
    }
    ?>


    <?php
    $openBD = mysqli_connect('localhost', 'root', '', 'money_control_php')
    or die('ERROR CONNECTION TO DB');
    $query_show = "SELECT product_categories.title as categ_ttl, products.title as prod_ttl, 
       price_of_one, total_price, grade, count, comment, receipt_id, 
       date, shops.title as shp_ttl FROM products 
    INNER JOIN receipts ON (products.receipt_id = receipts.id) 
    INNER JOIN shops ON (receipts.shop_id = shops.id)
    INNER JOIN product_categories ON (products.category_id = product_categories.id) WHERE receipt_id=" . (int)$_GET['receipt_id'];
    $result_query_show = mysqli_query($openBD, $query_show) or die();

    ?>
    <table class="center" border="1">
        <tr>
            <th>id чека</th>
            <th>Категория</th>
            <th>Продукт</th>
            <th>Магазин</th>
            <th>Цена за штуку</th>
            <th>Общая цена</th>
            <th>Количесво</th>
            <th>Оценка</th>
            <th>Комментарий</th>
            <th>Дата</th>
        </tr>

        <?php
        while ($row = mysqli_fetch_array($result_query_show)) {
            echo "<tr>";
            echo "<td>", $row['receipt_id'], "</td>";
            echo "<td>", $row['categ_ttl'], "</td>";
            echo "<td>", $row['prod_ttl'], "</td>";
            echo "<td>", $row['shp_ttl'], "</td>";
            echo "<td>", $row['price_of_one'], "</td>";
            echo "<td>", $row['total_price'], "</td>";
            echo "<td>", $row['count'], "</td>";
            echo "<td>", $row['grade'], "</td>";
            echo "<td>", $row['comment'], "</td>";
            echo "<td>", $row['date'], "</td>";
            echo "</tr>";
        }
        ?>

    </table>
    <a href="index.php">Вернуться обратно</a>
</body>
</html>