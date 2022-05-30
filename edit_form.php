<?php
include 'nav_menu.php';
include 'connectBD.php';

$category_query = 'SELECT * FROM product_categories';
/** @var mysqli $openBD */
$res_category_query = mysqli_query($openBD, $category_query) or die(mysqli_error($openBD));

$query_show = "SELECT products.id as prd_id, product_categories.title as categ_ttl, products.title as prod_ttl, 
       price_of_one, total_price, grade, count, comment, receipt_id, 
       date, shops.title as shp_ttl FROM products 
    INNER JOIN receipts ON (products.receipt_id = receipts.id) 
    INNER JOIN shops ON (receipts.shop_id = shops.id)
    INNER JOIN product_categories ON (products.category_id = product_categories.id) WHERE receipt_id=" . (int)$_GET['receipt_id'];
$result_query_show = mysqli_query($openBD, $query_show) or die(mysqli_error($openBD));

$receipt_id = null;
if (!empty($_GET['receipt_id'])) {
    $receipt_id = $_GET['receipt_id'];
}

$shops_query = "SELECT shops.title as shp_ttl,  date FROM shops 
    INNER JOIN receipts ON (shops.id = receipts.shop_id) 
    WHERE receipts.id=" . (int)$_GET['receipt_id'];
$res_shops_query = mysqli_query($openBD, $shops_query) or die(mysqli_error($openBD));


if (!empty($_POST)) {
    $receipt_id = $_POST['receipt_id'];
    $category = $_POST['category'];
    $product = $_POST['product'];
    $count = $_POST['count'];
    $price_of_one = $_POST['price_of_one'];
    $total_price = $_POST['price_of_one'] * $_POST['count'];
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
$query_sum_price = "SELECT SUM(total_price) as ttl_prc FROM products 
                        INNER JOIN receipts ON (products.receipt_id = receipts.id) 
                        WHERE receipts.id=" . (int)$_GET['receipt_id'];
$res_query_sum_price = mysqli_query($openBD, $query_sum_price) or die(mysqli_error($openBD));


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

        .center {
            margin-left: auto;
            margin-right: auto;
            margin-top: 50px;
        }

        #clickMe {
            /*background: #D8B36E;*/
            /*padding: 20px;*/
            /*text-align: center;*/
            /*width: 205px;*/
            display: block;
            /*border: 2px solid #000;*/
        }

        #picframe {
            /*background: #D8B36E;*/
            /*padding: 20px;*/
            /*width: 205px;*/
            display: none;
            /*border: 2px solid #000;*/
        }
    </style>

    <script src="jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#clickMe").click(function () {
                $("img").fadeIn(1000);
                $("#picframe").slideToggle("slow");
            });
        });
    </script>
</head>
<body>
<h1>Добавление продукта в чек №
    <?= $receipt_id . ", ";
    while ($row = mysqli_fetch_array($res_shops_query)) {
        echo $row['shp_ttl'] . ", ";
        echo $row['date'];
    }
    ?></h1>

<div class="form-center">
    <form action="edit_form.php?receipt_id=" method="post">
        <table>
            <tr>
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
                <td><input type="text" id="product" name="product" placeholder="Введите название" autocomplete="off">
                </td>
            </tr>
            <tr>
                <td><label for="count">Количество</label></td>
                <td><input type="text" id="count" name="count" placeholder="Введите число" autocomplete="off"></td>
            </tr>
            <tr>
                <td><label for="price_of_one">Цена за штуку</label></td>
                <td><input type="text" id="price_of_one" name="price_of_one" placeholder="Введите число"
                           autocomplete="off"></td>
            </tr>
            <tr>
                <td><label for="comment">Комментарий</label></td>
                <td><input type="text" id="comment" name="comment" placeholder="Коммент" autocomplete="off"></td>
            </tr>
            <tr>
                <td><label for="grade">Оценка</label></td>
                <td><label for="grade">Отлично</label>
                    <input type="radio" id="grade-good" name="grade" value="good"><br>
                    <label for="grade">Нормально</label>
                    <input type="radio" id="grade-normal" name="grade" value="normal"><br>
                    <label for="grade">Плохо</label>
                    <input type="radio" id="grade-bad" name="grade" value="bad"></td>
            </tr>
        <tr>
            <td><label for="screenshot">Фото</label></td>
            <td><input type="file" id="screenshot" name="screenshot"></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
            <tr>
                <td><input type="submit" value="Сохранить" name="submit"/></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
        </table>
    </form>
</div>


<table class="center">
    <tr>
        <th>ИТОГО</th>
    </tr>

    <?php
    while ($row = mysqli_fetch_assoc($res_query_sum_price)) {
        echo "<tr>";
        echo "<td>", $row['ttl_prc'], " ₽</td>";
        echo "</tr>";
    }
    ?>

</table>

<table class="center" border="1">
    <tr>
        <th>Категория</th>
        <th>Продукт</th>
        <th>Цена за штуку, ₽</th>
        <th>Общая цена, ₽</th>
        <th>Количесво</th>
        <th>Оценка</th>
        <th>Комментарий</th>
    </tr>

    <?php
    while ($row = mysqli_fetch_array($result_query_show)) {
        echo "<tr>";
        echo "<td>", $row['categ_ttl'], "</td>";
        echo "<td>", $row['prod_ttl'], "</td>";
        echo "<td>", $row['price_of_one'], "</td>";
        echo "<td>", $row['total_price'], "</td>";
        echo "<td>", $row['count'], "</td>";
        echo "<td>", $row['grade'], "</td>";
        echo "<td>", $row['comment'], "</td>";
        echo "<td>";
        echo "<form method='post' action='delete_product.php'>";
        echo "<input type='hidden' value='" . $row['prd_id'] . "' name='id_delete_prod'>";
        echo "<input type='hidden' value='" . $row['receipt_id'] . "' name='del_receipt_id'>";
        echo "<input type='submit' value='Удалить' name='submit'/>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    ?>

</table>
<div id="clickMe">Показать фото чека</div>
<div id="picframe">
    <img src="images/srisovki.jpg">
</div>
</body>
</html>